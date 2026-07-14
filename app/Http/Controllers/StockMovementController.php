<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreStockMovementRequest;
use App\Http\Requests\UpdateStockMovementRequest;

class StockMovementController extends Controller
{
    /**
     * Display a listing.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $stockMovements = StockMovement::with(['product', 'user'])
            ->search($search)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('stock_movements.index', compact(
            'stockMovements',
            'search'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('stock_movements.create', compact('products'));
    }

    /**
     * Store a newly created resource.
     */
    public function store(StoreStockMovementRequest $request)
    {
        DB::transaction(function () use ($request) {

            $product = Product::findOrFail($request->product_id);

            if (
                $request->type === 'OUT' &&
                $product->quantity < $request->quantity
            ) {
                abort(422, 'Stock insuffisant.');
            }

            if ($request->type === 'IN') {
                $product->increment('quantity', $request->quantity);
            } else {
                $product->decrement('quantity', $request->quantity);
            }

            StockMovement::create([
                'product_id' => $product->id,
                'user_id'    => Auth::id(),
                'type'       => $request->type,
                'quantity'   => $request->quantity,
                'reference'  => $request->reference,
                'notes'      => $request->notes,
            ]);
        });

        return redirect()
            ->route('stock-movements.index')
            ->with('success', 'Mouvement de stock créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StockMovement $stockMovement)
    {
        $stockMovement->load('product', 'user');

        return view('stock_movements.show', compact('stockMovement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockMovement $stockMovement)
    {
        $products = Product::orderBy('name')->get();
        $stockMovement->load('product');

        return view('stock_movements.edit', compact('stockMovement', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStockMovementRequest $request, StockMovement $stockMovement)
    {
        DB::transaction(function () use ($request, $stockMovement) {
            $stockMovement->load('product');

            $oldProduct = $stockMovement->product;
            $newProduct = Product::findOrFail($request->product_id);

            if ($stockMovement->type === 'IN') {
                if ($oldProduct->quantity < $stockMovement->quantity) {
                    abort(422, 'Stock insuffisant pour restaurer le mouvement précédent.');
                }
                $oldProduct->decrement('quantity', $stockMovement->quantity);
            } else {
                $oldProduct->increment('quantity', $stockMovement->quantity);
            }

            if ($oldProduct->id !== $newProduct->id) {
                $newProduct->refresh();
            }

            if ($request->type === 'OUT' && $newProduct->quantity < $request->quantity) {
                abort(422, 'Stock insuffisant pour appliquer le nouveau mouvement.');
            }

            if ($request->type === 'IN') {
                $newProduct->increment('quantity', $request->quantity);
            } else {
                $newProduct->decrement('quantity', $request->quantity);
            }

            $stockMovement->update([
                'product_id' => $newProduct->id,
                'type'       => $request->type,
                'quantity'   => $request->quantity,
                'reference'  => $request->reference,
                'notes'      => $request->notes,
            ]);
        });

        return redirect()
            ->route('stock-movements.index')
            ->with('success', 'Mouvement de stock modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockMovement $stockMovement)
    {
        DB::transaction(function () use ($stockMovement) {
            $stockMovement->load('product');
            $product = $stockMovement->product;

            if ($stockMovement->type === 'IN') {
                if ($product->quantity < $stockMovement->quantity) {
                    abort(422, 'Stock insuffisant pour supprimer ce mouvement.');
                }
                $product->decrement('quantity', $stockMovement->quantity);
            } else {
                $product->increment('quantity', $stockMovement->quantity);
            }

            $stockMovement->delete();
        });

        return redirect()
            ->route('stock-movements.index')
            ->with('success', 'Mouvement de stock supprimé avec succès.');
    }
}
