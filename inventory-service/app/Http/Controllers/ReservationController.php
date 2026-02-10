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

    public function reserve(Request $request, CreateReservationRequest $data) {
        $reservation = $this->reservationService->reserve($data->validated(), $request->header('x-request-id'));
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
