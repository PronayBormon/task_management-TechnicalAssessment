<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class TaskController extends Controller
{

    public function __construct(private TaskService $taskService) {}
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tasks = Task::latest();

            return DataTables::of($tasks)

                ->addIndexColumn()

                ->editColumn('status', function ($row) {

                    return match ($row->status) {
                        'pending' => '<span class="badge bg-warning">Pending</span>',
                        'in_progress' => '<span class="badge bg-info">In Progress</span>',
                        'completed' => '<span class="badge bg-success">Completed</span>',
                        default => '-',
                    };
                })

                ->editColumn('priority', function ($row) {

                    return match ($row->priority) {
                        1 => '<span class="badge bg-danger">High</span>',
                        2 => '<span class="badge bg-primary">Medium</span>',
                        3 => '<span class="badge bg-secondary">Low</span>',
                        default => '-',
                    };
                })

                ->editColumn('due_date', function ($row) {
                    return $row->due_date
                        ? Carbon::parse($row->due_date)->format('d M Y')
                        : '-';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at
                        ? Carbon::parse($row->created_at)->format('d M Y')
                        : '-';
                })

                ->addColumn('action', function ($row) {

                    $edit = route('admin.task.edit', $row->id);
                    $delete = route('admin.task.destroy', $row->id);

                    return '
                    <a href="' . $edit . '" class="btn btn-sm btn-primary me-1">
                        Edit
                    </a>

                    <button 
                        type="button"
                        data-url="' . $delete . '"
                        class="btn btn-sm btn-danger deleteBtn">
                        Delete
                    </button>
                ';
                })

                ->rawColumns(['status', 'priority', 'created_at', 'action'])

                ->make(true);
        }

        return view('backend.layouts.task.index');
    }

    public function create()
    {
        return view('backend.layouts.task.create');
    }
    public function store(StoreTaskRequest $request)
    {
        $this->taskService->store($request->validated());

        return redirect()
            ->route('admin.task.index')
            ->with('success', 'Task created successfully.');
    }

    public function edit($id)
    {
        $task = Task::find($id);
        return view('backend.layouts.task.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::find($id);

        $this->taskService->update($task, $request->validated());

        return redirect()
            ->route('admin.task.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        
        $task = Task::find($id);

        $this->taskService->delete($task);

        return response()->json([
            'status' => true,
            'message' => 'Task deleted successfully.'
        ]);
    }
}
