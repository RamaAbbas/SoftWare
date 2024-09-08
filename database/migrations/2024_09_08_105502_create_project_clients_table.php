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
        Schema::create('project_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
            $table->string('en_title')->nullable();
            $table->string('nl_title')->nullable();
            $table->string('en_sub_title')->nullable();
            $table->string('nl_sub_title')->nullable();
            $table->string('full_name')->nullable();
            $table->string('position')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_clients');
    }
};
