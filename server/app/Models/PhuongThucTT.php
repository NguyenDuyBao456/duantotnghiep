<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhuongThucTT extends Model
{
    use HasFactory;

    protected $table = 'phuongthuctt'; 

    protected $primaryKey = 'MaPTTT'; 
    protected $fillable = [
        'TenPTTT',
    ];

    public $timestamps = false; 
}

