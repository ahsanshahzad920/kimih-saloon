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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->date('date');
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->string('discount')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('grand_total');
            $table->string('payment_method')->nullable();
            $table->string('cash_received');
            $table->string('cash_return')->nullable();
            $table->string('due_amount')->nullable();
            $table->string('cash_received_by')->nullable();
            $table->string('sale_note')->nullable();
            $table->string('status')->default('pending');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
