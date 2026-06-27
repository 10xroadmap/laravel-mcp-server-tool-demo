<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    public $timestamps = true;
    protected $table = 'order_status';
    protected $fillable = ['order_id', 'product', 'status'];
}
