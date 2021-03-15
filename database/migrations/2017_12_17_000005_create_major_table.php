<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMajorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('major', function (Blueprint $table) {
          $table->engine = 'InnoDB';
            $table->integer('id')->unsigned()->autoIncrement();
            $table->unsignedTinyInteger('id_faculty');
            $table->string('major_name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('major', function($table) {
            $table->index('id_faculty');
            $table->foreign('id_faculty')
                ->references('id')->on('faculty')
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
        Schema::dropIfExists('major');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
