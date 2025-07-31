<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
            $table->integer('qty');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('requested_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_requests');
    }
};
