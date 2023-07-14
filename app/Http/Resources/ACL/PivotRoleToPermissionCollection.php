<?php

namespace App\Http\Resources\ACL;

use GDebrauwer\Hateoas\Traits\HasLinks;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PivotRoleToPermissionCollection extends ResourceCollection
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
            'data' => PermissionResource::collection($this->collection),
            '_links' => $this->links(\App\Hateoas\ACL\PivotRoleToPermissionHateoas::class),
        ];
    }
}
