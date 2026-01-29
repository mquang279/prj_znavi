<?php

namespace App\Services;

use App\Repositories\ReservationRepository;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class ReservationService
{
    private ReservationRepository $reservationRepository;
    private StockService $stockService;

    public function __construct(
        ReservationRepository $reservationRepository,
        StockService $stockService
    ) {
        $this->reservationRepository = $reservationRepository;
        $this->stockService = $stockService;
    }

    public function reserve(array $data, string $requestId)
    {
        return DB::transaction(function () use ($data, $requestId) {
            $billId = $data['billId'];
            $ttl = $data['ttlSeconds'];
            $items = $data['items'];

            $reservation = $this->reservationRepository->save([
                "request_id" => $requestId,
                "bill_id" => $billId,
                "status" => "RESERVED",
                "expired_at" => date('Y-m-d H:i:s', time() + $ttl),
            ]);

            foreach ($items as $item) {
                $itemData = (array) $item;
                $productId = $itemData['productId'];
                $qty = $itemData['qty'];

                $this->stockService->adjustStock($productId, -1 * abs($qty));

                $reservation->StockReservationItems()->create([
                    'product_id' => $productId,
                    'qty' => $qty
                ]);
            }

            return $reservation;
        });
    }

    public function commit(int $id)
    {

    }

    public function release(int $id)
    {

    }
}
