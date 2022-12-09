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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('m_events_id')->constrained()->cascadeOnDelete();
            $table->string('ticket_name');
            $table->longText('ticket_description');
            $table->string('ticket_type');
            $table->string('ticket_stock');
            $table->integer('stock_limit')->default(0);
            $table->double('price')->default(0);
            $table->json('perks')->nullable();
            $table->boolean('isTransferFeesToGuest')->default(false);
            $table->json('questions')->nullable();
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
        Schema::dropIfExists('tickets');
    }
};
