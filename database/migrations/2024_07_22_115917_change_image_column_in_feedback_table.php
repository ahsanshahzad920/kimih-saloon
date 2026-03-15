<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeImageColumnInFeedbackTable extends Migration
{
    public function up()
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->string('image')->nullable(false)->change();
        });
    }
}
