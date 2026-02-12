<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function home()
    {
        $latest = Product::orderBy('created_at', 'desc')->take(6)->get();
        return view('welcome', compact('latest'));
    }

    public function index()
    {
        $products = Product::orderBy('nom')->paginate(12);
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function createOrder(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $quantity = $validated['quantity'];
        $total = $product->prix * $quantity;

        return view('orders.confirm', compact('product', 'quantity', 'total'));
    }

    public function submitOrder(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total' => 'required|numeric',
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        // Ajouter user_id si l'utilisateur est connecté
        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        }

        $order = \App\Models\Order::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['message' => 'Merci de votre commande']);
        }

        return redirect('/')->with('success', 'Commande validée ! Référence : #' . $order->id);
    }
}
