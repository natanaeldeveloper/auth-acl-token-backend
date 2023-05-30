<?php

namespace App\Http\Controllers\Pivot;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pivot\PivotPermissionToRoleRequest;
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
        $data = $permission->roles()->paginate(10);

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Adiciona as papeis vindos do request a permissão.
     */
    public function store(PivotPermissionToRoleRequest $request, Permission $permission)
    {
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

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.created.success'),
            'data'      => $data,
        ]);
    }

    /**
     * Remove todos os papeis da permissão.
     */
    public function remove(PivotPermissionToRoleRequest $request, Permission $permission)
    {
        $roleIds = $request->input('roles') ?? [];

        $data = $permission->roles()->detach($roleIds);

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.deleted.success'),
            'data'      => $data,
        ]);
    }

    /**
     * Remove todos os papeis da permissão e adiciona os papeis vindos do request.
     */
    public function redefine(PivotPermissionToRoleRequest $request, Permission $permission)
    {
        $roleIds = $request->input('roles') ?? [];

        $data = $permission->roles()->sync($roleIds);

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.updated.success'),
            'data'      => $data,
        ]);
    }
}
