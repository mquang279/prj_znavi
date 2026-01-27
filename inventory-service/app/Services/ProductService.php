<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Repositories\StockRepository;
use Illuminate\Support\Facades\DB;

class ProductService
{
    private ProductRepository $productRepository;
    private StockRepository $stockRepository;

    public function __construct(ProductRepository $productRepository, StockRepository $stockRepository)
    {
        $this->productRepository = $productRepository;
        $this->stockRepository = $stockRepository;
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $product = $this->productRepository->save($data);

            $this->stockRepository->create([
                'product_id' => $product->id,
                'available_qty' => $data['quantity']
            ]);

            return $product;
        });
    }

    public function update(string $id, array $data)
    {
        $product = $this->productRepository->find($id);

        if (!isset($product)) {
            return;
        }

        if (isset($data['name'])) {
            $product->name = $data['name'];
        }

        if (isset($data['price'])) {
            $product->price = $data['price'];
        }

        if (isset($data['description'])) {
            $product->description = $data['description'];
        }

        $product->save();

        return $product;
    }

    public function getById(string $id)
    {
        $product = $this->productRepository->find($id);
        if (!isset($product)) {
            return;
        }
        return $product;
    }

    public function deleteById(string $id)
    {
        $product = $this->productRepository->find($id);

        if ($product) {
            $product->delete();
        }
    }
}


