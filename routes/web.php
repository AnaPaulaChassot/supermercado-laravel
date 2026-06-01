<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\FotoProdutoController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CarrinhoController;

/*Route::get('/', function () {
    return view('cliente');
});*/

Route::get('/', [LoginController::class, 'cliente'])
    ->name('cliente');

//proteção de rota login cliente
Route::middleware('login')->group(function () {
    Route::get('/clientes', [ClienteController::class, 'listar'])->name('cliente.listar');
    Route::get('/clientes/edit/{id}', [ClienteController::class, 'edit'])->name('cliente.edit');
    Route::get('/clientes/delete/{id}', [ClienteController::class, 'delete'])->name('cliente.delete');
    Route::get('/enderecos', [EnderecoController::class, 'listar'])->name('enderecos.listar');
    Route::get('/enderecos/novo', [EnderecoController::class, 'novo'])->name('enderecos.novo');
    Route::post('/enderecos/salvar/{id?}', [EnderecoController::class, 'salvar'])->name('enderecos.salvar');
    Route::get('/enderecos/edit/{id}', [EnderecoController::class, 'edit'])->name('enderecos.edit');
    Route::get('/enderecos/delete/{id}', [EnderecoController::class, 'delete'])->name('enderecos.delete');
    Route::get('/enderecos/show/{id}', [EnderecoController::class, 'show']);
    Route::get('/vendas/novo/{id}', [VendaController::class, 'novo'])->name('vendas.novo');
    Route::post('/vendas/salvar', [VendaController::class, 'salvar'])->name('vendas.salvar');
    Route::get('/vendas/edit/{id}', [VendaController::class, 'edit'])->name('vendas.edit');
    Route::get('/vendas/delete/{id}', [VendaController::class, 'delete'])->name('vendas.delete');
    Route::get('/vendas/show/{id}', [VendaController::class, 'show'])->name('vendas.show');
    Route::post('/carrinho/adicionar', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
    Route::get('/carrinho', [CarrinhoController::class, 'listar'])->name('carrinho');
    Route::get('/carrinho/delete/{id}', [CarrinhoController::class, 'delete'])->name('carrinho.delete');
});


Route::get('/clientes/novo', [ClienteController::class, 'novo'])->name('cliente.novo');
Route::post('/clientes/salvar/{id?}', [ClienteController::class, 'salvar'])->name('cliente.salvar');
//login
Route::get('/login', [LoginController::class, 'form'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.entrar');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/mercado', [LoginController::class, 'cliente'])
    ->name('cliente');

Route::get('/mercado', [ClienteController::class, 'cliente'])
    ->name('mercado');


Route::middleware('login.admin')->group(function () {
    Route::get('/vendas', [VendaController::class, 'listar'])->name('vendas.listar');
    //categorias
    Route::get('/categorias', [CategoriaController::class, 'listar'])->name('cat.listar');
    Route::get('/categorias/novo', [CategoriaController::class, 'novo'])->name('cat.novo');
    Route::post('/categorias/salvar/{id?}', [CategoriaController::class, 'salvar'])->name('cat.salvar');
    Route::get('/categorias/edit/{id}', [CategoriaController::class, 'edit'])->name('cat.edit');
    Route::get('/categorias/delete/{id}', [CategoriaController::class, 'delete'])->name('cat.delete');
    Route::get('/categorias/show/{id}', [CategoriaController::class, 'show']);

    //produtos
    Route::get('/produtos', [ProdutoController::class, 'listar'])->name('prod.listar');
    Route::get('/produtos/novo', [ProdutoController::class, 'novo']);
    Route::post('/produtos/salvar/{id?}', [ProdutoController::class, 'salvar'])->name('prod.salvar');
    Route::get('/produtos/edit/{id}', [ProdutoController::class, 'edit'])->name('prod.edit');
    Route::get('/produtos/delete/{id}', [ProdutoController::class, 'delete']);

    //foto-produtos
    Route::get('/foto-produtos', [FotoProdutoController::class, 'listar'])->name('foto-produtos.listar');
    Route::get('/foto-produtos/novo', [FotoProdutoController::class, 'novo'])->name('foto-produtos.novo');
    Route::post('/foto-produtos/salvar/{id?}', [FotoProdutoController::class, 'salvar'])->name('foto-produtos.salvar');
    Route::get('/foto-produtos/edit/{id}', [FotoProdutoController::class, 'edit'])->name('foto-produtos.edit');
    Route::get('/foto-produtos/delete/{id}', [FotoProdutoController::class, 'delete'])->name('foto-produtos.delete');

    //cidade
    Route::get('/cidades', [CidadeController::class, 'listar'])->name('cidade.listar');
    Route::get('/cidades/novo', [CidadeController::class, 'novo'])->name('cidade.novo');
    Route::post('/cidades/salvar/{id?}', [CidadeController::class, 'salvar'])->name('cidade.salvar');
    Route::get('/cidades/edit/{id}', [CidadeController::class, 'edit'])->name('cidade.edit');
    Route::get('/cidades/delete/{id}', [CidadeController::class, 'delete'])->name('cidade.delete');

    //usuarios
    Route::get('/usuarios', [UsuarioController::class, 'listar'])->name('usu.listar');
    Route::get('/usuarios/novo', [UsuarioController::class, 'novo'])->name('usu.novo');
    Route::post('/usuarios/salvar/{id?}', [UsuarioController::class, 'salvar'])->name('usu.salvar');
    Route::get('/usuarios/edit/{id}', [UsuarioController::class, 'edit'])->name('usu.edit');
    Route::get('/usuarios/delete/{id}', [UsuarioController::class, 'delete'])->name('usu.delete');
    Route::view('/administrador', 'administrador')->name('administrador');
});
