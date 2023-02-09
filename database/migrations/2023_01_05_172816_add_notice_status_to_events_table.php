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
            $table->boolean('weekly_notice')->default(0);
            $table->boolean('hourly_notice')->default(0);
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
            $table->dropColumn('weekly_notice');
            $table->dropColumn('hourly_notice');
        });
    }
};
