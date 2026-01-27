<?php
namespace App\Repositories\Interfaces;

use App\Models\Bill;

interface BillRepository{
    public function createBill(array $data):Bill;
    public function findById(string $id):?Bill;
    public function findAll();
    public function delete(Bill $bill):void;
}
