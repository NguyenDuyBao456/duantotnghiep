<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategories extends Model
{
    //
    use HasFactory;


    public $timestamps = false;



    protected $table = 'subcategories';
    protected $fillable = ['id', 'name', 'categories_id'];


}

