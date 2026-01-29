<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdjustStockRequest;
use App\Services\StockService;

class StockController extends Controller
{
    private StockService $stockService;

    public function __construct(StockService $stockService) {
        $this->stockService = $stockService;
    }

    public function adjustStock(AdjustStockRequest $request, string $id) {
        $stock = $this->stockService->adjustStock($id, $request->delta);
        return response()->json($stock, 200);
    }
}
