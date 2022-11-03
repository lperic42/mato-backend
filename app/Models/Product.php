<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

class Product extends Model
{
    use HasFactory, Mediable;

    protected $with = ['subcategories'];

    public $fillable = ['title', 'description', 'price', 'discount_price'];

    protected $appends = ['featured_image', 'gallery'];

    public function subcategories() {
        return $this->belongsToMany(Subcategory::class, 'product_subcategories', 'product_id', 'subcategory_id');
    }

    public function getFeaturedImageAttribute()
    {
        if($this->firstMedia('thumbnail')) {
            return $this->firstMedia('thumbnail')->getUrl();
        }

        return '';
    }

    public function getGalleryAttribute()
    {

    }
}
