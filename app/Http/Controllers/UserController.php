<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $response = User::orderBy('name')->paginate(10);
        $response['time'] = Carbon::now();

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.created.success'),
            'data'      => $user,
            'time'      => Carbon::now(),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json([
            'data' => $user,
            'time' => Carbon::now(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.updated.success'),
            'data'      => $user,
            'time'      => Carbon::now(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.deleted.success'),
            'id'        => $user->id,
            'time'      => Carbon::now(),
        ]);
    }
}
