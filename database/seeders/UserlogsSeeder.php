<?php

namespace Database\Seeders;

use App\Models\Userlog;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;

class UserlogsSeeder extends Seeder
{
    public function run(): void
    {
        // Create 500 dummy userlogs

        $this->command->warn(PHP_EOL . 'Creating userlogs ...');

        $this->withProgressBar(500, fn () => Userlog::factory()->count(1)->create());

        $this->command->info('Userlogs created.');
    }

    protected function withProgressBar(int $amount, Closure $createCollectionOfOne): Collection
    {
        $progressBar = new ProgressBar($this->command->getOutput(), $amount);

        $progressBar->start();

        $items = new Collection();

        foreach (range(1, $amount) as $i) {
            $items = $items->merge(
                $createCollectionOfOne()
            );
            $progressBar->advance();
        }

        $progressBar->finish();

        $this->command->getOutput()->writeln('');

        return $items;
    }
}
