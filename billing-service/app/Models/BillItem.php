<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BillItem extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'bill_items';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'bill_id',
        'product_id',
        'qty',
        'unitPrice',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id', 'id');
    }
}
