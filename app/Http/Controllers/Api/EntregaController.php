<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venda;

class EntregaController extends Controller
{
    public function atualizar(Request $request)
    {
        $venda = Venda::findOrFail($request->codigo_pedido);

        $venda->status_entrega = $request->status;

        $venda->save();

        return response()->json([
            'success' => true
        ]);
    }
}
