<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\ACL\PivotRoleToUserRequest;
use App\Http\Resources\ACL\PivotRoleToUserCollection;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class PivotRoleToUserController extends Controller
{
    /**
     * Lista os usuários do papel.
     */
    public function index(Role $role)
    {
        // retorna os usuários do papel paginados.
        return new PivotRoleToUserCollection($role->users()->get());
    }

    /**
     * Adiciona os usuários vindos do request ao papel.
     */
    public function store(PivotRoleToUserRequest $request, Role $role)
    {
        DB::beginTransaction();

        try {
            $userIds = $request->input('users') ?? [];

            $existingIds = DB::table('users_roles')
                ->where('role_id', $role->id)
                ->select('user_id')
                ->pluck('user_id')
                ->toArray();

            /**
             * O 'attach' diferente do comando: 'sync' não consegue diferenciar
             *  registros duplicados, por isso, a filtragem é feita a mão.
             */

            // filtra o ID dos usuários que ainda não foram vinculadas ao papel.
            $includeIds = array_filter($userIds, function ($value) use ($existingIds) {
                return !in_array($value, $existingIds);
            });

            $role->users()->attach($includeIds);

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
     * Remove todas os usuários do papel.
     */
    public function remove(PivotRoleToUserRequest $request, Role $role)
    {
        DB::beginTransaction();

        try {
            $userIds = $request->input('users');

            $data = $role->users()->detach($userIds);

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
     * Remove todaos os usuários do papel e adiciona os usuários vindas do request.
     */
    public function redefine(PivotRoleToUserRequest $request, Role $role)
    {
        DB::beginTransaction();

        try {
            $userIds = $request->input('users') ?? [];

            $data = $role->users()->sync($userIds);

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