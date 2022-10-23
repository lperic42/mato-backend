<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\PetTypesResource;
use App\Models\Tag;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Permission\PermissionResource;
use App\Models\Permission;
use App\Http\Resources\TagResource;
use Illuminate\Http\Resources\Json\ResourceCollection;


class PetTypesCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        $data = PetTypesResource::collection($this->collection);

        return [
            'data' => $data,
        ];
    }
}
