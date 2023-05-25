<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::orderBy('name')->paginate(10);

        return response()->json($permissions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        $permission = Permission::create($request->all());

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.created.success'),
            'data'      => $permission,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return response()->json([
            'data' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->all());

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.updated.success'),
            'data'      => $permission,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.deleted.success'),
            'id'        => $permission->id,
        ]);
    }
}
