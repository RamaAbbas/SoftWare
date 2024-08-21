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
        Schema::table('client_testimonials', function (Blueprint $table) {
            $table->dropColumn('client');
            $table->dropColumn('testimonial');
            $table->text('client_name')->nullable()->after('about_us_id');
            $table->text('en_client_testimonial')->nullable()->after('client_name');
            $table->text('nl_client_testimonial')->nullable()->after('en_client_testimonial');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_testimonials', function (Blueprint $table) {
            $table->json('client');
            $table->json('testimonial');
            $table->dropColumn('client_name');
            $table->dropColumn('en_client_testimonial');
            $table->dropColumn('nl_client_testimonial');
        });
    }
};
