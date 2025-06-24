<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthTipsTable extends Migration
{
    public function up()
    {
        Schema::create('health_tips', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->enum('type', ['tip', 'article', 'video']);
            $table->string('video_url', 500)->nullable();
            $table->foreignId('category_id')->nullable()->constrained('health_tip_categories')->onDelete('set null');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->unsignedBigInteger('view_count')->default(0);
            $table->timestamps();

            $table->index('created_by');
            $table->index('status');
            $table->index('category_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('health_tips');
    }
}
