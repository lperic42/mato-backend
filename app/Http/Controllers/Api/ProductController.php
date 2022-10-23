<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index() {
        $products = Product::get();

        return $products;
    }

    public function store(Request $request) {
        $product = new Product();

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;

        $product->save();

        $product->subcategories()->sync($request->subcategory_ids);
        $product->save();

        return $product;
    }

    public function show(Request $request, Product $product) {

        return $product;
    }

    public function update(Request $request, Product $product) {
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->save();

        return $product;
    }

    public function delete(Request $request, Product $product) {

        $product->delete();

        return null;
    }

}
