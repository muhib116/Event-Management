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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('m_event_id')->constrained()->cascadeOnDelete();
            $table->string('discount_code');
            $table->string('discount_code_type')->comment('fixed/percentage');
            $table->double('discount_value')->default(0);
            $table->string('applied_type')->nullable()->comment('all_ticket/specific_ticket');
            $table->json('tickets')->nullable();
            $table->string('use_limit')->comment('unlimited,one_use,limited');
            $table->integer('limit_amount')->default(0);
            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();
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
        Schema::dropIfExists('discounts');
    }
};
