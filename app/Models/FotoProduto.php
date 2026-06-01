<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoProduto extends Model
{
    protected $fillable = [
        'nome_arquivo',
        'produto_id'
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
