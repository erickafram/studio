<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cashflow;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CashflowController extends Controller
{
    public function index(Request $request)
    {
        $query = Cashflow::with('appointment');

        // Filtros
        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('transaction_date', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('transaction_date', '<=', $request->end_date);
        }

        $transactions = $query->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Totais
        $totalEntradas = $query->where('type', 'entrada')->sum('amount');
        $totalSaidas = $query->where('type', 'saida')->sum('amount');
        $saldo = $totalEntradas - $totalSaidas;

        return view('admin.cashflow.index', compact('transactions', 'totalEntradas', 'totalSaidas', 'saldo'));
    }

    public function create()
    {
        return view('admin.cashflow.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required', 'in:entrada,saida'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'description' => ['required', 'string', 'max:255'],
            'transaction_date' => ['required', 'date'],
            'category' => ['required', 'in:servico,produto,despesa,outro'],
        ]);

        Cashflow::create($validated);

        return redirect()->route('admin.cashflow.index')->with('success', 'Transação registrada com sucesso!');
    }

    public function edit(Cashflow $cashflow)
    {
        return view('admin.cashflow.edit', compact('cashflow'));
    }

    public function update(Request $request, Cashflow $cashflow)
    {
        $validated = $request->validate([
            'type' => ['required', 'in:entrada,saida'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'description' => ['required', 'string', 'max:255'],
            'transaction_date' => ['required', 'date'],
            'category' => ['required', 'in:servico,produto,despesa,outro'],
        ]);

        $cashflow->update($validated);

        return redirect()->route('admin.cashflow.index')->with('success', 'Transação atualizada com sucesso!');
    }

    public function destroy(Cashflow $cashflow)
    {
        $cashflow->delete();
        return redirect()->route('admin.cashflow.index')->with('success', 'Transação excluída com sucesso!');
    }

    public function dailyReport(Request $request)
    {
        $date = $request->get('date', Carbon::today()->format('Y-m-d'));
        
        $entradas = Cashflow::entrada()->byDate($date)->get();
        $saidas = Cashflow::saida()->byDate($date)->get();
        
        $totalEntradas = $entradas->sum('amount');
        $totalSaidas = $saidas->sum('amount');
        $saldo = $totalEntradas - $totalSaidas;

        return view('admin.cashflow.daily-report', compact('date', 'entradas', 'saidas', 'totalEntradas', 'totalSaidas', 'saldo'));
    }
}



