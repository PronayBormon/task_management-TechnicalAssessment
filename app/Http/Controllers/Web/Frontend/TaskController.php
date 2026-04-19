<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::query()
            ->where('is_active', 1)

            ->when(
                $request->search,
                fn($q) =>
                $q->where('title', 'like', '%' . $request->search . '%')
            )

            ->when(
                $request->status,
                fn($q) =>
                $q->where('status', $request->status)
            )

            ->when(
                $request->priority,
                fn($q) =>
                $q->where('priority', $request->priority)
            )

            ->latest()
            ->paginate(10);

        if ($request->ajax()) {
            return view('frontend.layouts.tasks.load-more', compact('tasks'))->render();
        }

        return view('frontend.layouts.tasks.index', compact('tasks'));
    }

    public function show($id)
    {
        $task = Task::where('is_active', 1)
            ->find($id);

        return view('frontend.layouts.tasks.details', compact('task'));
    }
}
