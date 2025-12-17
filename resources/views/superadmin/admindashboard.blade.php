@extends('layouts.backend')

@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            <div class="ibox">

                <div class="header1">OVER ALL DASHBOARD (2025-26)</div>

                <div class="row mt-3">

                    <div class="col-md-4 mb-3">
                        <a href="{{ route('superadmin.freightdashboard') }}" class="metric-card-link">
                            <div class="metric-card unreserved">
                                <div class="metric-title">Freight Revenue</div>
                                <div class="metric-columns">
                                    <div class="metric-column">
                                        <div class="metric-label">Target</div>
                                        <div class="metric-value">122.99</div>
                                    </div>
                                    <div class="metric-column">
                                        <div class="metric-label">Position</div>
                                        <div class="metric-value">122.99</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 mb-3">
                        <a href="{{ route('superadmin.parceldashboard') }}" class="metric-card-link">
                            <div class="metric-card reserved">
                                <div class="metric-title">Parcel</div>
                                <div class="metric-columns">
                                    <div class="metric-column">
                                        <div class="metric-label">Target</div>
                                        <div class="metric-value">122.99</div>
                                    </div>
                                    <div class="metric-column">
                                        <div class="metric-label">Position</div>
                                        <div class="metric-value">122.99</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 mb-3">
                        <a href="https://pms.cursorsoft.in/user/dashboard" class="metric-card-link">
                            <div class="metric-card reserved">
                                <div class="metric-title">Pay & Park</div>
                                <div class="metric-columns">
                                    <div class="metric-column">
                                        <div class="metric-label">Target</div>
                                        <div class="metric-value">122.99</div>
                                    </div>
                                    <div class="metric-column">
                                        <div class="metric-label">Position</div>
                                        <div class="metric-value">122.99</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>

                <!-- Repeat the same wrapping for other cards -->
                <div class="row mt-3">

                    <div class="col-md-4 mb-3">
                        <a href="#" class="metric-card-link">
                            <div class="metric-card unreserved">
                                <div class="metric-title">Catering</div>
                                <div class="metric-columns">
                                    <div class="metric-column">
                                        <div class="metric-label">Target</div>
                                        <div class="metric-value">122.99</div>
                                    </div>
                                    <div class="metric-column">
                                        <div class="metric-label">Position</div>
                                        <div class="metric-value">122.99</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 mb-3">
                        <a href="{{ route('superadmin.coachingdashboard') }}" class="metric-card-link">
                            <div class="metric-card reserved">
                                <div class="metric-title">Coaching</div>
                                <div class="metric-columns">
                                    <div class="metric-column">
                                        <div class="metric-label">Target</div>
                                        <div class="metric-value">122.99</div>
                                    </div>
                                    <div class="metric-column">
                                        <div class="metric-label">Position</div>
                                        <div class="metric-value">122.99</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 mb-3">
                        <a href="#" class="metric-card-link">
                            <div class="metric-card reserved">
                                <div class="metric-title">Exp Contract</div>
                                <div class="metric-columns">
                                    <div class="metric-column">
                                        <div class="metric-label">Target</div>
                                        <div class="metric-value">122.99</div>
                                    </div>
                                    <div class="metric-column">
                                        <div class="metric-label">Position</div>
                                        <div class="metric-value">122.99</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>

                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('superadmin.taskmanager') }}" class="metric-card-link">
                            <div class="metric-card reserved">
                                <div class="metric-title text-center mb-3">Task Manager (App)</div>
                                <div class="metric-columns">
                                    <div class="metric-column">
                                        <div class="metric-label">Target</div>
                                        <div class="metric-value">79</div>
                                    </div>
                                    <div class="metric-column">
                                        <div class="metric-label">Pending</div>
                                        <div class="metric-value">27</div>
                                    </div>
                                    <div class="metric-column">
                                        <div class="metric-label">Completed</div>
                                        <div class="metric-value">3</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 mb-3">
                        <a href="#" class="metric-card-link">
                            <div class="metric-card reserved">
                                <div class="metric-title text-center mb-3">NonFare Revenue</div>
                                <div class="metric-columns">
                                    <div class="metric-column">
                                        <div class="metric-label">Target</div>
                                        <div class="metric-value">122.99</div>
                                    </div>
                                    <div class="metric-column">
                                        <div class="metric-label">Position</div>
                                        <div class="metric-value">122.99</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 mb-3">
                        <a href="#" class="metric-card-link">
                            <div class="metric-card reserved">
                                <div class="metric-title text-center mb-3">Over all Revenue</div>
                                <div class="metric-columns">
                                    <div class="metric-column">
                                        <div class="metric-label">Revenue</div>
                                        <div class="metric-value">122.99</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 mb-3">
                        <a href="{{ route('superadmin.ticketchecking') }}" class="metric-card-link">
                            <div class="metric-card reserved">
                                <div class="metric-title text-center mb-3">Ticket Checking</div>
                                <div class="metric-columns">
                                    <div class="metric-column">
                                        <div class="metric-label">Total Cases</div>
                                        <div class="metric-value">00.00</div>
                                    </div>

                                    <div class="metric-column">
                                        <div class="metric-label">Amount</div>
                                        <div class="metric-value">00.00</div>
                                    </div>
                                </div>
                            </div>
                        </a>
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

            .metric-card-link {
                text-decoration: none;
                color: inherit;
                display: block;
                transition: box-shadow 0.3s ease;
                border-radius: 8px;
            }

            .metric-card-link:hover .metric-card {
                box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25);
                transform: translateY(-4px);
                transition: all 0.3s ease;
            }

            .metric-card {
                background: #fff;
                border-radius: 8px;
                padding: 20px;
                box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
                transition: all 0.3s ease;
                height: 100%;
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
                flex-wrap: nowrap;
            }

            .metric-column {
                flex: 1;
                background: #fff;
                padding: 30px 20px;
                border-radius: 16px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
                text-align: center;
                margin: 0 8px;
            }

            .metric-label {
                font-size: 20px;
                font-weight: 700;
                margin-bottom: 10px;
            }

            .metric-value {
                font-size: 32px;
                font-weight: 800;
            }

            .metric-change {
                margin-top: 10px;
                font-size: 18px;
                font-weight: 600;
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

            .table-section {
                flex: 2;
                background-color: #fff;
                padding: 10px;
                border: 1px solid #ddd;
            }

            .chart-section {
                flex: 1.5;
                background-color: #fff;
                padding: 10px;
                border: 1px solid #ddd;
            }

            .metric-columns {
                display: flex;
                gap: 25px;
                justify-content: space-between;
            }

            .metric-columns .metric-column {
                flex: 1;
                background: #f9f9f9;
                padding: 12px 10px;
                border-radius: 10px;
                text-align: center;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                margin: 0 8px;
            }

            .metric-columns .metric-value {
                font-size: 22px;
                font-weight: bold;
                margin: 5px 0;
            }

            .metric-columns .metric-label {
                font-size: 14px;
                color: #555;
            }

            .metric-columns .metric-change {
                margin-top: 5px;
            }

            .wide-box {
                padding: 50px !important;
                min-width: 420px;
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
            }
        </style>
    @endsection
