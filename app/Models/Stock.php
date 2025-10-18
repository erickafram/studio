<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stock';

    protected $fillable = [
        'product_name',
        'description',
        'quantity',
        'unit_cost',
        'minimum_quantity',
    ];

    protected $casts = [
        'unit_cost' => 'decimal:2',
    ];

    public function isLowStock()
    {
        return $this->quantity <= $this->minimum_quantity;
    }

    public function scopeLowStock($query)
    {
        return $query->whereRaw('quantity <= minimum_quantity');
    }
}



