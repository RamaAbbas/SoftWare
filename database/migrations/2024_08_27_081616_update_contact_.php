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
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('mobile_number');

            $table->string('email')->nullable()->after('last_name');
            $table->string('mobile_number')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('email');
            $table->string('mobile_number');
            $table->dropColumn('email');
            $table->dropColumn('mobile_number');
        });
    }
};
