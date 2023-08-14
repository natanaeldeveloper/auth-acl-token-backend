<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnexoRequest;
use App\Http\Requests\UpdateAnexoRequest;
use App\Http\Resources\AnexoCollection;
use App\Http\Resources\AnexoResource;
use App\Models\Anexo;
use App\Models\Processo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Illuminate\Support\Str;

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

            if ($request->por_arquivo == 1) {

                $path = "processos/{$processo->ano_processo}/{$processo->id}/{$anexo->uuid}";
                $file = $request->arquivo;

                Storage::disk('public')->put($path, $file->get());
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
    public function update(UpdateAnexoRequest $request, Processo $processo, Anexo $anexo)
    {
        DB::beginTransaction();

        try {
            $anexo->update(array_merge($request->all(), [
                'uuid' => $anexo->uuid,
                'editor_id' => $request->user()->id,
            ]));

            $path = "processos/{$processo->ano_processo}/{$processo->id}/{$anexo->uuid}";

            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            if ($request->por_arquivo == 1) {

                $file = $request->file('arquivo');
                Storage::disk('public')->put($path, $file->get());
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
    public function destroy(Processo $processo, Anexo $anexo)
    {
        DB::beginTransaction();

        try {
            $anexo->delete();

            $path = "processos/{$processo->ano_processo}/{$processo->id}/{$anexo->uuid}";

            Storage::disk('public')->delete($path);

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

    public function download(Processo $processo, Anexo $anexo)
    {
        $fileName = mb_strtoupper(str_replace([' ',  '_'], '-', Str::ascii($anexo->descricao)), 'UTF-8');

        if ($anexo->por_arquivo) {
            $path       = "processos/{$processo->ano_processo}/{$processo->id}/{$anexo->uuid}";
            $filePath   = storage_path("app/public/" . $path);

            if (!Storage::disk('public')->exists($path)) {
                throw new NotFoundHttpException('Arquivo do anexo não encontrado.');
            }

            return response()->download($filePath, $fileName, [
                'Content-Type' => $anexo->mime_type
            ]);
        } else {
            $pdf = Pdf::loadHTML($anexo->conteudo, 'UTF-8');

            return $pdf->stream($fileName . '.pdf');
        }
    }
}
