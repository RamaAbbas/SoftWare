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
        Schema::create('service_requirments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->references('id')->on('services')->onUpdate('cascade')->onDelete('cascade');
            $table->json('name')->nullable();
            $table->json('descripton')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requirments');
    }
};
