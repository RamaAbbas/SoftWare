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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
            $table->text('en_achievement_name')->nullable();
            $table->text('nl_achievement_name')->nullable();
            $table->text('en_how_we_achieved_it')->nullable();
            $table->text('nl_how_we_achieved_it')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
