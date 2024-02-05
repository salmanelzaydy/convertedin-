<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function create()
    {
        $users = User::where('role','user')->get();
        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_to_id' => 'required|exists:users,id',
        ]);

        Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'assigned_to_id' => $request->input('assigned_to_id'),
            'assigned_by_id' => Auth::id(),
        ]);

        return redirect('/tasks')->with('success', 'Task created successfully');
    }

    public function index()
    {
        // Get tasks based on user role
        if (Auth::user()->is_admin) {
            $tasks = Task::with('assignedTo', 'assignedBy')->paginate(10);
        } else {
            $tasks = Task::where('assigned_to_id', Auth::id())->with('assignedTo', 'assignedBy')->paginate(10);
        }

        return view('tasks.index', compact('tasks'));
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }

    public function statistics()
    {
        $topUsers = User::withCount('assignedTasks')
            ->orderBy('assigned_tasks_count', 'desc')
            ->limit(10)
            ->get();

        return view('tasks.statistics', compact('topUsers'));
    }
}

