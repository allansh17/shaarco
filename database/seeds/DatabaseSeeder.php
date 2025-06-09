<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $path = 'database/database.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Database seeded!');
    }
}
