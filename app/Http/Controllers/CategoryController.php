<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use App\Http\Resources\categoryCollection;
use App\Http\Resources\categoryResource;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        return new categoryCollection(category::paginate());
    }


    public function show(Request $request, category $category)
    {
        return new categoryResource($category);
    }

    public function store(StorecategoryRequest $request)
    {
        $validated = $request->validated();

        $category = category::create($validated);
        return new categoryResource($category);
    }

    public function update(UpdatecategoryRequest $request, category $category)
    {

        $validated = $request->validated();
        $category->update($validated);

        return new categoryResource($category);
    }

    public function destroy(Request $request, category $category)
    {
        $category->delete();
        return response()->noContent();
    }
}
