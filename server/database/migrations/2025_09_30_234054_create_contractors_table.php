<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contractors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('legal_name', 200);
            $table->string('display_name', 200)->nullable();
            $table->string('slug', 220)->unique()->nullable();
            $table->text('description')->nullable();
            $table->string('website_url', 255)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('headquarters_city', 120)->nullable();
            $table->string('headquarters_state', 10)->nullable();
            $table->string('country_code', 2)->default('US');
            $table->string('address_line1', 200)->nullable();
            $table->string('address_line2', 200)->nullable();
            $table->string('zip_code', 15)->nullable();
            $table->decimal('lat', 9, 6)->nullable();
            $table->decimal('lng', 9, 6)->nullable();
            $table->decimal('google_rating_avg', 2, 1)->nullable()->comment('Usado en vetting (>= 4.5)');
            $table->integer('google_rating_count')->nullable();
            $table->string('status', 30)->default('pending')->comment('pending | approved | suspended');
            $table->string('tier', 20)->default('Certified')->comment('Certified | Elite');
            $table->timestampsTz(); // created_at y updated_at como timestamptz
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contractors');
    }
};
