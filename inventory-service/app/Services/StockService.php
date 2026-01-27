<?php

namespace App\Services;

use App\Models\Stock;
use App\Repositories\StockRepository;
use Illuminate\Support\Facades\DB;

class StockService
{
    private StockRepository $stockRepository;

    public function adjustStock(string $productId, int $delta) {
        if ($delta === 0) {
            return null;
        }

        return DB::transaction(function () use ($productId, $delta) {
            $stock = Stock::where('product_id', $productId)
                ->lockForUpdate()
                ->firstOrFail();

            if ($delta < 0 && $stock->available_qty < abs($delta)) {
                throw new \RuntimeException('Not enough stock');
            }

            $stock->available_qty += $delta;
            $stock->save();

            return $stock->refresh();
        });
    }
}
