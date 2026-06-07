<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['name', 'img', 'category', 'brand', 'type', 'recept', 'price', 'sale', 'liked'];

    protected $casts = [
        'price' => 'decimal:2',
        'liked' => 'boolean',
    ];

    public function warehouses(): HasMany
    {
        return $this->hasMany(Warehouse::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
