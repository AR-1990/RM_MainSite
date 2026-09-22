<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AttendanceRecord;
use App\Models\User;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all active users
        $users = User::where('is_active', true)->get();
        
        if ($users->isEmpty()) {
            $this->command->info('No active users found. Please seed users first.');
            return;
        }

        // Generate attendance records for the last 30 days
        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();

        $statuses = ['present', 'absent', 'late', 'half_day', 'outdoor', 'leave'];
        $workTypes = ['office', 'outdoor', 'remote', 'meeting'];
        
        $locations = [
            'Client Office - ABC Corp',
            'Site Visit - Downtown Project',
            'Meeting Room - Conference Center',
            'Field Work - Construction Site',
            'Client Meeting - XYZ Industries'
        ];

        $workDescriptions = [
            'Client presentation and requirements gathering',
            'Site inspection and progress review',
            'Team coordination meeting',
            'Field measurements and documentation',
            'Client consultation and project planning'
        ];

        $comments = [
            'Productive day with good progress',
            'Client was satisfied with the presentation',
            'Team collaboration was excellent',
            'Site conditions were challenging but manageable',
            'Good feedback received from stakeholders'
        ];

        $this->command->info('Seeding attendance records...');

        foreach ($users as $user) {
            $currentDate = $startDate->copy();
            
            while ($currentDate <= $endDate) {
                // Skip weekends (Saturday = 6, Sunday = 0)
                if ($currentDate->dayOfWeek !== 6 && $currentDate->dayOfWeek !== 0) {
                    $status = $this->getRandomStatus($currentDate);
                    $workType = $this->getRandomWorkType($status);
                    
                    $attendanceData = [
                        'user_id' => $user->id,
                        'date' => $currentDate->format('Y-m-d'),
                        'status' => $status,
                        'work_type' => $workType,
                        'is_approved' => rand(0, 1),
                        'break_hours' => rand(0, 2) * 0.5, // 0, 0.5, 1, 1.5, 2
                    ];

                    // Add time data for present/late/half_day statuses
                    if (in_array($status, ['present', 'late', 'half_day'])) {
                        $attendanceData['check_in_time'] = $this->getCheckInTime($status);
                        $attendanceData['check_out_time'] = $this->getCheckOutTime($status);
                        
                        // Calculate total hours
                        if ($attendanceData['check_in_time'] && $attendanceData['check_out_time']) {
                            $checkIn = Carbon::parse($attendanceData['check_in_time']);
                            $checkOut = Carbon::parse($attendanceData['check_out_time']);
                            $totalMinutes = $checkOut->diffInMinutes($checkIn);
                            $breakMinutes = $attendanceData['break_hours'] * 60;
                            $attendanceData['total_hours'] = round(($totalMinutes - $breakMinutes) / 60, 2);
                        }
                    }

                    // Add outdoor work details
                    if ($workType === 'outdoor') {
                        $attendanceData['location'] = $locations[array_rand($locations)];
                        $attendanceData['work_description'] = $workDescriptions[array_rand($workDescriptions)];
                    }

                    // Add comments randomly
                    if (rand(1, 3) === 1) { // 33% chance
                        $attendanceData['comments'] = $comments[array_rand($comments)];
                    }

                    // Add break times if break hours > 0
                    if ($attendanceData['break_hours'] > 0) {
                        $attendanceData['break_start_time'] = '12:00';
                        $attendanceData['break_end_time'] = Carbon::parse('12:00')->addMinutes($attendanceData['break_hours'] * 60)->format('H:i');
                    }

                    // Create attendance record
                    AttendanceRecord::create($attendanceData);
                }
                
                $currentDate->addDay();
            }
        }

        $this->command->info('Attendance records seeded successfully!');
    }

    /**
     * Get random status based on date
     */
    private function getRandomStatus($date): string
    {
        $rand = rand(1, 100);
        
        // Higher chance of being present on weekdays
        if ($date->dayOfWeek >= 1 && $date->dayOfWeek <= 5) {
            if ($rand <= 70) return 'present';
            if ($rand <= 80) return 'late';
            if ($rand <= 85) return 'half_day';
            if ($rand <= 90) return 'outdoor';
            if ($rand <= 95) return 'leave';
            return 'absent';
        }
        
        // Weekend logic
        if ($rand <= 20) return 'present'; // Some people work on weekends
        if ($rand <= 30) return 'outdoor';
        if ($rand <= 40) return 'remote';
        return 'absent';
    }

    /**
     * Get random work type based on status
     */
    private function getRandomWorkType($status): string
    {
        if ($status === 'outdoor') return 'outdoor';
        if ($status === 'leave') return 'office'; // Default for leave
        
        $rand = rand(1, 100);
        
        if ($rand <= 60) return 'office';
        if ($rand <= 75) return 'outdoor';
        if ($rand <= 90) return 'remote';
        return 'meeting';
    }

    /**
     * Get check-in time based on status
     */
    private function getCheckInTime($status): string
    {
        switch ($status) {
            case 'late':
                return Carbon::parse('09:00')->addMinutes(rand(15, 120))->format('H:i'); // 9:15 to 11:00
            case 'half_day':
                return Carbon::parse('09:00')->addMinutes(rand(0, 60))->format('H:i'); // 9:00 to 10:00
            default:
                return Carbon::parse('08:00')->addMinutes(rand(0, 60))->format('H:i'); // 8:00 to 9:00
        }
    }

    /**
     * Get check-out time based on status
     */
    private function getCheckOutTime($status): string
    {
        switch ($status) {
            case 'half_day':
                return Carbon::parse('13:00')->addMinutes(rand(0, 60))->format('H:i'); // 1:00 to 2:00
            default:
                return Carbon::parse('17:00')->addMinutes(rand(-60, 60))->format('H:i'); // 4:00 to 6:00
        }
    }
}
