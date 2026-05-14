<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Tampilkan keranjang
    public function index()
    {
        $carts = Cart::with("product")
            ->where("user_id", Auth::id())
            ->where("status", "active")
            ->get();

        $total = $carts->sum(function ($cart) {
            return $cart->product->product_price * $cart->quantity;
        });

        return view("cart.index", compact("carts", "total"));
    }

    // Tambah ke keranjang
    public function add($productId)
    {
        $product = Product::findOrFail($productId);

        // Cek apakah produk sudah ada di keranjang
        $existingCart = Cart::where("user_id", Auth::id())
            ->where("product_id", $productId)
            ->where("status", "active")
            ->first();

        if ($existingCart) {
            // Jika sudah ada, tambah quantity
            if ($existingCart->quantity < $product->product_stock) {
                $existingCart->quantity++;
                $existingCart->save();
            } else {
                return back()->with("error", "Stok tidak mencukupi.");
            }
        } else {
            // Jika belum ada, buat baru
            if ($product->product_stock < 1) {
                return back()->with("error", "Stok habis.");
            }

            Cart::create([
                "user_id" => Auth::id(),
                "product_id" => $productId,
                "quantity" => 1,
                "status" => "active",
            ]);
        }

        return redirect()->route("cart")->with("success", "Produk ditambahkan ke keranjang.");
    }

    // Update quantity
    public function update(Request $request, $cartId)
    {
        $cart = Cart::where("user_id", Auth::id())->findOrFail($cartId);
        $quantity = (int) $request->quantity;

        if ($quantity <= 0) {
            $cart->delete();
            return redirect()->route("cart")->with("success", "Item dihapus dari keranjang.");
        }

        if ($quantity > $cart->product->product_stock) {
            return back()->with("error", "Jumlah melebihi stok tersedia.");
        }

        $cart->quantity = $quantity;
        $cart->save();

        return back()->with("success", "Jumlah berhasil diperbarui.");
    }

    // Hapus dari keranjang
    public function remove($cartId)
    {
        $cart = Cart::where("user_id", Auth::id())->findOrFail($cartId);
        $cart->delete();

        return redirect()->route("cart")->with("success", "Item dihapus dari keranjang.");
    }
}
