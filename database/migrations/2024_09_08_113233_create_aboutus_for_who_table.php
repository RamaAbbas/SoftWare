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
        Schema::create('aboutus_for_who', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_us_id')->references('id')->on('aboutus')->onUpdate('cascade')->onDelete('cascade');
            $table->string('en_name')->nullable();
            $table->string('nl_name')->nullable();
            $table->text('en_description')->nullable();
            $table->text('nl_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aboutus_for_who');
    }
};
