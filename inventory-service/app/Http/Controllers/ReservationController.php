<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationRequest;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReservationController
{
    private ReservationService $reservationService;

    public function __construct(ReservationService $reservationService) {
        $this->reservationService = $reservationService;
    }

    public function reserve(CreateReservationRequest $data) {
        $reservation = $this->reservationService->reserve($data->validated(), "a9ac5745-cd7e-445d-96f3-9d0bb78f24e0");
        return response()->json($reservation, 201);
    }

    public function commit(string $id) {
        $reservation = $this->reservationService->commit($id);
        return response()->json($reservation, 200);
    }

    public function release(string $id) {
        $reservation = $this->reservationService->release($id);
        return response()->json($reservation, 200);
    }
}
