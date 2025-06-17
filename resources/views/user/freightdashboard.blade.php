@extends('layouts.backend')

@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            <div class="ibox">
                <div class="header1">
                    FREIGHT DASHBOARD(2025-26)
                </div>

                <div class="filters">
                    <div class="filter-group">
                        <span>Customer</span>
                        <select> 
                            <option>Select Station</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <span>Location</span>
                        <select>
                            <option>Select Location</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <span>Commodity</span>
                        <select>
                            <option>Select Commodity</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <span>Apr 1, 2024 - Mar 31, 2025</span>
                    </div>
                </div>

                <div class="ibox-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-center fw-bold">FINANCIAL YEAR WISE REVENUE & TONNAGE</h6>
                            <div id="barChart" style="height: 300px;"></div>
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-around align-items-center">
                            <div class="text-center">
                                <h6>Revenue (In Cr.)</h6>
                                <h4 class="text-danger">467.47 <span class="text-danger small">▼ -6.5%</span></h4>
                            </div>
                            <div class="text-center">
                                <h6>Weight (1000 Tons)</h6>
                                <h4 class="text-danger">3,491.05 <span class="text-danger small">▼ -2.5%</span></h4>
                            </div>
                            <div class="text-center">
                                <h6>Wagons</h6>
                                <h4 class="text-success">93,359 <span class="text-success small">▲ +14.3%</span></h4>
                            </div>
                            <div class="text-center">
                                <h6>Average Lead</h6>
                                <h4 class="text-danger">1,431.45 <span class="text-danger small">▼ -2.2%</span></h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-center fw-bold">Optional Metrics (Freight / Weight)</h6>
                            <div id="lineChart1" style="height: 250px;"></div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-center fw-bold">Month wise wagons loading</h6>
                            <div id="lineChart2" style="height: 250px;"></div>
                        </div>
                    </div>
                </div>


                <div class="container mt-5">
                    <div class="row text-center justify-content-center">
                        <div class="col-lg-3 col-md-6 p-3">
                            <h6><strong>Location Wise Revenue</strong></h6>
                            <div id="chart1" style="width:100%; height:200px;"></div>
                        </div>
                        <div class="col-lg-3 col-md-6 p-3">
                            <h6><strong>Commodity Wise Revenue</strong></h6>
                            <div id="chart2" style="width:100%; height:200px;"></div>
                        </div>
                        <div class="col-lg-6 col-md-12 p-3">
                            <h6><strong>Month Wise Average Lead Position</strong></h6>
                            <div id="chart3" style="width: 100%; height: 350px;"></div>

                        </div>
                    </div>
                </div>

                    <div class="row mt-4">
                    <div class="col-md-12">
                        <h6 class="text-center fw-bold">Customer  Wise Revenue </h6>

                        <div class="table-responsive custom-scroll" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered text-center align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Passenger</th>
                                        <th>Revenue</th>
                                        <th>Passenger</th>
                                        <th>Revenue</th>
                                        <th>Passenger</th>
                                        <th>Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>SJM</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0.01</td>
                                    </tr>
                                    <tr>
                                        <td>BUBR</td>
                                        <td>0</td>
                                        <td>0.02</td>
                                        <td>0</td>
                                        <td>0.02</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>BTYA</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr style="background-color:#f8d7da;">
                                        <td>PHC</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>KHDB</td>
                                        <td>0</td>
                                        <td>0.02</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>DVGM</td>
                                        <td>0</td>
                                        <td>0.01</td>
                                        <td>0</td>
                                        <td>0.01</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>PLE</td>
                                        <td>0</td>
                                        <td>0.01</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>CDS</td>
                                        <td>0</td>
                                        <td>0.01</td>
                                        <td>0</td>
                                        <td>0.01</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>DKW</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0.01</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Recent Sales End -->

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 15px;
        }

        .header1 {
            background: linear-gradient(to right, #4CAF50, #8BC34A);
            color: #000;
            padding: 15px;
            text-align: center;
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .filters {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .filter-group {
            background: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            min-width: 200px;
            cursor: pointer;
        }

        .filter-group select {
            border: none;
            background: transparent;
            cursor: pointer;
            width: 100%;
            outline: none;
        }

        .metrics-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: 15px;
        }

        .metric-card {
            flex: 1;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .metric-title {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            margin-bottom: 10px;
        }

        .metric-columns {
            display: flex;
            justify-content: space-between;
            text-align: center;
        }

        .metric-column {
            flex: 1;
            padding: 0 10px;
        }

        .metric-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
        }

        .metric-value {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .metric-change {
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .metric-change.positive {
            color: #4CAF50;
        }

        .metric-change.negative {
            color: #F44336;
        }

        .arrow-up {
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-bottom: 5px solid #4CAF50;
            margin-right: 3px;
        }

        .optional-section {
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .optional-title {
            font-size: 14px;
            font-weight: bold;
        }

        .optional-icons {
            display: flex;
            gap: 10px;
        }

        .icon {
            cursor: pointer;
            color: #666;
        }

        /* Responsive styles */
        @media (max-width: 992px) {
            .metrics-container {
                flex-direction: column;
            }

            .filters {
                flex-direction: column;
                gap: 10px;
            }

            .filter-group {
                width: 100%;
            }
        }
    </style>

    <!-- Chart Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Placeholder chart logic
        var barOptions = {
            chart: {
                type: 'bar',
                height: 300
            },
            series: [{
                    name: 'Freight Cr',
                    data: [8037.15, 6885.26, 6412.52, 467.47]
                },
                {
                    name: 'Weight (1000 Tons)',
                    data: [53782.73, 48424.47, 46776.13, 3491.05]
                }
            ],
            xaxis: {
                categories: ['2022-2023', '2023-2024', '2024-2025', '2025-2026']
            },
            colors: ['#28a745', '#fd7e14']
        };
        var chart = new ApexCharts(document.querySelector("#barChart"), barOptions);
        chart.render();

        var lineChart1 = new ApexCharts(document.querySelector("#lineChart1"), {
            chart: {
                type: 'line',
                height: 250
            },
            series: [{
                    name: '2025-2026',
                    data: [467.47, 500, 520, 540]
                },
                {
                    name: '2024-2025',
                    data: [480, 490, 500, 510]
                },
                {
                    name: '2023-2024',
                    data: [600, 620, 610, 630]
                },
            ],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr']
            }
        });
        lineChart1.render();

        var lineChart2 = new ApexCharts(document.querySelector("#lineChart2"), {
            chart: {
                type: 'line',
                height: 250
            },
            series: [{
                    name: '2025-2026',
                    data: [93359, 95000, 94000, 96000]
                },
                {
                    name: '2024-2025',
                    data: [88000, 87000, 89000, 90000]
                },
                {
                    name: '2023-2024',
                    data: [75000, 74000, 76000, 77000]
                },
            ],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr']
            }
        });
        lineChart2.render();
    </script>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            // Location Wise Revenue
            var data1 = google.visualization.arrayToDataTable([
                ['Location', 'Revenue'],
                ['MDCC', 300],
                ['IFFG', 250],
                ['WPA', 200],
                ['CHIB', 180],
                ['SNLR', 160],
                ['KPRK', 150],
                ['KDLP', 130],
                ['AOMM', 110],
                ['MSIB', 90],
                ['Others', 70]
            ]);

            var options1 = {
                pieHole: 0.4,
                chartArea: {
                    width: '90%',
                    height: '90%'
                },
                colors: [
                    '#1976D2', // MDCC (blue)
                    '#00BCD4', // IFFG (cyan)
                    '#FB8C00', // WPA (orange)
                    '#8E24AA', // CHIB (purple)
                    '#EC407A', // SNLR (pink)
                    '#E91E63', // KPRK (magenta)
                    '#FFB300', // KDLP (amber)
                    '#FFCC80', // AOMM (light orange)
                    '#8BC34A', // MSIB (light green)
                    '#64B5F6' // Others (light blue)
                ]
            };

            var chart1 = new google.visualization.PieChart(document.getElementById('chart1'));
            chart1.draw(data1, options1);

            // Commodity Wise Revenue
            var data2 = google.visualization.arrayToDataTable([
                ['Location', 'Revenue'],
                ['MDCC', 300],
                ['IFFG', 250],
                ['WPA', 200],
                ['CHIB', 180],
                ['SNLR', 160],
                ['KPRK', 150],
                ['KDLP', 130],
                ['AOMM', 110],
                ['MSIB', 90],
                ['Others', 70]
            ]);

            var options2 = {
                pieHole: 0.4,
                chartArea: {
                    width: '90%',
                    height: '90%'
                },
                colors: [
                    '#1976D2', // MDCC (blue)
                    '#00BCD4', // IFFG (cyan)
                    '#FB8C00', // WPA (orange)
                    '#8E24AA', // CHIB (purple)
                    '#EC407A', // SNLR (pink)
                    '#E91E63', // KPRK (magenta)
                    '#FFB300', // KDLP (amber)
                    '#FFCC80', // AOMM (light orange)
                    '#8BC34A', // MSIB (light green)
                    '#64B5F6' // Others (light blue)
                ]
            };

            var chart2 = new google.visualization.PieChart(document.getElementById('chart2'));
            chart2.draw(data2, options2);

            // Chart 3: Month Wise Average Lead Position
            var data3 = google.visualization.arrayToDataTable([
                ['Month', '2025-2026', '2024-2025', '2023-2024'],
                ['Apr', 1431, 1500, 1510],
                ['May', 1440, 1495, 1505],
                ['Jun', 1435, 1470, 1490],
                ['Jul', 1450, 1480, 1500],
                ['Aug', 1460, 1490, 1550],
                ['Sep', 1455, 1505, 1520],
                ['Oct', 1440, 1485, 1505],
                ['Nov', 1435, 1475, 1480],
                ['Dec', 1500, 1560, 1580],
                ['Jan', 1495, 1520, 1550],
                ['Feb', 1510, 1505, 1570],
                ['Mar', 1530, 1535, 1600]
            ]);

            var options3 = {
                curveType: 'function',
                legend: {
                    position: 'top'
                },
                colors: ['#2e7d32', '#00bcd4', '#e91e63'],
                pointSize: 6,
                lineWidth: 2,
                chartArea: {
                    width: '85%',
                    height: '75%'
                },
                hAxis: {
                    title: '',
                    textStyle: {
                        fontSize: 12
                    }
                },
                vAxis: {
                    minValue: 0,
                    gridlines: {
                        count: 6
                    },
                    textStyle: {
                        fontSize: 12
                    }
                }
            };

            var chart3 = new google.visualization.LineChart(document.getElementById('chart3'));
            chart3.draw(data3, options3);

        }
    </script>
@endsection
