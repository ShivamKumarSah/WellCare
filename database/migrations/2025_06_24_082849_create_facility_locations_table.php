<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('facility_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address')->nullable();
            // For Postgres decimal: use string length to accommodate precision
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('type', 100)->nullable(); // e.g., clinic, pharmacy
            $table->string('contact_number', 50)->nullable();
            $table->json('opening_hours')->nullable();
            $table->timestamps();

            // If you plan DB-side proximity queries, consider PostGIS or manual haversine in queries
        });

        Schema::table('facility_locations', function (Blueprint $table) {
            // Optionally add indexes; for simple queries, index on latitude/longitude isn't straightforward without PostGIS
            // $table->index(['latitude','longitude']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('facility_locations');
    }
}
