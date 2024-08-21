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
        Schema::table('service_requirments', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('descripton');
            $table->text('en_name')->nullable();
            $table->text('nl_name')->nullable();
            $table->text('en_description')->nullable();
            $table->text('nl_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_requirments', function (Blueprint $table) {
            $table->json('name');
            $table->json('descripton');
            $table->dropColumn('en_name');
            $table->dropColumn('nl_name');
            $table->dropColumn('en_description');
            $table->dropColumn('nl_description');
        });
    }
};
