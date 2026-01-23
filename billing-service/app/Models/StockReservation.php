<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockReservation extends Model
{
    protected $table = "stock_reservations";

    protected $fillable = ["id", "request_id", "bill_id", "status", "expired_at", "created_at", "updated_at"];

    public function StockReservationItems(): HasMany {
        return $this->hasMany(StockReservationItem::class);
    }
}
