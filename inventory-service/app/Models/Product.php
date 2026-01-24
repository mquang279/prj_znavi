<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = "products";
    
    protected $fillable = ['id', 'name', 'price', 'created_at', 'updated_at'];

    public function stock(): HasOne {
        return $this->hasOne(Stock::class);
    }

    public function StockReservationItems(): HasMany {
        return $this->hasMany(StockReservationItem::class);
    }
}
