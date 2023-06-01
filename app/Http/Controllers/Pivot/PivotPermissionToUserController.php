<?php

namespace App\Http\Controllers\Pivot;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pivot\PivotPermissionToUserRequest;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PivotPermissionToUserController extends Controller
{
    /**
     * Lista os usuários da permissão.
     */
    public function index(Permission $permission)
    {
        // retorna os usuários da permissão paginados.
        $data = $permission->users()->paginate(10);

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Adiciona os usuários vindos do request a permissão.
     */
    public function store(PivotPermissionToUserRequest $request, Permission $permission)
    {
        DB::beginTransaction();

        try {
            $userIds = $request->input('users') ?? [];

            $existingIds = DB::table('users_roles')
                ->where('role_id', $permission->id)
                ->select('user_id')
                ->pluck('user_id')
                ->toArray();

            /**
             * O 'attach' diferente do comando: 'sync' não consegue diferenciar
             *  registros duplicados, por isso, a filtragem é feita a mão.
             */

            // filtra o ID dos usuários que ainda não foram vinculadas a permissão.
            $includeIds = array_filter($userIds, function ($value) use ($existingIds) {
                return !in_array($value, $existingIds);
            });

            $permission->users()->attach($includeIds);

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
     * Remove todas os usuários da permissão.
     */
    public function remove(PivotPermissionToUserRequest $request, Permission $permission)
    {
        DB::beginTransaction();

        try {
            $userIds = $request->input('users');

            $data = $permission->users()->detach($userIds);

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
     * Remove todaos os usuários da permissão e adiciona os usuários vindas do request.
     */
    public function redefine(PivotPermissionToUserRequest $request, Permission $permission)
    {
        DB::beginTransaction();

        try {
            $userIds = $request->input('users') ?? [];

            $data = $permission->users()->sync($userIds);

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
