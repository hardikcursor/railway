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
                <div class="d-flex justify-content-end align-items-center m-3">
                    <a href="#" class="btn btn-primary" style="margin-right:12px;">
                        ↑ Import Excel
                    </a>

                    <a href="{{ route('superadmin.coaching') }}" class="btn btn-success">
                        + Create Coaching
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


                <div class="row mt-4">
                    <div class="col-md-6 col-12">
                        <div class="chart-box">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>


                    <div class="col-md-6 col-12">
                        <div class="chart-box">
                            <canvas id="passengerChart"></canvas>
                        </div>
                    </div>
                </div>


                <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0"></script>
                <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

                <script>
                    const rawRevenueData = @json($earningChartData);
                    const passengerData = @json($passengerChartData);
                    const years = @json($years);

                    const months = ['APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB', 'MAR'];
                    const monthOrder = [4, 5, 6, 7, 8, 9, 10, 11, 12, 1, 2, 3];
                    const colors = ['#6ab04c', '#ffc107', '#ff7a00', '#00a8ff', '#9c27b0'];

                    const revenueDatasets = Object.keys(rawRevenueData)
                        .map(yearStr => parseInt(yearStr))
                        .sort((a, b) => b - a)
                        .map((year, i) => {
                            const data = monthOrder.map(m => +(rawRevenueData[year]?.[m] || 0) / 10000000);
                            return {
                                label: `${year}-${(year+1).toString().slice(-2)}`,
                                data: data,
                                borderColor: colors[i % colors.length],
                                backgroundColor: colors[i % colors.length],
                                tension: 0.4,
                                pointRadius: 3,
                                fill: false,
                                spanGaps: true
                            };
                        });

                    const passengerDatasets = years.map((year, i) => {
                        const data = monthOrder.map(m => passengerData[year]?.[m] || 0);
                        return {
                            label: `${year}-${(year+1).toString().slice(-2)}`,
                            data: data,
                            borderColor: colors[i % colors.length],
                            backgroundColor: colors[i % colors.length],
                            tension: 0.4,
                            pointRadius: 4,
                            fill: false,
                            spanGaps: true
                        };
                    });

                    new Chart(document.getElementById('revenueChart'), {
                        type: 'line',
                        data: {
                            labels: months,
                            datasets: revenueDatasets
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: ctx => `${ctx.dataset.label}: ${ctx.parsed.y.toFixed(2)} Cr`
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    min: 0,
                                    max: 2,
                                    ticks: {
                                        stepSize: 0.5,
                                        callback: val => {
                                            const lakhVal = val * 100;
                                            const allowed = [0, 50, 100, 150, 200];
                                            return allowed.includes(lakhVal) ? lakhVal.toString() : '';
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: 'Reserved Revenue (Crore)'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });

                    const allPassengerValues = passengerDatasets.flatMap(d => d.data);
                    const maxPassengerValue = Math.max(...allPassengerValues);

                    // 🔹 Smart step size logic
                    let stepSize = 5;

                    if (maxPassengerValue <= 5) {
                        stepSize = 1;
                    } else if (maxPassengerValue <= 10) {
                        stepSize = 2;
                    } else if (maxPassengerValue <= 20) {
                        stepSize = 5;
                    } else if (maxPassengerValue <= 50) {
                        stepSize = 10;
                    } else {
                        stepSize = 20;
                    }

                    const maxY = Math.ceil(maxPassengerValue / stepSize) * stepSize;

                    new Chart(document.getElementById('passengerChart'), {
                        type: 'line',
                        data: {
                            labels: months,
                            datasets: passengerDatasets
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: ctx =>
                                            `${ctx.dataset.label}: ${ctx.parsed.y.toFixed(2)} Lakh`
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: maxY,
                                    ticks: {
                                        stepSize: stepSize,
                                        callback: value => value + ' '
                                    },
                                    title: {
                                        display: true,
                                        text: 'Reserved Passenger (Lakh)'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            }
                        }
                    });
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
                    const stationLabels = @json($passengerLabels);
                    const passengerSeries = @json($passengerValues);
                    const revenueSeries = @json($revenueValues);
                </script>

                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

                <script>
                    function createDynamicDonut(id, series, labels, centerLabel, unit) {

                        var options = {
                            chart: {
                                type: 'donut',
                                height: 400
                            },
                            series: series.map(Number),
                            labels: labels,
                            legend: {
                                position: 'right',
                                fontSize: '12px'
                            },
                            plotOptions: {
                                pie: {
                                    donut: {
                                        size: '70%',
                                        labels: {
                                            show: true,
                                            total: {
                                                show: true,
                                                label: centerLabel,
                                                formatter: function(w) {
                                                    let total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                                    return total.toFixed(2) + ' ' + unit;
                                                }
                                            }
                                        }
                                    }
                                }
                            },
                            tooltip: {
                                y: {
                                    formatter: function(val, opts) {
                                        let total = opts.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        let percent = ((val / total) * 100).toFixed(1);
                                        return `${val} ${unit} (${percent}%)`;
                                    }
                                }
                            },
                            dataLabels: {
                                formatter: val => val.toFixed(1) + '%'
                            }
                        };

                        new ApexCharts(document.querySelector(id), options).render();
                    }
                </script>

                <script>
                    /* 🔵 Passenger Donut (Lakh) */
                    createDynamicDonut(
                        "#dynamic_passenger_chart",
                        passengerSeries,
                        stationLabels,
                        "Total Passengers",
                        "Lakh"
                    );

                    /* 🟢 Revenue Donut (Crore) */
                    createDynamicDonut(
                        "#dynamic_revenue_chart",
                        revenueSeries,
                        stationLabels,
                        "Total Revenue",
                        "Cr"
                    );
                </script>
            </div>

            <div class="container">
                <h3 class="group-title mb-3 text-center">Reserved Ticket</h3>

                <div class="row">
                    <div class="col-6">
                        <div class="ticket-group">
                            <div class="ticket-box">
                                <div id="res_revenue">Revenue (in.Cr)</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="ticket-group">
                            <div class="ticket-box">
                                <div id="res_passenger">Passenger (in.Lakh)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
            <script>
                function createStaticDonut(id, series, labels, centerText, unit) {
                    var options = {
                        chart: {
                            type: 'donut',
                            height: 260
                        },
                        series: series,
                        labels: labels,
                        legend: {
                            position: 'right',
                            fontSize: '12px'
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '65%',
                                    labels: {
                                        show: true,
                                        total: {
                                            show: true,
                                            label: centerText,
                                            formatter: function(w) {
                                                let total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                                return total.toFixed(1) + ' ' + unit;
                                            }
                                        }
                                    }
                                }
                            }
                        },
                        dataLabels: {
                            formatter: val => val.toFixed(1) + '%'
                        },
                        tooltip: {
                            y: {
                                formatter: function(val, opts) {
                                    let total = opts.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                    let percent = ((val / total) * 100).toFixed(1);
                                    return `${val} ${unit} (${percent}%)`;
                                }
                            }
                        }
                    };

                    new ApexCharts(document.querySelector(id), options).render();
                }

                // Prepare data dynamically from PHP variables passed from Laravel
                const reservedRevenueSeries = @json($reservedRevenueValues);
                const reservedRevenueLabels = @json($reservedPassengerLabels);

                const reservedPassengerSeries = @json($reservedPassengerValues);
                const reservedPassengerLabels = @json($reservedPassengerLabels);

                // Reserved Ticket Revenue chart
                createStaticDonut(
                    "#res_revenue",
                    reservedRevenueSeries,
                    reservedRevenueLabels,
                    "Total Revenue",
                    "Cr"
                );

                // Reserved Ticket Passenger chart
                createStaticDonut(
                    "#res_passenger",
                    reservedPassengerSeries,
                    reservedPassengerLabels,
                    "Total Passenger",
                    "Lakh"
                );
            </script>



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
@endsection
