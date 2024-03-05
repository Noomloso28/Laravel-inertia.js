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
        Schema::create('occurrences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id')->index('occurrences_company_id_foreign');
            $table->unsignedBigInteger('category_id')->index('occurrences_category_id_foreign');
            $table->unsignedBigInteger('severity');
            $table->string('status');
            $table->unsignedBigInteger('department_id')->index('occurrences_department_id_foreign');
            $table->timestamps();
            $table->text('topic');
            $table->longText('description');
            $table->string('classification', 200);
            $table->string('password')->nullable();
            $table->string('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('occurrences');
    }
};
