<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamMembers = [
            [
                'name' => 'John Smith',
                'position' => 'Senior Real Estate Agent',
                'bio' => 'John has over 15 years of experience in the real estate industry. He specializes in residential properties and has helped hundreds of families find their dream homes.',
                'email' => 'john.smith@example.com',
                'phone' => '+92 300 1234567',
                'linkedin' => 'https://linkedin.com/in/johnsmith',
                'twitter' => 'https://twitter.com/johnsmith',
                'facebook' => 'https://facebook.com/johnsmith',
                'instagram' => 'https://instagram.com/johnsmith',
                'experience_years' => 15,
                'education' => 'Bachelor of Business Administration, University of Karachi',
                'expertise' => ['Residential Properties', 'Property Investment', 'Market Analysis'],
                'certifications' => ['Licensed Real Estate Agent', 'Certified Property Manager'],
                'achievements' => ['Top Sales Agent 2023', 'Million Dollar Club Member'],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Sarah Johnson',
                'position' => 'Property Consultant',
                'bio' => 'Sarah is a dedicated property consultant with expertise in commercial real estate. She has successfully closed deals worth millions of dollars.',
                'email' => 'sarah.johnson@example.com',
                'phone' => '+92 300 2345678',
                'linkedin' => 'https://linkedin.com/in/sarahjohnson',
                'twitter' => 'https://twitter.com/sarahjohnson',
                'facebook' => 'https://facebook.com/sarahjohnson',
                'instagram' => 'https://instagram.com/sarahjohnson',
                'experience_years' => 12,
                'education' => 'Master of Real Estate Development, LUMS',
                'expertise' => ['Commercial Properties', 'Land Development', 'Investment Properties'],
                'certifications' => ['Certified Commercial Investment Member', 'Real Estate Broker License'],
                'achievements' => ['Best Commercial Agent 2022', 'Excellence in Service Award'],
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Ahmed Hassan',
                'position' => 'Real Estate Developer',
                'bio' => 'Ahmed is a visionary real estate developer with a passion for creating sustainable and innovative housing solutions.',
                'email' => 'ahmed.hassan@example.com',
                'phone' => '+92 300 3456789',
                'linkedin' => 'https://linkedin.com/in/ahmedhassan',
                'twitter' => 'https://twitter.com/ahmedhassan',
                'facebook' => 'https://facebook.com/ahmedhassan',
                'instagram' => 'https://instagram.com/ahmedhassan',
                'experience_years' => 20,
                'education' => 'Master of Architecture, NED University',
                'expertise' => ['Property Development', 'Urban Planning', 'Sustainable Design'],
                'certifications' => ['LEED Certified Professional', 'Urban Development Specialist'],
                'achievements' => ['Developer of the Year 2023', 'Green Building Award'],
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Fatima Ali',
                'position' => 'Property Manager',
                'bio' => 'Fatima excels in property management and tenant relations. She ensures smooth operations for all managed properties.',
                'email' => 'fatima.ali@example.com',
                'phone' => '+92 300 4567890',
                'linkedin' => 'https://linkedin.com/in/fatimaali',
                'twitter' => 'https://twitter.com/fatimaali',
                'facebook' => 'https://facebook.com/fatimaali',
                'instagram' => 'https://instagram.com/fatimaali',
                'experience_years' => 8,
                'education' => 'Bachelor of Property Management, University of Punjab',
                'expertise' => ['Property Management', 'Tenant Relations', 'Maintenance Coordination'],
                'certifications' => ['Certified Property Manager', 'Tenant Relations Specialist'],
                'achievements' => ['Property Manager of the Year 2023', 'Customer Service Excellence'],
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Muhammad Khan',
                'position' => 'Investment Advisor',
                'bio' => 'Muhammad specializes in real estate investment strategies and helps clients build profitable property portfolios.',
                'email' => 'muhammad.khan@example.com',
                'phone' => '+92 300 5678901',
                'linkedin' => 'https://linkedin.com/in/muhammadkhan',
                'twitter' => 'https://twitter.com/muhammadkhan',
                'facebook' => 'https://facebook.com/muhammadkhan',
                'instagram' => 'https://instagram.com/muhammadkhan',
                'experience_years' => 18,
                'education' => 'Master of Finance, IBA Karachi',
                'expertise' => ['Investment Strategies', 'Portfolio Management', 'Market Analysis'],
                'certifications' => ['Certified Financial Planner', 'Real Estate Investment Specialist'],
                'achievements' => ['Investment Advisor of the Year 2023', 'Portfolio Growth Award'],
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($teamMembers as $memberData) {
            TeamMember::create($memberData);
        }

        $this->command->info('Sample team members created successfully!');
    }
}
