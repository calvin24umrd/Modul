<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $primaryKey = "product_id";
    public $timestamps = false;
    protected $fillable = [
        "category_id",
        "product_name",
        "product_price",
        "product_stock",
        "description",
        "image",
    ];

    // Relasi ke category
    public function category()
    {
        return $this->belongsTo(Category::class, "category_id", "category_id");
    }

    // Relasi ke carts
    public function carts()
    {
        return $this->hasMany(Cart::class, "product_id", "product_id");
    }

    // Relasi ke order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, "product_id", "product_id");
    }

    // Cek stok tersedia
    public function hasStock(): bool
    {
        return $this->product_stock > 0;
    }

    // Format harga
    public function getFormattedPriceAttribute(): string
    {
        return "Rp " . number_format($this->product_price, 0, ",", ".");
    }
}
