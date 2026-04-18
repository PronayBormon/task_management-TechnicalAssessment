@extends('backend.app')

@section('title', 'Add Task')

@section('content')

    <div class="card shadow-sm border-0 rounded-4">

        <div class="card-header">
            <div class=" d-flex justify-content-between align-items-center w-100">
                <h4 class="mb-0 fw-bold">Add New Task</h4>

                <a href="{{ route('admin.task.index') }}" class="btn btn-light border">
                    Back
                </a>
            </div>

        </div>

        <div class="card-body p-4">

            <form action="{{ route('admin.task.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="form-label fw-semibold">Task Title <span class="text-danger">*</span></label>

                    <input type="text" name="title" value="{{ old('title') }}"
                        class="form-control @error('title') is-invalid @enderror" placeholder="Enter task title">

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-4">
                    <label class="form-label fw-semibold">Description</label>

                    <textarea name="description" rows="4" class="form-control summernote @error('description') is-invalid @enderror"
                        placeholder="Write task details...">{{ old('description') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="row">

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">Status</label>

                        <select name="status" class="form-select @error('status') is-invalid @enderror">

                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>

                        </select>

                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">Priority</label>

                        <select name="priority" class="form-select @error('priority') is-invalid @enderror">

                            <option value="1">High</option>
                            <option value="2" selected>Medium</option>
                            <option value="3">Low</option>

                        </select>

                        @error('priority')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="mb-4">
                    <label class="form-label fw-semibold">Due Date</label>

                    <input type="date" name="due_date" value="{{ old('due_date') }}"
                        class="form-control @error('due_date') is-invalid @enderror">

                    @error('due_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>

                    <label class="form-check-label fw-semibold">
                        Active Task
                    </label>
                </div>


                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('admin.task.index') }}" class="btn btn-light border px-4">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-primary px-4">
                        Save Task
                    </button>

                </div>

            </form>

        </div>
    </div>

@endsection
