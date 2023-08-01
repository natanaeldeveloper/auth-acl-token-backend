<?php

namespace App\Http\Controllers;

use App\Http\Resources\CaixaPostalCollection;
use App\Models\CaixaPostal;
use App\Models\TipoCaixaPostal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaixaEntradaController extends Controller
{

    protected $tipoCaixaPostalId;

    public function __construct()
    {
        $this->tipoCaixaPostalId = TipoCaixaPostal::$tipoCaixaDeEntradaId;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $itensCaixaDeEntrada = CaixaPostal::with('processo')
            ->where('usuario_id', $request->user()->id)
            ->where('tipo_caixa_postal_id', $this->tipoCaixaPostalId)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return new CaixaPostalCollection($itensCaixaDeEntrada);
    }
}
