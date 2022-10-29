<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $with = ['subcategories'];

    public $fillable = ['title', 'description', 'price', 'discount_price'];

    protected $appends = ['featured_image', 'gallery'];

    public function subcategories() {
        return $this->belongsToMany(Subcategory::class, 'product_subcategories', 'product_id', 'subcategory_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function getFeaturedImageAttribute()
    {
        $mediaItems = $this->getMedia('thumbnail')->first()->original_url;
        return $mediaItems;
    }

    public function getGalleryAttribute()
    {
        $mediaItems = $this->getMedia('gallery');

        return $mediaItems;
    }
}
