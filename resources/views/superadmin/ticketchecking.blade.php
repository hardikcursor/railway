@extends('layouts.backend') @section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            <div class="ibox">
                <div class="header1">TICKET CHECKING DASHBOARD (2024-25)</div>
                <div class="filters">
                    <div class="filter-group floating-label">
                        <label>Cadre / Type</label>
                        <select class="form-select" name="cadre">
                            <option value="">All Cadre / Type</option>

                            @foreach ($cadres as $cadre)
                                <option value="{{ $cadre }}">
                                    {{ $cadre }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="filter-group floating-label">
                        <label>Location</label>
                        <select class="form-select">
                            <option value="">Select Location</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location }}">
                                    {{ $location }}
                                </option>
                            @endforeach
                        </select>
                    </div>



                    <div class="filter-group ml-auto">
                        <select>
                            <option>Apr 1, 2024 - Mar 31, 2025</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end m-3">
                    <a href="{{ route('superadmin.ticketcheckingmaster') }}" class="btn btn-success">
                        <i class="ti-plus"></i> Create Ticket Checking Master
                    </a>
                </div>
                <div class="row mt-3">

                    <!-- CARD 1 -->
                    <div class="col-md-6 mb-3">
                        <div class="metric-card unreserved">
                            <div class="metric-title">Cases (In Lakh)</div>

                            <div class="metric-columns">
                                <div class="metric-column">
                                    <!-- Lakh value -->
                                    <div class="metric-value">
                                        {{ number_format($casesInLakh, 3) }}
                                    </div>

                                    <!-- Percentage -->
                                    <div class="metric-change positive">
                                        <span class="arrow-up"></span>
                                        {{ number_format($percentage, 2) }} %
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="metric-card unreserved">
                            <div class="metric-title">Revenue ( In Cr)</div>

                            <div class="metric-columns">
                                <div class="metric-column">
                                    <div class="metric-value">
                                        {{ number_format((float) $revenueInCr, 3) }} 
                                    </div>
                                    <div class="metric-change positive"><span class="arrow-up"></span>
                                        {{ number_format((float) $revenuePercentage, 2) }} % </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="chart-container">
                    <div class="chart-title">MONTH WISE TOTAL REVENUE (In Cr.)</div>
                    <canvas id="revenueChart"></canvas>

                </div>



                <div class="chart-container">
                    <div class="chart-title">MONTH WISE WT/HT REVENUE (In Lakh)</div>
                    <canvas id="wtChart"></canvas>
                </div>
            </div>


            <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1"></script>
            <script>
                (function() {

                    const months = ["APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC", "JAN", "FEB", "MAR"];

                    const revenueCtx = document.getElementById('revenueChart');

                    if (!revenueCtx) return;

                    new Chart(revenueCtx, {
                        type: 'line',
                        data: {
                            labels: months,
                            datasets: [{
                                    label: '2024-2025',
                                    data: [3.53, 2.68, 2.10, 0.50, 0.42, 0.46, 1.58, 1.70, 1.60, 2.00, 2.30, 2.60],
                                    borderColor: '#2e7d32',
                                    tension: 0.4,
                                    pointRadius: 4
                                },
                                {
                                    label: '2023-2024',
                                    data: [2.80, 3.00, 2.40, 1.50, 1.70, 1.60, 2.30, 3.40, 1.90, 2.00, 2.50, 2.80],
                                    borderColor: '#c62828',
                                    tension: 0.4,
                                    pointRadius: 4
                                },
                                {
                                    label: '2022-2023',
                                    data: [3.70, 3.90, 3.10, 1.80, 1.70, 1.60, 2.60, 1.70, 1.50, 1.70, 2.20, 2.50],
                                    borderColor: '#f57c00',
                                    tension: 0.4,
                                    pointRadius: 4
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                })();
            </script>

            <script>
                (function() {

                    const months = ["APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC", "JAN", "FEB", "MAR"];

                    const wtCtx = document.getElementById('wtChart');

                    if (!wtCtx) return;

                    new Chart(wtCtx, {
                        type: 'line',
                        data: {
                            labels: months,
                            datasets: [{
                                    label: '2024-2025',
                                    data: [62.34, 56.07, 45.76, 17.87, 16.65, 18.88, 31.87, 55, 40, 42, 46, 49],
                                    borderColor: '#2e7d32',
                                    tension: 0.4,
                                    pointRadius: 4
                                },
                                {
                                    label: '2023-2024',
                                    data: [55, 60, 50, 30, 25, 28, 45, 70, 38, 41, 44, 48],
                                    borderColor: '#c62828',
                                    tension: 0.4,
                                    pointRadius: 4
                                },
                                {
                                    label: '2022-2023',
                                    data: [145, 140, 120, 60, 55, 45, 68, 50, 35, 42, 46, 50],
                                    borderColor: '#f57c00',
                                    tension: 0.4,
                                    pointRadius: 4
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                })();
            </script>


            <div class="row">
                <div class="col-6">
                    <div class="ticket-box"
                        style="border: 1px solid #eee; padding: 15px; border-radius: 8px; overflow: visible;">
                        <h4 class="chart-title">STATION WISE REVENUE</h4>
                        <canvas id="stationChart"></canvas>

                    </div>
                </div>

                <div class="col-6">
                    <div class="ticket-box"
                        style="border: 1px solid #eee; padding: 15px; border-radius: 8px; overflow: visible;">
                        <h4 class="chart-title">UNIT WISE REVENUE</h4>
                        <canvas id="unitChart"></canvas>
                    </div>
                </div>
            </div>

            <script>
                (function() {

                    const ctx = document.getElementById('stationChart');
                    if (!ctx) return;

                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: [
                                'ADI', 'CTI-SBIB', 'DRM', 'Sr DCM', 'MAN',
                                'CTI-MS-ADI', 'GIM', 'MSH', 'PNU', 'Others'
                            ],
                            datasets: [{
                                data: [43.1, 17.1, 8.8, 7.8, 6.9, 6.2, 5.1, 3.4, 1.5, 0.1],
                                backgroundColor: [
                                    '#0d6efd', '#ffb366', '#9b59b6', '#ff7f0e', '#ff6b6b',
                                    '#e67ab1', '#87cefa', '#5dade2', '#f1c40f', '#95a5a6'
                                ],
                                borderWidth: 0
                            }]
                        },
                        options: {
                            cutout: '60%',
                            plugins: {
                                legend: {
                                    position: 'right',
                                    labels: {
                                        boxWidth: 12,
                                        font: {
                                            size: 12
                                        }
                                    }
                                }
                            }
                        }
                    });

                })();
            </script>

            <script>
                (function() {

                    const ctx = document.getElementById('unitChart');
                    if (!ctx) return;

                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: [
                                'Sleeper',
                                'Squad',
                                'Squad / SL',
                                'Squad',
                                'Stationary'
                            ],
                            datasets: [{
                                data: [45.7, 22.4, 17.1, 7.8, 7.1],
                                backgroundColor: [
                                    '#00bcd4',
                                    '#0d6efd',
                                    '#ff7f0e',
                                    '#f39c12',
                                    '#ff1493'
                                ],
                                borderWidth: 0
                            }]
                        },
                        options: {
                            cutout: '60%',
                            plugins: {
                                legend: {
                                    position: 'right',
                                    labels: {
                                        boxWidth: 12,
                                        font: {
                                            size: 12
                                        }
                                    }
                                }
                            }
                        }
                    });

                })();
            </script>


        </div>
        <div class="row">
            <div class="col-12">
                <div class="chart-box">
                    <h3 class="text-center">
                        Revenue (in Cr.) and Cases (in Lakh) - YOY
                    </h3>
                    <canvas id="yoyChart"></canvas>
                </div>
            </div>
        </div>



        <script>
            const ctx = document.getElementById('yoyChart').getContext('2d');

            const yoyChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['2023-2024', '2022-2023', '2021-2022', '2024-2025'],
                    datasets: [{
                            label: 'Revenue (In Cr.)',
                            data: [28.31, 27.9, 19.96, 11.27], // ફોટા મુજબના ડેટા
                            backgroundColor: '#388E3C', // લીલો રંગ
                            yAxisID: 'yRevenue',
                            barPercentage: 0.8,
                            categoryPercentage: 0.5
                        },
                        {
                            label: 'Total Case (In Lakh)',
                            data: [3.99, 4.04, 3.17, 1.51], // ફોટા મુજબના ડેટા
                            backgroundColor: '#FF9800', // નારંગી રંગ
                            yAxisID: 'yCases',
                            barPercentage: 0.8,
                            categoryPercentage: 0.5
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        yRevenue: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Revenue (In Cr.)'
                            },
                            min: 0,
                            max: 30
                        },
                        yCases: {
                            type: 'linear',
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Total Case (In Lakh)'
                            },
                            min: 0,
                            max: 5,
                            grid: {
                                drawOnChartArea: false
                            } // ગ્રીડ લાઈન ઓવરલેપ ન થાય તે માટે
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
            });
        </script>

        <canvas id="dualBarChart"></canvas>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('dualBarChart').getContext('2d');

            const data = {
                labels: ['2023-2024', '2022-2023', '2021-2022', '2024-2025'],
                datasets: [{
                        label: 'Revenue (In Cr.)',
                        data: [28.31, 27.9, 19.96, 11.27],
                        backgroundColor: 'green',
                        yAxisID: 'y1',
                        borderRadius: 4,
                        barPercentage: 0.4,
                    },
                    {
                        label: 'Total Case (In Lakh)',
                        data: [3.99, 4.04, 3.17, 1.51],
                        backgroundColor: 'orange',
                        yAxisID: 'y2',
                        borderRadius: 4,
                        barPercentage: 0.4,
                    },
                ],
            };

            const options = {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Revenue (in Cr.) and Cases (in Lakh) - YOY',
                        font: {
                            size: 16,
                            weight: 'bold',
                        },
                        padding: {
                            top: 10,
                            bottom: 20,
                        },
                    },
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            boxWidth: 20,
                            padding: 15,
                        },
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                },
                scales: {
                    y1: {
                        type: 'linear',
                        position: 'left',
                        beginAtZero: true,
                        max: 30,
                        title: {
                            display: true,
                            text: 'Revenue (In Cr.)',
                        },
                        ticks: {
                            stepSize: 5,
                        },
                    },
                    y2: {
                        type: 'linear',
                        position: 'right',
                        beginAtZero: true,
                        max: 5,
                        grid: {
                            drawOnChartArea: false,
                        },
                        title: {
                            display: true,
                            text: 'Total Case (In Lakh)',
                        },
                        ticks: {
                            stepSize: 1,
                        },
                    },
                },
            };

            new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options,
            });
        </script>
    </div>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .ibox {
            background: #f0f2f5;
            padding: 20px;
            border-radius: 8px;
        }

        .header1 {
            background: linear-gradient(to right, #4caf50, #8bc34a);
            padding: 15px;
            font-size: 24px;
            text-align: center;
            font-weight: bold;
            border-radius: 5px;
            color: #000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

        /* FILTERS */
        .filters {
            display: flex;
            gap: 10px;
            background: #fff;
            padding: 12px;
            border-radius: 5px;
            border-top: 5px solid #6c9c6f;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
            flex-wrap: wrap;
        }

        .filter-group {
            flex: 1;
            min-width: 180px;
            border: 1px solid #ccc;
            background: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            position: relative;
            width: 180px;
        }

        .filter-group select {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            font-size: 14px;
            width: 100%;
            padding: 10px 12px;
            font-size: 13px;
            border-radius: 6px;
            border: 1px solid #ccc;
            background: #fff;
        }

        .floating-label label {
            position: absolute;
            top: -8px;
            left: 12px;
            background: #eef1f5;
            padding: 0 6px;
            font-size: 11px;
            font-weight: 600;
            color: #28a745;
            letter-spacing: .3px;
        }


        .ml-auto {
            margin-left: auto;
        }


        .metrics-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .metric-card {
            flex: 1 1 320px;
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        }

        .metric-title {
            text-align: center;
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .total-earning .metric-title {
            border-bottom: none;
        }

        .metric-columns {
            display: flex;
            justify-content: space-between;
            text-align: center;
        }

        .metric-column {
            flex: 1;
        }

        .metric-label {
            font-size: 14px;
            color: #666;
        }

        .metric-value {
            font-size: 34px;
            font-weight: bold;
        }

        .metric-change {
            font-size: 13px;
            font-weight: bold;
        }

        .metric-change.positive {
            color: #4caf50;
        }

        .arrow-up {
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-bottom: 7px solid #4caf50;
            margin-right: 5px;
        }

        .chart-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .chart-box {
            flex: 1 1 450px;
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        }

        .chart-area {
            height: 320px;
        }

        .ticket-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .ticket-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .chart-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .col-6 {
            flex: 1 1 23%;
            min-width: 250px;
            margin-top: 30px;
        }

        .ticket-box {
            background: #fff;
            border-radius: 12px;
            padding: 20px 18px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: box-shadow 0.3s ease;
            cursor: default;
            user-select: none;
        }

        .ticket-box:hover {
            box-shadow: 0 8px 30px rgba(76, 175, 80, 0.2);
        }

        .ticket-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #2e2e2e;
        }

        .chart-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #555;
        }

        .ticket-group {
            text-align: center;
            margin-bottom: 15px;
        }

        .group-title {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 18px;
            color: #007bff;
            user-select: none;
        }

        .ticket-box {
            margin-bottom: 25px;
        }

        #unrev_revenue,
        #unrev_passenger {
            overflow: hidden !important;
            overflow: visible !important;
        }

        .ticket-box {
            overflow: visible;
            max-width: 100%;
        }

        .data-container {
            display: flex;
            gap: 20px;
            max-width: 1400px;
            margin: auto;
        }

        h3 {
            margin-top: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .unit {
            font-size: 12px;
            font-weight: normal;
        }

        .table-section {
            flex: 2;
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            text-align: center;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #ccc;
            padding: 5px;
        }

        .data-table thead th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .data-table .highlight {
            background-color: #e0f7fa;
        }

        .station-name {
            font-weight: bold;
            text-align: left;
        }

        .chart-section {
            flex: 1.5;
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ddd;
        }


        .legend {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .legend span {
            width: 10px;
            height: 10px;
            display: inline-block;
            margin-right: 5px;
        }

        .reserved-color {
            background-color: #007bff;

        }

        .unreserved-color {
            background-color: #00cccc;

        }

        .bar-chart {
            position: relative;
            padding-bottom: 30px;
        }

        .chart-row {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            border-bottom: 1px dashed #eee;
            padding: 5px 0;
        }

        .label {
            width: 15%;
            font-size: 11px;
            text-align: right;
            padding-right: 5px;
            color: #555;
        }

        .bar-group {
            flex-grow: 1;
            display: flex;
            align-items: center;
            height: 20px;
            border-left: 1px solid #000;
            margin-left: 10px;
        }

        .reserved-bar,
        .unreserved-bar {
            height: 100%;
            color: white;
            font-size: 10px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 3px;
            box-sizing: border-box;
            white-space: nowrap;
        }

        .reserved-bar {
            background-color: #007bff;
            justify-content: flex-start;
        }

        .unreserved-bar {
            background-color: #00cccc;
            order: -1;
            justify-content: flex-end;
        }

        .unreserved-bar.negative {
            background-color: #00cccc;
            direction: rtl;
            justify-content: flex-start;
        }

        .unreserved-bar.negative .value {
            direction: ltr;
            color: #333;
            position: absolute;
            right: 100%;
            margin-right: 5px;
        }

        .axis {
            display: flex;
            justify-content: space-between;
            padding-left: 20%;
            font-size: 10px;
            border-top: 1px solid #333;
            padding-top: 5px;
            margin-top: 10px;
            position: absolute;
            bottom: 0;
            width: 80%;
        }

        .axis span:first-child {
            margin-left: -5px;
        }

        .table-scroll-body {
            max-height: 400px;
            overflow-y: auto;
            overflow-x: hidden;
            margin-top: -1px;
            border-bottom: 1px solid #dee2e6;
        }

        .table-scroll-body table {
            width: 100%;
            margin-bottom: 0;
            table-layout: fixed;
        }

        .table-responsive>.table {
            table-layout: fixed;
        }

        @media (max-width: 992px) {
            .col-3 {
                flex: 1 1 48%;
            }
        }

        @media (max-width: 576px) {
            .col-3 {
                flex: 1 1 100%;
            }
        }

        @media (max-width: 768px) {
            .filters {
                flex-direction: column;
            }

            .ml-auto {
                margin-left: 0 !important;
            }

            .metric-columns {
                flex-direction: column;
                gap: 15px;
            }

            .chart-box {
                min-width: 100%;
            }
        }
    </style>
@endsection
