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
            //remove old column
            $table->dropColumn('status');
        });

        Schema::table('occurrences', function (Blueprint $table) {
            //create new same name
            $table->enum('status', ['New', 'Received', 'Beeing inspected', 'Waiting for whistleblower', 'Sent to company', 'Closed'])->default('New');
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
            //
        });
    }
};
