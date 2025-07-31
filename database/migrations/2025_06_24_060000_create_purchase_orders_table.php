<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_request_id')->constrained()->onDelete('cascade');
            $table->string('po_number', 50)->unique();
            $table->enum('status', ['draft', 'sent', 'complete'])->default('draft');
            $table->string('supplier_name')->nullable();
            $table->date('order_date')->nullable();
            $table->timestamps();
        });

        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained()->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_order_items');
        Schema::dropIfExists('purchase_orders');
    }
};
