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
        Schema::table('services', function (Blueprint $table) {
            $table->foreignId('default_service_id')->nullable()->after('id')
                ->constrained('services')->nullOnDelete();
            $table->boolean('is_active')->default(true)->after('service_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['default_service_id']);
            $table->dropColumn(['default_service_id', 'is_active']);
        });
    }
};
