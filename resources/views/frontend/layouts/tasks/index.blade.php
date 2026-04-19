@extends('frontend.app')

@section('title', 'Tasks')

@push('style')
    <style>
        /* wrapper */
        .custom-pagination nav {
            width: 100%;
        }

        /* mobile top row */
        .custom-pagination .sm\:hidden {
            display: flex !important;
            justify-content: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        /* desktop row */
        .custom-pagination .hidden.sm\:flex-1 {
            display: flex !important;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
        }

        /* result text */
        .custom-pagination p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
        }

        /* number wrapper */
        .custom-pagination .inline-flex {
            gap: 8px;
            flex-wrap: wrap;
        }

        /* all buttons */
        .custom-pagination a,
        .custom-pagination span[aria-current="page"] span {
            min-width: 44px;
            height: 44px;
            padding: 0 16px !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            border: none !important;
            border-radius: 14px !important;
            background: #ffffff !important;
            color: #0f172a !important;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .05);
            transition: all .25s ease;
        }

        /* hover */
        .custom-pagination a:hover {
            background: #0d6efd !important;
            color: #fff !important;
            transform: translateY(-2px);
        }

        /* active page */
        .custom-pagination span[aria-current="page"] span {
            background: #0d6efd !important;
            color: #fff !important;
            box-shadow: 0 10px 25px rgba(13, 110, 253, .25);
        }

        /* disabled */
        .custom-pagination span[aria-disabled="true"] span,
        .custom-pagination .cursor-default {
            background: #eef2f7 !important;
            color: #94a3b8 !important;
            box-shadow: none !important;
        }

        /* svg arrows */
        .custom-pagination svg {
            width: 18px;
            height: 18px;
        }

        /* mobile responsive */
        @media(max-width:767px) {

            .custom-pagination .hidden.sm\:flex-1 {
                flex-direction: column;
                align-items: center;
            }

            .custom-pagination p {
                text-align: center;
            }

        }
    </style>
@endpush
@section('content')

    <section class="py-5">
        <div class="container">

            {{-- Heading --}}
            <div class="text-center mb-5">
                <h1 class="fw-bold">Task List</h1>
                <p class="text-muted">Manage and track project tasks</p>
            </div>



            {{-- Filter + Search --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">

                    <form method="GET" action="{{ route('home') }}">

                        <div class="row g-3">

                            {{-- Search --}}
                            <div class="col-lg-5">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                    placeholder="Search task title...">
                            </div>


                            {{-- Status --}}
                            <div class="col-lg-3">
                                <select name="status" class="form-select">

                                    <option value="">All Status</option>

                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>
                                        In Progress
                                    </option>

                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                        Completed
                                    </option>

                                </select>
                            </div>


                            {{-- Priority --}}
                            <div class="col-lg-2">
                                <select name="priority" class="form-select">

                                    <option value="">Priority</option>

                                    <option value="1" {{ request('priority') == 1 ? 'selected' : '' }}>
                                        High
                                    </option>

                                    <option value="2" {{ request('priority') == 2 ? 'selected' : '' }}>
                                        Medium
                                    </option>

                                    <option value="3" {{ request('priority') == 3 ? 'selected' : '' }}>
                                        Low
                                    </option>

                                </select>
                            </div>


                            {{-- Button --}}
                            <div class="col-lg-2 d-grid">
                                <button class="btn btn-primary">
                                    <i class="bi bi-search me-1"></i> Filter
                                </button>
                            </div>

                        </div>

                    </form>

                </div>
            </div>



            {{-- Task List --}}
            <div class="row g-4">

                @forelse($tasks as $task)
                    <div class="col-lg-4 col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 h-100">

                            <div class="card-body p-4">

                                <h4 class="fw-bold mb-3">
                                    {{ $task->title }}
                                </h4>

                                <p class="text-muted mb-3">
                                    {{ Str::limit(strip_tags($task->description), 70) }}
                                </p>

                                <div class="mb-3">

                                    @if ($task->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($task->status == 'in_progress')
                                        <span class="badge bg-info">In Progress</span>
                                    @elseif($task->status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @endif

                                </div>

                                <small class="text-muted d-block mb-3">
                                    Due:
                                    {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : 'No Date' }}
                                </small>

                                <a href="{{ route('frontend.task.show', $task->id) }}" class="btn btn-primary btn-sm">
                                    Read More
                                </a>

                            </div>

                        </div>
                    </div>

                @empty

                    <div class="col-12 text-center py-5">
                        <h5>No Tasks Found</h5>
                    </div>
                @endforelse

            </div>



            {{-- Pagination --}}
            {{-- Put this where pagination shows --}}
            <div class="mt-5 custom-pagination">
                {{ $tasks->withQueryString()->links() }}
            </div>

        </div>
    </section>

@endsection
