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
        Schema::table('appointments', function (Blueprint $table) {
            $table->index('status');
            $table->index('payment_status');
            $table->index('start');
            $table->index(['created_by', 'status']);
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->index('created_at');
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->index('status');
            $table->index('date');
            $table->index(['created_by', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['payment_status']);
            $table->dropIndex(['start']);
            $table->dropIndex(['created_by', 'status']);
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['date']);
            $table->dropIndex(['created_by', 'status']);
        });
    }
};
