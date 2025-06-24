<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateHealthRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            // If a health worker is deleted, we can set null or cascade; here: set null
            $table->foreignId('health_worker_id')->nullable()->constrained('users')->onDelete('set null');
            $table->date('record_date')->default(DB::raw('CURRENT_DATE'));
            $table->text('description');
            $table->json('vitals')->nullable();
            $table->text('prescription')->nullable();
            $table->timestamps();

            $table->index('patient_id');
            $table->index('health_worker_id');
            $table->index('record_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('health_records');
    }
}
