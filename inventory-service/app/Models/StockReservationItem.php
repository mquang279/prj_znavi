<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockReservationItem extends Model
{
    protected $table = "stock_reservation_items";

    protected $fillable = ["reservation_id", "product_id", "qty"];

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = null;

    public function StockReservation(): BelongsTo
    {
        return $this->belongsTo(StockReservation::class, 'reservation_id');
    }

    public function Product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
