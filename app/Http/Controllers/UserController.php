<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!$request->user()->tokenCan('user:list')) {
            throw new AuthorizationException;
        }

        return UserResource::collection(User::orderBy('name')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());

        $data = new UserResource($user);

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.created.success'),
            'data'      => $data,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
        if(!$request->user()->tokenCan('user:list')) {

            if(!$request->user()->tokenCan('user:read') || $request->user()->id !== $user->id) {
                throw new AuthorizationException;
            }
        }

        $data = new UserResource($user);

        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());

        $data = new UserResource($user);

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.updated.success'),
            'data'      => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        // usuário a ser editado é super admin mas o usuário logado não possui permissão de edita-lo
        if($user->isSuperAdmin() && !$this->instance()->user()->tokenCan('admin:user')) {
            throw new AuthorizationException;
        }

        if(!$request->user()->tokenCan('user:write')) {
            throw new AuthorizationException;
        }

        $user->delete();

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.deleted.success'),
            'id'        => $user->id,
        ]);
    }
}
