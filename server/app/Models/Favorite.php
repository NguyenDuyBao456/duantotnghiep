<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorite';
    protected $primaryKey = 'MaYT';
    public $timestamps = false;
    protected $fillable = ['id_user', 'id_product'];



}

