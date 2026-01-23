<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    protected $table = "stock";
    
    protected $fillable = ["product_id", "available_qty", "updated_at"];

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
