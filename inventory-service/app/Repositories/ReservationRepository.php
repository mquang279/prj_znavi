<?php

namespace App\Repositories;

use App\Models\StockReservation;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function getAll() {
        return StockReservation::all();
    }

    public function find(string $id) {
        return StockReservation::find($id);
    }

    public function save(array $data) {
        return StockReservation::create($data);
    }
}
