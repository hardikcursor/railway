@extends('layouts.backend') @section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            <div class="ibox">
                <div class="header1">COACHING DASHBOARD (2025-26)</div>
                <div class="filters">
                    <div class="filter-group">
                        <select name="station" class="form-select">
                            <option value="">All Station</option>

                            @foreach ($station as $stations)
                                <option value="{{ $stations }}">{{ $stations }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="filter-group">
                        <select>
                            <option>Month</option>
                            <option>April</option>
                            <option>May</option>
                        </select>
                    </div>

                    <div class="filter-group ml-auto">
                        <select>
                            <option>Apr 1, 2024 - Mar 31, 2025</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end m-3">
                    <a href="{{ route('superadmin.coaching') }}" class="btn btn-success">
                        <i class="ti-plus"></i> Create Coaching
                    </a>
                </div>
                <div class="row mt-3">

                    <!-- CARD 1 -->
                    <div class="col-md-4 mb-3">
                        <div class="metric-card unreserved">
                            <div class="metric-title">Un-Reserved</div>

                            <div class="metric-columns">
                                <div class="metric-column">
                                    <div class="metric-label">Passenger (In Lakh)</div>
                                    <div class="metric-value">{{ $totalPassengersFormatted }}</div>
                                    <div class="metric-change positive"><span class="arrow-up"></span> 13.3% </div>
                                </div>

                                <div class="metric-column">
                                    <div class="metric-label">Revenue (In Cr.)</div>
                                    <div class="metric-value">{{ $totalEarningFormatted }}</div>
                                    <div class="metric-change positive"><span class="arrow-up"></span> 12.8%</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 2 -->
                    <div class="col-md-4 mb-3">
                        <div class="metric-card total-earning">
                            <div class="metric-title">Reserved</div>

                            <div class="metric-columns">
                                <div class="metric-column">
                                    <div class="metric-label">Passenger (In Lakh)</div>
                                    <div class="metric-value">{{ $totalReserved_Passengers }}</div>
                                    <div class="metric-change positive"><span class="arrow-up"></span> 8.2%</div>
                                </div>

                                <div class="metric-column">
                                    <div class="metric-label">Revenue (In Cr.)</div>
                                    <div class="metric-value">{{ $totalReserved_Earning }}</div>
                                    <div class="metric-change positive"><span class="arrow-up"></span> 8.2%</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 3 -->
                    <div class="col-md-4 mb-3">
                        <div class="metric-card reserved">
                            <div class="metric-title">Total Passenger Earning</div>

                            <div class="metric-columns">
                                <div class="metric-column">
                                    <div class="metric-label">Passenger (In Lakh)</div>
                                    <div class="metric-value">{{ $Total_Passengers }}</div>
                                    <div class="metric-change positive"><span class="arrow-up"></span> 3.4%</div>
                                </div>

                                <div class="metric-column">
                                    <div class="metric-label">Revenue (In Cr.)</div>
                                    <div class="metric-value">{{ $Total_Earning }}</div>
                                    <div class="metric-change positive"><span class="arrow-up"></span> 7.4%</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="chart-container">
                    <div class="chart-box shadow-sm p-3 bg-white rounded">
                        <canvas id="passengerTrendChart" height="260"></canvas>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0"></script>

                <script>
                    const rawPassengerData = @json($passengerChartData);
                    const financialMonths = ["APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC", "JAN", "FEB", "MAR"];
                    const monthOrder = [4, 5, 6, 7, 8, 9, 10, 11, 12, 1, 2, 3];
                    const colors = ["#ff5c33", "#ffcc00", "#4CAF50", "#2196F3"];
                    const FIXED_TOTAL = 100000;

                    const passengerDatasets = Object.keys(rawPassengerData).sort((a, b) => b - a).map((year, i) => {
                        const monthlyValues = monthOrder.map(m => rawPassengerData[year]?.[m] || 0);
                        const monthlyPercentages = monthlyValues.map(val =>
                            val > 0 ? parseFloat(((val / FIXED_TOTAL) * 100).toFixed(4)) : 0
                        );

                        return {
                            label: `${year-1}-${year.toString().slice(-2)}`,
                            data: monthlyPercentages,
                            actualData: monthlyValues,
                            borderColor: colors[i % colors.length],
                            backgroundColor: colors[i % colors.length],
                            borderWidth: 1.5,
                            tension: 0.4,
                            pointRadius: 2.5,
                            pointBackgroundColor: "#fff",
                            fill: false
                        };
                    });

                    new Chart(document.getElementById("passengerTrendChart"), {
                        type: "line",
                        data: {
                            labels: financialMonths,
                            datasets: passengerDatasets
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: "top",
                                    align: "end",
                                    labels: {
                                        usePointStyle: true,
                                        pointStyle: 'circle',
                                        boxWidth: 3,
                                        boxHeight: 3,
                                        pointStyleWidth: 3,
                                        padding: 10,
                                        font: {
                                            size: 10
                                        }
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(ctx) {
                                            let label = ctx.dataset.label || '';
                                            let percent = ctx.parsed.y + '%';
                                            let actual = ctx.dataset.actualData[ctx.dataIndex].toLocaleString('en-IN');
                                            return ` ${label}: ${percent}  `;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: "Reserved Passenger(In Crore)",
                                        font: {
                                            size: 15,
                                            weight: 'bold'
                                        }
                                    },
                                    ticks: {
                                        font: {
                                            size: 9
                                        },
                                        callback: (v) => v + "%"
                                    }
                                },
                                x: {
                                    ticks: {
                                        font: {
                                            size: 9
                                        }
                                    },
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
                </script>

                <div class="chart-container">
                    <div class="chart-box shadow-sm p-3 bg-white rounded">
                        <canvas id="myChart2" height="260"></canvas>
                    </div>
                </div>

                <script>
                    const rawEarningData = @json($earningChartData);
                    const monthsList = ["APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC", "JAN", "FEB", "MAR"];
                    const mOrder = [4, 5, 6, 7, 8, 9, 10, 11, 12, 1, 2, 3];
                    const chartColors = ["#FF5722", "#FFC107", "#4CAF50", "#2196F3"];
                    const FIXED_TOTAL_LAKH = 10000000;

                    const earnDatasets = Object.keys(rawEarningData).sort((a, b) => b - a).map((year, i) => {
                        const monthlyValues = mOrder.map(m => rawEarningData[year]?.[m] || 0);
                        const monthlyPercentages = monthlyValues.map(val =>
                            val > 0 ? parseFloat(((val / FIXED_TOTAL_LAKH) * 100).toFixed(2)) : 0
                        );

                        return {
                            label: `${year-1}-${year.toString().slice(-2)}`,
                            data: monthlyPercentages,
                            actualValues: monthlyValues,
                            borderColor: chartColors[i % chartColors.length],
                            backgroundColor: chartColors[i % chartColors.length],
                            borderWidth: 1.5,
                            tension: 0.4,
                            pointRadius: 2.5,
                            pointBackgroundColor: "#fff",
                            fill: false
                        };
                    });

                    const earnCtx = document.getElementById("myChart2");
                    if (earnCtx) {
                        new Chart(earnCtx.getContext('2d'), {
                            type: "line",
                            data: {
                                labels: monthsList,
                                datasets: earnDatasets
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: "top",
                                        align: "end",
                                        labels: {
                                            usePointStyle: true,
                                            pointStyle: 'circle',
                                            boxWidth: 3,
                                            boxHeight: 3,
                                            pointStyleWidth: 3,
                                            padding: 10,
                                            font: {
                                                size: 10
                                            }
                                        }
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(ctx) {
                                                let label = ctx.dataset.label || '';
                                                let percentageValue = ctx.raw + '%';
                                                let actualAmount = ctx.dataset.actualValues[ctx.dataIndex].toLocaleString(
                                                    'en-IN', {
                                                        style: 'currency',
                                                        currency: 'INR',
                                                        minimumFractionDigits: 0
                                                    });
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: "Contribution % (of 1 Lakh)",
                                            font: {
                                                size: 10,
                                                weight: 'bold'
                                            }
                                        },
                                        ticks: {
                                            font: {
                                                size: 9
                                            },
                                            callback: (v) => v + "%"
                                        }
                                    },
                                    x: {
                                        ticks: {
                                            font: {
                                                size: 9
                                            }
                                        },
                                        grid: {
                                            display: false
                                        }
                                    }
                                }
                            }
                        });
                    }
                </script>

                <div class="row">
                    <div class="col-6">
                        <div class="ticket-box"
                            style="border: 1px solid #eee; padding: 15px; border-radius: 8px; overflow: visible;">
                            <div class="chart-title" style="font-weight: bold; color: #555;">Unreserved Passengers (in Lakh)
                            </div>
                            <div id="dynamic_passenger_chart"></div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="ticket-box"
                            style="border: 1px solid #eee; padding: 15px; border-radius: 8px; overflow: visible;">
                            <div class="chart-title" style="font-weight: bold; color: #555;">Unreserved Revenue (in Cr.)
                            </div>
                            <div id="dynamic_revenue_chart"></div>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                <script>
                    function createDynamicChart(id, dataValues, dataLabels, centerLabel) {
                        var options = {
                            chart: {
                                type: 'donut',
                                height: 400,
                                width: '100%'
                            },
                            series: dataValues.map(Number), // Controller માંથી આવતા આંકડા
                            labels: dataLabels,
                            colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#3F51B5', '#546E7A', '#D4526E',
                                '#8D5B4C', '#F86624'
                            ],
                            legend: {
                                position: 'right',
                                width: 140,
                                fontSize: '12px'
                            },
                            plotOptions: {
                                pie: {
                                    customScale: 0.85,
                                    donut: {
                                        size: '70%',
                                        labels: {
                                            show: true,
                                            total: {
                                                show: true,
                                                label: centerLabel,
                                                fontSize: '14px',
                                                fontWeight: 'bold',
                                                formatter: function(w) {
                                                    // કુલ સરવાળો Lakh માં બતાવશે
                                                    let total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                                    return total.toFixed(2) + " Lakh";
                                                }
                                            }
                                        }
                                    }
                                }
                            },
                            // ચાર્ટની ઉપર ટકાવારી બતાવવા માટે
                            dataLabels: {
                                enabled: true,
                                formatter: function(val, opts) {
                                    // અહીં val એ આપોઆપ ગણાયેલી ટકાવારી છે
                                    return val.toFixed(1) + "%";
                                },
                                dropShadow: {
                                    enabled: false
                                }
                            },
                            // જ્યારે માઉસ સ્ટેશન પર લઈ જાવ ત્યારે કિંમત અને % બંને બતાવવા
                            tooltip: {
                                y: {
                                    formatter: function(val, opts) {
                                        let total = opts.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        let percent = (val / total * 100).toFixed(1);
                                        return val + " Lakh (" + percent + "%)";
                                    }
                                }
                            }
                        };

                        new ApexCharts(document.querySelector(id), options).render();
                    }


                    createDynamicChart(
                        "#dynamic_passenger_chart",
                        @json($unrevPassengerValues),
                        @json($unrevPassengerLabels),
                        "Total Passengers"
                    );


                    createDynamicChart(
                        "#dynamic_revenue_chart",
                        @json($unrevEarningValues),
                        @json($unrevEarningLabels),
                        "Total Revenue"
                    );
                </script>



                <div class="col-6">
                    <div class="ticket-group">
                        <h3 class="group-title">Reserved Ticket</h3>
                        <div class="ticket-box">
                            <div class="chart-title">Revenue (in Cr.)</div>
                            <div id="res_revenue"></div>
                        </div>

                        <div class="ticket-box">
                            <div class="chart-title">Passenger (in Lakh)</div>
                            <div id="res_passenger"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="data-container">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th rowspan="2" class="align-middle">Station</th>
                                @foreach ($years as $y)
                                    <th colspan="2">{{ $y - 1 }}-{{ $y }}</th>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($years as $y)
                                    <th>Passenger</th>
                                    <th>Revenue</th>
                                @endforeach
                            </tr>
                        </thead>
                    </table>

                    <div class="table-scroll-body">
                        <table class="table table-bordered table-striped table-hover text-center align-middle">
                            <tbody>
                                @foreach ($data as $station => $yearData)
                                    <tr>
                                        <td class="text-start fw-bold" style="width: 16.66%">{{ $station }}</td>

                                        @foreach ($years as $y)
                                            <td style="width: 16.66%">{{ $yearData[$y]['Passengers'] ?? 0 }}</td>
                                            <td style="width: 16.66%">{{ $yearData[$y]['Revenue'] ?? 0 }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="chart-section">
            <div class="legend">
                <span class="reserved-color"></span> RESERVED <span class="unreserved-color"></span> UNRESERVED
            </div>

            <div class="bar-chart">
                <div class="chart-row">
                    <span class="label">2019-2020</span>
                    <div class="bar-group">
                        <div class="unreserved-bar" style="width: 15%"><span class="value">187.93</span></div>
                        <div class="reserved-bar" style="width: 60%">726.54</div>
                    </div>
                </div>

                <div class="chart-row">
                    <span class="label">2020-2021</span>
                    <div class="bar-group">
                        <div class="unreserved-bar negative" style="width: 2.5%"></div>
                        <div class="reserved-bar" style="width: 25%">318.62</div>
                    </div>
                </div>

                <div class="chart-row">
                    <span class="label">2021-2022</span>
                    <div class="bar-group">
                        <div class="unreserved-bar negative" style="width: 1%"></div>
                        <div class="reserved-bar" style="width: 65%">812.75</div>
                    </div>
                </div>

                <div class="chart-row">
                    <span class="label">2022-2023</span>
                    <div class="bar-group">
                        <div class="unreserved-bar negative" style="width: 10%"></div>
                        <div class="reserved-bar" style="width: 90%">1,175.2</div>
                    </div>
                </div>

                <div class="axis">
                    <span>0</span>
                    <span>200</span>
                    <span>400</span>
                    <span>600</span>
                    <span>800</span>
                    <span>1K</span>
                    <span>1.2K</span>
                </div>
            </div>
        </div>
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
        }

        .filter-group select {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            font-size: 14px;
        }

        .ml-auto {
            margin-left: auto;
        }

        /* METRIC CARDS */
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

        /* CHARTS */
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

        /* --- General Headings --- */
        h3 {
            margin-top: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .unit {
            font-size: 12px;
            font-weight: normal;
        }

        /* --- Table Styling (Left Section) --- */
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

        /* Styling for the light blue rows (as seen in the image) */
        .data-table .highlight {
            background-color: #e0f7fa;
            /* Light Cyan */
        }

        .station-name {
            font-weight: bold;
            text-align: left;
        }

        /* --- Chart Styling (Right Section) --- */
        .chart-section {
            flex: 1.5;
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ddd;
        }

        /* Legend Styling */
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
            /* Blue */
        }

        .unreserved-color {
            background-color: #00cccc;
            /* Cyan */
        }

        /* Chart Structure */
        .bar-chart {
            position: relative;
            padding-bottom: 30px;
            /* Space for axis */
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
            /* Represents the Y-axis (0-point) */
            margin-left: 10px;
        }

        /* Individual Bars */
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
            /* Values on the left edge of the bar */
        }

        .unreserved-bar {
            background-color: #00cccc;
            /* Unreserved bars for 2020-2023 in the image are negative/left-aligned */
            order: -1;
            /* Place before the reserved bar */
            justify-content: flex-end;
            /* Value at the right edge of the bar */
        }

        /* Special styling for negative/left-side bars */
        .unreserved-bar.negative {
            background-color: #00cccc;
            direction: rtl;
            /* Flip direction to align text to the right inside the bar */
            justify-content: flex-start;
        }

        .unreserved-bar.negative .value {
            direction: ltr;
            /* Reset text direction for the number itself */
            color: #333;
            /* Darker text for readability over light cyan */
            position: absolute;
            /* Position value next to the bar */
            right: 100%;
            margin-right: 5px;
        }

        /* X-Axis Representation */
        .axis {
            display: flex;
            justify-content: space-between;
            padding-left: 20%;
            /* Align with the start of the bar area */
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
                /* full width on small devices */
            }
        }

        /* MEDIA QUERIES */
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

    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load("current", {
            packages: ["corechart"],
        });
        google.charts.setOnLoadCallback(() => {
            drawRevenueChart();
            drawPassChart();
        });

        function drawRevenueChart() {
            var data = google.visualization.arrayToDataTable([
                ["Month", "2024-25", "2023-24", "2022-23"],
                ["APR", 101.33, 112.16, 88],
                ["MAY", 100, 116.69, 93],
                ["JUN", 100, 151.96, 98],
                ["JUL", 110, 125.99, 97],
                ["AUG", 120, 129.19, 100],
                ["SEP", 105, 112.28, 93],
                ["OCT", 98, 101.06, 88],
                ["NOV", 105, 113.02, 101],
                ["DEC", 108, 117.44, 98],
                ["JAN", 110, 113.01, 102],
                ["FEB", 100, 110, 105],
                ["MAR", 150.05, 112, 115],
            ]);

            var options = {
                title: "OPTIONAL METRICS RESVD/UNRESVD REVENUE",
                legend: {
                    position: "top",
                },
                curveType: "function",
            };

            new google.visualization.LineChart(document.getElementById("revenue_chart_div")).draw(data, options);
        }

        function drawPassChart() {
            var data = google.visualization.arrayToDataTable([
                ["Month", "2024-25", "2023-24", "2022-23"],
                ["APR", 12, 14.08, 13],
                ["MAY", 12.5, 14.68, 13.5],
                ["JUN", 14, 19.3, 14.8],
                ["JUL", 16, 16.28, 14.5],
                ["AUG", 16.5, 15.58, 14],
                ["SEP", 14, 14.59, 12.5],
                ["OCT", 13.5, 13.03, 13],
                ["NOV", 14, 14.59, 14],
                ["DEC", 12.8, 14.7, 13.8],
                ["JAN", 13, 13.88, 13],
                ["FEB", 13.5, 14, 12.5],
                ["MAR", 15, 17.87, 14.5],
            ]);

            var options = {
                title: "OPTIONAL METRICS RESVD/UNRESVD PASS",
                legend: {
                    position: "top",
                },
                curveType: "function",
            };

            new google.visualization.LineChart(document.getElementById("pass_chart_div")).draw(data, options);
        }
    </script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            function makeDonutChart(id, values, labels) {
                var options = {
                    chart: {
                        type: "donut",
                        height: 260,
                    },
                    series: values,
                    labels: labels,
                    legend: {
                        position: "right",
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: (v) => v.toFixed(1) + "%",
                    },
                };
                new ApexCharts(document.querySelector(id), options).render();
            }

            const labels = ["ADI", "SBIB", "GIMB", "MISC", "NBVJ", "MSH", "PNU", "ASV", "VG", "Others"];

            makeDonutChart("#unrev_revenue", [44, 13.3, 7.5, 5, 4, 3.5, 3, 2.5, 2, 13.2], labels);
            makeDonutChart("#unrev_passenger", [34.9, 10.1, 8, 6, 5, 4.5, 3.2, 2.5, 2, 24.1], labels);

            makeDonutChart("#res_revenue", [53.5, 18.4, 6.5, 5, 4, 3, 2, 2, 1.5, 3], labels);
            makeDonutChart("#res_passenger", [54.9, 17.2, 6.8, 5.5, 4, 3.2, 3, 2.4, 1.8, 3], labels);
        </script> --}}
@endsection
</div>
