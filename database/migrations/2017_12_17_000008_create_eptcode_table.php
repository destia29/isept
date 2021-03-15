<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEptcodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eptcode', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->tinyInteger('id')->unsigned()->autoIncrement();
            $table->string('code')->unique();
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
        Schema::dropIfExists('eptcode');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
