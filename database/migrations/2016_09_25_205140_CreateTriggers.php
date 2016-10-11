<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER CALCULATE_RATE_AFTER_INSERT AFTER INSERT ON ratings
                        FOR EACH ROW
                            BEGIN
                            UPDATE dish_resto dr SET dr.average_rate = (SELECT round(avg(r.value), 1)
                                                FROM ratings r where r.dish_resto_id = new.dish_resto_id),
                                                dr.reviews_count = (SELECT count(r.id)
                                                    FROM ratings r where r.dish_resto_id = new.dish_resto_id)
                                                    where dr.id = new.dish_resto_id;
                            END;');

        DB::unprepared('CREATE TRIGGER DISABLE_DISHES_AFTER_RESTO_DISABLED AFTER UPDATE ON restos
                        FOR EACH ROW
                        BEGIN
                            IF new.enabled = 0 THEN
                              UPDATE dish_resto dr SET dr.enabled = 0 WHERE dr.resto_id = new.id;
                            END IF;
                        END;');

        DB::unprepared('CREATE TRIGGER DISABLE_RESTOS_AFTER_DISH_DISABLED AFTER UPDATE ON dishes
                        FOR EACH ROW
                        BEGIN
                            IF new.enabled = 0 THEN
                              UPDATE dish_resto dr SET dr.enabled = 0 WHERE dr.dish_id = new.id;
                            END IF;
                        END;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER CALCULATE_RATE_AFTER_INSERT');
        DB::unprepared('DROP TRIGGER DISABLE_DISHES_AFTER_RESTO_DISABLED');
        DB::unprepared('DROP TRIGGER DISABLE_RESTOS_AFTER_DISH_DISABLED');
    }
}
