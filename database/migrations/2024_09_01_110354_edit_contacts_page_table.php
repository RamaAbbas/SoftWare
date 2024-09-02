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
        Schema::table('contacts_page', function (Blueprint $table) {
            $table->string('en_sub_title')->nullable()->after('nl_title');
            $table->string('nl_sub_title')->nullable()->after('en_sub_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts_page', function (Blueprint $table) {
            $table->dropColumn('en_sub_title');
            $table->dropColumn('nl_sub_title');
        });
    }
};
