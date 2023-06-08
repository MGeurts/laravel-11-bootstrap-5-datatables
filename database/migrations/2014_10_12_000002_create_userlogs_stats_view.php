<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        $this->down();

        DB::statement($this->createViewUserlogsStatsDay());
        DB::statement($this->createViewUserlogsStatsMonth());
        DB::statement($this->createViewUserlogsStatsWeek());
        DB::statement($this->createViewUserlogsStatsYear());
    }

    public function down()
    {
        DB::statement($this->dropViewUserlogsStatsDay());
        DB::statement($this->dropViewUserlogsStatsMonth());
        DB::statement($this->dropViewUserlogsStatsWeek());
        DB::statement($this->dropViewUserlogsStatsYear());
    }

    private function createViewUserlogsStatsDay(): string
    {
        return <<<'SQL'
            CREATE VIEW `v_userlogs_stats_day` AS
                SELECT
                    YEAR(`userlogs`.`created_at`) AS `year`,
                    DATE_FORMAT(`userlogs`.`created_at`, '%Y-%m-%d') AS `period`,
                    COUNT(`userlogs`.`id`) AS `visitors`
                FROM `userlogs`
                GROUP BY `year`, `period`;
        SQL;
    }

    private function createViewUserlogsStatsMonth(): string
    {
        return <<<'SQL'
            CREATE VIEW `v_userlogs_stats_month` AS
                SELECT
                    YEAR(`userlogs`.`created_at`) AS `year`,
                    LPAD(MONTH(`userlogs`.`created_at`), 2, '0') AS `period`,
                    COUNT(`userlogs`.`id`) AS `visitors`
                FROM `userlogs`
                GROUP BY `year`, `period`;
        SQL;
    }

    private function createViewUserlogsStatsWeek(): string
    {
        return <<<'SQL'
            CREATE VIEW `v_userlogs_stats_week` AS
                SELECT
                    YEAR(`userlogs`.`created_at`) AS `year`,
                    LPAD(WEEK(`userlogs`.`created_at`, 0), 2, '0') AS `period`,
                    COUNT(`userlogs`.`id`) AS `visitors`
                FROM `userlogs`
                GROUP BY `year`, `period`;
        SQL;
    }

    private function createViewUserlogsStatsYear(): string
    {
        return <<<'SQL'
            CREATE VIEW `v_userlogs_stats_year` AS
                SELECT
                    YEAR(`userlogs`.`created_at`) AS `year`,
                    YEAR(`userlogs`.`created_at`) AS `period`,
                    COUNT(`userlogs`.`id`) AS `visitors`
                FROM `userlogs`
                GROUP BY `year`, `period`;
        SQL;
    }

    private function dropViewUserlogsStatsDay(): string
    {
        return <<<'SQL'
            DROP VIEW IF EXISTS `v_userlogs_stats_day`;
        SQL;
    }

    private function dropViewUserlogsStatsMonth(): string
    {
        return <<<'SQL'
            DROP VIEW IF EXISTS `v_userlogs_stats_month`;
        SQL;
    }

    private function dropViewUserlogsStatsWeek(): string
    {
        return <<<'SQL'
            DROP VIEW IF EXISTS `v_userlogs_stats_week`;
        SQL;
    }

    private function dropViewUserlogsStatsYear(): string
    {
        return <<<'SQL'
            DROP VIEW IF EXISTS `v_userlogs_stats_year`;
        SQL;
    }
};
