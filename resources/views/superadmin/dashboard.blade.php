@extends('layouts.backend')
@section('main')
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
           <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-success color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">{{ $totalInspections }}</h2>
                            <div class="m-b-5">TOTAL INSPECTION</div><i class="ti-shopping-cart widget-stat-icon"></i>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-info color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">{{ $pendingCount }}</h2>
                            <div class="m-b-5">PENDING INTRUCTIONS</div><i class="ti-bar-chart widget-stat-icon"></i>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-warning color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">{{ $forwardCount }}</h2>
                            <div class="m-b-5">FORWARD CONCERNED</div><i class="fa fa-money widget-stat-icon"></i>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-danger color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">{{ $replyPendingCount }}</h2>
                            <div class="m-b-5">TOTAL PENDING</div><i class="ti-user widget-stat-icon"></i>
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="row">
                <!-- Bar Chart -->
                <div class="col-lg-8 col-md-12 mb-4">
                    <div class="ibox">
                        <div class="ibox-body">
                            <h4 class="mb-3">Weekly Statistics</h4>
                            <canvas id="barChart" style="width:100%; height:300px;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title"> Data Analysis</div>
                        </div>
                        <div class="ibox-body d-flex justify-content-center align-items-center" style="height: 100%;">
                            <canvas id="pieChart" style="width:100%; height:300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

 

            <!-- Latest Records Table -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Latest Record</div>
                            <div class="ibox-tools">
                                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Name of Inspector</th>
                                        <th scope="col">Station</th>
                                        <th scope="col">Type of Inspection</th>
                                        <th scope="col">Duration</th>
                                        <th>Download</th>
                                        <th>Approve</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $key => $report)
                                        <tr
                                            class="
                                            @if ($report->last_clicked_by_role == 'admin') table-danger
                                            @elseif ($report->status == 'pending')
                                                table-warning
                                            @elseif ($report->status == 'sent')
                                                table-danger
                                            @else
                                                table-success @endif
                                        ">
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $report->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $report->NameInspector }}</td>
                                            <td>{{ $report->Station }}</td>
                                            <td>{{ $report->TypeofInspection }}</td>
                                            <td>{{ $report->Duration }}</td>
                                            <td>
                                           <a class="btn btn-sm btn-primary" href="{{ route('superadmin.reports.download', $report->id) }}">Download</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('superadmin.approval', $report->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">ok</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <script>
        // Bar Chart
        new Chart("barChart", {
            type: "bar",
            data: {
                labels: ["Italy", "France", "Spain", "USA", "Argentina"],
                datasets: [{
                    backgroundColor: ["red", "green", "blue", "orange", "brown"],
                    data: [55, 49, 44, 24, 15]
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Pie Chart
        const pieLabels = ["Pending", "Approved", "Sent"];
        const pieData = [{{ $pendingCount }}, {{ $approvedReports }}, {{ $forwardCount }}];
        const pieColors = ["#ffc107", "#28a745", "#dc3545"];

        new Chart("pieChart", {
            type: "pie",
            data: {
                labels: pieLabels,
                datasets: [{
                    backgroundColor: pieColors,
                    data: pieData
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Report Status Breakdown"
                }
            }
        });

        // Chatbox Show/Hide (Updated for multiple buttons)
        const chatbox = document.getElementById('chatbox');
        const closeChat = document.getElementById('close-chat');

        chatbox.style.display = 'none';

        document.querySelectorAll('.open-chat').forEach(button => {
            button.addEventListener('click', () => {
                let reportId = button.getAttribute('data-report-id');

                // Optional: You can store the reportId to load previous messages or send it to backend
                chatbox.setAttribute('data-report-id', reportId);

                chatbox.style.display = 'block';
                chatbox.style.position = 'fixed';
                chatbox.style.bottom = '80px';
                chatbox.style.right = '20px';
                chatbox.style.width = '300px';
                chatbox.style.border = '1px solid #ccc';
                chatbox.style.borderRadius = '10px';
                chatbox.style.boxShadow = '0 0 10px rgba(0,0,0,0.3)';
                chatbox.style.background = '#fff';
                chatbox.style.zIndex = '9999';
            });
        });

        closeChat.addEventListener('click', () => {
            chatbox.style.display = 'none';
        });

        // Chat Send Button
        document.getElementById('send-button').addEventListener('click', function() {
            let input = document.getElementById('chat-input');
            let message = input.value.trim();
            if (message !== '') {
                let chatBody = document.getElementById('chat-messages');

                // User Message
                let newMessage = document.createElement('div');
                newMessage.classList.add('message', 'right', 'p-2', 'mb-2', 'text-white', 'bg-primary', 'rounded');
                newMessage.style.maxWidth = '75%';
                newMessage.style.alignSelf = 'flex-end';
                newMessage.textContent = message;
                chatBody.appendChild(newMessage);

                input.value = '';
                chatBody.scrollTop = chatBody.scrollHeight;

                // Optional: Send message to backend using AJAX with reportId
                // let reportId = chatbox.getAttribute('data-report-id');
            }
        });
    </script>
@endsection
