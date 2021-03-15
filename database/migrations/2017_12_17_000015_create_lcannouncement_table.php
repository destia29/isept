<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLcannouncementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lcannouncement', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id')->unsigned()->autoIncrement();
            $table->unsignedInteger('id_user');
            $table->string('title');
            $table->string('thumbnail');
            $table->longText('description')->nullable();
            $table->date('release_date');
            $table->string('tag')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('lcannouncement', function($table) {
            $table->index('id_user');
            $table->foreign('id_user')
                ->references('id')->on('users')
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
        Schema::dropIfExists('lcannouncement');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
