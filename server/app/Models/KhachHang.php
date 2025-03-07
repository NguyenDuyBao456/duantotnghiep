<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    use HasFactory;

    protected $table = 'khachhang';
    protected $primaryKey = 'MaKH'; 

    protected $fillable = [
        'TenKH',
        'DiaChi',
        'Email',
        'MatKhau',
        'SDT',
        'HinhAnh',
    ];

    public $timestamps = false; 
}


