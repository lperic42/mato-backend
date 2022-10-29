<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsResource;
use App\Models\Product;
use App\Traits\MediaUploadComponentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    use MediaUploadComponentTrait;

    public function index() {
        $products = Product::get();

        return new ProductsResource($products);

    }

    public function store(Request $request) {
        $product = new Product();

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;

        if($product->save()) {
            $product
                ->addMedia($request->file('thumbnail'))
                ->toMediaCollection('thumbnail');

            foreach($request->file('gallery') as $g) {
                $product
                    ->addMedia($g)
                    ->toMediaCollection('gallery');
            }

            $product->subcategories()->sync($request->subcategory_ids);
        };
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
