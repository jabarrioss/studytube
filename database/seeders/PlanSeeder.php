<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'name' => 'free',
            'price' => 0.00,
            'features_json' => [
                'unlimited_topics' => true,
                'unlimited_notes' => true,
                'basic_support' => true,
            ],
        ]);

        Plan::create([
            'name' => 'premium',
            'price' => 9.99,
            'features_json' => [
                'unlimited_topics' => true,
                'unlimited_notes' => true,
                'priority_support' => true,
                'advanced_analytics' => true,
                'export_data' => true,
            ],
        ]);
    }
}
