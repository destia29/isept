<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvailableseatTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER trigger_insert_availableseat BEFORE INSERT ON `availableseat` FOR EACH ROW
            BEGIN
            DECLARE ID_EPTROOM INT;

            SET @ID_EPTROOM := NEW.id_eptroom;

            SET NEW.available = (SELECT capacity FROM `eptroom` WHERE id=@ID_EPTROOM);

            END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `trigger_insert_availableseat`');
    }
}
