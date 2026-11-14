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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->string('payment_method'); // bank_transfer, e_wallet, qris, cod
            $table->string('payment_channel')->nullable(); // bca, bni, mandiri, bri, bsi, gopay, ovo, dana, spay
            $table->string('account_number')->nullable(); // No Rek / No VA
            $table->decimal('amount', 12, 2);
            $table->string('payment_proof')->nullable(); // Path bukti transfer
            $table->enum('payment_status', ['unpaid', 'waiting_verification', 'paid', 'expired', 'failed'])->default('unpaid');
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

