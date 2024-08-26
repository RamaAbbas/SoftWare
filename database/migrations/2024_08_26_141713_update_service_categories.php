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
        Schema::table('service_categories', function (Blueprint $table) {
            $table->dropColumn('en_service_name');
            $table->dropColumn('nl_service_name');
            $table->text('en_service_name')->nullable()->after('project_id');
            $table->text('nl_service_name')->nullable()->after('en_service_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_categories', function (Blueprint $table) {
            $table->text('en_service_name');
            $table->text('nl_service_name');
            $table->dropColumn('en_service_name');
            $table->dropColumn('nl_service_name');
        });
    }
};
