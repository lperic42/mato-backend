<?php


namespace App\Traits;


use App\Http\Resources\MediaCollectionResource;
use App\Http\Resources\MediaResource;
use App\Transformers\MediaTransformer;
use Illuminate\Support\Collection;

trait mediaMapper
{

    /**
     * @param Collection $files
     * @return array
     */
    public function mapMedia($files)
    {
        if($files == null || empty($files)) {
            return null;
        }
        if($files instanceof Collection) {
            return new MediaCollectionResource($files);

        }
        return new MediaResource($files);
    }
}
