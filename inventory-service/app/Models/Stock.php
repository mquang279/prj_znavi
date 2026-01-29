<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    protected $table = "stocks";

    protected $fillable = ["product_id", "available_qty"];

    protected $keyType = 'string';

    protected $primaryKey = 'product_id';

    public $incrementing = false;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
