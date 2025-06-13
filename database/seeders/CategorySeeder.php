<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Motor',
                'fee_per_hour' => 2000,
            ],
            [
                'name' => 'Mobil',
                'fee_per_hour' => 5000,
            ],
            [
                'name' => 'Bus',
                'fee_per_hour' => 10000,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
