<?php

namespace Database\Seeders;

use App\Models\Severity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeveritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Severity::insert([
            ["name" => "Low"],
            ["name" => "Medium"],
            ["name" => "High"],
        ]);
    }
}
