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
        Schema::table('blogs', function (Blueprint $table) {
            // First, drop the existing foreign key constraint
            $table->dropForeign(['blog_type_id']);

            // Then, add the foreign key with onDelete('cascade')
            $table->foreign('blog_type_id')
                ->references('id')
                ->on('blog_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            // Drop the foreign key with onDelete('cascade')
            $table->dropForeign(['blog_type_id']);

            // Re-add the original foreign key constraint without onDelete('cascade')
            $table->foreign('blog_type_id')
                ->references('id')
                ->on('blog_types');
        });
    }
};
