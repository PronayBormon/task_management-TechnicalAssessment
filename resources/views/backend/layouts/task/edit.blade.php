@extends('backend.app')

@section('title', 'Edit Task')

@section('content')

    <div class="card shadow-sm border-0 rounded-4">

        <div class="card-header bg-white border-0 py-3 px-4 ">
            <div class="d-flex justify-content-between align-items-center">

                <h4 class="mb-0 fw-bold">Edit Task</h4>

                <a href="{{ route('admin.task.index') }}" class="btn btn-light border">
                    Back
                </a>
            </div>
        </div>

        <div class="card-body p-4">

            <form action="{{ route('admin.task.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Task Title <span class="text-danger">*</span>
                    </label>

                    <input type="text" name="title" value="{{ old('title', $task->title) }}"
                        class="form-control @error('title') is-invalid @enderror" placeholder="Enter task title">

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Description</label>

                    <textarea name="description" rows="4" class="form-control summernote @error('description') is-invalid @enderror"
                        placeholder="Write task details...">{{ old('description', $task->description) }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">

                    <!-- Status -->
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">Status</label>

                        <select name="status" class="form-select @error('status') is-invalid @enderror">

                            <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="in_progress"
                                {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>
                                In Progress
                            </option>

                            <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>

                        </select>

                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Priority -->
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">Priority</label>

                        <select name="priority" class="form-select @error('priority') is-invalid @enderror">

                            <option value="1" {{ old('priority', $task->priority) == 1 ? 'selected' : '' }}>
                                High
                            </option>

                            <option value="2" {{ old('priority', $task->priority) == 2 ? 'selected' : '' }}>
                                Medium
                            </option>

                            <option value="3" {{ old('priority', $task->priority) == 3 ? 'selected' : '' }}>
                                Low
                            </option>

                        </select>

                        @error('priority')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Replace your current due date input with this -->

                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Due Date
                    </label>

                    <input type="date" name="due_date"
                        value="{{ old('due_date', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}"
                        class="form-control @error('due_date') is-invalid @enderror">

                    @error('due_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Active -->
                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                        {{ old('is_active', $task->is_active) ? 'checked' : '' }}>

                    <label class="form-check-label fw-semibold">
                        Active Task
                    </label>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('admin.task.index') }}" class="btn btn-light border px-4">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-primary px-4">
                        Update Task
                    </button>

                </div>

            </form>

        </div>
    </div>
@endsection
