<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Endereco;
use App\Models\Venda;
use App\Models\Usuario;

class Cliente extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'data_nascimento',
        'telefone',
        'email',
        'senha',
        'usuario_id'
    ];

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }

    public function usuario()
{
    return $this->belongsTo(Usuario::class);
}
}
