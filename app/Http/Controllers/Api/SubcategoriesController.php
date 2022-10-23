<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoriesController extends Controller
{

    public function index() {
        $subcategories = Subcategory::get();

        return $subcategories;
    }

    public function store(Request $request) {
        $subcategory = new Subcategory();

        $subcategory->title = $request->title;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();

        return $subcategory;
    }

    public function show(Request $request, Subcategory $subcategory) {

        return $subcategory;
    }

    public function update(Request $request, Subcategory $subcategory) {
        $subcategory->title = $request->title;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();

        return $subcategory;
    }

    public function delete(Request $request, Subcategory $subcategory) {

        $subcategory->delete();

        return null;
    }

}
