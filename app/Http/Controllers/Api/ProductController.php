<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsCollection;
use App\Http\Resources\ProductsResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Plank\Mediable\Facades\MediaUploader;

class ProductController extends Controller
{
    public function index() {
        $products = Product::get();

        return new ProductsCollection($products);

    }

    public function store(Request $request) {
        $product = new Product();

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;

        if($product->save()) {
            if($request->has('featured_image')) {
                $media = MediaUploader::fromSource($request->featured_image)->upload();
                $product->syncMedia($media, 'featured_image');
            }
            if($request->has('gallery')) {
                foreach($request->gallery as $g) {
                    $media = MediaUploader::fromSource($g)->upload();
                    $product->attachMedia($media, 'gallery');
                }
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

        if($product->save()) {
            if($request->has('featured_image')) {
                $media = MediaUploader::fromSource($request->featured_image)->upload();
                $product->syncMedia($media, 'featured_image');
            }
            if($request->has('gallery')) {
                $product->detachMediaTags('gallery');
                foreach($request->gallery as $g) {
                    $media = MediaUploader::fromSource($g)->upload();
                    $product->attachMedia($media, 'gallery');
                }
            }

            $product->subcategories()->sync($request->subcategory_ids);
        };
        return $product;
    }

    public function delete(Request $request, Product $product) {

        $product->delete();

        return null;
    }

}
