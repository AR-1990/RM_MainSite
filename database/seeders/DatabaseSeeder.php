<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TeamMemberSeeder::class,
            ProjectSeeder::class,
            WorkloadSeeder::class,
            AttendanceSeeder::class,
            UserProfileSeeder::class,
        ]);
    }
}
