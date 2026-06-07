<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminAuditLog extends Model
{
    protected $fillable = ['admin_user', 'product_id', 'hash_name', 'hash_price', 'hash_unit'];
}
