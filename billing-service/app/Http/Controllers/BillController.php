<?php
namespace App\Http\Controllers;

use App\Http\Requests\BillRequest;
use App\Services\Interface\BillService;

class BillController extends Controller{
    protected $billService;
    public function __construct(BillService $billService)
    {
        $this->billService = $billService;
    }

    public function getBills(){
        return $this->billService->getAll();
    }

    public function create(BillRequest $request)
    {
        return response()->json(
            $this->billService->createBill($request->validated()['items']),
            201
        );
    }
}
