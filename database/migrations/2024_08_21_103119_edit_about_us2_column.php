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
            $table->text('en_company_name')->nullable();
            $table->text('nl_company_name')->nullable();
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->dropColumn('en_company_name');
            $table->dropColumn('nl_company_name');
            $table->dropColumn('en_introduction');
            $table->dropColumn('nl_introduction');
            $table->dropColumn('en_our_mission');
            $table->dropColumn('nl_our_mission');
            $table->dropColumn('en_our_goals');
            $table->dropColumn('nl_our_goals');
            $table->dropColumn('en_title_for_who');
            $table->dropColumn('nl_title_for_who');
            $table->dropColumn('en_title_steps_process');
            $table->dropColumn('nl_title_steps_process');
            $table->dropColumn('en_meet_our_team');
            $table->dropColumn('nl_meet_our_team');
            $table->dropColumn('en_our_partners_associates');
            $table->dropColumn('nl_our_partners_associates');
            $table->dropColumn('en_end');
            $table->dropColumn('nl_end');
        });
    }
};
