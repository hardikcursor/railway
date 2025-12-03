    @extends('layouts.backend')

    @section('main')
        <div class="content-wrapper">
            <div class="page-content fade-in-up">

                <div class="ibox">

                    <!-- HEADER -->
                    <div class="header1">COACHING DASHBOARD (2025-26)</div>

                    <!-- FILTERS -->
                    <div class="filters">
                        <div class="filter-group">
                            <select>
                                <option>Station</option>
                                <option>Mumbai</option>
                                <option>Delhi</option>
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

                    <!-- METRICS SECTION -->
                    <!-- METRICS SECTION -->
                    <div class="row mt-3">

                        <!-- CARD 1 -->
                        <div class="col-md-4 mb-3">
                            <div class="metric-card unreserved">
                                <div class="metric-title">Un-Reserved</div>

                                <div class="metric-columns">
                                    <div class="metric-column">
                                        <div class="metric-label">Passenger (In Lakh)</div>
                                        <div class="metric-value">187.9</div>
                                        <div class="metric-change positive"><span class="arrow-up"></span> 13.3%</div>
                                    </div>

                                    <div class="metric-column">
                                        <div class="metric-label">Revenue (In Cr.)</div>
                                        <div class="metric-value">253.29</div>
                                        <div class="metric-change positive"><span class="arrow-up"></span> 12.8%</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CARD 2 -->
                        <div class="col-md-4 mb-3">
                            <div class="metric-card total-earning">
                                <div class="metric-title">Total Passenger Earning</div>

                                <div class="metric-columns">
                                    <div class="metric-column">
                                        <div class="metric-label">Passenger (In Lakh)</div>
                                        <div class="metric-value">370.47</div>
                                        <div class="metric-change positive"><span class="arrow-up"></span> 8.2%</div>
                                    </div>

                                    <div class="metric-column">
                                        <div class="metric-label">Revenue (In Cr.)</div>
                                        <div class="metric-value">1,697.47</div>
                                        <div class="metric-change positive"><span class="arrow-up"></span> 8.2%</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CARD 3 -->
                        <div class="col-md-4 mb-3">
                            <div class="metric-card reserved">
                                <div class="metric-title">Reserved</div>

                                <div class="metric-columns">
                                    <div class="metric-column">
                                        <div class="metric-label">Passenger (In Lakh)</div>
                                        <div class="metric-value">182.57</div>
                                        <div class="metric-change positive"><span class="arrow-up"></span> 3.4%</div>
                                    </div>

                                    <div class="metric-column">
                                        <div class="metric-label">Revenue (In Cr.)</div>
                                        <div class="metric-value">1,444.18</div>
                                        <div class="metric-change positive"><span class="arrow-up"></span> 7.4%</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- CHART SECTION -->
                    <div class="chart-container">
                        <div class="chart-box">
                            <div id="revenue_chart_div" class="chart-area"></div>
                        </div>

                        <div class="chart-box">
                            <div id="pass_chart_div" class="chart-area"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="ticket-group">
                                <h3 class="group-title">Un-reserved Ticket</h3>

                                <div class="ticket-box">
                                    <div class="chart-title">Revenue (in Cr.)</div>
                                    <div id="unrev_revenue"></div>
                                </div>

                                <div class="ticket-box">
                                    <div class="chart-title">Passenger (in Lakh)</div>
                                    <div id="unrev_passenger"></div>
                                </div>
                            </div>
                        </div>




                        <!-- Chart 3 -->
                        <div class="col-6">
                            <div class="ticket-group">
                                <h3 class="group-title"> Reserved Ticket</h3>
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
                        <div class="table-section">
                            <table class="data-table">
                                <thead>
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
                                        <td class="station-name">ADI</td>
                                        <td>165</td>
                                        <td>883.5</td>
                                        <td>183</td>
                                        <td>1,010.36</td>
                                        <td>162</td>
                                        <td>908.84</td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="station-name">SBIB</td>
                                        <td>48</td>
                                        <td>300.2</td>
                                        <td>28</td>
                                        <td>121.63</td>
                                        <td>19</td>
                                        <td>71</td>
                                    </tr>
                                    <tr>
                                        <td class="station-name">GIMB</td>
                                        <td>18</td>
                                        <td>113.5</td>
                                        <td>17</td>
                                        <td>105.11</td>
                                        <td>14</td>
                                        <td>96</td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="station-name">MSH</td>
                                        <td>15</td>
                                        <td>40.21</td>
                                        <td>13</td>
                                        <td>35.19</td>
                                        <td>9</td>
                                        <td>28.3</td>
                                    </tr>
                                    <tr>
                                        <td class="station-name">VG</td>
                                        <td>11</td>
                                        <td>37.21</td>
                                        <td>11</td>
                                        <td>36.66</td>
                                        <td>10</td>
                                        <td>34.23</td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="station-name">PNU</td>
                                        <td>10</td>
                                        <td>33.13</td>
                                        <td>10</td>
                                        <td>31.86</td>
                                        <td>8</td>
                                        <td>29.02</td>
                                    </tr>
                                    <tr>
                                        <td class="station-name">BHUJ</td>
                                        <td>2</td>
                                        <td>10.08</td>
                                        <td>11</td>
                                        <td>74.88</td>
                                        <td>10</td>
                                        <td>66.93</td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="station-name">MAN</td>
                                        <td>6</td>
                                        <td>5.84</td>
                                        <td>6</td>
                                        <td>5.05</td>
                                        <td>5</td>
                                        <td>3.85</td>
                                    </tr>
                                    <tr>
                                        <td class="station-name">PTN</td>
                                        <td>8</td>
                                        <td>3.25</td>
                                        <td>6</td>
                                        <td>3.12</td>
                                        <td>3</td>
                                        <td>1.76</td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="station-name">ASV</td>
                                        <td>14</td>
                                        <td>52.98</td>
                                        <td>11</td>
                                        <td>44.18</td>
                                        <td>2</td>
                                        <td>4.11</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="chart-section">
                            <div class="legend">
                                <span class="reserved-color"></span> RESERVED
                                <span class="unreserved-color"></span> UNRESERVED
                            </div>

                            <div class="bar-chart">
                                <div class="chart-row">
                                    <span class="label">2019-2020</span>
                                    <div class="bar-group">
                                        <div class="unreserved-bar" style="width: 15%;"><span
                                                class="value">187.93</span></div>
                                        <div class="reserved-bar" style="width: 60%;">726.54</div>
                                    </div>
                                </div>

                                <div class="chart-row">
                                    <span class="label">2020-2021</span>
                                    <div class="bar-group">
                                        <div class="unreserved-bar negative" style="width: 2.5%;"></div>
                                        <div class="reserved-bar" style="width: 25%;">318.62</div>
                                    </div>
                                </div>

                                <div class="chart-row">
                                    <span class="label">2021-2022</span>
                                    <div class="bar-group">
                                        <div class="unreserved-bar negative" style="width: 1%;"></div>
                                        <div class="reserved-bar" style="width: 65%;">812.75</div>
                                    </div>
                                </div>

                                <div class="chart-row">
                                    <span class="label">2022-2023</span>
                                    <div class="bar-group">
                                        <div class="unreserved-bar negative" style="width: 10%;"></div>
                                        <div class="reserved-bar" style="width: 90%;">1,175.2</div>
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

                </div>

            </div>
        </div>



        <!-- CSS -->
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
                background: linear-gradient(to right, #4CAF50, #8BC34A);
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
                color: #4CAF50;
            }

            .arrow-up {
                width: 0;
                height: 0;
                border-left: 4px solid transparent;
                border-right: 4px solid transparent;
                border-bottom: 7px solid #4CAF50;
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

        <!-- GOOGLE CHART JS (Your Same Script) -->
        <script src="https://www.gstatic.com/charts/loader.js"></script>
        <script>
            google.charts.load('current', {
                packages: ['corechart']
            });
            google.charts.setOnLoadCallback(() => {
                drawRevenueChart();
                drawPassChart();
            });

            function drawRevenueChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Month', '2024-25', '2023-24', '2022-23'],
                    ['APR', 101.33, 112.16, 88],
                    ['MAY', 100, 116.69, 93],
                    ['JUN', 100, 151.96, 98],
                    ['JUL', 110, 125.99, 97],
                    ['AUG', 120, 129.19, 100],
                    ['SEP', 105, 112.28, 93],
                    ['OCT', 98, 101.06, 88],
                    ['NOV', 105, 113.02, 101],
                    ['DEC', 108, 117.44, 98],
                    ['JAN', 110, 113.01, 102],
                    ['FEB', 100, 110, 105],
                    ['MAR', 150.05, 112, 115]
                ]);

                var options = {
                    title: 'OPTIONAL METRICS RESVD/UNRESVD REVENUE',
                    legend: {
                        position: 'top'
                    },
                    curveType: 'function',
                };

                new google.visualization.LineChart(document.getElementById('revenue_chart_div')).draw(data, options);
            }

            function drawPassChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Month', '2024-25', '2023-24', '2022-23'],
                    ['APR', 12, 14.08, 13],
                    ['MAY', 12.5, 14.68, 13.5],
                    ['JUN', 14, 19.3, 14.8],
                    ['JUL', 16, 16.28, 14.5],
                    ['AUG', 16.5, 15.58, 14],
                    ['SEP', 14, 14.59, 12.5],
                    ['OCT', 13.5, 13.03, 13],
                    ['NOV', 14, 14.59, 14],
                    ['DEC', 12.8, 14.7, 13.8],
                    ['JAN', 13, 13.88, 13],
                    ['FEB', 13.5, 14, 12.5],
                    ['MAR', 15, 17.87, 14.5]
                ]);

                var options = {
                    title: 'OPTIONAL METRICS RESVD/UNRESVD PASS',
                    legend: {
                        position: 'top'
                    },
                    curveType: 'function',
                };

                new google.visualization.LineChart(document.getElementById('pass_chart_div')).draw(data, options);
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            function makeDonutChart(id, values, labels) {
                var options = {
                    chart: {
                        type: 'donut',
                        height: 260
                    },
                    series: values,
                    labels: labels,
                    legend: {
                        position: 'right'
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: (v) => v.toFixed(1) + "%"
                    }
                };
                new ApexCharts(document.querySelector(id), options).render();
            }

            const labels = ["ADI", "SBIB", "GIMB", "MISC", "NBVJ", "MSH", "PNU", "ASV", "VG", "Others"];

            makeDonutChart("#unrev_revenue", [44, 13.3, 7.5, 5, 4, 3.5, 3, 2.5, 2, 13.2], labels);
            makeDonutChart("#unrev_passenger", [34.9, 10.1, 8, 6, 5, 4.5, 3.2, 2.5, 2, 24.1], labels);

            makeDonutChart("#res_revenue", [53.5, 18.4, 6.5, 5, 4, 3, 2, 2, 1.5, 3], labels);
            makeDonutChart("#res_passenger", [54.9, 17.2, 6.8, 5.5, 4, 3.2, 3, 2.4, 1.8, 3], labels);
        </script>
    @endsection
