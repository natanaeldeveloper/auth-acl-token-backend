<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\ACL\StoreRoleRequest;
use App\Http\Requests\ACL\UpdateRoleRequest as ACLUpdateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\ACL\RoleCollection;
use App\Http\Resources\ACL\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new RoleCollection(Role::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $data = new RoleResource(Role::create($request->all()));

        return response()->json([
            'status'    => 'success',
            'message'   => __('Resource created successfully.'),
            'data'      => $data,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $data = new RoleResource($role);

        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ACLUpdateRoleRequest $request, Role $role)
    {
        $role->update($request->all());

        $data = new RoleResource($role);

        return response()->json([
            'status'    => 'success',
            'message'   => __('Resource updated successfully.'),
            'data'      => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.deleted.success'),
            'id'        => $role->id,
        ]);
    }
}