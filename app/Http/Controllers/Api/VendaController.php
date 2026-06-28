<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Venda;

class VendaController extends Controller
{
    public function index()
    {
        $vendas = Venda::with([
            'cliente',
            'endereco',
            'produtos'
        ])->get();

        return response()->json($vendas);
    }

    public function show($id)
    {
        $venda = Venda::with([
            'cliente',
            'endereco',
            'produtos'
        ])->findOrFail($id);

        return response()->json($venda);
    }
}