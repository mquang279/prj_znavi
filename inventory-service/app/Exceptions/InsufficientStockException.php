<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InsufficientStockException extends Exception
{
    public array $items;

    public function __construct(array $items)
    {
        parent::__construct('Not enough stock for some items');
        $this->items = $items;
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'error' => [
                'code' => 'INSUFFICIENT_STOCK',
                'message' => $this->getMessage(),
                'details' => [
                    'items' => $this->items,
                ],
            ],
            'requestId' => $request->header('X-Request-Id')
        ], 409);
    }
}
