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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->json('company_name')->nullable();
            $table->json('introduction')->nullable();
            $table->json('our_mission')->nullable();
            $table->json('for_who')->nullable();
            $table->json('steps_process')->nullable();
            $table->json('meet_our_team')->nullable();
            $table->json('our_partners&associates')->nullable();
            $table->json('client_testimonials')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
