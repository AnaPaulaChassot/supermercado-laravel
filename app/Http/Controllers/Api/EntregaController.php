<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venda;

class EntregaController extends Controller
{
    public function status(Request $request)
{

    $venda = Venda::find(
        $request->pedido
    );


    $venda->status_entrega =
        $request->status;


    $venda->save();


    return response()->json([
        'ok'=>true
    ]);

}
}
