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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name');
            $table->string('service_type');
            $table->foreignId('service_category')->constrained('service_categories')->onDelete('cascade');
            $table->string('available_for')->nullable();
            $table->string('aftercare_description')->nullable();
            $table->string('service_description')->nullable();
            $table->string('online_bookings')->nullable();
            $table->string('team_member')->nullable();
            $table->string('team_memeber_commission')->nullable();
            $table->string('duration')->nullable();
            $table->string('price_type')->nullable();
            $table->float('price')->nullable();
            $table->string('notify')->nullable();
            $table->string('notify_count')->nullable();
            $table->string('notify_days')->nullable();
            $table->string('sales_tax')->nullable();
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
        Schema::dropIfExists('services');
    }
};
