<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;
    protected $table = 'donhang';
    protected $primaryKey = 'MaDH';
    protected $fillable = ['MaKH', 'MaPTTT', 'MaVC', 'TrangThai', 'NgayDat', 'TongTien'];

    public function khachhang()
    {
        return $this->belongsTo(KhachHang::class, 'MaKH');
    }

    public function phuongthuctt()
    {
        return $this->belongsTo(PhuongThucTT::class, 'MaPTTT');
    }

    public function vanchuyen()
    {
        return $this->belongsTo(VanChuyen::class, 'MaVC');
    }

    public function donhangchitiet()
    {
        return $this->hasMany(DonHangChiTiet::class, 'MaDH');
    }
}

