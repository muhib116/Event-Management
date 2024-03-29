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
        Schema::create('ticket_sales', function (Blueprint $table) {
            $table->id();

            $table->integer('organizer_id')->unsigned()->nullable();
            $table->integer('guest_id')->unsigned()->nullable();
            $table->integer('ticket_id')->unsigned()->nullable();
            $table->string('ticket_type', 100)->nullable();
            $table->integer('quantity')->unsigned()->default(0);
            $table->float('commission')->default(0);
            $table->float('price')->default(0);
            
            $table->string('payment_method', 100)->nullable();
            $table->json('settings')->nullable();
            $table->string('status', 100)->default('complete');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_sales');
    }
};
