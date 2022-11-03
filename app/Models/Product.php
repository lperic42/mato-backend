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
        if($this->firstMedia('featured_image')) {
            return $this->firstMedia('featured_image')->getUrl();
        }

        return '';
    }

    public function getGalleryAttribute()
    {
        $gallery = [];
        if($this->firstMedia('gallery')) {
            foreach($this->getMedia('gallery') as $g) {
                $gallery[] = $g->getUrl();
            }

            return $gallery;
        }

        return '';
    }
}
