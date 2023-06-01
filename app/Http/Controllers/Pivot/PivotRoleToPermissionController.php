<?php

namespace App\Http\Controllers\Pivot;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pivot\PivotRoleToPermissionRequest;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class PivotRoleToPermissionController extends Controller
{
    /**
     * Lista as permissões do papel.
     */
    public function index(Role $role)
    {
        // retorna as permissões do papel paginados.
        $data = $role->permissions()->paginate(10);

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Adiciona as permissões vindas do request ao papel.
     */
    public function store(PivotRoleToPermissionRequest $request, Role $role)
    {
        DB::beginTransaction();

        try {
            $permissionIds = $request->input('permissions') ?? [];

            $existingIds = DB::table('roles_permissions')
                ->where('role_id', $role->id)
                ->select('permission_id')
                ->pluck('permission_id')
                ->toArray();

            /**
             * O 'attach' diferente do comando: 'sync' não consegue diferenciar
             *  registros duplicados, por isso, a filtragem é feita a mão.
             */

            // filtra o ID das permissões que ainda não foram vinculadas ao papel.
            $includeIds = array_filter($permissionIds, function ($value) use ($existingIds) {
                return !in_array($value, $existingIds);
            });

            $role->permissions()->attach($includeIds);

            $data = count($includeIds);

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => __('messages.created.success'),
                'data'      => $data,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    /**
     * Remove todas as permissões do papel.
     */
    public function remove(PivotRoleToPermissionRequest $request, Role $role)
    {
        DB::beginTransaction();

        try {
            $permissionIds = $request->input('permissions') ?? [];

            $data = $role->permissions()->detach($permissionIds);

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
     * Remove todas as permissões do papel e adiciona as permissões vindas do request.
     */
    public function redefine(PivotRoleToPermissionRequest $request, Role $role)
    {
        DB::beginTransaction();

        try {
            $permissionIds = $request->input('permissions') ?? [];

            $data = $role->permissions()->sync($permissionIds);

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => __('messages.updated.success'),
                'data'      => $data,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
