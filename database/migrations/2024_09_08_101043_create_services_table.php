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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('en_name')->nullable();
            $table->string('nl_name')->nullable();
            $table->text('en_description')->nullable();
            $table->text('nl_description')->nullable();
            $table->text('en_title_of_requirments')->nullable();
            $table->text('nl_title_of_requirments')->nullable();
            $table->text('en_title_of_how_it_works')->nullable();
            $table->text('nl_title_of_how_it_works')->nullable();
            $table->text('en_title_of_service_benefit')->nullable();
            $table->text('nl_title_of_service_benefit')->nullable();
            $table->text('en_title_call_to_action')->nullable();
            $table->text('nl_title_call_to_action')->nullable();
            $table->text('en_sub_title_call_to_action')->nullable();
            $table->text('nl_sub_title_call_to_action')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
