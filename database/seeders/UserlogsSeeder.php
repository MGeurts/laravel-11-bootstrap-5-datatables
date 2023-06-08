<?php

namespace Database\Seeders;

use App\Models\Userlog;
use Illuminate\Database\Seeder;

class UserlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create dummy userlogs
        Userlog::factory()->count(500)->create();
    }
}
