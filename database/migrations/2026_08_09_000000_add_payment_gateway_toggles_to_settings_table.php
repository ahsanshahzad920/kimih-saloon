<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentGatewayTogglesToSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('stripe_enabled')->default(false)->after('partner_terms');
            $table->boolean('jazzcash_enabled')->default(true)->after('stripe_enabled');
            $table->boolean('easypaisa_enabled')->default(true)->after('jazzcash_enabled');
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['stripe_enabled', 'jazzcash_enabled', 'easypaisa_enabled']);
        });
    }
}
