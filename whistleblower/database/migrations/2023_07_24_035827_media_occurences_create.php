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
        Schema::create('media_occurrence', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('occurrences_id')->unsigned();
            $table->uuid('uuid')->nullable()->unique();
            $table->longText('data_base64');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size');

            $table->foreign(['occurrences_id'])->references(['id'])->on('occurrences')->onDelete('CASCADE');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media_occurrence', function (Blueprint $table) {
            Schema::dropIfExists('media_occurrence');
        });
    }
};
