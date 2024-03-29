<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\ACL\PivotPermissionToRoleRequest;
use App\Http\Resources\ACL\PivotPermissionToRoleCollection;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PivotPermissionToRoleController extends Controller
{
    /**
     * Lista os papeis da permissão.
     */
    public function index(Permission $permission)
    {
        // retorna os papeis da permissão paginados.
        return new PivotPermissionToRoleCollection($permission->roles()->get());
    }

    /**
     * Adiciona as papeis vindos do request a permissão.
     */
    public function store(PivotPermissionToRoleRequest $request, Permission $permission)
    {
        DB::beginTransaction();

        try {
            $roleIds = $request->input('roles') ?? [];

            $existingIds = DB::table('roles_permissions')
                ->where('permission_id', $permission->id)
                ->select('role_id')
                ->pluck('role_id')
                ->toArray();

            /**
             * O 'attach' diferente do comando: 'sync' não consegue diferenciar
             *  registros duplicados, por isso, a filtragem é feita a mão.
             */

            // filtra o ID dos papeis que ainda não foram vinculadas a permissão.
            $includeIds = array_filter($roleIds, function ($value) use ($existingIds) {
                return !in_array($value, $existingIds);
            });

            $permission->roles()->attach($includeIds);

            $data = count($includeIds);

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => __('Resource created successfully.'),
                'data'      => $data,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    /**
     * Remove todos os papeis da permissão.
     */
    public function remove(PivotPermissionToRoleRequest $request, Permission $permission)
    {
        DB::beginTransaction();

        try {
            $roleIds = $request->input('roles') ?? [];

            $data = $permission->roles()->detach($roleIds);

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => __('messages.deleted.success'),
                'data'      => $data,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    /**
     * Remove todos os papeis da permissão e adiciona os papeis vindos do request.
     */
    public function redefine(PivotPermissionToRoleRequest $request, Permission $permission)
    {
        DB::beginTransaction();

        try {
            $roleIds = $request->input('roles') ?? [];

            $data = $permission->roles()->sync($roleIds);

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => __('Resource updated successfully.'),
                'data'      => $data,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}