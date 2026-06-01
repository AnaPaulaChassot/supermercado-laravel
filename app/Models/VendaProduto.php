<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Venda;
use App\Models\Produto;


class VendaProduto extends Model
{
    protected $fillable = [
        'venda_id',
        'produto_id',
        'quantidade',
        'subtotal'
    ];

    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
