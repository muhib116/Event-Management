<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_lists', function (Blueprint $table) {
            $table->boolean('admin_overview_notice')->default(0);
            $table->boolean('can_withdraw_notice')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_lists', function (Blueprint $table) {
            $table->dropColumn('admin_overview_notice');
            $table->dropColumn('can_withdraw_notice');
        });
    }
};
