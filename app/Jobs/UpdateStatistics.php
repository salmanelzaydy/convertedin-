<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Statistics;

class UpdateStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        // Example: Update user task counts in the Statistics table
        $users = User::where('role','user')->withCount('assignedTasks')->get();

        foreach ($users as $user) {
            $taskCount = $user->assignedTasks();

            Statistics::updateOrCreate(
                ['user_id' => $user->id],
                ['task_count' => $taskCount]
            );
        }
    }
}
