<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan semua produk (bisa diakses semua orang)
    public function index(Request $request)
    {
        $query = Product::with("category");

        // Search functionality
        if ($request->has("search") && $request->search != "") {
            $query->where("product_name", "like", "%" . $request->search . "%");
        }

        $products = $query->paginate(12);

        return view("products.index", compact("products"));
    }

    // Detail produk
    public function show($id)
    {
        $product = Product::with("category")->findOrFail($id);
        return view("products.show", compact("product"));
    }
}
