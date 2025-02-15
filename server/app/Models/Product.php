<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['name', 'img', 'categories_id', 'subcategories_id'];
}
