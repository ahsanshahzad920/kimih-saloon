<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialMediaLinksToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->after('remember_token', function ($table) {
                $table->string('facebook_link')->nullable();
                $table->string('twitter_link')->nullable();
                $table->string('instagram_link')->nullable();
                $table->string('linkedin_link')->nullable();
                $table->string('vimo_link')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['facebook_link', 'twitter_link', 'instagram_link', 'linkedin_link', 'vimo']);
        });
    }
}
