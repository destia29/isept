<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistereptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registerept', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id')->unsigned()->autoIncrement();
            $table->unsignedInteger('id_eptparticipant')->unsigned();
            $table->unsignedInteger('id_ept')->unsigned();
            $table->unsignedTinyInteger('id_availableseat')->unsigned();
            $table->string('code')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('status')->default('Unverified');
            $table->string('attempt');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('registerept', function($table) {
            $table->index('id_eptparticipant');
            $table->foreign('id_eptparticipant')
                ->references('id')->on('eptparticipant')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->index('id_ept');
            $table->foreign('id_ept')
                ->references('id')->on('ept')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->index('id_availableseat');
            $table->foreign('id_availableseat')
                ->references('id')->on('availableseat')
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
        Schema::dropIfExists('registerept');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
