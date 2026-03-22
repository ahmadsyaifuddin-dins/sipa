<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->enum('type', ['barang', 'jasa']); // Pembeda ATK & Fotocopy
            $table->string('kode')->unique();
            $table->string('nama');
            $table->integer('harga');
            $table->integer('stok')->nullable(); // Null karena Jasa tidak pakai stok
            $table->string('foto')->nullable();  // Sesuai aturan: simpan nama file saja
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
