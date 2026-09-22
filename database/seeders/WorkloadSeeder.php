<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkloadTask;
use App\Models\TaskAssignment;
use App\Models\TaskAttachment;
use App\Models\TaskComment;
use App\Models\TaskReminder;
use App\Models\User;
use Carbon\Carbon;

class WorkloadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users for assignments
        $users = User::take(5)->get();
        
        if ($users->isEmpty()) {
            $this->command->info('No users found. Please run UserSeeder first.');
            return;
        }

        // Create sample tasks
        $tasks = [
            [
                'title' => 'Website Redesign Project',
                'description' => 'Complete redesign of the company website with modern UI/UX principles. Include responsive design, improved navigation, and performance optimization.',
                'priority' => 'high',
                'status' => 'in_progress',
                'frequency' => 'weekly',
                'recurring_interval' => 1,
                'start_date' => Carbon::now()->subDays(7),
                'due_date' => Carbon::now()->addDays(14),
                'reminder_time' => Carbon::now()->addDays(10)->format('H:i'),
                'is_recurring' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Monthly Sales Report',
                'description' => 'Generate and analyze monthly sales data, prepare presentation for stakeholders, and identify key performance indicators.',
                'priority' => 'medium',
                'status' => 'pending',
                'frequency' => 'monthly',
                'recurring_interval' => 1,
                'start_date' => Carbon::now()->startOfMonth(),
                'due_date' => Carbon::now()->endOfMonth(),
                'reminder_time' => Carbon::now()->endOfMonth()->subDays(2)->format('H:i'),
                'is_recurring' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Client Meeting Preparation',
                'description' => 'Prepare agenda, gather project updates, and create presentation materials for quarterly client review meeting.',
                'priority' => 'urgent',
                'status' => 'pending',
                'frequency' => 'one_time',
                'recurring_interval' => null,
                'start_date' => Carbon::now(),
                'due_date' => Carbon::now()->addDays(3),
                'reminder_time' => Carbon::now()->addDays(2)->format('H:i'),
                'is_recurring' => false,
                'is_active' => true,
            ],
            [
                'title' => 'Database Maintenance',
                'description' => 'Perform routine database maintenance including backup verification, performance optimization, and security updates.',
                'priority' => 'low',
                'status' => 'completed',
                'frequency' => 'weekly',
                'recurring_interval' => 1,
                'start_date' => Carbon::now()->subDays(14),
                'due_date' => Carbon::now()->subDays(7),
                'reminder_time' => Carbon::now()->subDays(8)->format('H:i'),
                'is_recurring' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Team Training Session',
                'description' => 'Organize training session for new team members on project management tools and company procedures.',
                'priority' => 'medium',
                'status' => 'cancelled',
                'frequency' => 'one_time',
                'recurring_interval' => null,
                'start_date' => Carbon::now()->addDays(7),
                'due_date' => Carbon::now()->addDays(21),
                'reminder_time' => Carbon::now()->addDays(18)->format('H:i'),
                'is_recurring' => false,
                'is_active' => true,
            ],
            [
                'title' => 'Daily Standup Meeting',
                'description' => 'Conduct daily team standup meeting to discuss progress, blockers, and plan for the day.',
                'priority' => 'low',
                'status' => 'pending',
                'frequency' => 'daily',
                'recurring_interval' => 1,
                'start_date' => Carbon::now(),
                'due_date' => Carbon::now()->addDays(30),
                'reminder_time' => Carbon::now()->addHours(8)->format('H:i'),
                'is_recurring' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Quarterly Budget Review',
                'description' => 'Review quarterly budget performance, analyze variances, and prepare recommendations for next quarter.',
                'priority' => 'high',
                'status' => 'pending',
                'frequency' => 'monthly',
                'recurring_interval' => 3,
                'start_date' => Carbon::now()->addDays(14),
                'due_date' => Carbon::now()->addDays(28),
                'reminder_time' => Carbon::now()->addDays(25)->format('H:i'),
                'is_recurring' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Bug Fix Implementation',
                'description' => 'Fix critical bugs reported in the production system and deploy hotfix to resolve user issues.',
                'priority' => 'urgent',
                'status' => 'in_progress',
                'frequency' => 'one_time',
                'recurring_interval' => null,
                'start_date' => Carbon::now()->subDays(1),
                'due_date' => Carbon::now()->addDays(2),
                'reminder_time' => Carbon::now()->addDays(1)->format('H:i'),
                'is_recurring' => false,
                'is_active' => true,
            ],
        ];

        foreach ($tasks as $taskData) {
            $task = WorkloadTask::create($taskData);
            
            // Assign users to tasks
            $numAssignments = rand(1, min(3, $users->count()));
            $selectedUsers = $users->random($numAssignments);
            
            foreach ($selectedUsers as $user) {
                $roles = ['assignee', 'reviewer', 'supervisor'];
                $statuses = ['assigned', 'accepted', 'in_progress', 'completed'];
                
                TaskAssignment::create([
                    'task_id' => $task->id,
                    'user_id' => $user->id,
                    'role' => $roles[array_rand($roles)],
                    'status' => $statuses[array_rand($statuses)],
                    'accepted_at' => rand(0, 1) ? Carbon::now()->subDays(rand(1, 5)) : null,
                    'started_at' => rand(0, 1) ? Carbon::now()->subDays(rand(1, 3)) : null,
                    'completed_at' => $task->status === 'completed' ? Carbon::now()->subDays(rand(1, 2)) : null,
                    'notes' => rand(0, 1) ? 'Sample assignment notes for ' . $user->name : null,
                ]);
            }
            
            // Add comments to tasks
            $numComments = rand(1, 4);
            for ($i = 0; $i < $numComments; $i++) {
                $commentTypes = ['comment', 'update', 'reminder', 'note'];
                $commentTexts = [
                    'Task is progressing well. All milestones are on track.',
                    'Need clarification on the requirements for this task.',
                    'Updated the project timeline based on client feedback.',
                    'Great work on the initial phase. Looking forward to the next steps.',
                    'Please review the latest changes and provide feedback.',
                    'Task completed successfully. All requirements have been met.',
                    'Encountered some technical challenges. Working on solutions.',
                    'Client is satisfied with the current progress.',
                ];
                
                TaskComment::create([
                    'task_id' => $task->id,
                    'user_id' => $users->random()->id,
                    'comment' => $commentTexts[array_rand($commentTexts)],
                    'type' => $commentTypes[array_rand($commentTypes)],
                    'is_internal' => rand(0, 1),
                ]);
            }
            
            // Add reminders
            if ($task->reminder_time) {
                $reminderTypes = ['email', 'notification', 'sms'];
                $numReminders = rand(1, 2);
                
                for ($i = 0; $i < $numReminders; $i++) {
                    TaskReminder::create([
                        'task_id' => $task->id,
                        'user_id' => $users->random()->id,
                        'type' => $reminderTypes[array_rand($reminderTypes)],
                        'reminder_time' => $task->reminder_time->copy()->subDays(rand(1, 3)),
                        'is_sent' => $task->reminder_time->isPast(),
                        'sent_at' => $task->reminder_time->isPast() ? $task->reminder_time->copy()->subDays(rand(1, 2)) : null,
                        'message' => 'Reminder: ' . $task->title . ' is due soon.',
                    ]);
                }
            }
            
            // Add some attachments (simulated)
            if (rand(0, 1)) {
                $fileTypes = ['pdf', 'doc', 'xls', 'jpg'];
                $fileNames = [
                    'project_specification.pdf',
                    'requirements_document.docx',
                    'budget_spreadsheet.xlsx',
                    'design_mockup.jpg',
                    'technical_diagram.pdf',
                    'meeting_notes.docx',
                ];
                
                $numAttachments = rand(1, 3);
                for ($i = 0; $i < $numAttachments; $i++) {
                    $fileName = $fileNames[array_rand($fileNames)];
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                    
                    TaskAttachment::create([
                        'task_id' => $task->id,
                        'file_name' => 'sample_' . $task->id . '_' . ($i + 1) . '.' . $fileType,
                        'file_path' => 'workload/attachments/sample_' . $task->id . '_' . ($i + 1) . '.' . $fileType,
                        'file_type' => $fileType,
                        'original_name' => $fileName,
                        'file_size' => rand(100, 5000) * 1024, // 100KB to 5MB
                        'description' => 'Sample attachment for ' . $task->title,
                        'uploaded_by' => $users->random()->id,
                    ]);
                }
            }
        }
        
        $this->command->info('Workload management system seeded successfully!');
        $this->command->info('Created ' . count($tasks) . ' sample tasks with assignments, comments, reminders, and attachments.');
    }
}
