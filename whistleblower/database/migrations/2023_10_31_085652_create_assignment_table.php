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
        Schema::create('assignment', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('occurrence_id')->unsigned();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::table('assignment', function (Blueprint $table) {
            $table->foreign(['occurrence_id'])->references(['id'])->on('occurrences')->onDelete('CASCADE');
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
        Schema::dropIfExists('assignment');
    }
};
