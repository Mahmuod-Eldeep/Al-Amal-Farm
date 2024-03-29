<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        return new ProductCollection(Product::paginate());
    }


    public function show(Request $request, Product $product)
    {
        return new ProductResource($product);
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $product = Product::create($validated);
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {

        $validated = $request->validated();
        $product->update($validated);

        return new ProductResource($product);
    }

    public function destroy(Request $request, Product $product)
    {
        $product->delete();
        return response()->noContent();
    }
}
