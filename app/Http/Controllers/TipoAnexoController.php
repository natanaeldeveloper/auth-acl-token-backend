<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoAnexoRequest;
use App\Http\Requests\UpdateTipoAnexoRequest;
use App\Http\Resources\TipoAnexoCollection;
use App\Http\Resources\TipoAnexoResource;
use App\Models\TipoAnexo;
use Illuminate\Http\Request;

class TipoAnexoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiposAnexo= TipoAnexo::orderBy('created_at', 'DESC')->paginate(10);

        $data = new TipoAnexoCollection($tiposAnexo);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTipoAnexoRequest $request)
    {
        $tipoAnexo = TipoAnexo::create($request->all());

        $data = new TipoAnexoResource($tipoAnexo);

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.created.success'),
            'data'      => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, TipoAnexo $tipoAnexo)
    {
        $data = new TipoAnexoResource($tipoAnexo);

        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTipoAnexoRequest $request, TipoAnexo $tipoAnexo)
    {
        $tipoAnexo->update($request->all());

        $data = new TipoAnexoResource($tipoAnexo);

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.updated.success'),
            'data'      => $data
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
