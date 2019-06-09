<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDvotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dvotes', function (Blueprint $table) {
            $table->integer('education');
            $table->integer('monthly_inc');
            $table->integer('family');
            $table->integer('region');
            $table->integer('county');
            $table->integer('age');
            $table->integer('area');
            $table->integer('cand_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dvotes');
    }
}
