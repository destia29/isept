<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEptparticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eptparticipant', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('id')->unsigned()->autoIncrement();
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_major')->nullable();
            $table->string('idnumber_eptparticipant');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('handphone_number')->nullable();
            $table->string('profile_picture')->default('default.png');
            $table->string('userstatus')->default('Active');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('eptparticipant', function($table) {
            $table->index('id_user');
            $table->foreign('id_user')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->index('id_major');
            $table->foreign('id_major')
                ->references('id')->on('major')
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
        Schema::dropIfExists('eptparticipant');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
