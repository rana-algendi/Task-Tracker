<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class GenerateRecurringTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = ' tasks:generate-recurring{--frequency=daily}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the predefined daily recurring task for all users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
               $today = Carbon::today();

        User::chunk(100, function ($users) use ($today) {
            foreach ($users as $user) {
                $exists = $user->tasks()
                    ->where('title', 'Plan your day')
                    ->whereDate('due_date', $today)
                    ->exists();

                if (! $exists) {
                    $user->tasks()->create([
                        'title' => 'Plan your day',
                        'description' => 'Take 10 minutes to organize and prioritize your tasks.',
                        'due_date' => $today,
                        'is_recurring' => true,
                    ]);

                    $this->info("✔ Created for: {$user->email}");
                } else {
                    $this->line("⏩ Already exists for: {$user->email}");
                }
            }
        });

        $this->info('✅ Recurring tasks generated successfully.');
    }

}
