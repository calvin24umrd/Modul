<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Insert categories without foreign key dependency
        DB::table("categories")->insert([
            ["category_id" => 1, "category_name" => "Sport", "created_at" => now(), "updated_at" => now()],
            ["category_id" => 2, "category_name" => "Casual", "created_at" => now(), "updated_at" => now()],
            ["category_id" => 3, "category_name" => "Classic", "created_at" => now(), "updated_at" => now()],
        ]);

        // Buat akun Admin
        User::updateOrCreate(
            ["email" => "admin@toko.com"],
            [
                "name" => "Admin Toko",
                "email" => "admin@toko.com",
                "password" => Hash::make("password"),
                "role" => "admin",
                "alamat" => "Jl. Admin No. 1, Bandung",
                "no_telepon" => "081234567890",
            ]
        );

        // Sample products
        $products = [
            ["category_id" => 1, "product_name" => "Nike Air Jordan 1", "product_price" => 2500000, "product_stock" => 10, "description" => "Sepatu basket klasik dari Nike."],
            ["category_id" => 1, "product_name" => "Adidas Ultraboost 22", "product_price" => 2800000, "product_stock" => 8, "description" => "Sepatu lari premium dengan teknologi Boost."],
            ["category_id" => 2, "product_name" => "Puma RS-X", "product_price" => 1800000, "product_stock" => 12, "description" => "Sepatu lifestyle dengan desain retro-modern."],
            ["category_id" => 2, "product_name" => "New Balance 574", "product_price" => 1500000, "product_stock" => 15, "description" => "Sepatu kasual klasik."],
            ["category_id" => 3, "product_name" => "Converse Chuck Taylor", "product_price" => 900000, "product_stock" => 20, "description" => "Sepatu canvas klasik."],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(["product_name" => $product["product_name"]], $product);
        }
    }
}