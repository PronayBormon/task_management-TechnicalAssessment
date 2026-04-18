<?php

namespace App\DataTables;

// use App\Models\Task;
use App\Models\Task;
use Yajra\DataTables\Contracts\DataTable;
// use Yajra\DataTables\Services\DataTable;

class TasksDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()

            ->editColumn('status', function ($row) {
                return match ($row->status) {
                    'pending' => '<span class="badge bg-warning">Pending</span>',
                    'in_progress' => '<span class="badge bg-info">In Progress</span>',
                    'completed' => '<span class="badge bg-success">Completed</span>',
                };
            })

            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('admin.tasks.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>

                    <button data-id="' . $row->id . '" class="btn btn-sm btn-danger deleteBtn">
                        Delete
                    </button>
                ';
            })

            ->rawColumns(['status', 'action']);
    }

    public function query(Task $model)
    {
        return $model->newQuery()->latest();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('tasks-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(['excel', 'csv', 'print']);
    }

    protected function getColumns()
    {
        return [
            'DT_RowIndex',
            'title',
            'status',
            'created_at',
            'action',
        ];
    }
}
