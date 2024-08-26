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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->references('id')->on('clients')->onUpdate('cascade')->onDelete('cascade');
            $table->text('en_title')->nullable();
            $table->text('nl_title')->nullable();
            $table->text('en_description')->nullable();
            $table->text('nl_escription')->nullable();
            $table->text('en_service_category')->nullable();
            $table->text('nl_service_category')->nullable();
            $table->date('begin_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('en_result')->nullable();
            $table->text('nl_result')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
