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
        Schema::create('event_lists', function (Blueprint $table) {
            $table->id();
            $table->string('eventType', 150)->nullable();
            $table->string('name', 150)->nullable();
            $table->string('slug', 150)->nullable();
            $table->text('description')->nullable();
            $table->text('location')->nullable();
            $table->string('url', 150)->nullable();
            $table->string('locationTips', 150)->nullable();
            $table->string('video_link', 150)->nullable();
            $table->string('eventCategory', 150)->nullable();
            $table->string('timezone', 150)->nullable();

            $table->date('start_date')->nullable();
            $table->time('start_time')->nullable();

            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();
            
            $table->text('website')->nullable();
            $table->text('instagram')->nullable();
            $table->text('twitter')->nullable();
            $table->text('facebook')->nullable();
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
        Schema::dropIfExists('event_lists');
    }
};
