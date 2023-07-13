<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\ACL\PivotUserToRoleRequest;
use App\Http\Resources\ACL\PivotUserToRoleCollection;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PivotUserToRoleController extends Controller
{
    /**
     * Lista os papeis do usuário.
     */
    public function index(User $user)
    {
        // retorna os papeis do usuário paginados.
        return new PivotUserToRoleCollection($user->roles()->get());
    }

    /**
     * Adiciona as papeis vindos do request ao usuário.
     */
    public function store(PivotUserToRoleRequest $request, User $user)
    {
        DB::beginTransaction();

        try {
            $roleIds = $request->input('roles') ?? [];

            $existingIds = DB::table('users_roles')
                ->where('user_id', $user->id)
                ->select('role_id')
                ->pluck('role_id')
                ->toArray();

            /**
             * O 'attach' diferente do comando: 'sync' não consegue diferenciar
             *  registros duplicados, por isso, a filtragem é feita a mão.
             */

            // filtra o ID dos papeis que ainda não foram vinculadas ao usuário.
            $includeIds = array_filter($roleIds, function ($value) use ($existingIds) {
                return !in_array($value, $existingIds);
            });

            $user->roles()->attach($includeIds);

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
     * Remove todos os papeis do usuário.
     */
    public function remove(PivotUserToRoleRequest $request, User $user)
    {
        DB::beginTransaction();

        try {
            $roleIds = $request->input('roles') ?? [];

            $data = $user->roles()->detach($roleIds);

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
     * Remove todos os papeis do usuário e adiciona os papeis vindos do request.
     */
    public function redefine(PivotUserToRoleRequest $request, User $user)
    {
        DB::beginTransaction();

        try {
            $roleIds = $request->input('roles') ?? [];

            $data = $user->roles()->sync($roleIds);

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
