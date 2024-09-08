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
        Schema::create('project_about_us', function (Blueprint $table) {
            $table->id();
            $table->string('en_company_name')->nullable();
            $table->string('nl_company_name')->nullable();
            $table->text('en_introduction')->nullable();
            $table->text('nl_introduction')->nullable();
            $table->text('en_our_mission')->nullable();
            $table->text('nl_our_mission')->nullable();
            $table->text('en_our_goals')->nullable();
            $table->text('nl_our_goals')->nullable();
            $table->text('en_title_for_who')->nullable();
            $table->text('nl_title_for_who')->nullable();
            $table->text('en_title_steps_process')->nullable();
            $table->text('nl_title_steps_process')->nullable();
            $table->text('en_meet_our_team')->nullable();
            $table->text('nl_meet_our_team')->nullable();
            $table->text('en_our_partners_associates')->nullable();
            $table->text('nl_our_partners_associates')->nullable();
            $table->text('en_end')->nullable();
            $table->text('nl_end')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_about_us');
    }
};
