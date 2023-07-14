<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcessoRequest;
use App\Http\Requests\UpdateProcessoRequest;
use App\Http\Resources\ProcessoCollection;
use App\Http\Resources\ProcessoResource;
use App\Models\Processo;
use Illuminate\Http\Request;

class ProcessoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $processos = Processo::with('solicitante')->orderBy('created_at', 'DESC')->paginate(10);

        return new ProcessoCollection($processos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProcessoRequest $request)
    {
        $tipoAnexo = Processo::create($request->all());

        $data = new ProcessoResource($tipoAnexo);

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.created.success'),
            'data'      => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Processo $processo)
    {
        $data = new ProcessoResource($processo);

        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProcessoRequest $request, Processo $processo)
    {
        $processo->update($request->all());

        $data = new ProcessoResource($processo);

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.updated.success'),
            'data'      => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Processo $processo)
    {
        $processo->delete();

        return response()->json([
            'status'    => 'success',
            'message'   => __('messages.deleted.success'),
            'id'        => $processo->id,
        ]);
    }
}
