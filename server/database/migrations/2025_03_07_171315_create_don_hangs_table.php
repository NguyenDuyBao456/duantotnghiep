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
    Schema::create('donhang', function (Blueprint $table) {
        $table->id('MaDH');
        $table->foreignId('MaKH')->constrained('khachhang')->onDelete('cascade');
        $table->foreignId('MaPTTT')->constrained('phuongthuctt')->onDelete('cascade');
        $table->foreignId('MaVC')->nullable()->constrained('vanchuyen')->onDelete('set null');
        $table->string('TrangThai')->default('pending');
        $table->dateTime('NgayDat');
        $table->decimal('TongTien', 10, 2);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hangs');
    }
};
