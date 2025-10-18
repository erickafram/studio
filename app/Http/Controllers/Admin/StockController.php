<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stockItems = Stock::orderBy('product_name')->get();
        return view('admin.stock.index', compact('stockItems'));
    }

    public function create()
    {
        return view('admin.stock.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'quantity' => ['required', 'integer', 'min:0'],
            'unit_cost' => ['nullable', 'numeric', 'min:0'],
            'minimum_quantity' => ['required', 'integer', 'min:0'],
        ]);

        Stock::create($validated);

        return redirect()->route('admin.stock.index')->with('success', 'Produto adicionado ao estoque com sucesso!');
    }

    public function edit(Stock $stock)
    {
        return view('admin.stock.edit', compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $validated = $request->validate([
            'product_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'quantity' => ['required', 'integer', 'min:0'],
            'unit_cost' => ['nullable', 'numeric', 'min:0'],
            'minimum_quantity' => ['required', 'integer', 'min:0'],
        ]);

        $stock->update($validated);

        return redirect()->route('admin.stock.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('admin.stock.index')->with('success', 'Produto excluído do estoque com sucesso!');
    }

    public function adjustQuantity(Request $request, Stock $stock)
    {
        $validated = $request->validate([
            'adjustment' => ['required', 'integer'],
            'reason' => ['required', 'string'],
        ]);

        $stock->quantity += $validated['adjustment'];
        $stock->save();

        return back()->with('success', 'Quantidade ajustada com sucesso!');
    }
}



