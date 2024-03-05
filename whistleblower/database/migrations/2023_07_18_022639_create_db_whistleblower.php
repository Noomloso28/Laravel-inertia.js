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
        Schema::create('whistleblower', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('occurrences_id')->unsigned();
            $table->text('whistleblower_private_key');
            $table->text('whistleblower_public_rsa_key');
            $table->text('company_public_key');
            $table->text('whistleblower_public_key');

            $table->foreign(['occurrences_id'])->references(['id'])->on('occurrences')->onDelete('CASCADE');
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
        Schema::dropIfExists('whistleblower');
    }
};
