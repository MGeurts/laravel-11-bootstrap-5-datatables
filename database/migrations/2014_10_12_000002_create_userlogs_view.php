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
            CREATE VIEW `v_userlogs` AS
                SELECT
                    `userlogs`.`created_at` AS `created_at`,
                    DATE_FORMAT(`userlogs`.`created_at`, '%Y-%m-%d') AS `date`,
                    DATE_FORMAT(`userlogs`.`created_at`, '%T') AS `time`,
                    `userlogs`.`ip` AS `ip`,
                    `userlogs`.`country_name` AS `country_name`,
                    `userlogs`.`country_code` AS `country_code`,
                    `userlogs`.`user_id` AS `user_id`,
                    `users`.`name` AS `name`,
                    `users`.`is_developer` AS `is_developer`
                FROM `userlogs` LEFT JOIN `users` ON (`userlogs`.`user_id` = `users`.`id`)
                WHERE `userlogs`.`created_at` >= (NOW() - INTERVAL 3 MONTH);
        SQL;
    }

    private function dropView(): string
    {
        return <<<'SQL'
            DROP VIEW IF EXISTS `v_userlogs`;
        SQL;
    }
};
