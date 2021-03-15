<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEptroomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eptroom', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->tinyInteger('id')->unsigned()->autoIncrement();
            $table->string('room_name');
            $table->unsignedInteger('capacity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('eptroom');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
