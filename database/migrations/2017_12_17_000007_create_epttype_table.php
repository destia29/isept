<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpttypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epttype', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->tinyInteger('id')->unsigned()->autoIncrement();
            $table->string('code')->unique();
            $table->string('type');
            $table->unsignedInteger('cost');
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
        Schema::dropIfExists('epttype');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
