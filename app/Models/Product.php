<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $with = ['subcategories'];

    public $fillable = ['title', 'description', 'price', 'discount_price'];

    protected $appends = ['featured_image'];

    public function subcategories() {
        return $this->belongsToMany(Subcategory::class, 'product_subcategories', 'product_id', 'subcategory_id');
    }

    public function getFeaturedImageAttribute()
    {
        return $this->getMedia('featured_image')->first();
    }
}
