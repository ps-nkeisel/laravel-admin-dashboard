@extends('layouts.backend')

@section('css_before')
    <link rel="stylesheet" href="/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="/js/plugins/select2/css/select2.min.css">
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">Dashboard</h1>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">

        <div class="row">
            <div class="col-xl-12">
                <!-- Bars Chart -->
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Requests</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center" style="height: 400px">
                        <div class="py-3"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <!-- Bars Chart Container -->
                            <canvas id="last_31_days_requests" class="js-chartjs-bars chartjs-render-monitor" height=350></canvas>
                        </div>
                    </div>
                </div>
                <!-- END Bars Chart -->
            </div>
            <div class="col-xl-12">
                <!-- Bars Chart -->
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Content activities</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center" style="height: 400px">
                        <div class="py-3"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <!-- Bars Chart Container -->
                            <canvas id="last_31_days_entry_activities" class="js-chartjs-bars chartjs-render-monitor" height=350></canvas>
                        </div>
                    </div>
                </div>
                <!-- END Bars Chart -->
            </div>
            <div class="col-xl-12">
                <!-- Bars Chart -->
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Client activities</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center" style="height: 400px">
                        <div class="py-3"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <!-- Bars Chart Container -->
                            <canvas id="last_31_days_client_activities" class="js-chartjs-bars chartjs-render-monitor" height=350></canvas>
                        </div>
                    </div>
                </div>
                <!-- END Bars Chart -->
            </div>
            <div class="col-xl-6">
                <!-- Donut Chart -->
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">User activities this week (max 5)</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        <div class="py-3"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <!-- Donut Chart Container -->
                            <canvas id="this_week_five_users_actions" class="js-chartjs-donut chartjs-render-monitor" width="1194" height="596" style="display: block; height: 298px; width: 597px;"></canvas>
                        </div>
                    </div>
                </div>
                <!-- END Donut Chart -->
            </div>
            <div class="col-xl-6">
                <!-- Pie Chart -->
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">User activities last week (max 5)</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center">
                        <div class="py-3"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <!-- Pie Chart Container -->
                            <canvas id="last_week_five_users_actions" class="js-chartjs-pie chartjs-render-monitor" width="1194" height="596" style="display: block; height: 298px; width: 597px;"></canvas>
                        </div>
                    </div>
                </div>
                <!-- END Pie Chart -->
            </div>
            <div class="col-xl-6">
                <!-- Lines Chart -->
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Test 1</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-center" style="height: 400px">
                        <div class="py-3"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <!-- Lines Chart Container -->
                            <canvas id="this_last_week_action_counts" class="js-chartjs-lines chartjs-render-monitor" height=350></canvas>
                        </div>
                    </div>
                </div>
                <!-- END Lines Chart -->
            </div>
            <div class="col-xl-6">
                <!-- Bars Chart -->
                <div class="block block-rounded block-bordered">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Test 2</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>

                    <div class="block-content block-content-full text-center" style="height: 400px">
                        <div class="py-3"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <!-- Bars Chart Container -->
                            <canvas id="this_last_week_request_counts" class="js-chartjs-bars chartjs-render-monitor" height=350></canvas>
                        </div>
                    </div>
                </div>
                <!-- END Bars Chart -->
            </div>
        </div>

    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/js/plugins/select2/js/select2.full.min.js"></script>

    <!-- Page JS Plugins -->
    <script src="/js/plugins/easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="/js/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="/js/plugins/chart.js/Chart.bundle.min.js"></script>
    <script src="/js/plugins/moment/moment.min.js"></script>

    <!-- Page JS Code -->
    <!-- <script src="/js/pages/be_comp_charts.min.js"></script> -->

    <!-- Page JS Helpers (BS Datepicker + Select2) -->
    <script>
        jQuery(function () {
            // last 31 days
            var last31Days = [];
            @foreach ($last31Days as $day)
                last31Days.push( moment('{{ $day }}').format('MM-DD') );
            @endforeach
            //requests
            var requestsLast31Days = [];
            @foreach ($requestsLast31Days as $request)
                requestsLast31Days.push("{{ $request }}");
            @endforeach

            new Chart('last_31_days_requests', {
                type: 'line',
                data: {
                    labels: last31Days,
                    datasets: [{
                        label: 'Last 31 days',
                        fill: true,
                        backgroundColor: 'rgba(0,0,0,0)',
                        borderColor: 'rgb(54, 162, 235)',
                        data: requestsLast31Days,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0, // it is for ignoring negative step.
                                beginAtZero: true,
                                callback: function(value, index, values) {
                                    if (Math.floor(value) === value) {
                                        return value;
                                    }
                                }
                            },
                        }]
                    },
                    title: {
                        display: false,
                    },
                }
            });
            //entry
            var requestsLast31DaysEntryActions = [];
            @foreach ($actionsEntryLast31Days as $request)
                requestsLast31DaysEntryActions.push("{{ $request }}");
            @endforeach
            //visa
            var actionsVisaLast31Days = [];
            @foreach ($actionsVisaLast31Days as $request)
                actionsVisaLast31Days.push("{{ $request }}");
            @endforeach
            // health
            var actionsHealthLast31Days = [];
            @foreach ($actionsHealthLast31Days as $request)
                actionsHealthLast31Days.push("{{ $request }}");
            @endforeach
            //transitvisa
            var actionsTransitvisaLast31Days = [];
            @foreach ($actionsTransitvisaLast31Days as $request)
                actionsTransitvisaLast31Days.push("{{ $request }}");
            @endforeach
            //cruise
            var actionsCruiseLast31Days = [];
            @foreach ($actionsCruiseLast31Days as $request)
                actionsCruiseLast31Days.push("{{ $request }}");
            @endforeach
            //corona
            var actionsCoronaLast31Days = [];
            @foreach ($actionsCoronaLast31Days as $request)
                actionsCoronaLast31Days.push("{{ $request }}");
            @endforeach
            //info2
            var actionsInfo2Last31Days = [];
            @foreach ($actionsInfosystem2Last31Days as $request)
            actionsInfo2Last31Days.push("{{ $request }}");
            @endforeach
            //info
            var actionsInfoLast31Days = [];
            @foreach ($actionsInfosystemLast31Days as $request)
            actionsInfoLast31Days.push("{{ $request }}");
            @endforeach

            new Chart('last_31_days_entry_activities', {
                type: 'line',
                data: {
                    labels: last31Days,
                    datasets: [
                        {
                            label: 'Entry',
                            fill: true,
                            backgroundColor: 'rgba(0,0,0,0)',
                            borderColor: 'rgb(54, 162, 235)',
                            data: requestsLast31DaysEntryActions,
                        },
                        {
                            label: 'Visa',
                            fill: true,
                            backgroundColor: 'rgba(0,0,0,0)',
                            borderColor: 'rgba(126,127,129,0.72)',
                            data: actionsVisaLast31Days,
                        },
                        {
                            label: 'Health',
                            fill: true,
                            backgroundColor: 'rgba(0,0,0,0)',
                            borderColor: 'rgba(255,117,96,0.72)',
                            data: actionsHealthLast31Days,
                        },
                        {
                            label: 'Transitvisa',
                            fill: true,
                            backgroundColor: 'rgba(0,0,0,0)',
                            borderColor: 'rgba(38,191,71,0.72)',
                            data: actionsTransitvisaLast31Days,
                        },
                        {
                            label: 'Cruise',
                            fill: true,
                            backgroundColor: 'rgba(0,0,0,0)',
                            borderColor: 'rgba(157,51,214,0.72)',
                            data: actionsCruiseLast31Days,
                        },
                        {
                            label: 'Corona',
                            fill: true,
                            backgroundColor: 'rgba(0,0,0,0)',
                            borderColor: 'rgba(83,47,214,0.72)',
                            data: actionsCoronaLast31Days,
                        },
                        {
                            label: 'Infosystem 2 (Corona)',
                            fill: true,
                            backgroundColor: 'rgba(0,0,0,0)',
                            borderColor: 'rgba(40,214,211,0.72)',
                            data: actionsInfo2Last31Days,
                        },
                        {
                            label: 'Infosystem',
                            fill: true,
                            backgroundColor: 'rgba(0,0,0,0)',
                            borderColor: 'rgba(214,35,91,0.72)',
                            data: actionsInfoLast31Days,
                        }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0, // it is for ignoring negative step.
                                beginAtZero: true,
                                callback: function(value, index, values) {
                                    if (Math.floor(value) === value) {
                                        return value;
                                    }
                                }
                            },
                        }]
                    },
                    title: {
                        display: false,
                    },
                }
            });

            var actionsClientLast31Days = [];
            @foreach ($actionsClientLast31Days as $request)
                actionsClientLast31Days.push("{{ $request }}");
            @endforeach

            new Chart('last_31_days_client_activities', {
                type: 'line',
                data: {
                    labels: last31Days,
                    datasets: [{
                        label: 'Client activities (add/edit)',
                        fill: true,
                        backgroundColor: 'rgba(0,0,0,0)',
                        borderColor: 'rgb(54, 162, 235)',
                        data: actionsClientLast31Days,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0, // it is for ignoring negative step.
                                beginAtZero: true,
                                callback: function(value, index, values) {
                                    if (Math.floor(value) === value) {
                                        return value;
                                    }
                                }
                            },
                        }]
                    },
                    title: {
                        display: false,
                    },
                }
            });

            // Dashmix.helpers(['datepicker', 'select2', 'easy-pie-chart', 'sparkline']);

            // This/Last week user action counts

            var thisWeekActionCounts = Array(7).fill(0);
            @foreach ($thisWeekActionCounts as $index => $actionCount)
                thisWeekActionCounts[{{ $index }}] = {{ $actionCount }};
            @endforeach
            var lastWeekActionCounts = Array(7).fill(0);
            @foreach ($lastWeekActionCounts as $index => $actionCount)
                lastWeekActionCounts[{{ $index }}] = {{ $actionCount }};
            @endforeach

            new Chart('this_last_week_action_counts', {
                type: 'line',
                data: {
                    labels: ["MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"],
                    datasets: [{
                        label: 'This Week',
                        fill: true,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgb(54, 162, 235)',
                        data: thisWeekActionCounts,
                    },{
                        label: 'Last Week',
                        fill: true,
                        backgroundColor: 'rgba(146,147,149,0.37)',
                        borderColor: 'rgba(126,127,129,0.72)',
                        data: lastWeekActionCounts,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0, // it is for ignoring negative step.
                                beginAtZero: true,
                                callback: function(value, index, values) {
                                    if (Math.floor(value) === value) {
                                        return value;
                                    }
                                }
                            },
                        }]
                    },
                    title: {
                        display: false,
                    },
                }
            });


            // This/Last week request counts

            var thisWeekRequestCounts = Array(7).fill(0);
            @foreach ($thisWeekRequestCounts as $index => $requestCount)
                thisWeekRequestCounts[{{ $index }}] = {{ $requestCount }};
            @endforeach
            var lastWeekRequestCounts = Array(7).fill(0);
            @foreach ($lastWeekRequestCounts as $index => $requestCount)
                lastWeekRequestCounts[{{ $index }}] = {{ $requestCount }};
            @endforeach

            let last7Days = [];
            for (let i = 6; i >= 0; i --) {
                last7Days.push(moment().subtract(i, 'days').format('MM-DD'));
            }

            new Chart('this_last_week_request_counts', {
                type: 'line',
                data: {
                    labels: last7Days,
                    datasets: [{
                        label: 'This Week',
                        fill: true,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgb(54, 162, 235)',
                        data: thisWeekRequestCounts,
                    },
                    {
                        label: 'Last Week',
                        fill: true,
                        backgroundColor: 'rgba(146,147,149,0.37)',
                        borderColor: 'rgba(126,127,129,0.72)',
                        data: lastWeekRequestCounts,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0, // it is for ignoring negative step.
                                beginAtZero: true,
                                callback: function(value, index, values) {
                                    if (Math.floor(value) === value) {
                                        return value;
                                    }
                                }
                            },
                        }]
                    },
                    title: {
                        display: false,
                    },
                }
            });


            // Last 31 days corona activities
            var last31DaysCoronaActionCounts = Array(31).fill(0);
            @foreach ($last31DaysCoronaActionCounts as $index => $actioncount)
                last31DaysCoronaActionCounts[{{ $index }}] = {{ $actioncount }};
            @endforeach

            new Chart('last_31_days_corona_activities', {
                type: 'line',
                data: {
                    labels: last31Days,
                    datasets: [{
                        label: 'Last 31 days',
                        fill: true,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgb(54, 162, 235)',
                        data: last31DaysCoronaActionCounts,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0, // it is for ignoring negative step.
                                beginAtZero: true,
                                callback: function(value, index, values) {
                                    if (Math.floor(value) === value) {
                                        return value;
                                    }
                                }
                            },
                        }]
                    },
                    title: {
                        display: false,
                    },
                }
            });


            // Last 31 days visa activities

            var last31DaysVisaActionCounts = Array(31).fill(0);
            @foreach ($last31DaysVisaActionCounts as $index => $actioncount)
                last31DaysVisaActionCounts[{{ $index }}] = {{ $actioncount }};
            @endforeach

            new Chart('last_31_days_visa_activities', {
                type: 'line',
                data: {
                    labels: last31Days,
                    datasets: [{
                        label: 'Last 31 days',
                        fill: true,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgb(54, 162, 235)',
                        data: last31DaysVisaActionCounts,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0, // it is for ignoring negative step.
                                beginAtZero: true,
                                callback: function(value, index, values) {
                                    if (Math.floor(value) === value) {
                                        return value;
                                    }
                                }
                            },
                        }]
                    },
                    title: {
                        display: false,
                    },
                }
            });


            // This week five users actions
            var thisWeekTopFiveUsersByActionCount = {
                'usernames': [],
                'actioncounts': [],
            };
            @foreach ($thisWeekTopFiveUsersByActionCount as $index => $useraction)
                thisWeekTopFiveUsersByActionCount['usernames'].push("{{ $useraction->created_username }}");
                thisWeekTopFiveUsersByActionCount['actioncounts'].push({{ $useraction->actionCount }});
            @endforeach

            new Chart('this_week_five_users_actions', {
                type: 'pie',
                data: {
                    datasets: [{
                        data: thisWeekTopFiveUsersByActionCount['actioncounts'],
                        backgroundColor: [
                            "rgb(140, 192, 91)",
                            "rgb(254, 173, 56)",
                            "rgb(221, 78, 40)",
                            "rgb(48, 205, 204)",
                            "rgb(18, 157, 251",
                        ],
                        label: 'This Week'
                    }],
                    labels: thisWeekTopFiveUsersByActionCount['usernames'],
                },
                options: {
                    responsive: true
                }
            });


            // Last week five users actions
            var lastWeekTopFiveUsersByActionCount = {
                'usernames': [],
                'actioncounts': [],
            };
            @foreach ($lastWeekTopFiveUsersByActionCount as $index => $useraction)
                lastWeekTopFiveUsersByActionCount['usernames'].push("{{ $useraction->created_username }}");
                lastWeekTopFiveUsersByActionCount['actioncounts'].push({{ $useraction->actionCount }});
            @endforeach

            new Chart('last_week_five_users_actions', {
                type: 'pie',
                data: {
                    datasets: [{
                        data: lastWeekTopFiveUsersByActionCount['actioncounts'],
                        backgroundColor: [
                            "rgb(140, 192, 91)",
                            "rgb(254, 173, 56)",
                            "rgb(221, 78, 40)",
                            "rgb(48, 205, 204)",
                            "rgb(18, 157, 251",
                        ],
                        label: 'Last Week'
                    }],
                    labels: lastWeekTopFiveUsersByActionCount['usernames'],
                },
                options: {
                    responsive: true
                }
            });
        });
    </script>
@endsection
