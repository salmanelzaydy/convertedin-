<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        // Example: Update user task counts in the Statistics table
        $users = User::withCount('assignedTasks')->get();

        foreach ($users as $user) {
            // Update the Statistics table or perform necessary calculations
            // Example: $user->statistics()->update(['task_count' => $user->assigned_tasks_count]);
        }
    }
}
