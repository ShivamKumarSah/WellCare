<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailabilitySlotsTable extends Migration
{
    public function up()
    {
        Schema::create('availability_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('health_worker_id')->constrained('users')->onDelete('cascade');
            // day_of_week 0 (Sunday) to 6 (Saturday) if recurring
            $table->tinyInteger('day_of_week')->nullable()->comment('0=Sunday to 6=Saturday for recurring slots');
            $table->time('start_time');
            $table->time('end_time');
            $table->date('date')->nullable()->comment('If one-off availability on a specific date; null if recurring');
            $table->boolean('is_recurring')->default(true);
            $table->timestamps();

            $table->index('health_worker_id');
            $table->index('day_of_week');
        });
    }

    public function down()
    {
        Schema::dropIfExists('availability_slots');
    }
}
