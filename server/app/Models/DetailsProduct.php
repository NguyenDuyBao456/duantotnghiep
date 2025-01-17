<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsProduct extends Model
{
    //

    use HasFactory;

    protected $fillable = ["size", "color", "material"];
}
