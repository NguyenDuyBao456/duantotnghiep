<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('donhangchitiet', function (Blueprint $table) {
        $table->id('MaDHCT');
        $table->foreignId('MaDH')->constrained('donhang')->onDelete('cascade');
        $table->foreignId('MaSP')->constrained('sanpham')->onDelete('cascade');
        $table->decimal('Gia', 10, 2);
        $table->integer('SoLuong');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hang_chi_tiets');
    }
};
