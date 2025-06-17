@extends('layouts.backend')

@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            <div class="ibox">
                <div class="header1">
                    COACHING DASHBOARD (2024-25)
                </div>

                <div class="filters">
                    <div class="filter-group">
                        <span>Station</span>
                        <select>
                            <option>Select Station</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <span>Month</span>
                        <select>
                            <option>Select Month</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <span>Apr 1, 2024 - Mar 31, 2025</span>
                    </div>
                </div>

                <div class="metrics-container">
                    <div class="metric-card">
                        <div class="metric-title">Un-Reserved</div>
                        <div class="metric-columns">
                            <div class="metric-column">
                                <div class="metric-label">Passenger(In Lakh)</div>
                                <div class="metric-value">187.9</div>
                                <div class="metric-change positive">
                                    <div class="arrow-up"></div> 13.3%
                                </div>
                            </div>
                            <div class="metric-column">
                                <div class="metric-label">Revenue(In Cr.)</div>
                                <div class="metric-value">253.29</div>
                                <div class="metric-change positive">
                                    <div class="arrow-up"></div> 12.8%
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="metric-card">
                        <div class="metric-title">Total Passenger Earning</div>
                        <div class="metric-columns">
                            <div class="metric-column">
                                <div class="metric-label">Passenger(In Lakh)</div>
                                <div class="metric-value">370.47</div>
                                <div class="metric-change positive">
                                    <div class="arrow-up"></div> 8.2%
                                </div>
                            </div>
                            <div class="metric-column">
                                <div class="metric-label">Revenue(In Cr.)</div>
                                <div class="metric-value">1,697.47</div>
                                <div class="metric-change positive">
                                    <div class="arrow-up"></div> 8.2%
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="metric-card">
                        <div class="metric-title">Reserved</div>
                        <div class="metric-columns">
                            <div class="metric-column">
                                <div class="metric-label">Passenger(In Lakh)</div>
                                <div class="metric-value">182.57</div>
                                <div class="metric-change positive">
                                    <div class="arrow-up"></div> 3.4%
                                </div>
                            </div>
                            <div class="metric-column">
                                <div class="metric-label">Revenue(In Cr.)</div>
                                <div class="metric-value">1,444.18</div>
                                <div class="metric-change positive">
                                    <div class="arrow-up"></div> 7.4%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span class="fw-bold">OPTIONAL METRICS RESVD/UNRESVD REVENUE</span>

                            </div>
                            <div class="card-body">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span class="fw-bold">OPTIONAL METRICS RESVD/UNRESVD PASS</span>

                            </div>
                            <div class="card-body">
                                <canvas id="passengerChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container mt-5">
                    <div class="row text-center fw-bold mb-3">
                        <div class="col-md-6">
                            <h5>Un-reserved Ticket</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>Reserved Ticket</h5>
                        </div>
                    </div>

                    <div class="row text-center">
                        <div class="col-md-3 p-3">
                            <h6>Revenue (in Cr.)</h6>
                            <div id="chart1" style="width:100%; max-width:300px; height:200px;"></div>
                        </div>
                        <div class="col-md-3 p-3">
                            <h6>Passenger (in Lakh)</h6>
                            <div id="chart2" style="width:100%; max-width:300px; height:200px;"></div>
                        </div>
                        <div class="col-md-3 p-3">
                            <h6>Revenue (in Cr.)</h6>
                            <div id="chart3" style="width:100%; max-width:300px; height:200px;"></div>
                        </div>
                        <div class="col-md-3 p-3">
                            <h6>Passenger (in Lakh)</h6>
                            <div id="chart4" style="width:100%; max-width:300px; height:200px;"></div>
                        </div>
                    </div>




                </div>


                <div class="row mt-4">
                    <div class="col-md-8">
                        <h6 class="text-center fw-bold">Location wise Passenger (in Lakh) & Revenue (in crores)</h6>

                        <div class="table-responsive custom-scroll" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered text-center align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th rowspan="2">Station</th>
                                        <th colspan="2">2024-2025</th>
                                        <th colspan="2">2023-2024</th>
                                        <th colspan="2">2022-2023</th>
                                    </tr>
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

                    <div class="col-md-4">
                        <h6 class="text-center fw-bold">FINANCIAL YEAR WISE RESERVED/UNRESERVED REVENUE (in CRORES)</h6>
                        <div id="barChart" style="height: 300px;"
                            class="bg-light rounded d-flex justify-content-center align-items-center">
                            [Bar Chart Placeholder]
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Line Charts -->
    <script>
        const months = ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'];

        new Chart(document.getElementById('revenueChart'), {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                        label: '2024-2025',
                        data: [101.33, 112.16, 116.69, 151.96, 125.99, 129.19, 112.28, 101.06, 113.02, 117.44,
                            113.01, 150.05
                        ],
                        borderColor: '#fd7e14',
                        fill: false
                    },
                    {
                        label: '2023-2024',
                        data: [95, 108, 115, 140, 120, 130, 110, 99, 112, 114, 111, 145],
                        borderColor: '#ffc107',
                        fill: false
                    },
                    {
                        label: '2022-2023',
                        data: [90, 100, 105, 130, 115, 118, 108, 95, 109, 111, 108, 138],
                        borderColor: '#28a745',
                        fill: false
                    }
                ]
            }
        });

        new Chart(document.getElementById('passengerChart'), {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                        label: '2024-2025',
                        data: [13, 14.08, 14.68, 19.3, 16.28, 16.58, 14.59, 13.03, 14.59, 14.7, 13.88, 17.87],
                        borderColor: '#fd7e14',
                        fill: false
                    },
                    {
                        label: '2023-2024',
                        data: [12.5, 13.5, 14.2, 17.5, 15.8, 16.2, 14.1, 12.8, 14.2, 14.4, 13.6, 16.9],
                        borderColor: '#ffc107',
                        fill: false
                    },
                    {
                        label: '2022-2023',
                        data: [12, 13, 13.5, 16.5, 15, 15.5, 13.5, 12.5, 13.9, 14.1, 13.3, 16],
                        borderColor: '#28a745',
                        fill: false
                    }
                ]
            }
        });
    </script>


    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            const data1 = google.visualization.arrayToDataTable([
                ['Country', 'Revenue'],
                ['India', 40],
                ['USA', 20],
                ['UK', 25],
                ['Canada', 15]
            ]);

            const data2 = google.visualization.arrayToDataTable([
                ['Category', 'Passenger'],
                ['Bus', 50],
                ['Train', 30],
                ['Flight', 20],
                ['Canada', 15]
            ]);

            const data3 = google.visualization.arrayToDataTable([
                ['Source', 'Revenue'],
                ['Online', 60],
                ['Offline', 40],
                ['Flight', 20],
                ['Canada', 15]
            ]);

            const data4 = google.visualization.arrayToDataTable([
                ['City', 'Passenger'],
                ['Delhi', 20],
                ['Mumbai', 30],
                ['Chennai', 25],
                ['Kolkata', 25]
            ]);

            const options = {
                chartArea: {
                    width: '100%',
                    height: '100%'
                }
            };

            const chart1 = new google.visualization.PieChart(document.getElementById('chart1'));
            const chart2 = new google.visualization.PieChart(document.getElementById('chart2'));
            const chart3 = new google.visualization.PieChart(document.getElementById('chart3'));
            const chart4 = new google.visualization.PieChart(document.getElementById('chart4'));

            chart1.draw(data1, options);
            chart2.draw(data2, options);
            chart3.draw(data3, options);
            chart4.draw(data4, options);
        }
    </script>


    <script>
        google.charts.setOnLoadCallback(drawBarChart);

        function drawBarChart() {
            const data = google.visualization.arrayToDataTable([
                ['Year', 'Reserved', 'Unreserved'],
                ['2019-2020', 187.93, 726.54],
                ['2020-2021', 25.28, 318.62],
                ['2021-2022', 9.18, 812.75],
                ['2022-2023', 131.45, 1175.2]
            ]);

            const options = {
                chartArea: {
                    width: '70%'
                },
                isStacked: false,
                legend: {
                    position: 'top',
                    maxLines: 3
                },
                bar: {
                    groupWidth: '60%'
                },
                colors: ['#00bcd4', '#007bff'],
                hAxis: {
                    title: 'Revenue in Cr.',
                    minValue: 0,
                    format: 'decimal'
                }
            };

            const chart = new google.visualization.BarChart(document.getElementById('barChart'));
            chart.draw(data, options);
        }
    </script>
@endsection
