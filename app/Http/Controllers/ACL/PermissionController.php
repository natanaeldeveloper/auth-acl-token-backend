<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\ACL\StorePermissionRequest;
use App\Http\Requests\ACL\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->user()->tokenCan('user_access:list')) {
            throw new AuthorizationException;
        }

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
    public function show(Request $request, Permission $permission)
    {
        if($request->user()->tokenCan('user_access:list')) {
            throw new AuthorizationException;
        }

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
    public function destroy(Request $request, Permission $permission)
    {
        if($request->user()->tokenCan('user_access:write')) {
            throw new AuthorizationException;
        }

        $permission->delete();

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.deleted.success'),
            'id'        => $permission->id,
        ]);
    }
}
