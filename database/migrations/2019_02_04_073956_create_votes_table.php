<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->primary();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->integer('candidate_id')->unsigned();
            $table->foreign('candidate_id')->references('candidate_id')->on('candidates');
            $table->string('party_name');
            $table->foreign('party_name')->references('party_name')->on('parties');
            $table->string('county_name');
            $table->foreign('county_name')->references('county_name')->on('counties');
            $table->time('vote_time');
            $table->date('vote_date');
            $table->string('ip');
            $table->string('os');
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
        Schema::dropIfExists('votes');
    }
}

