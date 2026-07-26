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
            $table->index(['created_by', 'start'], 'idx_appointments_creator_start');
            $table->index(['client_id'], 'idx_appointments_client_id');
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->index(['created_by', 'created_at'], 'idx_sales_creator_date');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->index(['created_by'], 'idx_services_creator');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->index(['created_by'], 'idx_products_creator');
        });

        Schema::table('business_images', function (Blueprint $table) {
            $table->index(['business_id'], 'idx_business_images_biz');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropIndex('idx_appointments_creator_start');
            $table->dropIndex('idx_appointments_client_id');
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->dropIndex('idx_sales_creator_date');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex('idx_services_creator');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('idx_products_creator');
        });

        Schema::table('business_images', function (Blueprint $table) {
            $table->dropIndex('idx_business_images_biz');
        });
    }
};
