<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Create 2 table because , the system run DB::table inside first piority.
         */
        Schema::table('mail_templates', function (Blueprint $table) {
            $table->string('type_back_up')->default('occurrence.created');
        });

        Schema::table('mail_templates', function (Blueprint $table) {

            // Remove the old enum column
            DB::table('mail_templates')->update(['type_back_up' => DB::raw('type')]);

            // Remove the old enum column
            $table->dropColumn('type');

            // Rename the new varchar column to the old column name
            $table->renameColumn('type_back_up', 'type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mail_templates', function (Blueprint $table) {
            //
        });
    }
};
