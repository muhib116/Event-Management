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
        Schema::create('ticket_designs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_ticket_id')->constrained()->cascadeOnDelete();
            $table->string('border_color', 20)->default('#666666');
            $table->string('bg_color', 20)->default('#FFFFFF');
            $table->string('text_color', 20)->default('#000000');
            $table->string('sub_text_color', 20)->default('#666666');
            $table->string('footer_text', 20)->default('#666666');
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
        Schema::dropIfExists('ticket_designs');
    }
};
