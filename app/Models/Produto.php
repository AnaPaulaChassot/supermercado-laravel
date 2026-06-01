<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
       protected $fillable = [
        'nome',
        'descricao',
        'quantidade_estoque',
        'slug',
        'valor',
        'categoria_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function fotos()
    {
        return $this->hasMany(FotoProduto::class);
    }

    public function vendas()
    {
        return $this->belongsToMany(
            Venda::class,
            'venda_produtos'
        )->withPivot(
            'quantidade',
            'subtotal'
        )->withTimestamps();
    }
}
