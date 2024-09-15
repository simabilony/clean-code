<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::all());
//        return Category::all();
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
        // return $category;
    }
    public function list()
    {
        return CategoryResource::collection(Category::all());
    }
}
