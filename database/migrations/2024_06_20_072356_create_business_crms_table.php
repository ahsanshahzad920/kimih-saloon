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
        Schema::create('business_crms', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained('users');

            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('header_image')->nullable();

            $table->string('capterra_image')->nullable();
            $table->string('capterra_rating')->nullable();
            $table->json('capterra_review')->nullable();

            $table->string('top_rating_title')->nullable();
            $table->text('top_rating_description')->nullable();
            $table->string('business_partner_count')->nullable();
            $table->string('business_partner_title')->nullable();
            $table->string('appointmens_count')->nullable();
            $table->string('appointmens_title')->nullable();
            $table->string('stylists_count')->nullable();
            $table->string('stylists_title')->nullable();
            $table->string('countries_count')->nullable();
            $table->string('countries_title')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_crms');
    }
};
