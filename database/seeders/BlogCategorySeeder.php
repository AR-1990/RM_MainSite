<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Real Estate News',
                'description' => 'Latest news and updates from real estate industry',
                'color' => '#007bff',
                'is_active' => true
            ],
            [
                'name' => 'Property Investment',
                'description' => 'Tips and insights for property investment',
                'color' => '#28a745',
                'is_active' => true
            ],
            [
                'name' => 'Home Buying Guide',
                'description' => 'Complete guides for home buyers',
                'color' => '#dc3545',
                'is_active' => true
            ],
            [
                'name' => 'Market Analysis',
                'description' => 'Real estate market trends and analysis',
                'color' => '#ffc107',
                'is_active' => true
            ],
            [
                'name' => 'Property Management',
                'description' => 'Property management tips and best practices',
                'color' => '#6610f2',
                'is_active' => true
            ],
            [
                'name' => 'Interior Design',
                'description' => 'Home decoration and interior design ideas',
                'color' => '#fd7e14',
                'is_active' => true
            ],
        ];

        foreach ($categories as $category) {
            BlogCategory::create($category);
        }
    }
}