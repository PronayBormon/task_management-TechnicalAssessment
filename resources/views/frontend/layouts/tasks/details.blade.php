@extends('frontend.app')

@section('title', $task->title)

@push('style')
    <style>
        .task-card {
            border: 0;
            border-radius: 22px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, .06);
        }

        .info-box {
            background: #f8fafc;
            border-radius: 16px;
            padding: 18px;
        }

        .label-title {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .value-text {
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 0;
        }

        .task-title {
            font-size: 32px;
            font-weight: 700;
            color: #0f172a;
        }

        .description-box {
            line-height: 1.8;
            color: #334155;
        }

        .badge-status {
            font-size: 13px;
            padding: 8px 14px;
            border-radius: 30px;
        }

        .side-card {
            border: 0;
            border-radius: 22px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, .06);
        }
    </style>
@endpush


@section('content')

    <div class="container">

        <div class="row g-4">

            {{-- MAIN CONTENT --}}
            <div class="col-lg-8">

                <div class="card task-card p-4 p-lg-5">

                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">

                        <div>
                            <small class="text-muted">Task Details</small>
                            <h1 class="task-title mt-2">
                                {{ $task->title }}
                            </h1>
                        </div>

                        <div>
                            @if ($task->status == 'pending')
                                <span class="badge bg-warning badge-status">Pending</span>
                            @elseif($task->status == 'in_progress')
                                <span class="badge bg-info badge-status">In Progress</span>
                            @elseif($task->status == 'completed')
                                <span class="badge bg-success badge-status">Completed</span>
                            @else
                                <span class="badge bg-secondary badge-status">
                                    {{ ucfirst($task->status) }}
                                </span>
                            @endif
                        </div>

                    </div>


                    <div class="row g-3 mb-4">

                        <div class="col-md-4">
                            <div class="info-box">
                                <div class="label-title">Priority</div>
                                <p class="value-text">

                                    @if ($task->priority == 1)
                                        High
                                    @elseif($task->priority == 2)
                                        Medium
                                    @else
                                        Low
                                    @endif

                                </p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box">
                                <div class="label-title">Due Date</div>
                                <p class="value-text">
                                    {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : 'No Date' }}
                                </p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box">
                                <div class="label-title">Created</div>
                                <p class="value-text">
                                    {{ $task->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                    </div>


                    <hr class="my-4">


                    <h4 class="fw-bold mb-3">Description</h4>

                    <div class="description-box">
                        {!! $task->description ?: '<span class="text-muted">No description available.</span>' !!}
                    </div>


                    <div class="mt-5">
                        <a href="{{ route('home') }}" class="btn btn-primary px-4">
                            <i class="bi bi-arrow-left me-1"></i> Back to Tasks
                        </a>
                    </div>

                </div>

            </div>



            {{-- SIDEBAR --}}
            <div class="col-lg-4">

                <div class="card side-card p-4">

                    <h5 class="fw-bold mb-4">Quick Info</h5>

                    <div class="mb-3">
                        <div class="label-title">Task ID</div>
                        <p class="value-text">#{{ $task->id }}</p>
                    </div>

                    <div class="mb-3">
                        <div class="label-title">Status</div>
                        <p class="value-text">{{ ucwords(str_replace('_', ' ', $task->status)) }}</p>
                    </div>

                    <div class="mb-3">
                        <div class="label-title">Priority</div>
                        <p class="value-text">

                            @if ($task->priority == 1)
                                High
                            @elseif($task->priority == 2)
                                Medium
                            @else
                                Low
                            @endif

                        </p>
                    </div>

                    <div class="mb-0">
                        <div class="label-title">Last Updated</div>
                        <p class="value-text">
                            {{ $task->updated_at->format('d M Y h:i A') }}
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
