<?php
namespace App\Repositories;

use App\Models\BillItem;
use App\Repositories\Interfaces\BillItemRepository;

class BillItemRepositoryImpl implements BillItemRepository {
    public function create(array $data){
        return BillItem::create($data);
    }
}
