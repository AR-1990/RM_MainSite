<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        
        foreach ($users as $user) {
            // Check if user already has a profile
            if (!$user->profile) {
                $this->createUserProfile($user);
            }
        }
    }

    private function createUserProfile(User $user)
    {
        $departments = ['Sales', 'Marketing', 'HR', 'Finance', 'IT', 'Operations', 'Customer Service'];
        $designations = ['Manager', 'Senior Executive', 'Executive', 'Assistant', 'Intern'];
        
        $profileData = [
            'user_id' => $user->id,
            'phone' => '+91' . rand(7000000000, 9999999999),
            'department' => $departments[array_rand($departments)],
            'designation' => $designations[array_rand($designations)],
            'date_of_joining' => now()->subDays(rand(30, 365)),
            'basic_salary' => rand(25000, 80000),
            'allowances' => rand(5000, 15000),
            'employee_id' => 'EMP' . str_pad($user->id, 4, '0', STR_PAD_LEFT),
            'is_portal_active' => true,
            'address' => $this->getRandomAddress(),
            'city' => $this->getRandomCity(),
            'state' => $this->getRandomState(),
            'country' => 'India',
            'postal_code' => rand(100000, 999999),
            'bank_name' => $this->getRandomBank(),
            'bank_account_number' => rand(10000000000, 99999999999),
            'ifsc_code' => 'SBIN' . rand(1000000, 9999999),
            'pan_number' => 'ABCDE' . rand(1000, 9999) . 'F',
            'aadhar_number' => rand(100000000000, 999999999999),
            'skills' => $this->getRandomSkills(),
            'experience_summary' => $this->getRandomExperience(),
            'education' => $this->getRandomEducation(),
            'certifications' => $this->getRandomCertifications(),
        ];

        // Calculate total salary
        $profileData['total_salary'] = $profileData['basic_salary'] + $profileData['allowances'];

        UserProfile::create($profileData);
    }

    private function getRandomAddress()
    {
        $addresses = [
            '123 Main Street, Sector 15',
            '456 Park Avenue, Block A',
            '789 Lake View Colony',
            '321 Green Park Extension',
            '654 Sunshine Apartments',
            '987 Royal Plaza, Floor 3',
            '147 Garden Estate, Unit 5',
            '258 Business Park, Tower 2',
            '369 Riverside Society',
            '741 Downtown Complex'
        ];
        
        return $addresses[array_rand($addresses)];
    }

    private function getRandomCity()
    {
        $cities = ['Mumbai', 'Delhi', 'Bangalore', 'Hyderabad', 'Chennai', 'Kolkata', 'Pune', 'Ahmedabad', 'Jaipur', 'Surat'];
        return $cities[array_rand($cities)];
    }

    private function getRandomState()
    {
        $states = ['Maharashtra', 'Delhi', 'Karnataka', 'Telangana', 'Tamil Nadu', 'West Bengal', 'Gujarat', 'Rajasthan', 'Uttar Pradesh', 'Kerala'];
        return $states[array_rand($states)];
    }

    private function getRandomBank()
    {
        $banks = ['State Bank of India', 'HDFC Bank', 'ICICI Bank', 'Axis Bank', 'Punjab National Bank', 'Bank of Baroda', 'Canara Bank', 'Union Bank of India'];
        return $banks[array_rand($banks)];
    }

    private function getRandomSkills()
    {
        $skillSets = [
            'Sales Management, Customer Relations, Negotiation, CRM Software',
            'Digital Marketing, Social Media, SEO, Google Analytics',
            'HR Management, Recruitment, Employee Relations, HRIS',
            'Financial Analysis, Budgeting, Excel, QuickBooks',
            'Web Development, PHP, Laravel, MySQL, JavaScript',
            'Project Management, Agile, Scrum, MS Project',
            'Customer Service, Communication, Problem Solving, Zendesk',
            'Data Analysis, Excel, SQL, Power BI, Statistics'
        ];
        
        return $skillSets[array_rand($skillSets)];
    }

    private function getRandomExperience()
    {
        $experiences = [
            'Experienced professional with strong background in sales and customer relationship management.',
            'Skilled digital marketer with expertise in social media campaigns and SEO optimization.',
            'HR professional with experience in recruitment, employee engagement, and policy development.',
            'Finance professional with strong analytical skills and experience in financial planning.',
            'Full-stack developer with expertise in modern web technologies and frameworks.',
            'Project manager with experience in leading cross-functional teams and delivering projects on time.',
            'Customer service specialist with excellent communication and problem-solving abilities.',
            'Data analyst with strong quantitative skills and experience in business intelligence tools.'
        ];
        
        return $experiences[array_rand($experiences)];
    }

    private function getRandomEducation()
    {
        $education = [
            'Bachelor of Commerce',
            'Master of Business Administration',
            'Bachelor of Technology in Computer Science',
            'Master of Computer Applications',
            'Bachelor of Arts in Marketing',
            'Master of Science in Finance',
            'Bachelor of Business Administration',
            'Post Graduate Diploma in HR Management'
        ];
        
        return $education[array_rand($education)];
    }

    private function getRandomCertifications()
    {
        $certifications = [
            'Google Digital Marketing Certification',
            'PMP (Project Management Professional)',
            'HRCI PHR Certification',
            'Microsoft Excel Expert Certification',
            'AWS Certified Solutions Architect',
            'Salesforce Administrator Certification',
            'Google Analytics Individual Qualification',
            'HubSpot Inbound Marketing Certification'
        ];
        
        return $certifications[array_rand($certifications)];
    }
}
