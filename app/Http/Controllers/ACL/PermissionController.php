<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\ACL\StorePermissionRequest;
use App\Http\Requests\ACL\UpdatePermissionRequest;
use App\Http\Requests\Request;
use App\Http\Resources\ACL\PermissionCollection;
use App\Http\Resources\ACL\PermissionResource;
use App\Models\Permission;
use Illuminate\Auth\Access\AuthorizationException;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return new PermissionCollection(Permission::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        $data = new PermissionResource(Permission::create($request->all()));

        return response()->json([
            'status'    => 'success',
            'message'   => __('Resource created successfully.'),
            'data'      => $data,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Permission $permission)
    {
        $data = new PermissionResource($permission);

        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->all());

        $data = new PermissionResource($permission);

        return response()->json([
            'status'    => 'success',
            'message'   => __('Resource updated successfully.'),
            'data'      => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Permission $permission)
    {
        $permission->delete();

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.deleted.success'),
            'id'        => $permission->id,
        ]);
    }
}