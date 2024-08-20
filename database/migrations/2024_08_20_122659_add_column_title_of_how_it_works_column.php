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
        Schema::table('services', function (Blueprint $table) {
            $table->json('title_of_how_it_works')->after('title_of_requirements')->nullable();
            $table->json('title_of_service_benefit')->after('title_of_how_it_works')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('title_of_how_it_works');
            $table->dropColumn('title_of_service_benefit');
        });
    }
};
