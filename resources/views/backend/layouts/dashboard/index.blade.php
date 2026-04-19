@extends('backend.app')

@section('title', 'Dashboard')

@push('style')

<style>
    body{
        background:#f4f7fb;
    }

    .dashboard-card{
        border:none;
        border-radius:18px;
        box-shadow:0 8px 25px rgba(0,0,0,.04);
        transition:.3s;
        height:100%;
    }

    .dashboard-card:hover{
        transform:translateY(-3px);
    }

    .stat-icon{
        width:54px;
        height:54px;
        border-radius:16px;
        background:#eef4ff;
        color:#3b82f6;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:22px;
    }

    .metric-number{
        font-size:42px;
        font-weight:700;
        color:#0f172a;
        margin-bottom:0;
    }

    .metric-label{
        font-size:14px;
        color:#94a3b8;
    }

    .chart-card{
        border:none;
        border-radius:20px;
        box-shadow:0 8px 25px rgba(0,0,0,.04);
    }

    .status-row{
        background:#f8fafc;
        border-radius:14px;
        padding:16px;
        margin-bottom:14px;
    }

    .status-dot{
        width:14px;
        height:14px;
        border-radius:50%;
        display:inline-block;
        margin-right:8px;
    }

    .progress{
        height:8px;
        border-radius:30px;
        background:#e5e7eb;
    }

    .progress-bar{
        border-radius:30px;
    }

    .title-main{
        font-weight:700;
        color:#0f172a;
    }
</style>
@endpush

@section('content')

<div class="container-fluid">

    <div class="row g-4 mb-4">

        <div class="col-lg-3 col-md-6">
            <div class="card dashboard-card p-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="title-main">Team Members</h5>
                        <h2 class="metric-number">12</h2>
                        <div class="metric-label">2 joined this month</div>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card dashboard-card p-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="title-main">Active Tasks</h5>
                        <h2 class="metric-number">24</h2>
                        <div class="metric-label">8 due this week</div>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-check2-square"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card dashboard-card p-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="title-main">Team Activity</h5>
                        <h2 class="metric-number">87%</h2>
                        <div class="metric-label">+12% from last week</div>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-activity"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card dashboard-card p-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="title-main">Unread Messages</h5>
                        <h2 class="metric-number">9</h2>
                        <div class="metric-label">3 require attention</div>
                    </div>
                    <div class="stat-icon">
                        <i class="bi bi-chat-square"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="row g-4">

        <div class="col-lg-6">
            <div class="card chart-card p-4 h-100">
                <h3 class="title-main mb-4">Project Analytics</h3>

                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div id="donutChart"></div>
                    </div>

                    <div class="col-md-7">

                        <h4 class="fw-bold mb-4">Status Breakdown</h4>

                        <div class="status-row">
                            <div class="d-flex justify-content-between mb-2">
                                <span><span class="status-dot bg-success"></span>Completed</span>
                                <strong>8</strong>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-success" style="width:60%"></div>
                            </div>
                        </div>

                        <div class="status-row">
                            <div class="d-flex justify-content-between mb-2">
                                <span><span class="status-dot bg-primary"></span>In Progress</span>
                                <strong>12</strong>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-primary" style="width:78%"></div>
                            </div>
                        </div>

                        <div class="status-row">
                            <div class="d-flex justify-content-between mb-2">
                                <span><span class="status-dot bg-warning"></span>Planning</span>
                                <strong>5</strong>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" style="width:35%"></div>
                            </div>
                        </div>

                        <div class="status-row mb-0">
                            <div class="d-flex justify-content-between mb-2">
                                <span><span class="status-dot bg-danger"></span>On Hold</span>
                                <strong>3</strong>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-danger" style="width:20%"></div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>


        <div class="col-lg-6">
            <div class="card chart-card p-4 h-100">
                <h3 class="title-main mb-4">Trend Analysis</h3>
                <div id="trendChart"></div>
            </div>
        </div>

    </div>

</div>

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    if(document.querySelector("#donutChart")){

        let donutChart = new ApexCharts(document.querySelector("#donutChart"), {
            chart: {
                type: 'donut',
                height: 320
            },
            series: [12,8,5,3],
            labels: ['In Progress','Completed','Planning','On Hold'],
            colors: ['#4f8ef7','#2ecc71','#f39c12','#ef476f'],
            legend:{
                show:false
            },
            dataLabels:{
                enabled:false
            },
            plotOptions:{
                pie:{
                    donut:{
                        size:'70%',
                        labels:{
                            show:true,
                            total:{
                                show:true,
                                label:'Total Projects',
                                formatter:function(){
                                    return 28;
                                }
                            }
                        }
                    }
                }
            }
        });

        donutChart.render();
    }


    if(document.querySelector("#trendChart")){

        let trendChart = new ApexCharts(document.querySelector("#trendChart"), {
            chart:{
                type:'line',
                height:360,
                toolbar:{show:false}
            },
            stroke:{
                curve:'smooth',
                width:4
            },
            markers:{
                size:4
            },
            series:[
                {
                    name:'Tasks',
                    data:[45,50,47,58,55,63,69,74,80,87,94,101]
                },
                {
                    name:'Completed',
                    data:[38,42,40,43,44,46,49,52,54,57,60,63]
                },
                {
                    name:'Planning',
                    data:[12,15,13,22,18,24,28,31,36,40,44,48]
                }
            ],
            colors:['#7c6ee6','#5fb98c','#f0b03d'],
            xaxis:{
                categories:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
            },
            grid:{
                borderColor:'#edf2f7'
            },
            legend:{
                position:'top'
            }
        });

        trendChart.render();
    }

});
</script>
@endpush