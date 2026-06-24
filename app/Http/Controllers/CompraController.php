<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Configuracao;
use App\Models\Venda;



class CompraController extends Controller
{


public function finalizar(Request $request)
{

    $venda = Venda::find(
        $request->venda_id
    );


    $config = Configuracao::first();

    // caçapay

    $pagamento = Http::withToken(

        $config->token_cacapay

    )->post(

        $config->url_cacapay.'/api/compras',

        [

        'cpf'=>$venda->cliente->cpf,

        'token'=>$config->token_cacapay,

        'valor'=>$venda->valor

        ]

    );



    if(!$pagamento->successful()){


        $venda->status_pagamento =
            'Negado';


        $venda->save();


        return response()->json(
            [
            'erro'=>'Pagamento recusado'
            ],
            422
        );

    }



    $venda->status_pagamento =
        'Aprovado';


    $venda->save();


    // CAÇALOG
 
    $entrega = Http::withToken(

        $config->token_cacalog

    )->post(

        $config->url_cacalog.'/api/entregas',

        [

        'cliente'=>$venda->cliente->nome,


        'endereco'=>$venda->cliente->endereco,


        'callback'=>
        route('entrega.status'),


        'produtos'=>$venda->produtos

        ]

    );



    $venda->status_entrega =
        'Recebido';


    $venda->save();



    return response()->json([

        'pagamento'=>$pagamento->json(),

        'entrega'=>$entrega->json()

    ]);


}



}