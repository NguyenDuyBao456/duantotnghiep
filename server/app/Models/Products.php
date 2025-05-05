<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //

    use HasFactory;

    public $timestamps = false;



    protected $table = 'products';
    protected $fillable = ['name', 'img', 'categories_id', 'subcategories_id', 'price','size', 'description'];

}
