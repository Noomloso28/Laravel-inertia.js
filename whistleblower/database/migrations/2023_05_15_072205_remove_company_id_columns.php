<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign('departments_company_id_foreign');
            $table->dropColumn(['company_id']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('categories_company_id_foreign');
            $table->dropColumn(['company_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->string('company_id');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('company_id');
        });
    }
};
