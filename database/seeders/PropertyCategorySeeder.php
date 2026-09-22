<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PropertyCategory;

class PropertyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'House', 'description' => 'Residential houses'],
            ['name' => 'Apartment', 'description' => 'Residential apartments'],
            ['name' => 'Plot', 'description' => 'Empty plots for construction'],
            ['name' => 'Commercial', 'description' => 'Commercial properties'],
            ['name' => 'Villa', 'description' => 'Luxury villas'],
            ['name' => 'Office', 'description' => 'Office spaces'],
            ['name' => 'Shop', 'description' => 'Retail shops'],
            ['name' => 'Warehouse', 'description' => 'Storage and warehouse spaces'],
        ];

        foreach ($categories as $category) {
            PropertyCategory::create($category);
        }
    }
}
