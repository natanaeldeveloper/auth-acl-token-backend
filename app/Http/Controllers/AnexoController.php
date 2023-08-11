<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnexoRequest;
use App\Http\Resources\AnexoCollection;
use App\Http\Resources\AnexoResource;
use App\Models\Anexo;
use App\Models\Processo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class AnexoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $processo)
    {
        $anexos = Anexo::with('tipoAnexo')->orderBy('created_at')
            ->where('processo_id', $processo)
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

                $path = "processos/{$processo->ano_processo}/{$processo->id}/{$anexo->uuid}";

                if (Storage::disk('public')->exists($path)) {
                    throw new InternalErrorException("Um arquivo o mesmo UUID: {$anexo->uuid} foi encontrado na pasta do processo.");
                }

                $file = $request->file('arquivo');
                $mimeType = $file->getClientMimeType();

                Storage::disk('public')->put($path, $file->get());

                $anexo->update(['mime_type' => $mimeType]);
            }

            $data = new AnexoResource($anexo);

            DB::commit();

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
    public function show($processo, Anexo $anexo)
    {
        $data = new AnexoResource($anexo);

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Processo $processo, Anexo $anexo)
    {
        dd($request->all());

        DB::beginTransaction();

        try {
            $anexo->update(array_merge($request->all(), [
                'uuid' => Uuid::uuid4()->toString(),
                'editor_id' => $request->user()->id,
            ]));

            if ($request->has('arquivo') && $request->file('arquivo')->isValid()) {

                $path = "processos/{$processo->ano_processo}/{$processo->id}/{$anexo->uuid}";

                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }

                $file = $request->file('arquivo');
                $mimeType = $file->getClientMimeType();;

                Storage::disk('public')->put($path, $file->get());

                $anexo->update(['mime_type' => $mimeType]);
            }

            $data = new AnexoResource($anexo);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => __('messages.updated.success'),
                'data' => $data,
            ]);
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($processo, Anexo $anexo)
    {
        DB::beginTransaction();

        try {
            $anexo->delete();

            Storage::disk('public')->delete("processos/{$processo->ano_processo}/{$processo->id}/{$anexo->uuid}");

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => __('messages.deleted.success'),
                'id' => $anexo->id,
            ]);
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function download(Request $request, Processo $processo, Anexo $anexo)
    {
        $path = "processos/{$processo->ano_processo}/{$processo->id}/{$anexo->uuid}";

        if (!Storage::disk('public')->exists($path)) {
            throw new NotFoundHttpException('Arquivo do anexo não encontrado.');
        }

        $file = Storage::disk('public')->get($path);
        $fileName = mb_strtoupper(str_replace([' ',  '_'], '-', $anexo->descricao), 'UTF-8');

        return response()->download($file, $fileName, [
            'Content-Type' => $anexo->mime_type,
            'Content-Disposition' => 'attachment; filename="' . $fileName . '.pdf"',
        ]);
    }
}
