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
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->string('home_title')->nullable();
            $table->string('section1_title')->nullable();
            $table->text('section1_image')->nullable();
            $table->string('section1_desc',1000)->nullable();
            $table->string('section2_title')->nullable();
            $table->string('section2_video_link')->nullable();
            $table->string('last_section_title')->nullable();
            $table->string('last_section_desc',1000)->nullable();
            $table->text('last_section_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homes');
    }
};
