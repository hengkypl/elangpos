<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTidakterdaftarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tidakterdaftar', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('kassa', 10);
            $table->string('operator',10);
            $table->string('kodebarang',20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tidakterdaftar');
    }
}
