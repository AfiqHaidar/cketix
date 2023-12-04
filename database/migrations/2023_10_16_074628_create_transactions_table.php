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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedDecimal('total', $precision = 10, $scale = 2);
            $table->foreignId('payment_method_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            $table->string('status');
            $table->string('receipt')->nullable()->default(null);;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
