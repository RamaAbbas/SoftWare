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
        //    $table->dropColumn('en_service_name');
         //   $table->dropColumn('nl_service_name');
        //    $table->foreignId('service_id')->references('id')->on('services')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_categories', function (Blueprint $table) {
        //    $table->text('en_service_name');
        //    $table->text('nl_service_name');
       //     $table->dropColumn('service_id');
        });
    }
};
