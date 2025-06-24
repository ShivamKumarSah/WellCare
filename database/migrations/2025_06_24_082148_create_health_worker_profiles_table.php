<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthWorkerProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('health_worker_profiles', function (Blueprint $table) {
            $table->id();
            // Assumes users table exists
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->text('specialization');
            $table->text('qualifications');
            $table->text('bio')->nullable();
            $table->string('license_number')->nullable();
            $table->integer('experience_years')->nullable();
            $table->enum('profile_status', ['pending', 'approved', 'rejected'])
                ->default('pending');
            $table->json('availability')->nullable(); // optional structured availability JSON
            $table->timestamps();

            $table->index('profile_status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('health_worker_profiles');
    }
}
