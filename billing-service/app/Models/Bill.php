<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bill extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'bills';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'status',
        'total_amount',
        'reservation_id',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function items()
    {
        return $this->hasMany(BillItem::class, 'bill_id', 'id');
    }
}
