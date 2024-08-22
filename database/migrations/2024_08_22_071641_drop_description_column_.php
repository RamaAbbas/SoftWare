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
        Schema::table('service_processs', function (Blueprint $table) {
            $table->dropColumn('en_description');
            $table->dropColumn('nl_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_processs', function (Blueprint $table) {
            $table->text('en_description');
            $table->text('nl_description');
        });
    }
};
