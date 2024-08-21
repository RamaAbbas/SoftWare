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
            $table->dropColumn('company_name');
            $table->dropColumn('introduction');
            $table->dropColumn('our_mission');
            $table->dropColumn('our_goals');
            $table->dropColumn('title_for_who');
            $table->dropColumn('for_who');
            $table->dropColumn('meet_our_team');
            $table->dropColumn('our_partners_associates');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->json('company_name');
            $table->json('introduction');
            $table->json('our_mission');
            $table->json('our_goals');
            $table->json('title_for_who');
            $table->json('for_who');
            $table->json('meet_our_team');
            $table->json('our_partners_associates');
        });
    }
};
