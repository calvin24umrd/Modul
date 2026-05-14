<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "carts";
    protected $fillable = ["user_id", "product_id", "quantity", "status"];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke product
    public function product()
    {
        return $this->belongsTo(Product::class, "product_id", "product_id");
    }

    // Subtotal per item
    public function getSubtotalAttribute(): float
    {
        return $this->quantity * $this->product->product_price;
    }
}
