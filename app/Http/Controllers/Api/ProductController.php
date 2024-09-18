<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\Group;
/**
 * @group Products
 *
 * Managing Products
 */
#[Group('Products', 'Managing Products')]
class ProductController extends Controller
{
    public function index()
    {
//        $products = Product::with('category')->get();
        $products = Product::with('category')->paginate(9);
        return ProductResource::collection($products);
    }
}
