<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venda;

class PagamentoController extends Controller
{
     public function atualizar(Request $request)
    {

        $venda = Venda::find(
            $request->venda_id
        );

        $venda->status_pagamento =
            $request->status;

        $venda->save();


        return response()->json([
            'success'=>true
        ]);

    }
}
