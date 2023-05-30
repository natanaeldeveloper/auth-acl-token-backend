<?php

namespace App\Http\Controllers\Pivot;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pivot\PivotUserToPermissionRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PivotUserToPermissionController extends Controller
{
    /**
     * Lista as permissões do usuário.
     */
    public function index(User $user)
    {
        // retorna as permissões do usuário paginados.
        $data = $user->permissions()->paginate(10);

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Adiciona as permissões vindas do request ao usuário.
     */
    public function store(PivotUserToPermissionRequest $request, User $user)
    {
        DB::beginTransaction();

        try {
            $permissionIds = $request->input('permissions') ?? [];

            $existingIds = DB::table('users_permissions')
                ->where('user_id', $user->id)
                ->select('permission_id')
                ->pluck('permission_id')
                ->toArray();

            /**
             * O 'attach' diferente do comando: 'sync' não consegue diferenciar
             *  registros duplicados, por isso, a filtragem é feita a mão.
             */

            // filtra o ID das permissões que ainda não foram vinculadas ao usuário.
            $includeIds = array_filter($permissionIds, function ($value) use ($existingIds) {
                return !in_array($value, $existingIds);
            });

            $user->permissions()->attach($includeIds);

            $data = count($includeIds);

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => __('messages.created.success'),
                'data'      => $data,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
        }
    }

    /**
     * Remove todas as permissões do usuário.
     */
    public function remove(PivotUserToPermissionRequest $request, User $user)
    {
        DB::beginTransaction();

        try {
            $permissionIds = $request->input('permissions') ?? [];

            $data = $user->permissions()->detach($permissionIds);

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => __('messages.deleted.success'),
                'data'      => $data,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
        }
    }

    /**
     * Remove todas as permissões do usuário e adiciona as permissões vindas do request.
     */
    public function redefine(PivotUserToPermissionRequest $request, User $user)
    {
        DB::beginTransaction();

        try {
            $permissionIds = $request->input('permissions') ?? [];

            $data = $user->permissions()->sync($permissionIds);

            DB::commit();

            return response()->json([
                'status'    => 'success',
                'message'   => __('messages.updated.success'),
                'data'      => $data,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
        }
    }
}
