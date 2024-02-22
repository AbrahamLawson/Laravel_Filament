<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Owner;
use App\Models\Patient;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Owner::factory(10)->hasPatient(3)->create();
        Patient::factory(15)->hasOwner(3)->create();
        Treatment::factory(5)->hasPatient(8)->create();
    }
}
