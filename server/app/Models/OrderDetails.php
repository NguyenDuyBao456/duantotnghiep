<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'orderdetails';
    protected $fillable = ['id_order', 'id_product', 'price', 'quantity'];
}

