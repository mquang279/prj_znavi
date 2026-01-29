<?php

namespace App\Repositories;

interface StockRepositoryInterface
{
    public function getAll();

    public function find(string $id);

    public function create(array $data);
}