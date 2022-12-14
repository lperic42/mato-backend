<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $with = 'category';

    public $fillable = ['title', 'category_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'product_subcategories', 'subcategory_id', 'product_id');
    }

}
