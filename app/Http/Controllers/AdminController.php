<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard admin
    public function dashboard()
    {
        $stats = [
            "totalProducts" => Product::count(),
            "totalUsers" => User::where("role", "user")->count(),
            "totalOrders" => Order::count(),
            "totalRevenue" => Order::where("status", "!=", "cancelled")->sum("total_amount"),
        ];

        $recentOrders = Order::with("user")->latest()->take(5)->get();

        return view("admin.dashboard", compact("stats", "recentOrders"));
    }

    // Lihat semua produk (hanya baca)
    public function products()
    {
        $products = Product::with("category")->paginate(15);

        return view("admin.products", compact("products"));
    }

    // Lihat semua user
    public function users()
    {
        $users = User::where("role", "user")->latest()->paginate(15);

        return view("admin.users", compact("users"));
    }

    // Lihat semua transaksi
    public function orders()
    {
        $orders = Order::with("user")->latest()->paginate(15);

        return view("admin.orders", compact("orders"));
    }
}
