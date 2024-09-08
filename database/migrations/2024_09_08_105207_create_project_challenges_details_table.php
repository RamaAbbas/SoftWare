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
        Schema::create('project_challenges_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('challenge_id')->references('id')->on('project_challenges')->onUpdate('cascade')->onDelete('cascade');
            $table->text('en_step')->nullable();
            $table->text('nl_step')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_challenges_details');
    }
};
