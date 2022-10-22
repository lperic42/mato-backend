<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function index() {
        $categories = Category::get();

        return $categories;
    }

    public function store(Request $request) {
        $category = new Category();

        $category->title = $request->title;
        $category->save();

        return $category;
    }

    public function show(Request $request, Category $category) {

        return $category;
    }

    public function update(Request $request, Category $category) {
        $category->title = $request->title;
        $category->save();

        return $category;
    }

    public function delete(Request $request, Category $category) {

        $category->delete();

        return null;
    }

}
