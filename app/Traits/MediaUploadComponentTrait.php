<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\Models\Media;

trait MediaUploadComponentTrait
{


    /**
     * @param Collection|Media $files
     * @return array
     */
    public function mapMediaUploadComponent($files)
    {
        if($files == null || empty($files)) {
            return [];
        }

        if($files instanceof Collection) {
            return $files->map(function($item)  {
                $previewUrl = $item->getFullUrl();
                if(Str::contains($item->mime_type, 'pdf')) {
                    $previewUrl = asset('images/preview/pdf.png');
                }
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'realPath' => null,
                    'url' =>  $previewUrl,
                    'fileUrl' =>$item->getFullUrl()
                ];
            })->toArray();
        }
        $previewUrl = $files->getFullUrl();
        if(Str::contains($files->mime_type, 'pdf')) {
            $previewUrl = asset('images/preview/pdf.png');
        }
        return [
                [
                'id' => $files->id,
                'name' => $files->name,
                'realPath' => null,
                'url' => $previewUrl ,
                'fileUrl' => $files->getFullUrl()
            ]
        ];
    }

    protected function syncModelMedia($model, $mediaList, $collectionName = "default" )
    {
        $existingMediaIds = [];
        $newMedias = [];
        if(count($mediaList)> 0 ) {
            foreach ($mediaList as $m) {
                if(isset($m['id']) and $m['id'] > 0) {
                    $existingMediaIds[] = $m['id'];
                } else {
                    $newMedias[] = $m;
                }
            }
        }

        $model->media()->where('collection_name', $collectionName)->whereNotIn('id', $existingMediaIds)->delete();
        $model = $model->refresh();

        if(count($newMedias) > 0 ) {
            foreach ($newMedias as $nm) {
                $model->addMediaFromUrl($nm['fileUrl'])->toMediaCollection($collectionName);
            }
        }

        return $model->refresh();
    }


}
