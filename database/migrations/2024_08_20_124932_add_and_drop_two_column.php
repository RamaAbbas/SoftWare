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
        Schema::table('about_us', function (Blueprint $table) {
            $table->json('title_for_who')->after('our_mission')->nullable();
            $table->dropColumn('steps_process');
            $table->dropColumn('client_testimonials');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->dropColumn('title_for_who');
            $table->json('steps_process');
            $table->json('client_testimonials');
        });
    }
};
