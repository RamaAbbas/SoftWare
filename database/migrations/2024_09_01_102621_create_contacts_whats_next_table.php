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
        Schema::create('contacts_whats_next', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contacts_id')->references('id')->on('contacts_page')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('contacts_whats_next');
    }
};
