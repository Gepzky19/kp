<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'address', 'products', 'total_price', 'amount_paid', 'change', 'paid_at'
    ];

    protected $casts = [
        'products' => 'array', // Mengubah data produk menjadi array
        'paid_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

