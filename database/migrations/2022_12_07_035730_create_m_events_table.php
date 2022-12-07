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
        Schema::create('m_events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('location');
            $table->string('location_tips');
            $table->string('custom_url');
            $table->enum('type', ['live', 'online']);
            $table->foreignId('category_id');
            $table->foreignId('time_zone');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->enum('event_date_type', ['single', 'recurring', 'one_on_one']);
            // social
            $table->text('website')->nullable();
            $table->text('instagram')->nullable();
            $table->text('twitter')->nullable();
            $table->text('facebook')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }
    // https://drawsql.app/teams/nl-draw/diagrams/event-ticket
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_events');
    }
};
