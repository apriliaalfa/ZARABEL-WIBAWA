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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Kode barang (SKU)
            $table->string('name');            // Nama produk
            $table->string('slug')->unique();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('category_name')->nullable();
            $table->decimal('price', 12, 2);   // Harga
            $table->decimal('discount_price', 12, 2)->nullable(); // Harga diskon/coret
            $table->integer('stock')->default(10);
            $table->string('main_image');      // Foto produk utama
            $table->json('gallery_images')->nullable(); // Foto-foto pendukung
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable(); // Isi deskripsi produk
            $table->longText('additional_information')->nullable(); // Additional information
            $table->json('sizes')->nullable(); // Pilihan ukuran ['xxs', 'xs', 's', 'm', 'l', 'xl']
            $table->decimal('rating', 3, 2)->default(5.00);
            $table->integer('reviews_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

