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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('pronouns')->nullable();
            $table->string('preferred_language')->nullable();
            $table->string('client_source')->nullable();
            $table->string('occupation')->nullable();
            $table->string('country')->nullable();
            $table->string('additional_email')->nullable();
            $table->string('additional_phone')->nullable();
            $table->string('e_primary_name')->nullable();
            $table->string('e_primary_relationship')->nullable();
            $table->string('e_primary_email')->nullable();
            $table->string('e_primary_phone')->nullable();
            $table->string('e_secondary_name')->nullable();
            $table->string('e_secondary_relationship')->nullable();
            $table->string('e_secondary_email')->nullable();
            $table->string('e_secondary_phone')->nullable();
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
        Schema::dropIfExists('clients');
    }
};
