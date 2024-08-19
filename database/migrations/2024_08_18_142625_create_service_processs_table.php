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
        Schema::create('service_processs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->references('id')->on('services')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('step_no')->nullable();
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
        Schema::dropIfExists('how_it_works_services_');
    }
};
