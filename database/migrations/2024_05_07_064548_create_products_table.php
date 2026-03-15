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
            $table->string('name');
            $table->foreignId('category_id')->constrained('product_categories')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('product_brands')->onDelete('cascade');
            $table->string('product_short_description');
            $table->string('description');
            $table->string('measureType');
            $table->string('amount');
            $table->string('supply_price');
            $table->string('retail_sales')->nullable();
            $table->string('retail_price')->nullable();
            $table->string('marked')->nullable();
            $table->string('sales_tax')->nullable();
            $table->string('team_memeber_commission')->nullable();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->string('track_stock_quantity')->nullable();
            $table->string('current_stock_quantity')->nullable();
            $table->string('low_stock_level')->nullable();
            $table->string('reorder_quantity')->nullable();
            $table->string('low_stock_noti')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('cascade');
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
