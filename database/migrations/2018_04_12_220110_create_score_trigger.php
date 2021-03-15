<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoreTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::unprepared("
          CREATE TRIGGER trigger_eptscore AFTER UPDATE ON `eptscore` FOR EACH ROW
          BEGIN
            DECLARE IDREGISTER, JUMLAHEPT1, JUMLAHEPT2, IDPARTICIPANT INT;
            SET @IDREGISTER := NEW.id_registerept;

            SELECT id_eptparticipant INTO @IDPARTICIPANT FROM registerept WHERE id = @IDREGISTER;

            SELECT COUNT(*) INTO @JUMLAHEPT1
            FROM eptscore
            LEFT JOIN registerept AS reg ON eptscore.id_registerept = reg.id
            LEFT JOIN ept ON reg.id_ept = ept.id
            WHERE id_eptparticipant = @IDPARTICIPANT
            AND id_epttype = 1
            AND total_score < 450;

            SELECT COUNT(*) INTO @JUMLAHEPT2
            FROM eptscore
            LEFT JOIN registerept AS reg ON eptscore.id_registerept = reg.id
            LEFT JOIN ept ON reg.id_ept = ept.id
            WHERE id_eptparticipant = @IDPARTICIPANT
            AND id_epttype = 2
            AND total_score < 500;

            IF @JUMLAHEPT1 = 3 THEN
              UPDATE eptparticipant SET userstatus = 'Nonactive' WHERE id = @IDPARTICIPANT;
            END IF;

            IF @JUMLAHEPT2 = 3 THEN
              UPDATE eptparticipant SET userstatus = 'Nonactive' WHERE id = @IDPARTICIPANT;
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
        DB::unprepared('DROP TRIGGER `trigger_eptscore`');
    }
}
