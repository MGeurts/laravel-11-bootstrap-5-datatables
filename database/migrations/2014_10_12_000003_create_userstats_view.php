<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        $this->down();

        DB::statement($this->createView());
    }

    public function down()
    {
        DB::statement($this->dropView());
    }

    private function createView(): string
    {
        return <<<'SQL'
            CREATE VIEW `v_userstats` AS
                SELECT 
                    `userlogs`.`country_name`,
                    count(`users`.`id`) as users
                FROM `userlogs` LEFT JOIN `users` ON (`userlogs`.`user_id` = `users`.`id`)
                WHERE `userlogs`.`country_name` IS NOT NULL
                GROUP BY `userlogs`.`country_name`
                ORDER BY `userlogs`.`country_name`;
        SQL;
    }

    private function dropView(): string
    {
        return <<<'SQL'
            DROP VIEW IF EXISTS `v_userstats`;
        SQL;
    }
};
