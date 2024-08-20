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
        Schema::create('steps_processs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_us_id')->references('id')->on('about_us')->onUpdate('cascade')->onDelete('cascade');
            $table->json('name')->nullable();
            $table->json('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('steps_processs');
    }
};
