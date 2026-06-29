<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Models\Produto;
use App\Models\VendaProduto;

class Venda extends Model
{
    protected $fillable = [
        'valor_total',
        'cliente_id',
        'endereco_id',
        'status_pagamento',
        'status_entrega'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function produtos()
    {
        return $this->belongsToMany(
            Produto::class,
            'venda_produtos'
        )->withPivot(
            'quantidade',
            'subtotal'
        )->withTimestamps();
    }
}
