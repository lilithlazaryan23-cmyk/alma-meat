<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = ['product_id', 'qty', 'total_price', 'status', 'source'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
