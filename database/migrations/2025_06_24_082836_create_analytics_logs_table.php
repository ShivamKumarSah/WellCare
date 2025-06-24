<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalyticsLogsTable extends Migration
{
    public function up()
    {
        Schema::create('analytics_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('event_type');
            $table->json('event_data')->nullable();
            $table->timestamp('created_at')->useCurrent();
            // No updated_at needed for logs, but you may add if desired:
            // $table->timestamp('updated_at')->nullable();
        });

        Schema::table('analytics_logs', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('event_type');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('analytics_logs');
    }
}
