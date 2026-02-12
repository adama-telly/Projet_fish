<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'total',
        'name',
        'phone',
        'address',
        'statut',
        'mode_paiement',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
