<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAll();
        return response()->json($products, 200);
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->create($request->validated());
        return response()->json($product, 201);
    }

    public function show(string $id)
    {
        $product = $this->productService->getById($id);
        return response()->json($product, 200);
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        $product = $this->productService->update($id, $request->validated());
        return response()->json($product, 200);
    }

    public function destroy(string $id)
    {
        $this->productService->deleteById($id);
        return response()->json(null, 204);
    }
}
