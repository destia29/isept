<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminuserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminuser', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id')->unsigned()->autoIncrement();
            $table->unsignedInteger('id_user');
            $table->string('position')->nullable();
            $table->string('nip_user');
            $table->string('handphone_number')->nullable();
            $table->string('profile_picture')->default('default.png');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('adminuser', function($table) {
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
        Schema::dropIfExists('adminuser');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
