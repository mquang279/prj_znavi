<?php

namespace App\Repositories;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAll();

    public function find(string $id);

    public function save(array $data);

    public function delete(Product $product);
}
