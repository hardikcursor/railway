@extends('layouts.backend')

@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            <div class="ibox">
                <div class="header1">
                    FREIGHT DASHBOARD(2025-26)
                </div>
                <div class="filters">
                    <div class="filter-group floating-label">
                        <label>Select Customer</label>
                        <select class="form-select">
                            <option value="">Customer</option>

                        </select>
                    </div>
                    <div class="filter-group floating-label">
                        <label>Select Location</label>
                        <select class="form-select">
                            <option value="">Location</option>

                        </select>
                    </div>
                    <div class="filter-group floating-label">
                        <label>Select Commodity</label>
                        <select class="form-select">
                            <option value="">Commodity</option>

                        </select>
                    </div>
                    <div class="filter-group floating-label">
                        <label>Select Date</label>
                        <input type="date" class="form-control">
                    </div>

                </div>

                <div class="row g-3 mb-4">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="kpi-card bg-primary">
                            <div class="kpi-title">Revenue (In Cr.)</div>
                            <div class="kpi-value">
                                <h4 class="text-white">467.47 <span class="text-white small">▼ -6.5%</span></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="kpi-card bg-success">
                            <div class="kpi-title">Weight (1000 Tons)</div>
                            <div class="kpi-value">
                                <h4 class="text-white">312.80 <span class="text-white small">▲ 3.2%</span></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="kpi-card bg-warning">
                            <div class="kpi-title">Wagons</div>
                            <div class="kpi-value">
                                <h4 class="text-white">298.15 <span class="text-white small">▲ 1.8%</span></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="kpi-card bg-danger">
                            <div class="kpi-title">Average Lead</div>
                            <div class="kpi-value">
                                <h4 class="text-white">14.65 <span class="text-white small">▼ -0.9%</span></h4>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-end m-3">
                    <a href="{{ route('superadmin.freightform') }}" class="btn btn-success">
                        <i class="ti-plus"></i> Import Freight
                    </a>
                </div>
                 <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Area Chart example</div>
                    </div>
                    <div class="ibox-body">
                        <div id="morris_area_chart" style="height:280px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Line Chart example</div>
                    </div>
                    <div class="ibox-body">
                        <div id="morris_line_chart" style="height:280px;"></div>
                    </div>
                </div>
            </div>
        </div>


                <div class="ibox-body">
                          <div class="col-md-6">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Bar Chart example</div>
                            </div>
                            <div class="ibox-body">
                                <div id="morris_bar_chart" style="height:280px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <h6 class="text-center fw-bold">Optional Metrics (Freight / Weight)</h6>
                    <div id="lineChart1" style="height: 250px;"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h6 class="text-center fw-bold">Month wise wagons loading</h6>
                    <div id="lineChart2" style="height: 250px;"></div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <h4 class="fw-bold text-center mb-4" style="font-size: 1.8rem;">Location Wise Revenue</h4>
                            <div id="chart1" style="width: 100%; height: 280px;"></div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <h4 class="fw-bold text-center mb-4" style="font-size: 1.8rem;">Commodity Wise Revenue</h4>
                            <div id="chart2" style="width: 100%; height: 280px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h6 class="fw-bold text-center mb-3">Month Wise Average Lead Position</h6>
                        <div id="chart3" style="width:100%; height:350px;"></div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <h6 class="text-center fw-bold mb-3">Customer Wise Revenue</h6>

                    <div class="table-responsive custom-scroll" style="max-height:400px; overflow-y:auto;">
                        <table class="table table-bordered table-striped table-hover text-center align-middle mb-0">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>commodity</th>
                                    <th>LOCATION</th>
                                    <th>Freight Cr</th>
                                    <th>% Δ</th>
                                    <th>Wagon</th>
                                    <th>% Δ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>SJM</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0.01</td>
                                    <td>0</td>
                                    <td>0.00</td>
                                    
                                </tr>
                      
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

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
                gap: 10px;
                background: #fff;
                padding: 12px;
                border-radius: 5px;
                border-top: 5px solid #6c9c6f;
                box-shadow: 0 2px 4px rgba(0, 0, 0, .15);
                flex-wrap: wrap
            }

            .filter-group {
                flex: 1;
                min-width: 180px;
                border: 1px solid #ccc;
                background: #fff;
                padding: 10px 15px;
                border-radius: 5px;
                position: relative
            }

            .filter-group select {
                width: 100%;
                padding: 10px 12px;
                font-size: 13px;
                border-radius: 6px;
                border: 1px solid #ccc
            }

            .floating-label label {
                position: absolute;
                top: -8px;
                left: 12px;
                background: #eef1f5;
                padding: 0 6px;
                font-size: 11px;
                font-weight: 600;
                color: #28a745
            }

            .kpi-card {
                padding: 20px;
                margin-top: 10px;
                border-radius: 12px;
                color: #fff;
                box-shadow: 0 6px 15px rgba(0, 0, 0, .15);
                text-align: center
            }

            .kpi-title {
                font-size: 14px;
                text-transform: uppercase
            }

            .kpi-value {
                font-size: 34px;
                font-weight: bold
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


        
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            var lineChart1 = new ApexCharts(document.querySelector("#lineChart1"), {
                chart: {
                    type: 'line',
                    height: 250,
                    toolbar: {
                        show: false
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                markers: {
                    size: 4
                },
                series: [{
                        name: '2025-2026',
                        data: [467.47, 480, 495, 510, 525, 540, 560, 575, 590, 605, 620, 635]
                    },
                    {
                        name: '2024-2025',
                        data: [450, 465, 480, 495, 510, 525, 540, 555, 570, 585, 600, 615]
                    },
                    {
                        name: '2023-2024',
                        data: [520, 540, 560, 580, 600, 620, 640, 660, 680, 700, 720, 740]
                    }
                ],
                xaxis: {
                    categories: months
                },
                legend: {
                    position: 'top'
                }
            });
            lineChart1.render();


            var lineChart2 = new ApexCharts(document.querySelector("#lineChart2"), {
                chart: {
                    type: 'line',
                    height: 250,
                    toolbar: {
                        show: false
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                markers: {
                    size: 4
                },
                series: [{
                        name: '2025-2026',
                        data: [93359, 94000, 94800, 95500, 96200, 97000, 97800, 98500, 99000, 99500, 100200, 101000]
                    },
                    {
                        name: '2024-2025',
                        data: [88000, 88500, 89000, 89500, 90000, 90500, 91000, 91500, 92000, 92500, 93000, 93500]
                    },
                    {
                        name: '2023-2024',
                        data: [75000, 75500, 76000, 76500, 77000, 77500, 78000, 78500, 79000, 79500, 80000, 80500]
                    }
                ],
                xaxis: {
                    categories: months
                },
                legend: {
                    position: 'top'
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
                        '#1976D2',
                        '#00BCD4',
                        '#FB8C00',
                        '#8E24AA',
                        '#EC407A',
                        '#E91E63',
                        '#FFB300',
                        '#FFCC80',
                        '#8BC34A',
                        '#64B5F6'
                    ]
                };

                var chart1 = new google.visualization.PieChart(document.getElementById('chart1'));
                chart1.draw(data1, options1);

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
                        '#1976D2',
                        '#00BCD4',
                        '#FB8C00',
                        '#8E24AA',
                        '#EC407A',
                        '#E91E63',
                        '#FFB300',
                        '#FFCC80',
                        '#8BC34A',
                        '#64B5F6'
                    ]
                };

                var chart2 = new google.visualization.PieChart(document.getElementById('chart2'));
                chart2.draw(data2, options2);

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
