<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ept', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id')->unsigned()->autoIncrement();
            $table->unsignedtinyInteger('id_epttype')->unsigned();
            $table->unsignedtinyInteger('id_eptcode')->unsigned();
            $table->date('ept_date');
            $table->time('ept_time');
            // $table->string('ept_room');
            // $table->unsignedInteger('ept_quota');
            $table->date('registration_date');
            $table->string('code');
            $table->string('qr_code');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('ept', function($table) {
            $table->index('id_epttype');
            $table->foreign('id_epttype')
                ->references('id')->on('epttype')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->index('id_eptcode');
            $table->foreign('id_eptcode')
                ->references('id')->on('eptcode')
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
        Schema::dropIfExists('ept');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
