<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        
        // vendas por mês
        $vendasPorMes = Venda::select(
                DB::raw('YEAR(created_at) as ano'),
                DB::raw('MONTH(created_at) as mes'),
                DB::raw('COUNT(*) as total_vendas'),
                DB::raw('SUM(valor_total) as faturamento')
            )
            ->groupBy('ano', 'mes')
            ->orderBy('ano')
            ->orderBy('mes')
            ->get();


        // clientes por mês
        $clientesPorMes = Cliente::select(
                DB::raw('YEAR(created_at) as ano'),
                DB::raw('MONTH(created_at) as mes'),
                DB::raw('COUNT(*) as total_clientes')
            )
            ->groupBy('ano', 'mes')
            ->orderBy('ano')
            ->orderBy('mes')
            ->get();


        //clientes + vendas
        $clientes = Cliente::withCount('vendas') 
            ->withSum('vendas', 'valor_total')
            ->orderByDesc('vendas_sum_valor_total')
            ->get();

        return view('dashboard', compact(
            'vendasPorMes',
            'clientesPorMes',
            'clientes'
        ));
    }
}