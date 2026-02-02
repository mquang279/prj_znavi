<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $table = "products";
    protected $fillable = ['id', 'name', 'price', 'description', 'image_url', 'created_at', 'updated_at'];
    protected $keyType = 'string';
    public $incrementing = false;

    public function stock(): HasOne
    {
        return $this->hasOne(Stock::class);
    }

    public function StockReservationItems(): HasMany
    {
        return $this->hasMany(StockReservationItem::class);
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
