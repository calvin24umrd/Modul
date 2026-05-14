<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

// ========================
// HALAMAN PUBLIK (Guest)
// ========================

// Home - lihat semua produk
Route::get("/", [ProductController::class, "index"])->name("home");

// Detail produk
Route::get("/produk/{id}", [ProductController::class, "show"])->name("products.show");

// ========================
// AUTH (Guest only)
// ========================
Route::middleware("guest")->group(function () {
    Route::get("/login", [AuthController::class, "showLogin"])->name("login");
    Route::post("/login", [AuthController::class, "login"])->name("login.proses");
    Route::get("/register", [AuthController::class, "showRegister"])->name("register");
    Route::post("/register", [AuthController::class, "register"])->name("register.proses");
});

// ========================
// USER (Harus login, role user)
// ========================
Route::middleware(["auth", "user"])->group(function () {
    // Dashboard
    Route::get("/dashboard", [AuthController::class, "dashboard"])->name("dashboard");

    // Profil
    Route::get("/profile", [AuthController::class, "editProfile"])->name("profile");
    Route::post("/profile", [AuthController::class, "updateProfile"])->name("profile.update");

    // Cart
    Route::get("/cart", [CartController::class, "index"])->name("cart");
    Route::post("/cart/add/{productId}", [CartController::class, "add"])->name("cart.add");
    Route::post("/cart/update/{cartId}", [CartController::class, "update"])->name("cart.update");
    Route::post("/cart/remove/{cartId}", [CartController::class, "remove"])->name("cart.remove");

    // Checkout
    Route::post("/checkout", [OrderController::class, "checkout"])->name("checkout");

    // Orders
    Route::get("/orders", [OrderController::class, "index"])->name("orders");
    Route::get("/orders/{orderId}", [OrderController::class, "show"])->name("orders.show");
});

// ========================
// ADMIN (Harus login, role admin)
// ========================
Route::middleware(["auth", "admin"])->prefix("admin")->group(function () {
    Route::get("/dashboard", [AdminController::class, "dashboard"])->name("admin.dashboard");
    Route::get("/products", [AdminController::class, "products"])->name("admin.products");
    Route::get("/users", [AdminController::class, "users"])->name("admin.users");
    Route::get("/orders", [AdminController::class, "orders"])->name("admin.orders");
    Route::post("/orders/{orderId}/status", [OrderController::class, "updateStatus"])->name("admin.orders.updateStatus");
});

// ========================
// LOGOUT (Semua user login)
// ========================
Route::post("/logout", [AuthController::class, "logout"])->name("logout")->middleware("auth");

