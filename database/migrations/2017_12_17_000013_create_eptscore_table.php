<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEptscoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eptscore', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id')->unsigned()->autoIncrement();
            $table->unsignedInteger('id_registerept')->unsigned();
            $table->unsignedInteger('listening_score')->nullable();
            $table->unsignedInteger('structure_score')->nullable();
            $table->unsignedInteger('reading_score')->nullable();
            $table->unsignedInteger('total_score')->nullable();
            $table->enum('takecourse', ['Yes', 'No'])->default('No');
            $table->string('code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('eptscore', function($table) {
            $table->index('id_registerept');
            $table->foreign('id_registerept')
                ->references('id')->on('registerept')
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
        Schema::dropIfExists('eptscore');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
