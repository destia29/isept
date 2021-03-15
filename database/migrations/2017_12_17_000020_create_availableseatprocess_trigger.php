<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvailableseatprocessTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /**
        * Kegunaan: Untuk mengurangi sisa kuota ept unila
        */
        DB::unprepared("
            CREATE TRIGGER trigger_updt_min_seat AFTER INSERT ON `registerept` FOR EACH ROW
            BEGIN
            DECLARE CAPACITY, AVA INT;

                SELECT capacity into @CAPACITY FROM eptroom
                LEFT JOIN availableseat as avs ON avs.id_eptroom = eptroom.id
                WHERE avs.id = NEW.id_availableseat;

                UPDATE `availableseat`
                    SET available = available-1
                WHERE id = NEW.id_availableseat;

                SELECT available into @AVA FROM availableseat
                WHERE id = NEW.id_availableseat;

                IF(@AVA = 0) THEN
                        BEGIN
                            UPDATE `availableseat` SET isfull = 1 WHERE id = NEW.id_availableseat;
                        END;
                END IF;
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
        DB::unprepared('DROP TRIGGER `trigger_updt_min_seat`');
    }
}
