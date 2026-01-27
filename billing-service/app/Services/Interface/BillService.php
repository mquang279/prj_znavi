<?php
namespace App\Services\Interface;

use App\Models\Bill;

interface BillService{
    public function createBill(array $data);
    public function getAll();
    public function getBill(string $id);
}