<?php

namespace App\Http\Resources;

use App\Http\Resources\Api\PetTypesCollectionResource;
use App\Traits\MediaUploadComponentTrait;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class ProductsResource extends JsonResource
{
    use MediaUploadComponentTrait;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);

        return $data;
    }
}
