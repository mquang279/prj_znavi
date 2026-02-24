<?php
namespace App\Http\Controllers;

use App\Http\Requests\BillRequest;
use App\Services\Interface\BillService;
use Illuminate\Foundation\Http\FormRequest;

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
            $this->billService->createBill($request->validated()['items'],$request->headers->get('x-request-id')),
            201
        );
    }

    public function confirm(string $id,FormRequest $request)
    {
        return response()->json(
            $this->billService->confirmBill($id,$request->headers->get('x-request-id')),200
        );
    }
}
