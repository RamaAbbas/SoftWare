<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aboutus_client_testimonials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_us_id')->references('id')->on('aboutus')->onUpdate('cascade')->onDelete('cascade');
            $table->string('client_name')->nullable();
            $table->text('en_client_testimonial')->nullable();
            $table->text('nl_client_testimonial')->nullable();
            $table->text('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aboutus_client_testimonials');
    }
};
