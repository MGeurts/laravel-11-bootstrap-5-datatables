<?php

namespace Database\Seeders;

use App\Models\Customer;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;

class CustomersSeeder extends Seeder
{
    public function run(): void
    {
        // Create 2000 dummy customers

        $this->command->warn(PHP_EOL . 'Creating customers ...');

        $this->withProgressBar(2000, fn () => Customer::factory()->count(1)->create());

        $this->command->info('Customers created.');
    }

    protected function withProgressBar(int $amount, Closure $createCollectionOfOne): Collection
    {
        $progressBar = new ProgressBar($this->command->getOutput(), $amount);

        $progressBar->start();

        $items = new Collection;

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
