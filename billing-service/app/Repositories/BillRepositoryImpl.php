<?php
namespace App\Repositories;

use App\Models\Bill;
use App\Repositories\Interfaces\BillRepository;

class BillRepositoryImpl implements BillRepository {
    public function createBill(array $data):Bill{
        return Bill::create($data);
    }
    public function findById(string $id):?Bill{
        return Bill::where('id',$id)
                    ->first();
    }
    public function findAll(){
        return Bill::all();
    }
    public function delete(Bill $bill):void{
        $bill->BillItems()->delete();
        $bill->delete();
    }
}
