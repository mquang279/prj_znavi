<?php

namespace App\Repositories;

use App\Models\Stock;

class StockRepository implements StockRepositoryInterface
{
    public function getAll()
    {
        return Stock::all();
    }

    public function find(string $id)
    {
        return Stock::find($id);
    }

    public function create(array $data)
    {
        return Stock::create($data);
    }
}