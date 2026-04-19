<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // All Tasks
        $tasks = Task::latest()->get();

        // Cards Data
        $totalTasks      = Task::count();
        $pendingTasks    = Task::where('status', 'pending')->count();
        $progressTasks   = Task::where('status', 'in_progress')->count();
        $completedTasks  = Task::where('status', 'completed')->count();

        // Donut Chart Data
        $chartStatus = [
            $pendingTasks,
            $progressTasks,
            $completedTasks
        ];

        // Monthly Task Trend
        $months = [];
        $monthlyTasks = [];
        $monthlyCompleted = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->format('M');
            $months[] = $monthName;

            $monthlyTasks[] = Task::whereMonth('created_at', $i)->count();

            $monthlyCompleted[] = Task::whereMonth('created_at', $i)
                ->where('status', 'completed')
                ->count();
        }

        // Recent Tasks
        $recentTasks = Task::latest()->take(5)->get();

        return view('backend.layouts.dashboard.index', compact(
            'tasks',
            'totalTasks',
            'pendingTasks',
            'progressTasks',
            'completedTasks',
            'chartStatus',
            'months',
            'monthlyTasks',
            'monthlyCompleted',
            'recentTasks'
        ));
    }
}
