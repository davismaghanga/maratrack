<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = ['name', 'opening_stock', 'current_stock', 'closing_stock','packaged_products'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);

    }
}
