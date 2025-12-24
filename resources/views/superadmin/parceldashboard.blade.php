@extends('layouts.backend')

@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            <div class="ibox">
                <div class="header1">
                    PARCEL DASHBOARD(2025-26)
                </div>



                <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-7 gap-4 mb-6">

                    <!-- Filters (4 blocks) -->
                    <div class="lg:col-span-1">
                        <div class="dropdown relative w-full">
                            <button
                                class="w-full bg-white p-2 border border-gray-300 rounded-md shadow-sm flex justify-between items-center text-gray-700 text-sm hover:border-blue-500">
                                Items <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Mock Dropdown Content (Based on 2.png) -->
                            <div
                                class="dropdown-content mt-1 w-60 bg-white border border-gray-300 rounded-lg shadow-xl p-3">
                                @foreach ($item as $items)
                                    <option value="{{ $items }}">
                                        {{ $items }}
                                    </option>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1">
                        <div class="dropdown relative w-full">
                            <button
                                class="w-full bg-white p-2 border border-gray-300 rounded-md shadow-sm flex justify-between items-center text-gray-700 text-sm hover:border-blue-500">
                                Station <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Mock Dropdown Content (Based on 3.png) -->
                            <div
                                class="dropdown-content mt-1 w-60 bg-white border border-gray-300 rounded-lg shadow-xl p-3">
                                @foreach ($station as $stations)
                                    <option value="{{ $stations }}">
                                        {{ $stations }}
                                    </option>
                                @endforeach
                            </div>
                        </div>
                    </div>



                    <div class="lg:col-span-1">
                        <div class="dropdown relative w-full">
                            <button
                                class="w-full bg-white p-2 border border-gray-300 rounded-md shadow-sm flex justify-between items-center text-gray-700 text-sm hover:border-blue-500">
                                Apr 1, 2024 - Nov 30, 2024 <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Mock Date Picker Content (Based on 5.png) - Simplified UI -->
                            <div
                                class="dropdown-content mt-1 w-64 bg-white border border-gray-300 rounded-lg shadow-xl p-3 right-0 md:right-auto">
                                <div class="flex justify-between items-center mb-2 text-sm">
                                    <span>Start Date: **Apr 1, 2024**</span>
                                    <span>End Date: **Nov 30, 2024**</span>
                                </div>
                                <div class="grid grid-cols-7 gap-1 text-xs text-center font-semibold mb-2">
                                    <span>S</span><span>M</span><span>T</span><span>W</span><span>T</span><span>F</span><span>S</span>
                                </div>
                                <div class="grid grid-cols-7 gap-1 text-xs text-center">
                                    <!-- Mock April Calendar -->
                                    <span
                                        class="col-start-2">1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span>
                                    <span>7</span><span>8</span><span>9</span><span>10</span><span>11</span><span>12</span><span>13</span>
                                    <span>14</span><span>15</span><span>16</span><span>17</span><span>18</span><span>19</span><span>20</span>
                                    <span>21</span><span>22</span><span>23</span><span>24</span><span>25</span><span>26</span><span>27</span>
                                    <span>28</span><span class="text-white bg-blue-600 rounded">29</span><span>30</span>
                                </div>
                                <div class="flex justify-end space-x-2 mt-4">
                                    <button
                                        class="text-sm px-3 py-1 text-gray-600 rounded hover:bg-gray-100">Cancel</button>
                                    <button
                                        class="text-sm px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>

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

                </div>

                <div class="d-flex justify-content-end m-3">
                    <a href="{{ route('superadmin.parcelform') }}" class="btn btn-success">
                        <i class="ti-plus"></i> Create Parcel Form
                    </a>
                </div>


                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <!-- Chart 1: Month wise revenue generation (YOY) - Line Chart -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold mb-4">Month wise revenue generation (YOY)</h2>
                        <div class="chart-container">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>

                    <!-- Chart 2: Month wise weight (In Metric Tones) (YOY) - Line Chart -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold mb-4">Month wise weight ( In Metric Tones ) (YOY)</h2>
                        <div class="chart-container">
                            <canvas id="weightChart"></canvas>
                        </div>
                    </div>

                    <!-- Chart 3: Location wise (% Revenue generation) - Donut Chart -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold mb-4">Location wise (% Revenue generation)</h2>
                        <div class="chart-container flex items-center justify-center">
                            <canvas id="locationChart" class="max-w-xs"></canvas>
                        </div>
                    </div>

                    <!-- Chart 4: Items wise Revenue & Tonege - Bar Chart (Dual Axis) -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold mb-4">Items wise Revenue & Tonege</h2>
                        <div class="chart-container">
                            <canvas id="itemsChart"></canvas>
                        </div>
                    </div>

                    <!-- Chart 5: Revenue and Tonnage generation (YOY) - Bar Chart -->
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold mb-4">Revenue and Tonnage generation (YOY)</h2>
                        <div class="chart-container">
                            <canvas id="yoyBarChart"></canvas>
                        </div>
                    </div>

                    <!-- Chart 6: Revenue and Tonnage generation (YOY) - Pie Chart -->
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

        .dropdown-content {
            display: none;
            position: absolute;
            z-index: 10;
        }

        .dropdown:hover .dropdown-content,
        .dropdown.active .dropdown-content {
            display: block;
        }

        /* Custom class for the green/grey banner header */
        .dashboard-header-bg {
            background-image: linear-gradient(to right, #4CAF50 0%, #4CAF50 50%, #D3D3D3 50%, #D3D3D3 100%);
        }

        /* Custom chart styling */
        .chart-container {
            height: 300px;
            width: 100%;
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



    <!-- Load Chart.js for graphs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <!-- Load Chart.js Datalabels Plugin for showing values on bars/lines -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js">
    </script>

    <script>
        // Register the datalabels plugin globally for all charts
        Chart.register(ChartDataLabels);

        // --- COMMON DATA ---
        const MONTHS = ['APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC', 'JAN', 'FEB', 'MAR'];
        const REVENUE_COLOR = '#1976D2'; // Blue
        const WEIGHT_COLOR = '#00BCD4'; // Cyan

        // Utility function to get a lighter shade for backgrounds
        const getBackgroundColor = (hex) => hex + '40'; // Adds 40% opacity

        // --- CHART 1: MONTH WISE REVENUE (YOY) ---
        const revenueYOYData = {
            labels: MONTHS,
            datasets: [{
                    label: '2024-2025',
                    data: [5.76, 6.8, 6.0, 5.8, 6.0, 6.0, 5.8, 5.5, 5.3, 5.8, 6.0, 6.0], // Approx from 6.png
                    borderColor: '#4CAF50', // Green
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#4CAF50',
                    tension: 0.4,
                    datalabels: {
                        display: (context) => context.dataIndex < 3, // Display only first 3 labels
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
                    borderColor: '#9C27B0', // Purple/Pink
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#9C27B0',
                    tension: 0.4
                },
                {
                    label: '2022-2023',
                    data: [9.5, 8.8, 7.5, 8.0, 7.8, 7.5, 8.0, 8.2, 7.0, 7.2, 7.5, 8.2], // Approx from 6.png
                    borderColor: '#FF9800', // Orange
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


        // --- CHART 2: MONTH WISE WEIGHT (YOY) ---
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

        // --- CHART 3: LOCATION WISE REVENUE (DONUT) ---
        const locationData = {
            labels: ['ADI', 'LCH', 'PNU', 'SBIB', 'ASV', 'GIMB', 'NBVJ', 'GNC', 'MSH', 'Other'],
            datasets: [{
                data: [61.6, 13, 16.1, 2.5, 1.5, 1.5, 1, 1, 1, 0.8], // Approx from 7.png
                backgroundColor: [
                    REVENUE_COLOR, // Blue - ADI
                    '#FF5722', // Deep Orange - LCH
                    '#E91E63', // Pink - PNU
                    '#FFC107', // Amber - SBIB
                    '#4CAF50', // Green - ASV
                    '#009688', // Teal - GIMB
                    '#9E9E9E', // Grey - NBVJ
                    '#607D8B', // Blue Grey - GNC
                    '#FF9800', // Orange - MSH
                    '#795548', // Brown - Other
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
                            // Display label only for segments > 5% for readability
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


        // --- CHART 4: ITEMS WISE REVENUE & TONEGE - BAR CHART ---
        const itemsBarData = {
            labels: ['Leasing', 'Non-Perishable', 'RMT', 'Perishable', 'Luggage'],
            datasets: [{
                    type: 'bar',
                    label: 'Revenue(In Cr.)',
                    backgroundColor: REVENUE_COLOR,
                    data: [10.44, 4.42, 2.76, 0.33, 0.26], // Approx from 7.png
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
                    data: [145.43, 102.63, 133.33, 12.06, 3.60], // Approx from 7.png
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
                        max: 150 // Set max to match screenshot
                    }
                }
            }
        });

        // --- CHART 5: REVENUE AND TONNAGE GENERATION (YOY) - BAR CHART ---
        const yoyBarChartData = {
            labels: ['2021-2022', '2022-2023', '2023-2024', '2020-2021', '2019-2020', '2024-2025'],
            datasets: [{
                    type: 'bar',
                    label: 'Frgt In Cr',
                    backgroundColor: REVENUE_COLOR,
                    data: [100.86, 94.33, 80.24, 77.67, 72.51, 18.2], // Approx from 8.png
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
                    data: [2607.05, 2725.5, 2079.02, 2318.34, 2092.01, 397.05], // Approx from 8.png
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
                        max: 150, // Set max to match screenshot
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
                        max: 3000 // Set max to match screenshot
                    }
                }
            }
        });

        // --- CHART 6: ITEMS COMPOSITION (PIE) ---
        const compositionPieData = {
            labels: ['Leasing', 'Non-Perishable', 'RMT', 'Perishable', 'Luggage'],
            datasets: [{
                data: [57.4, 24.3, 15.2, 1.6, 1.5], // Approx from 8.png (57.4 + 24.3 + 15.2 + X + Y = 100)
                backgroundColor: [
                    '#E91E63', // Magenta - Leasing
                    '#673AB7', // Deep Purple - Non-Perishable
                    REVENUE_COLOR, // Blue - RMT
                    '#FF9800', // Orange - Perishable
                    '#4CAF50', // Green - Luggage
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
