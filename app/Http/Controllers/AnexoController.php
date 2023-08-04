<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnexoRequest;
use App\Http\Requests\UpdateAnexoRequest;
use App\Http\Resources\AnexoCollection;
use App\Http\Resources\AnexoResource;
use App\Models\Anexo;
use App\Models\Processo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Throwable;

class AnexoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Processo $processo)
    {
        $anexos = Anexo::orderBy('created_at')
            ->where('processo_id', $processo->id)
            ->paginate(10);

        return new AnexoCollection($anexos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnexoRequest $request, Processo $processo)
    {

        DB::beginTransaction();

        try {
            $anexo = Anexo::create(array_merge($request->all(), [
                'uuid' => Uuid::uuid4()->toString(),
                'editor_id' => $request->user()->id,
                'processo_id' => $processo->id,
            ]));

            if ($request->has('arquivo') && $request->file('arquivo')->isValid()) {

                $file = $request->file('arquivo');
                $mimeType = $file->getClientMimeType();
                $path = 'processos/' . $processo->id . '/' . $anexo->uuid;

                Storage::disk('public')->put($path, $file->get());

                $anexo->update(['mime_type' => $mimeType]);
            }

            DB::commit();

            $data = new AnexoResource($anexo);

            return response()->json([
                'status' => 'success',
                'message' => __('messages.created.success'),
                'data' => $data,
            ], 201);

        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Processo $processo, Anexo $anexo)
    {
        $data = new AnexoResource($anexo);

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnexoRequest $request, Anexo $anexo)
    {
        $anexo->update(array_merge($request->all(), [
            'uuid' => Uuid::uuid4()->toString(),
            'editor_id' => $request->user()->id,
        ]));

        return response()->json([
            'status' => 'success',
            'message' => __('messages.updated.success'),
            'data' => $anexo,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anexo $anexo)
    {
        $anexo->delete();

        Storage::disk('public')->deleteDirectory('processos/' . $anexo->processo_id);

        return response()->json([
            'status' => 'success',
            'message' => __('messages.deleted.success'),
            'id' => $anexo->id,
        ]);
    }
}
