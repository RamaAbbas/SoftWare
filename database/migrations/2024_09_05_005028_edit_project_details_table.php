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
        Schema::table('project_details', function (Blueprint $table) {
            $table->dropColumn('step');
            $table->text('en_step')->nullable()->after('project_id');
            $table->text('nl_step')->nullable()->after('en_step');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_details', function (Blueprint $table) {
            $table->text('step');
            $table->dropColumn('en_step');
            $table->dropColumn('nl_step');
        });
    }
};
