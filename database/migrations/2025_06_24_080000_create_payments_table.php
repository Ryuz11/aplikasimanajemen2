<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained()->onDelete('cascade');
            $table->foreignId('goods_receipt_id')->constrained()->onDelete('cascade');
            $table->string('invoice_number');
            $table->date('tanggal');
            $table->decimal('jumlah', 15, 2);
            $table->string('bukti')->nullable(); // path file bukti pembayaran
            $table->enum('status', ['pending', 'paid'])->default('pending');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
