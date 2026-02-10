<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll()
    {
        return Product::paginate(15);
    }

    public function find(string $id)
    {
        return Product::find($id);
    }

    public function save(array $data)
    {
        return Product::create($data);
    }

    public function delete(Product $product)
    {
        $product->delete();
    }
}