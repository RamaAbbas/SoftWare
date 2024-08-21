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
        Schema::table('service_benefits', function (Blueprint $table) {
            $table->dropColumn('benefit_name');
            $table->dropColumn('benefit_description');
            $table->text('en_name')->nullable()->after('service_id');
            $table->text('nl_name')->nullable()->after('en_name');
            $table->text('en_description')->nullable()->after('nl_name');
            $table->text('nl_description')->nullable()->after('en_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_benefits', function (Blueprint $table) {
            $table->json('benefit_name');
            $table->json('benefit_description');
            $table->dropColumn('en_name');
            $table->dropColumn('nl_name');
            $table->dropColumn('en_description');
            $table->dropColumn('nl_description');
        });
    }
};
