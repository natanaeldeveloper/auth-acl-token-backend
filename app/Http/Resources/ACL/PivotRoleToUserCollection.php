<?php

namespace App\Http\Resources\ACL;

use App\Http\Resources\UserResource;
use GDebrauwer\Hateoas\Traits\HasLinks;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PivotRoleToUserCollection extends ResourceCollection
{
    use HasLinks;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => UserResource::collection($this->collection),
            '_links' => $this->links(\App\Hateoas\ACL\PivotRoleToUserHateoas::class),
        ];
    }
}
