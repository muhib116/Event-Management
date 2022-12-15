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
        Schema::create('event_tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id')->unsigned();
            $table->string('ticketType', 100)->nullable();
            $table->string('ticket_name', 150)->nullable();
            $table->string('ticket_stock', 150)->nullable();
            $table->integer('stock_limit')->unsigned()->nullable();
            $table->float('price')->default(0);
            $table->integer('purchase_limit')->unsigned()->nullable();
            $table->text('ticket_description')->nullable();
            $table->boolean('isTransferFeesToGuest')->nullable()->default(false);
            $table->json('questions')->nullable();
            $table->string('perks', 150)->nullable();
            $table->integer('sold')->unsigned()->nullable()->default(0);
            $table->json('settings')->nullable();
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
        Schema::dropIfExists('event_tickets');
    }
};
