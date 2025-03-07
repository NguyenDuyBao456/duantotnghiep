<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VanChuyen extends Model
{
    use HasFactory;

    protected $table = 'VanChuyen';

    protected $primaryKey = 'MaVC'; 
    public $timestamps = false; 
    protected $fillable = ['TenPTVC']; 
}
