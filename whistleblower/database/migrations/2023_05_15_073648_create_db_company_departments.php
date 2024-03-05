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
        Schema::create('company_departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('department_id')->unsigned();
            $table->bigInteger('company_id')->unsigned();

            $table->foreign(['company_id'])->references(['id'])->on('companies')->onDelete('CASCADE');
            $table->foreign(['department_id'])->references(['id'])->on('departments')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_departments', function (Blueprint $table) {
            //
        });
    }
};
