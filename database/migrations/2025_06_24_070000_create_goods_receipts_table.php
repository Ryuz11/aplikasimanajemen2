<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('goods_receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained()->onDelete('cascade');
            $table->date('tanggal');
            $table->string('kondisi', 50)->nullable();
            $table->string('bukti')->nullable(); // path file bukti
            $table->timestamps();
        });
        // Tabel pivot untuk barang yang diterima per GRN
        Schema::create('goods_receipt_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('goods_receipt_id')->constrained()->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
            $table->integer('jumlah_diterima');
            $table->string('keterangan', 30)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('goods_receipt_items');
        Schema::dropIfExists('goods_receipts');
    }
};
