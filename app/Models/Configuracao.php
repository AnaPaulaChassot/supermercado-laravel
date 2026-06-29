<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Configuracao extends Model
{
    protected $fillable = [
        'url_cacapay',
        'token_cacapay',
        'url_cacalog',
        'token_cacalog'
    ];
}
