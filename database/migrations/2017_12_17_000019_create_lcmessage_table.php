<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLcmessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lcmessage', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id')->unsigned()->autoIncrement();
            $table->string('name');
            $table->string('email');
            $table->string('subject');
            $table->longText('message');
            $table->string('status')->default('Unread');
            $table->rememberToken();
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
        Schema::dropIfExists('lcmessage');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
