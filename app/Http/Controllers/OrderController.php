<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Proses checkout
    public function checkout(Request $request)
    {
        $carts = Cart::with("product")
            ->where("user_id", Auth::id())
            ->where("status", "active")
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route("cart")->with("error", "Keranjang kosong.");
        }

        // Validasi stok
        foreach ($carts as $cart) {
            if ($cart->quantity > $cart->product->product_stock) {
                return redirect()->route("cart")->with("error", "Stok {$cart->product->product_name} tidak mencukupi.");
            }
        }

        // Hitung total
        $total = $carts->sum(function ($cart) {
            return $cart->product->product_price * $cart->quantity;
        });

        DB::beginTransaction();
        try {
            // Buat order
            $order = Order::create([
                "user_id" => Auth::id(),
                "order_number" => Order::generateOrderNumber(),
                "total_amount" => $total,
                "status" => "pending",
                "shipping_address" => Auth::user()->alamat,
            ]);

            // Kurangi stok dan buat order items
            foreach ($carts as $cart) {
                // Kurangi stok
                Product::where("product_id", $cart->product_id)->update([
                    "product_stock" => $cart->product->product_stock - $cart->quantity,
                ]);

                // Buat order item
                OrderItem::create([
                    "order_id" => $order->id,
                    "product_id" => $cart->product_id,
                    "quantity" => $cart->quantity,
                    "price" => $cart->product->product_price,
                ]);

                // Update cart status
                $cart->status = "checked_out";
                $cart->save();
            }

            DB::commit();

            return redirect()->route("orders.show", $order->id)
                ->with("success", "Pesanan berhasil dibuat! Order #{$order->order_number}");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("cart")->with("error", "Terjadi kesalahan. Silakan coba lagi.");
        }
    }

    // Riwayat pesanan user
    public function index()
    {
        $orders = Order::with("items")
            ->where("user_id", Auth::id())
            ->latest()
            ->paginate(10);

        return view("orders.index", compact("orders"));
    }

    // Detail pesanan user
    public function show($orderId)
    {
        $order = Order::with(["items.product", "user"])
            ->where("user_id", Auth::id())
            ->findOrFail($orderId);

        return view("orders.show", compact("order"));
    }

    // Semua pesanan (Admin)
    public function adminIndex()
    {
        $orders = Order::with(["user", "items"])
            ->latest()
            ->paginate(15);

        return view("admin.orders", compact("orders"));
    }

    // Update status pesanan (Admin)
    public function updateStatus(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $validated = $request->validate([
            "status" => "required|in:pending,paid,shipped,delivered,cancelled",
        ]);

        $order->status = $validated["status"];
        $order->save();

        return back()->with("success", "Status pesanan berhasil diperbarui.");
    }
}
