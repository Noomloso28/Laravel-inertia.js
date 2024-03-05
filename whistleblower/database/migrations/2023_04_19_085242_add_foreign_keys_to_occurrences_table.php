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
        Schema::table('occurrences', function (Blueprint $table) {
            $table->foreign(['category_id'])->references(['id'])->on('categories')->onDelete('CASCADE');
            $table->foreign(['department_id'])->references(['id'])->on('departments')->onDelete('CASCADE');
            $table->foreign(['company_id'])->references(['id'])->on('companies')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('occurrences', function (Blueprint $table) {
            $table->dropForeign('occurrences_category_id_foreign');
            $table->dropForeign('occurrences_department_id_foreign');
            $table->dropForeign('occurrences_company_id_foreign');
        });
    }
};
