<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; 
    protected $primaryKey = 'MaSP'; 
    public $timestamps = true; 
    protected $fillable = [
        'name', 'img', 'subcategories_id'
    ];
}
