<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::table('companies', function (Blueprint $table) {
            $default = $this->getDefaultUserId();

            $table->bigInteger('created_by')->default($default)->unsigned();
            $table->foreign(['created_by'])->references(['id'])->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

    public function getDefaultUserId(): int
    {
        $oldestRow = User::oldest('id')->first();
        return $oldestRow->id ?? 0;
    }
};
