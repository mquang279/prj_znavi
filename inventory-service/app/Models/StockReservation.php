<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class StockReservation extends Model
{
    protected $table = "stock_reservations";

    protected $fillable = ["id", "request_id", "bill_id", "status", "expired_at", "created_at", "updated_at"];

    protected $keyType = 'string';

    public $incrementing = false;

    public function StockReservationItems(): HasMany
    {
        return $this->hasMany(StockReservationItem::class, 'reservation_id');
    }

    public static function booted()
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (String) Str::uuid();
            }
        });
    }
}
