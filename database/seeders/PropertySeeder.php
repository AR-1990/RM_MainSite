<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\User;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user if not exists
        $user = User::firstOrCreate([
            'email' => 'admin@example.com'
        ], [
            'name' => 'Admin User',
            'password' => bcrypt('password'),
        ]);

        // Create test properties
        $properties = [
            [
                'title' => 'Luxury Villa in DHA',
                'description' => 'Beautiful 5-bedroom villa with modern amenities',
                'full_address' => 'DHA Phase 6, Lahore',
                'city' => 'Lahore',
                'location' => 'Lahore, Pakistan',
                'price' => 45000000,
                'property_category_id' => 1, // House
                'property_status' => 'for_sale',
                'size_prefix' => 'Square Feet',
                'size' => 4500,
                'marla_value' => 272,
                'furnished_status' => 'Furnished',
                'rooms' => 8,
                'bedrooms' => 5,
                'bathrooms' => 4,
                'garages' => 2,
                'video_url' => 'https://www.youtube.com/watch?v=example',
                'is_active' => true,
                'is_sold' => false,
                'is_deactivated' => false,
                'user_id' => $user->id,
            ],
            [
                'title' => 'Modern Apartment in Gulberg',
                'description' => 'Spacious 3-bedroom apartment with city view',
                'full_address' => 'Gulberg III, Lahore',
                'city' => 'Lahore',
                'location' => 'Lahore, Pakistan',
                'price' => 25000000,
                'property_category_id' => 2, // Apartment
                'property_status' => 'for_sale',
                'size_prefix' => 'Square Feet',
                'size' => 2800,
                'marla_value' => 272,
                'furnished_status' => 'Non-Furnished',
                'rooms' => 5,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'garages' => 1,
                'video_url' => null,
                'is_active' => true,
                'is_sold' => false,
                'is_deactivated' => false,
                'user_id' => $user->id,
            ],
            [
                'title' => 'Commercial Space in Faisalabad',
                'description' => 'Prime commercial space for business',
                'full_address' => 'D Ground, Faisalabad',
                'city' => 'Faisalabad',
                'location' => 'Faisalabad, Pakistan',
                'price' => 35000000,
                'property_category_id' => 4, // Commercial
                'property_status' => 'for_rent',
                'size_prefix' => 'Square Feet',
                'size' => 5000,
                'marla_value' => 272,
                'furnished_status' => 'Non-Furnished',
                'rooms' => 10,
                'bedrooms' => 0,
                'bathrooms' => 3,
                'garages' => 5,
                'video_url' => null,
                'is_active' => true,
                'is_sold' => false,
                'is_deactivated' => false,
                'user_id' => $user->id,
            ],
        ];

        foreach ($properties as $propertyData) {
            Property::create($propertyData);
        }

        // Create a property with floors to demonstrate the functionality
        $propertyWithFloors = Property::create([
            'title' => 'Multi-Floor Commercial Building',
            'description' => 'Modern commercial building with multiple floors for different business types',
            'full_address' => 'Main Boulevard, Gulberg III, Lahore',
            'city' => 'Lahore',
            'location' => 'Lahore, Pakistan',
            'price' => 75000000,
            'property_category_id' => 4, // Commercial
            'property_status' => 'for_sale',
            'size_prefix' => 'Square Feet',
            'size' => 12000,
            'marla_value' => 500,
            'furnished_status' => 'Non-Furnished',
            'rooms' => 20,
            'bedrooms' => 0,
            'bathrooms' => 8,
            'garages' => 10,
            'video_url' => null,
            'is_active' => true,
            'is_sold' => false,
            'is_deactivated' => false,
            'user_id' => $user->id,
        ]);

        // Create floors for this property
        $floors = [
            [
                'floor_name' => 'Ground Floor',
                'floor_price' => 15000000,
                'price_prefix' => 'PKR',
                'floor_size' => 4000,
                'size_postfix' => 'sq ft',
                'bedrooms' => 0,
                'bathrooms' => 2,
                'description' => 'Large open space perfect for retail or showroom',
            ],
            [
                'floor_name' => 'First Floor',
                'floor_price' => 18000000,
                'price_prefix' => 'PKR',
                'floor_size' => 4000,
                'size_postfix' => 'sq ft',
                'bedrooms' => 0,
                'bathrooms' => 2,
                'description' => 'Office space with conference rooms and meeting areas',
            ],
            [
                'floor_name' => 'Second Floor',
                'floor_price' => 20000000,
                'price_prefix' => 'PKR',
                'floor_size' => 4000,
                'size_postfix' => 'sq ft',
                'bedrooms' => 0,
                'bathrooms' => 2,
                'description' => 'Executive offices with premium finishes',
            ],
        ];

        foreach ($floors as $floorData) {
            $propertyWithFloors->floors()->create($floorData);
        }
    }
}
