<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHangChiTiet extends Model
{
    use HasFactory;
    protected $table = 'donhangchitiet';
    protected $primaryKey = 'MaDHCT';
    protected $fillable = ['MaDH', 'MaSP', 'Gia', 'SoLuong'];

    public function sanpham()
    {
        return $this->belongsTo(Product::class, 'MaSP');
    }

    public function donhang()
    {
        return $this->belongsTo(DonHang::class, 'MaDH');
    }
}

