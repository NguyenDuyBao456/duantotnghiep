<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preview extends Model
{
    use HasFactory;

    protected $table = 'preview';
    protected $primaryKey = 'MaDG'; // Khóa chính của bảng

    public $timestamps = false;
    protected $fillable = ['id_user', 'id_product', 'content', 'Rating'];


}
