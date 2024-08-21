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
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('title_of_requirements');
            $table->dropColumn('title_of_how_it_works');
            $table->dropColumn('title_of_service_benefit');
            $table->dropColumn('call_to_action');
            $table->dropColumn('client_testimonial');
            $table->dropColumn('for_who');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->json('title_of_requirements');
            $table->json('title_of_how_it_works');
            $table->json('title_of_service_benefit');
            $table->json('call_to_action');
            $table->json('client_testimonial');
            $table->json('for_who');
        });
    }
};

/*
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 /*   public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
          //  $table->dropColumn('name');
          //  $table->dropColumn('description');
            $table->dropColumn('title_of_requirments');
            $table->dropColumn('title_of_how_it_works');
            $table->dropColumn('title_of_service_benefit');
            $table->dropColumn('call_to_action');
            $table->dropColumn('client_testimonial');
            $table->dropColumn('for_who');
            $table->text('en_name')->nullable();
            $table->text('nl_name')->nullable();
            $table->text('en_description')->nullable();
            $table->text('nl_description')->nullable();
            $table->text('en_title_of_requirments')->nullable();
            $table->text('nl_title_of_requirments')->nullable();
            $table->text('en_title_of_how_it_works')->nullable();
            $table->text('nl_title_of_how_it_works')->nullable();
            $table->text('en_title_of_service_benefit')->nullable();
            $table->text('nl_title_of_service_benefit')->nullable();
            $table->text('en_title_call_to_action')->nullable();
            $table->text('nl_title_call_to_action')->nullable();
            $table->text('en_sub_title_call_to_action')->nullable();
            $table->text('nl_sub_title_call_to_action')->nullable();



        });
    }

    /**
     * Reverse the migrations.
     */
    /*
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
         //   $table->json('name');
         //   $table->json('description');
            $table->json('title_of_requirements');
            $table->json('title_of_how_it_works');
            $table->json('title_of_service_benefit');
            $table->json('call_to_action');
            $table->json('client_testimonial');
            $table->json('for_who');
            $table->dropColumn('en_name');
            $table->dropColumn('nl_name');
            $table->dropColumn('en_description');
            $table->dropColumn('nl_description');
            $table->dropColumn('en_title_of_requirments');
            $table->dropColumn('nl_title_of_requirments');
            $table->dropColumn('en_title_of_how_it_works');
            $table->dropColumn('nl_title_of_how_it_works');
            $table->dropColumn('en_title_of_service_benefit');
            $table->dropColumn('nl_title_of_service_benefit');
            $table->dropColumn('en_title_call_to_action');
            $table->dropColumn('nl_title_call_to_action');
            $table->dropColumn('en_sub_title_call_to_action');
            $table->dropColumn('nl_sub_title_call_to_action');


        });
    }
};

*/
