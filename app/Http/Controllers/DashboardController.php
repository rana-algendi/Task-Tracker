<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();

        $completedToday = Task::where('user_id', $userId)
            ->whereDate('completed_at', $today)
            ->count();

        $overdue = Task::where('user_id', $userId)
            ->whereNull('completed_at')
            ->whereDate('due_date', '<', $today)
            ->count();

        $totalTasks = Task::where('user_id', $userId)->count();
        $dueToday = Task::where('user_id', $userId)
            ->whereDate('due_date', $today)
            ->count();

        $completedTotal = Task::where('user_id', $userId)
            ->whereNotNull('completed_at')
            ->count();

        $incompleteTotal = Task::where('user_id', $userId)
            ->whereNull('completed_at')
            ->count();
        $upcomingTasks = Task::where('user_id', $userId)
            ->whereNull('completed_at')
            ->whereIn('due_date', [$today->toDateString(), $tomorrow->toDateString()])
            ->orderBy('due_date')
            ->get();

        return view('dashboard', compact(
            'completedToday',
            'overdue',
            'totalTasks',
            'dueToday',
            'completedTotal',
            'incompleteTotal',
            'upcomingTasks'
        ));
    }
}
