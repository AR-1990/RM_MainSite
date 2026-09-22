<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Luxury Residential Complex',
                'slug' => 'luxury-residential-complex',
                'description' => '<p>A premium residential complex featuring modern amenities, spacious apartments, and beautiful landscaping. Perfect for families looking for luxury living.</p><p>Features include:</p><ul><li>Swimming pool</li><li>Gym and fitness center</li><li>24/7 security</li><li>Underground parking</li><li>Children\'s playground</li></ul>',
                'short_description' => 'Premium residential complex with modern amenities and beautiful landscaping.',
                'location' => 'DHA Phase 6, Lahore',
                'price' => 25000000,
                'price_type' => 'total',
                'area' => 2500,
                'area_unit' => 'sqft',
                'bedrooms' => 4,
                'bathrooms' => 3.5,
                'floors' => 2,
                'project_type' => 'residential',
                'status' => 'under_construction',
                'completion_date' => '2025-06-30',
                'developer' => 'Randhawa Marketing',
                'amenities' => ['swimming_pool', 'gym', 'park', 'security', 'elevator', 'parking', 'garden', 'playground'],
                'features' => ['air_conditioning', 'heating', 'balcony', 'fireplace', 'hardwood_floors', 'walk_in_closet', 'granite_countertops', 'stainless_steel_appliances'],
                'meta_title' => 'Luxury Residential Complex - DHA Phase 6, Lahore',
                'meta_description' => 'Premium residential complex with modern amenities in DHA Phase 6, Lahore. 4 bedrooms, 3.5 bathrooms, swimming pool, gym, and more.',
                'meta_keywords' => 'luxury residential, DHA Phase 6, Lahore, swimming pool, gym, modern amenities',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Commercial Plaza',
                'slug' => 'commercial-plaza',
                'description' => '<p>A modern commercial plaza designed for businesses and retail. Features include:</p><ul><li>Multiple retail spaces</li><li>Office spaces</li><li>Conference rooms</li><li>High-speed internet</li><li>Parking facilities</li></ul>',
                'short_description' => 'Modern commercial plaza with retail and office spaces.',
                'location' => 'Gulberg III, Lahore',
                'price' => 45000000,
                'price_type' => 'total',
                'area' => 5000,
                'area_unit' => 'sqft',
                'bedrooms' => null,
                'bathrooms' => 8,
                'floors' => 4,
                'project_type' => 'commercial',
                'status' => 'ready_to_move',
                'completion_date' => '2024-12-31',
                'developer' => 'Randhawa Marketing',
                'amenities' => ['elevator', 'parking', 'security', 'air_conditioning'],
                'features' => ['high_speed_internet', 'conference_rooms', 'retail_spaces', 'office_spaces'],
                'meta_title' => 'Commercial Plaza - Gulberg III, Lahore',
                'meta_description' => 'Modern commercial plaza with retail and office spaces in Gulberg III, Lahore.',
                'meta_keywords' => 'commercial plaza, Gulberg III, Lahore, retail spaces, office spaces',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'title' => 'Mixed-Use Development',
                'slug' => 'mixed-use-development',
                'description' => '<p>A comprehensive mixed-use development combining residential, commercial, and recreational spaces. Features include:</p><ul><li>Residential apartments</li><li>Retail shops</li><li>Restaurants</li><li>Recreation center</li><li>Green spaces</li></ul>',
                'short_description' => 'Comprehensive mixed-use development with residential and commercial spaces.',
                'location' => 'Bahria Town, Lahore',
                'price' => 35000000,
                'price_type' => 'total',
                'area' => 8000,
                'area_unit' => 'sqft',
                'bedrooms' => 3,
                'bathrooms' => 2.5,
                'floors' => 3,
                'project_type' => 'mixed',
                'status' => 'planning',
                'completion_date' => '2026-03-31',
                'developer' => 'Randhawa Marketing',
                'amenities' => ['swimming_pool', 'gym', 'park', 'security', 'elevator', 'parking', 'garden', 'playground'],
                'features' => ['air_conditioning', 'balcony', 'hardwood_floors', 'granite_countertops'],
                'meta_title' => 'Mixed-Use Development - Bahria Town, Lahore',
                'meta_description' => 'Comprehensive mixed-use development with residential and commercial spaces in Bahria Town, Lahore.',
                'meta_keywords' => 'mixed-use development, Bahria Town, Lahore, residential, commercial',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Affordable Housing Project',
                'slug' => 'affordable-housing-project',
                'description' => '<p>An affordable housing project designed for middle-income families. Features include:</p><ul><li>2-3 bedroom apartments</li><li>Basic amenities</li><li>Community spaces</li><li>Affordable pricing</li></ul>',
                'short_description' => 'Affordable housing project for middle-income families.',
                'location' => 'Johar Town, Lahore',
                'price' => 12000000,
                'price_type' => 'total',
                'area' => 1200,
                'area_unit' => 'sqft',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'floors' => 1,
                'project_type' => 'residential',
                'status' => 'completed',
                'completion_date' => '2024-08-31',
                'developer' => 'Randhawa Marketing',
                'amenities' => ['park', 'security', 'parking', 'playground'],
                'features' => ['air_conditioning', 'balcony'],
                'meta_title' => 'Affordable Housing Project - Johar Town, Lahore',
                'meta_description' => 'Affordable housing project for middle-income families in Johar Town, Lahore.',
                'meta_keywords' => 'affordable housing, Johar Town, Lahore, middle-income',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'title' => 'Premium Office Tower',
                'slug' => 'premium-office-tower',
                'description' => '<p>A premium office tower designed for corporate clients. Features include:</p><ul><li>Modern office spaces</li><li>Conference facilities</li><li>High-speed internet</li><li>Security systems</li><li>Parking facilities</li></ul>',
                'short_description' => 'Premium office tower with modern facilities for corporate clients.',
                'location' => 'Defence, Lahore',
                'price' => 60000000,
                'price_type' => 'total',
                'area' => 10000,
                'area_unit' => 'sqft',
                'bedrooms' => null,
                'bathrooms' => 12,
                'floors' => 8,
                'project_type' => 'commercial',
                'status' => 'under_construction',
                'completion_date' => '2025-12-31',
                'developer' => 'Randhawa Marketing',
                'amenities' => ['elevator', 'parking', 'security', 'air_conditioning'],
                'features' => ['high_speed_internet', 'conference_rooms', 'modern_offices', 'security_systems'],
                'meta_title' => 'Premium Office Tower - Defence, Lahore',
                'meta_description' => 'Premium office tower with modern facilities for corporate clients in Defence, Lahore.',
                'meta_keywords' => 'premium office tower, Defence, Lahore, corporate offices, modern facilities',
                'is_active' => true,
                'is_featured' => true,
            ],
        ];

        foreach ($projects as $projectData) {
            // Generate slug if not provided
            if (empty($projectData['slug'])) {
                $projectData['slug'] = Str::slug($projectData['title']);
            }
            
            Project::create($projectData);
        }

        $this->command->info('Sample projects created successfully!');
    }
}
