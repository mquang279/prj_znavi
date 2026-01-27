<?php

namespace App\Inventory;

use App\Exceptions\InventoryException;
use Carbon\Carbon;
use Illuminate\Support\Str;

class InventoryClient
{
    public function reserve(array $payload, string $requestId): array
    {
        // giả lập thiếu hàng nếu qty > 5
        foreach ($payload['items'] as $item) {
            if ($item['qty'] > 5) {
                throw new InventoryException(
                    'INSUFFICIENT_STOCK',
                    'Not enough stock',
                    [
                        'items' => [
                            [
                                'productId' => $item['productId'],
                                'requested' => $item['qty'],
                                'available' => 5,
                            ]
                        ]
                    ]
                );
            }
        }

        return [
            'reservationId' => 'RSV_' . Str::uuid(),
            'requestId' => $requestId,
            'billId' => $payload['billId'],
            'status' => 'RESERVED',
            'expireAt' => Carbon::now()->addSeconds($payload['ttlSeconds'])->toISOString(),
        ];
    }

    public function commit(string $requestId){
        return [
          'requestId' => $requestId,
          'billId' => 'billId',
          'status' => 'CONFIRMED',
        ];
    }
}
