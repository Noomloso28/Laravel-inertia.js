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
        Schema::table('admin_companies', function (Blueprint $table) {
            $table->foreign(['company_id'])->references(['id'])->on('companies')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_companies', function (Blueprint $table) {
            $table->dropForeign('admin_companies_company_id_foreign');
            $table->dropForeign('admin_companies_user_id_foreign');
        });
    }
};
