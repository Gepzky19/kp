<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'status',
        'paid_at',
        'shipping_address',
        'payment_method',
    ];
    

    protected $dates = [
        'paid_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
