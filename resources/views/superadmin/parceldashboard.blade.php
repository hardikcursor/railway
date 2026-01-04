@extends('layouts.backend')

@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            <div class="ibox">
                <div class="header1">
                    PARCEL DASHBOARD(2025-26)
                </div>

                <div class="filters">
                    <div class="filter-group floating-label">
                        <label>Select Items</label>
                        <select class="form-select">
                            <option value="">Items</option>
                            @foreach ($item as $items)
                                <option value="{{ $items }}">
                                    {{ $items }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="filter-group floating-label">
                        <label>Select Station</label>
                        <select class="form-select">
                            <option value="">Station</option>
                            @foreach ($station as $stations)
                                <option value="{{ $stations }}">
                                    {{ $stations }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="filter-group floating-label">
                        <label>Select Date</label>
                        <input type="date" class="form-control">
                    </div>

                </div>


                <div class="row g-4 mb-4">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="kpi-card bg-primary">
                            <div class="kpi-title">Revenue (In Cr.)</div>
                            <div class="kpi-value">
                                <h4 class="text-white"> {{ number_format($revenueInCr, 2) }} <span
                                        class="text-white small">▼ -6.5%</span></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="kpi-card bg-success">
                            <div class="kpi-title">Weight (In Tonnes)</div>
                            <div class="kpi-value">
                                <h4 class="text-white">    {{ number_format($weightInTonnes, 2) }} <span class="text-white small">▲ 3.2%</span></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="kpi-card bg-warning">
                            <div class="kpi-title">Package (In Lakh)</div>
                            <div class="kpi-value">
                                <h4 class="text-white">   {{ number_format($packageInLakh, 2) }} <span class="text-white small">▲ 1.8%</span></h4>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-7 gap-4 mb-6">

                    <!-- KPIs (3 blocks) -->
                    <div class="lg:col-span-2 bg-white p-3 rounded-lg shadow-md text-center">
                        <p class="text-xs text-gray-500 mb-1">Revenue (In Cr.)</p>

                        <h3 class="text-xl font-bold text-gray-800">
                            {{ number_format($revenueInCr, 2) }}
                        </h3>

                        <p
                            class="text-sm flex items-center justify-center
                             {{ $revenuePercentage >= 0 ? 'text-green-600' : 'text-red-600' }}">

                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $revenuePercentage >= 0 ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}">
                                </path>
                            </svg>

                            {{ number_format($revenuePercentage, 1) }}%
                        </p>
                    </div>

                    <div class="lg:col-span-1 bg-white p-3 rounded-lg shadow-md text-center">
                        <p class="text-xs text-gray-500 mb-1">Weight (In Tonnes)</p>

                        <h3 class="text-xl font-bold text-gray-800">
                            {{ number_format($weightInTonnes, 2) }}
                        </h3>

                        <p
                            class="text-sm {{ $weightPercentage >= 0 ? 'text-green-600' : 'text-red-600' }}
                    flex items-center justify-center">

                            @if ($weightPercentage >= 0)
                                ▲
                            @else
                                ▼
                            @endif

                            {{ number_format(abs($weightPercentage), 2) }}%
                        </p>
                    </div>

                    <div class="lg:col-span-1 bg-white p-3 rounded-lg shadow-md text-center">
                        <p class="text-xs text-gray-500 mb-1">Package (In Lakh)</p>

                        <p class="text-xl font-bold text-gray-800">
                            {{ number_format($packageInLakh, 2) }}
                        </p>

                        <p
                            class="text-sm flex items-center justify-center
                             {{ $packagePercentage >= 0 ? 'text-green-600' : 'text-red-600' }}">

                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $packagePercentage >= 0 ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}">
                                </path>
                            </svg>

                            {{ number_format($packagePercentage, 1) }}%
                        </p>
                    </div>

                </div> --}}

                <div class="d-flex justify-content-end m-3">
                    <a href="{{ route('superadmin.parcelform') }}" class="btn btn-success">
                        <i class="ti-plus"></i> Create Parcel Form
                    </a>
                </div>


                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold mb-4">Month wise revenue generation (YOY)</h2>
                        <div class="chart-container">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold mb-4">Month wise weight ( In Metric Tones ) (YOY)</h2>
                        <div class="chart-container">
                            <canvas id="weightChart"></canvas>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold mb-4">Location wise (% Revenue generation)</h2>
                        <div class="chart-container flex items-center justify-center">
                            <canvas id="locationChart" class="max-w-xs"></canvas>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold mb-4">Items wise Revenue & Tonege</h2>
                        <div class="chart-container">
                            <canvas id="itemsChart"></canvas>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold mb-4">Revenue and Tonnage generation (YOY)</h2>
                        <div class="chart-container">
                            <canvas id="yoyBarChart"></canvas>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold mb-4">Items Composition</h2>
                        <div class="chart-container flex items-center justify-center">
                            <canvas id="compositionPieChart" class="max-w-xs"></canvas>
                        </div>
                    </div>

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

       
        
            .chart-container {
                height: 300px;
                width: 100%;
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




    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js">
    </script>

    <script>
 
        Chart.register(ChartDataLabels);

      
        const MONTHS = ['APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB', 'MAR'];
        const REVENUE_COLOR = '#1976D2'; 
        const WEIGHT_COLOR = '#00BCD4'; 


        const getBackgroundColor = (hex) => hex + '40'; 

        const revenueYOYData = {
            labels: MONTHS,
            datasets: [{
                    label: '2024-2025',
                    data: [5.76, 6.8, 6.0, 5.8, 6.0, 6.0, 5.8, 5.5, 5.3, 5.8, 6.0, 6.0], 
                    borderColor: '#4CAF50', 
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#4CAF50',
                    tension: 0.4,
                    datalabels: {
                        display: (context) => context.dataIndex < 3, 
                        align: 'end',
                        color: '#4CAF50',
                        formatter: (value) => value.toFixed(2),
                        font: {
                            size: 10
                        }
                    }
                },
                {
                    label: '2023-2024',
                    data: [7.5, 7.0, 7.5, 6.5, 7.0, 7.5, 7.5, 6.0, 5.2, 5.3, 5.5, 6.0], // Approx from 6.png
                    borderColor: '#9C27B0',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#9C27B0',
                    tension: 0.4
                },
                {
                    label: '2022-2023',
                    data: [9.5, 8.8, 7.5, 8.0, 7.8, 7.5, 8.0, 8.2, 7.0, 7.2, 7.5, 8.2], // Approx from 6.png
                    borderColor: '#FF9800',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#FF9800',
                    tension: 0.4
                },
            ]
        };

        new Chart(document.getElementById('revenueChart'), {
            type: 'line',
            data: revenueYOYData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                        }
                    },
                    title: {
                        display: false
                    },
                    datalabels: {}
                },
                scales: {
                    y: {
                        title: {
                            display: true,
                            text: 'Revenue (In Cr.)'
                        },
                        beginAtZero: true
                    }
                }
            }
        });


    
        const weightYOYData = {
            labels: MONTHS,
            datasets: [{
                    label: '2024-2025',
                    data: [2.75, 3.34, 3.04, 3.0, 3.0, 3.0, 3.0, 3.0, 3.0, 3.0, 3.0, 3.0], // Approx from 6.png
                    borderColor: '#4CAF50',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#4CAF50',
                    tension: 0.4,
                    datalabels: {
                        display: (context) => context.dataIndex < 3,
                        align: 'end',
                        color: '#4CAF50',
                        formatter: (value) => value.toFixed(2),
                        font: {
                            size: 10
                        }
                    }
                },
                {
                    label: '2023-2024',
                    data: [5.0, 5.5, 5.3, 5.8, 5.5, 5.8, 5.5, 5.8, 5.5, 2.5, 2.5, 2.8], // Approx from 6.png
                    borderColor: '#9C27B0',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#9C27B0',
                    tension: 0.4
                },
                {
                    label: '2022-2023',
                    data: [7.0, 6.5, 7.0, 6.5, 6.8, 7.0, 7.2, 5.8, 10.0, 5.5, 5.2, 5.8], // Approx from 6.png
                    borderColor: '#FF9800',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#FF9800',
                    tension: 0.4
                },
            ]
        };

        new Chart(document.getElementById('weightChart'), {
            type: 'line',
            data: weightYOYData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                        }
                    },
                    title: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        title: {
                            display: true,
                            text: 'Weight (In Tonnes)'
                        },
                        beginAtZero: true
                    }
                }
            }
        });

     
        const locationData = {
            labels: ['ADI', 'LCH', 'PNU', 'SBIB', 'ASV', 'GIMB', 'NBVJ', 'GNC', 'MSH', 'Other'],
            datasets: [{
                data: [61.6, 13, 16.1, 2.5, 1.5, 1.5, 1, 1, 1, 0.8],
                backgroundColor: [
                    REVENUE_COLOR, 
                    '#FF5722', 
                    '#E91E63', 
                    '#FFC107', 
                    '#4CAF50', 
                    '#009688', 
                    '#9E9E9E', 
                    '#607D8B', 
                    '#FF9800',
                    '#795548', 
                ],
                borderWidth: 1,
            }]
        };

        new Chart(document.getElementById('locationChart'), {
            type: 'doughnut',
            data: locationData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.formattedValue + '%';
                                return label;
                            }
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        formatter: (value, context) => {
                        
                            if (value > 5) {
                                return value.toFixed(1) + '%';
                            }
                            return '';
                        },
                        font: {
                            weight: 'bold',
                            size: 10
                        }
                    }
                }
            }
        });


       
        const itemsBarData = {
            labels: ['Leasing', 'Non-Perishable', 'RMT', 'Perishable', 'Luggage'],
            datasets: [{
                    type: 'bar',
                    label: 'Revenue(In Cr.)',
                    backgroundColor: REVENUE_COLOR,
                    data: [10.44, 4.42, 2.76, 0.33, 0.26], 
                    yAxisID: 'y1',
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        color: REVENUE_COLOR,
                        formatter: (value) => value.toFixed(2),
                        font: {
                            size: 10
                        }
                    }
                },
                {
                    type: 'bar',
                    label: 'Weight(MT)',
                    backgroundColor: WEIGHT_COLOR,
                    data: [145.43, 102.63, 133.33, 12.06, 3.60], 
                    yAxisID: 'y2',
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        color: WEIGHT_COLOR,
                        formatter: (value) => value.toFixed(2),
                        font: {
                            size: 10
                        }
                    }
                }
            ]
        };

        new Chart(document.getElementById('itemsChart'), {
            type: 'bar',
            data: itemsBarData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 10,
                            boxHeight: 10,
                            usePointStyle: false,
                        }
                    }
                },
                scales: {
                    x: {
                        stacked: false
                    },
                    y1: {
                        type: 'linear',
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Revenue(In Cr.)'
                        },
                        grid: {
                            drawOnChartArea: true
                        }
                    },
                    y2: {
                        type: 'linear',
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Weight(MT)'
                        },
                        grid: {
                            drawOnChartArea: false
                        },
                        min: 0,
                        max: 150 
                    }
                }
            }
        });

   
        const yoyBarChartData = {
            labels: ['2021-2022', '2022-2023', '2023-2024', '2020-2021', '2019-2020', '2024-2025'],
            datasets: [{
                    type: 'bar',
                    label: 'Frgt In Cr',
                    backgroundColor: REVENUE_COLOR,
                    data: [100.86, 94.33, 80.24, 77.67, 72.51, 18.2], 
                    yAxisID: 'y1',
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        color: REVENUE_COLOR,
                        formatter: (value) => value.toFixed(2),
                        font: {
                            size: 10
                        }
                    }
                },
                {
                    type: 'bar',
                    label: 'Weight (MT)',
                    backgroundColor: WEIGHT_COLOR,
                    data: [2607.05, 2725.5, 2079.02, 2318.34, 2092.01, 397.05], 
                    yAxisID: 'y2',
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        color: WEIGHT_COLOR,
                        formatter: (value) => value.toFixed(2),
                        font: {
                            size: 10
                        }
                    }
                }
            ]
        };

        new Chart(document.getElementById('yoyBarChart'), {
            type: 'bar',
            data: yoyBarChartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 10,
                            boxHeight: 10
                        }
                    }
                },
                scales: {
                    x: {
                        stacked: false
                    },
                    y1: {
                        type: 'linear',
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Frgt In Cr'
                        },
                        min: 0,
                        max: 150, 
                        grid: {
                            drawOnChartArea: true
                        }
                    },
                    y2: {
                        type: 'linear',
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Weight (MT)'
                        },
                        grid: {
                            drawOnChartArea: false
                        },
                        min: 0,
                        max: 3000 
                    }
                }
            }
        });


        const compositionPieData = {
            labels: ['Leasing', 'Non-Perishable', 'RMT', 'Perishable', 'Luggage'],
            datasets: [{
                data: [57.4, 24.3, 15.2, 1.6, 1.5], 
                backgroundColor: [
                    '#E91E63', 
                    '#673AB7', 
                    REVENUE_COLOR, 
                    '#FF9800', 
                    '#4CAF50', 
                ],
                borderWidth: 1,
            }]
        };

        new Chart(document.getElementById('compositionPieChart'), {
            type: 'pie',
            data: compositionPieData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: (context) => {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.formattedValue + '%';
                                return label;
                            }
                        }
                    },
                    datalabels: {
                        color: '#fff',
                        formatter: (value) => {
                            if (value > 5) {
                                return value.toFixed(1) + '%';
                            }
                            return '';
                        },
                        font: {
                            weight: 'bold',
                            size: 10
                        }
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    </script>
@endsection
