<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvailableseatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('availableseat', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->tinyInteger('id')->unsigned()->autoIncrement();
            $table->unsignedtinyInteger('id_eptroom')->unsigned();
            $table->unsignedInteger('id_ept')->unsigned();
            $table->unsignedInteger('available')->nullable();
            $table->boolean('isfull')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('availableseat', function($table) {
            $table->index('id_eptroom');
            $table->foreign('id_eptroom')
                ->references('id')->on('eptroom')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->index('id_ept');
            $table->foreign('id_ept')
                ->references('id')->on('ept')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('availableseat');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
