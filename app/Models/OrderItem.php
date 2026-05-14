<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = "order_items";
    protected $fillable = ["order_id", "product_id", "quantity", "price"];

    // Relasi ke order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi ke product
    public function product()
    {
        return $this->belongsTo(Product::class, "product_id", "product_id");
    }

    // Subtotal
    public function getSubtotalAttribute(): float
    {
        return $this->quantity * $this->price;
    }
}
