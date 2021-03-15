<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeatabandonprocessTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::unprepared("
          CREATE TRIGGER trigger_update_registerept AFTER UPDATE ON `registerept` FOR EACH ROW
          BEGIN

          IF (NEW.status = 'Abandoned') THEN
            BEGIN
              UPDATE availableseat SET available = available+1 WHERE id=NEW.id_availableseat;
              UPDATE availableseat SET isfull = 0 WHERE id=NEW.id_availableseat;
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
        DB::unprepared('DROP TRIGGER `trigger_update_registerept`');
    }
}
