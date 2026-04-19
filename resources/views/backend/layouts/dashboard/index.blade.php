@extends('backend.app')

@section('title', 'Dashboard')

@push('style')
    <style>
        body {
            background: #f4f6f9;
        }

        .dashboard-card,
        .table-card {
            border: 0;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
        }

        .small-box {
            border-radius: 18px !important;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .04);
        }

        .small-box .inner {
            padding: 20px;
        }

        .small-box h3 {
            font-size: 34px;
            font-weight: 700;
        }

        .small-box p {
            margin-bottom: 0;
            font-size: 15px;
        }

        .small-box-icon {
            font-size: 60px !important;
            top: 15px !important;
            right: 15px !important;
            opacity: .18;
        }

        .recent-badge {
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 30px;
        }

        .card-title-main {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0;
        }

        .table> :not(caption)>*>* {
            padding: 14px;
        }

        .empty-chart {
            min-height: 350px;
        }
    </style>
@endpush


@section('content')


    {{-- TOP CARDS --}}
    <div class="row g-4 mb-4">

        <div class="col-lg-3 col-md-6">
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>{{ $totalTasks }}</h3>
                    <p>Total Tasks</p>
                </div>
                <i class="bi bi-list-check small-box-icon"></i>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>{{ $pendingTasks }}</h3>
                    <p>Pending Tasks</p>
                </div>
                <i class="bi bi-clock-history small-box-icon"></i>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="small-box text-bg-info">
                <div class="inner">
                    <h3>{{ $progressTasks }}</h3>
                    <p>In Progress</p>
                </div>
                <i class="bi bi-arrow-repeat small-box-icon"></i>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>{{ $completedTasks }}</h3>
                    <p>Completed Tasks</p>
                </div>
                <i class="bi bi-check-circle small-box-icon"></i>
            </div>
        </div>

    </div>



    {{-- CHARTS --}}
    <div class="row g-4 mb-4">

        <div class="col-lg-7">
            <div class="card dashboard-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title-main">Monthly Task Analytics</h5>
                </div>

                <div id="trendChart" class="empty-chart"></div>
            </div>
        </div>


        <div class="col-lg-5">
            <div class="card dashboard-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title-main">Task Status Overview</h5>
                </div>

                <div id="taskStatusChart" class="empty-chart"></div>
            </div>
        </div>

    </div>



    {{-- RECENT TASKS --}}
    <div class="row">
        <div class="col-12">

            <div class="card table-card p-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title-main">Recent Tasks</h5>

                    <a href="{{ route('admin.task.index') }}" class="btn btn-primary btn-sm px-3">
                        View All
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th width="60">#</th>
                                <th>Task Name</th>
                                <th width="180">Status</th>
                                <th width="180">Created</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($recentTasks as $key => $task)
                                <tr>
                                    <td>{{ $key + 1 }}</td>

                                    <td>
                                        {{ $task->title ?? $task->name }}
                                    </td>

                                    <td>

                                        @if ($task->status == 'pending')
                                            <span class="badge bg-warning recent-badge">Pending</span>
                                        @elseif($task->status == 'in_progress')
                                            <span class="badge bg-info recent-badge">In Progress</span>
                                        @elseif($task->status == 'completed')
                                            <span class="badge bg-success recent-badge">Completed</span>
                                        @else
                                            <span class="badge bg-secondary recent-badge">
                                                {{ ucfirst($task->status) }}
                                            </span>
                                        @endif

                                    </td>

                                    <td>
                                        {{ $task->created_at->format('d M Y') }}
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        No Tasks Found
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>


@endsection



@push('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        window.addEventListener('load', function() {

            // Prevent duplicate charts
            if (window.taskStatusChartObj) {
                window.taskStatusChartObj.destroy();
            }

            if (window.trendChartObj) {
                window.trendChartObj.destroy();
            }


            // DONUT CHART
            const taskStatusElement = document.querySelector("#taskStatusChart");

            if (taskStatusElement) {

                window.taskStatusChartObj = new ApexCharts(taskStatusElement, {

                    chart: {
                        type: 'donut',
                        height: 350
                    },

                    series: @json($chartStatus),

                    labels: ['Pending', 'In Progress', 'Completed'],

                    colors: ['#f59e0b', '#0dcaf0', '#198754'],

                    legend: {
                        position: 'bottom'
                    },

                    dataLabels: {
                        enabled: true
                    },

                    plotOptions: {
                        pie: {
                            donut: {
                                size: '68%'
                            }
                        }
                    }

                });

                window.taskStatusChartObj.render();
            }



            // LINE CHART
            const trendElement = document.querySelector("#trendChart");

            if (trendElement) {

                window.trendChartObj = new ApexCharts(trendElement, {

                    chart: {
                        type: 'line',
                        height: 350,
                        toolbar: {
                            show: false
                        }
                    },

                    series: [{
                            name: 'Tasks',
                            data: @json($monthlyTasks)
                        },
                        {
                            name: 'Completed',
                            data: @json($monthlyCompleted)
                        }
                    ],

                    xaxis: {
                        categories: @json($months)
                    },

                    stroke: {
                        curve: 'smooth',
                        width: 4
                    },

                    colors: ['#0d6efd', '#198754'],

                    markers: {
                        size: 5
                    },

                    legend: {
                        position: 'top'
                    },

                    grid: {
                        borderColor: '#eef2f7'
                    }

                });

                window.trendChartObj.render();
            }

        });
    </script>
@endpush
