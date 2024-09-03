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
            $table->dropColumn('en_meet_our_team');
            $table->dropColumn('nl_meet_our_team');

            $table->text('en_title_meet_our_team')->nullable()->after('nl_title_for_who');
            $table->text('nl_title_meet_our_team')->nullable()->after('en_title_meet_our_team');
            $table->text('en_sub_title_meet_our_team')->nullable()->after('nl_title_meet_our_team');
            $table->text('nl_sub_title_meet_our_team')->nullable()->after('en_sub_title_meet_our_team');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->text('en_meet_our_team');
            $table->text('nl_meet_our_team');
            $table->dropColumn('en_title_meet_our_team');
            $table->dropColumn('nl_title_meet_our_team');
            $table->dropColumn('en_sub_title_meet_our_team');
            $table->dropColumn('nl_sub_title_meet_our_team');
        });
    }
};
