@extends('layouts.backend')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            <div class="ibox">
                <div class="header1">Catering Dashboard (2024-25)</div>

                <div class="filters">
                    <div class="filter-group floating-label">
                        <label>Select Category</label>
                        <select class="form-select">
                            <option value="">All Category</option>
                            @foreach ($category as $categories)
                                <option value="{{ $categories }}">
                                    {{ $categories }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group floating-label">
                        <label>Select Station</label>
                        <select class="form-select">
                            <option value="">All Station</option>
                            @foreach ($station as $stations)
                                <option value="{{ $stations }}">
                                    {{ $stations }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group floating-label">
                        <label>Type OF Unit</label>
                        <select class="form-select">
                            <option value="">Select Type OF Unit</option>
                            @foreach ($unittype as $unitTypes)
                                <option value="{{ $unitTypes }}">
                                    {{ $unitTypes }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row g-3 mb-4">

                    <div class="col-md-4">
                        <div class="kpi-card bg-primary">
                            <div class="kpi-title">Total Units</div>
                            <div class="kpi-value">{{ $totalunit }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="kpi-card bg-success">
                            <div class="kpi-title">Annual L/Fee (Cr.)</div>
                            <div class="kpi-value">{{ $revenueInCr }}</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="kpi-card bg-warning">
                            <div class="kpi-title">L/Fee Paid (Cr.)</div>
                            <div class="kpi-value">{{ $fee_paidInCr }}</div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end m-3">
                    <a href="{{ route('superadmin.cateringform') }}" class="btn btn-success">
                        <i class="ti-plus"></i> Create Catering
                    </a>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-8 col-md-12 mb-4">
                <div class="chart-card">
                    <div class="chart-header">
                        <h5>Month wise License Fee Paid</h5>
                        <span class="unit">(In Lakh)</span>
                    </div>
                    <div class="chart-body">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 mb-4">
                <div class="chart-card">
                    <div class="chart-header text-center">
                        <h5>Unit Wise Details</h5>
                        <span class="unit">(Nos.)</span>
                    </div>
                    <div class="chart-body donut-body">
                        <canvas id="donutChart"></canvas>
                    </div>
                </div>
            </div>

        </div>

        <div class="card mb-3">
            <canvas id="barChart"></canvas>
        </div>

        <div class="bottom-row">
            <div class="card">
                <h4>Category Wise Station (Nos)</h4>
                <canvas id="pieChart"></canvas>
            </div>

            <div class="card">
                <h4>Station Details</h4>

                <div class="table-responsive-custom">
                    <table class="responsive-table">

                        <thead>
                            <tr>
                                <th>Stn</th>
                                <th>Category</th>
                                <th>Unit</th>
                                <th>Licensee</th>
                                <th>Annual (Cr.)</th>
                                <th>Paid (Cr.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carings as $catering)
                                <tr>
                                    <td>{{ $catering->station }}</td>
                                    <td>{{ $catering->category }}</td>
                                    <td>{{ $catering->unit_type }}</td>
                                    <td>{{ $catering->name }}</td>
                                    <td>{{ $catering->annual_fee }}</td>
                                    <td>{{ $catering->fee_paid }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box
            }

            .ibox {
                background: #f0f2f5;
                padding: 20px;
                border-radius: 8px
            }

            .header1 {
                background: linear-gradient(to right, #4caf50, #8bc34a);
                padding: 15px;
                font-size: 24px;
                text-align: center;
                font-weight: bold;
                border-radius: 5px;
                color: #000;
                box-shadow: 0 2px 5px rgba(0, 0, 0, .2);
                margin-bottom: 20px
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

            .chart-card {
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 6px 18px rgba(0, 0, 0, .12);
                height: 100%
            }

            .chart-header {
                padding: 15px 20px;
                border-bottom: 1px solid #eee
            }

            .chart-body {
                padding: 15px 20px;
                height: 320px
            }

            .donut-body {
                display: flex;
                align-items: center;
                justify-content: center
            }

            .card {
                background: #fff;
                padding: 12px;
                border-radius: 6px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, .1)
            }

            .bottom-row {
                display: grid;
                grid-template-columns: 1fr 2fr;
                gap: 15px
            }

            .table-responsive-custom {
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .responsive-table {
                width: 100%;
                min-width: 700px;
                border-collapse: collapse;
                font-size: 13px;
            }

            .responsive-table th,
            .responsive-table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
                white-space: nowrap;
            }

            .responsive-table th {
                background: #f1f1f1;
                font-weight: 600;
                position: sticky;
                top: 0;
                z-index: 2;
            }

            /* Mobile optimization */
            @media (max-width: 768px) {
                .responsive-table {
                    font-size: 12px;
                }
            }


            @media(max-width:768px) {
                .filters {
                    flex-direction: column
                }

                .chart-body {
                    height: 280px
                }

                .bottom-row {
                    grid-template-columns: 1fr
                }
            }
        </style>

        <script>
            new Chart(document.getElementById('lineChart'), {
                type: 'line',
                data: {
                    labels: ['APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB'],
                    datasets: [{
                        label: 'Fee Paid',
                        data: [8.03, 6.44, 9.05, 10.13, 14.43, 14.68, 12.31, 16.17, 16.46, 14.43, 14.07],
                        borderColor: '#ff7f0e',
                        tension: .3
                    }]
                }
            })


            const ctx = document.getElementById('donutChart').getContext('2d');

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: [
                        'Surat',
                        'Vadodara',
                        'Ahmedabad',
                        'Rajkot',
                        'Bhavnagar'
                    ],
                    datasets: [{
                        data: [120, 90, 150, 70, 60],
                        backgroundColor: [
                            '#4e79a7',
                            '#f28e2b',
                            '#e15759',
                            '#76b7b2',
                            '#59a14f'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    plugins: {
                        legend: {
                            position: 'right', // 🔥 RIGHT SIDE
                            labels: {
                                boxWidth: 12,
                                padding: 15,
                                font: {
                                    size: 12,
                                    weight: '500'
                                }
                            }
                        }
                    }
                }
            });



            new Chart(document.getElementById('barChart'), {
                type: 'bar',
                data: {
                    labels: ['APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB'],
                    datasets: [{
                            label: 'Annual Fee',
                            data: [3.36, 3.36, 3.36, 3.36, 3.36, 3.36, 3.32, 3.35, 3.35, 3.30, 3.27],
                            backgroundColor: '#198754'
                        },
                        {
                            label: 'Fee Paid',
                            data: [0.08, 0.06, 0.09, 0.10, 0.14, 0.15, 0.12, 0.16, 0.16, 0.14, 0.14],
                            backgroundColor: '#a61e4d'
                        }
                    ]
                }
            })

            new Chart(document.getElementById('pieChart'), {
                type: 'pie',
                data: {
                    labels: ['NSG1', 'NSG2', 'NSG5', 'NSG6'],
                    datasets: [{
                        data: [11, 6, 8, 1],
                        backgroundColor: ['#0dcaf0', '#ff006e', '#ffbe0b', '#3a86ff']
                    }]
                }
            })
        </script>
    @endsection



