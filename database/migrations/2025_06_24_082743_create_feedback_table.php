<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->nullable()->constrained('appointments')->onDelete('set null');
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('health_worker_id')->constrained('users')->onDelete('cascade');
            $table->smallInteger('rating')->unsigned()->comment('1 to 5');
            $table->text('comments')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('moderation_note')->nullable();
            $table->timestamps();

            $table->index('patient_id');
            $table->index('health_worker_id');
            $table->index('appointment_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
