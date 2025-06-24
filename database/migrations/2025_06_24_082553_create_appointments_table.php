<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            // patient and healthcare worker reference the users table
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('health_worker_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('scheduled_at');
            $table->enum('status', ['pending', 'confirmed', 'rescheduled', 'cancelled', 'completed'])
                ->default('pending');
            $table->text('reason')->nullable();
            $table->text('notes')->nullable();
            $table->text('reschedule_note')->nullable();
            $table->timestamps();

            $table->index('patient_id');
            $table->index('health_worker_id');
            $table->index('scheduled_at');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
