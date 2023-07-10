<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrgaoRequest;
use App\Http\Requests\UpdateOrgaoRequest;
use App\Http\Resources\OrgaoCollection;
use App\Http\Resources\OrgaoResource;
use App\Models\Orgao;
use Illuminate\Http\Request;

class OrgaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orgaos = Orgao::with([
            'orgaoResponsavel',
            'tipoOrgao',
        ])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        $data = new OrgaoCollection($orgaos);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrgaoRequest $request)
    {
        $orgao = Orgao::create($request->all());

        $orgao->tiposAnexo()->attach($request->tipos_anexo_id);

        $data = new OrgaoResource($orgao);

        return response()->json([
            'status' => 'success',
            'messages' => __('messages.created.success'),
            'data' => $data,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Orgao $orgao)
    {
        $data = new OrgaoResource($orgao);

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrgaoRequest $request, Orgao $orgao)
    {
        $orgao->update($request->all());

        $orgao->tiposAnexo()->sync($request->tipos_anexo_id);

        $data = new OrgaoResource($orgao);

        return response()->json([
            'status' => 'success',
            'messages' => __('messages.updated.success'),
            'data' => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orgao $orgao)
    {
        $orgao->tiposAnexo()->sync([]);
        $orgao->delete();

        return response()->json([
            'status' => 'success',
            'messages' => __('messages.deleted.success'),
            'id' => $orgao->id,
        ]);
    }
}
