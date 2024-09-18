<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use http\Env\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Endpoint;
use OpenApi\Annotations as OA;

#[Group('Categories', 'Managing Categories')]
/**
 * @group Categories
 *
 * Managing Categories
 */
class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/categories",
     *     tags={"Categories"},
     *     summary="Get list of categories",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *     )
     * )
     */
    public function index()
    {
        abort_if(! auth()->user()->tokenCan('categories-list'), 403);
        return CategoryResource::collection(Category::all());
//        return Category::all();
    }
    /**
     * @OA\Get(
     *     path="/categories/{category}",
     *     tags={"Categories"},
     *     summary="Get a single category",
     *     @OA\Parameter(
     *         name="category",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Not Found",
     *     )
     * )
     */
    public function show(Category $category)
    {
        abort_if(! auth()->user()->tokenCan('categories-show'), 403);
        return new CategoryResource($category);
        // return $category;
    }
    public function list()
    {
        return CategoryResource::collection(Category::all());
    }
    /**
     * @OA\Post(
     *     path="/categories",
     *     tags={"Categories"},
     *     summary="Create a new category",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreCategoryRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Category created successfully",
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Validation Error",
     *     )
     * )
     */
    /**
     * @param StoreCategoryRequest $request
     * @return CategoryResource
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = 'categories/' . Str::uuid() . '.' . $file->extension();
            $file->storePubliclyAs('public' ,  name: $name);
            $data['photo'] = $name;
        }
        $category = Category::create($data);
        return new CategoryResource($category);
    }

    public function update(Category $category, StoreCategoryRequest $request)
    {
        $category->update($request->all());
        return new CategoryResource($category);
    }

    /**
     * @OA\Delete(
     *     path="/categories/{category}",
     *     tags={"Categories"},
     *     summary="Delete a category",
     *     @OA\Parameter(
     *         name="category",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Category deleted successfully",
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Not Found",
     *     )
     * )
     */
    public function destroy(Category $category)
    {
        Product::where('category_id', $category->id)->delete();
        $category->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

}
