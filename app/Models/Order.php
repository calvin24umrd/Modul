<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = [
        "user_id",
        "order_number",
        "total_amount",
        "status",
        "shipping_address",
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke order items
    public function items()
    {
        return $this->hasMany(OrderItem::class, "order_id");
    }

    // Format total
    public function getFormattedTotalAttribute(): string
    {
        return "Rp " . number_format($this->total_amount, 0, ",", ".");
    }

    // Generate order number
    public static function generateOrderNumber(): string
    {
        return "ORD-" . date("YmdHis") . "-" . rand(1000, 9999);
    }
}
