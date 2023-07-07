<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoAnexoRequest;
use App\Http\Requests\UpdateTipoAnexoRequest;
use App\Models\TipoAnexo;
use Illuminate\Http\Request;

class TipoAnexoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoAnexoList = TipoAnexo::orderBy('nome')->paginate(10);

        return response()->json($tipoAnexoList);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTipoAnexoRequest $request)
    {
        $tipoAnexo = TipoAnexo::create($request->all());

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.created.success'),
            'data'      => $tipoAnexo
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoAnexo $tipoAnexo)
    {
        return response()->json([
            'data' => $tipoAnexo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTipoAnexoRequest $request, TipoAnexo $tipoAnexo)
    {
        $tipoAnexo->update($request->all());

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.updated.success'),
            'data'      => $tipoAnexo
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoAnexo $tipoAnexo)
    {
        $tipoAnexo->delete();

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.deleted.success'),
            'id'        => $tipoAnexo->id,
        ]);
    }
}
