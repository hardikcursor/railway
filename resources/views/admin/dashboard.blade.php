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
                            <div class="m-b-5">TOTAL INSPECTION</div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-info color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">{{ $pendingCount }}</h2>
                            <div class="m-b-5">PENDING INTRUCTIONS</div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-warning color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">{{ $forwardCount }}</h2>
                            <div class="m-b-5">FORWARD CONCERNED</div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-danger color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">{{ $replyPendingCount }}</h2>
                            <div class="m-b-5">TOTAL PENDING</div>
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <!-- Bar Chart Section -->
                <div class="col-lg-8 col-md-12 mb-4">
                    <div class="ibox">
                        <div class="ibox-body">
                            <h4 class="mb-3">Weekly Statistics</h4>
                            <canvas id="barChart" style="width:100%; height:300px;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart Section -->
                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Data Analysis</div>
                        </div>
                        <div class="ibox-body d-flex justify-content-center align-items-center" style="height: 100%;">
                            <canvas id="pieChart" style="width:100%; height:300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">All Record</div>
                            <div class="ibox-tools">
                                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>

                        <div class="ibox-body ">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" id="flash-message">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('info'))
                                <div class="alert alert-info alert-dismissible fade show" id="flash-message">
                                    {{ session('info') }}
                                </div>
                            @endif
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
                                        <th scope="col">Send To Officer </th>
                                        <th>Download Report</th>
                                        <th>Checked</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $key => $report)
                                        <tr
                                            class="
                                            @if ($report->last_clicked_by_role == 'user' || $report->last_clicked_by_role == 'admin') table-danger
                                            @elseif($report->status == 'pending')
                                                table-warning
                                            @elseif($report->status == 'sent')
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
                                                <form action="{{ route('admin.sendToAdmin', $report->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn {{ $report->last_clicked_by_role == 'admin' || $report->last_clicked_by_role == 'user' ? 'btn-danger' : 'btn-primary' }}">
                                                        <i class="ti-control-forward"></i>
                                                    </button>
                                                </form>

                                            </td>
                                            <td><a class="btn btn-sm btn-primary"
                                                    href="{{ route('admin.reports.download', $report->id) }}">Download</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.sendToApprove', $report->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Checked</button>
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
    <!-- Chat Button -->
    <!-- Chat Open Button -->
    <button id="openChatBtn" style="position: fixed; bottom: 20px; right: 20px; padding: 10px 20px;">💬 Chat</button>

    <!-- Overlay (hidden by default) -->
    <div id="chatOverlay"
        style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
    background: rgba(0, 0, 0, 0.3); z-index: 999;">
    </div>

    <!-- Chat Box -->
    <div id="chatBox"
        style="display: none; position: fixed; bottom: 70px; right: 20px; width: 300px; height: 400px;
    background: #fff; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.2);
    z-index: 1000;">
        <div
            style="background: #007bff; color: white; padding: 10px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
            Chat with us
            <button id="closeChatBtn" style="float: right; background: none; color: white; border: none;">✖</button>
        </div>

        <div id="chatMessages" style="padding: 10px; height: 300px; overflow-y: auto; border-bottom: 1px solid #ccc;">
            <p>Hello! How can we help you?</p>
        </div>

        <div style="display: flex; padding: 10px;">
            <input type="text" id="chatInput" placeholder="Type your message..."
                style="flex: 1; padding: 5px; margin-right: 5px;">
            <button id="sendChatBtn"
                style="background-color: #007bff; color: white; border: none; padding: 6px 10px; border-radius: 4px;">Send</button>
        </div>
    </div>

    <!-- Chat Box JavaScript -->
    <script>
        const openChatBtn = document.getElementById("openChatBtn");
        const closeChatBtn = document.getElementById("closeChatBtn");
        const chatBox = document.getElementById("chatBox");
        const chatOverlay = document.getElementById("chatOverlay");
        const sendChatBtn = document.getElementById("sendChatBtn");
        const chatMessages = document.getElementById("chatMessages");
        const chatInput = document.getElementById("chatInput");

        openChatBtn.addEventListener("click", function() {
            chatBox.style.display = "block";
            chatOverlay.style.display = "block";
            document.body.style.overflow = "hidden"; // disable scroll
        });

        closeChatBtn.addEventListener("click", function() {
            chatBox.style.display = "none";
            chatOverlay.style.display = "none";
            document.body.style.overflow = ""; // enable scroll
        });

        sendChatBtn.addEventListener("click", function() {
            const message = chatInput.value.trim();
            if (message !== "") {
                const newMsg = document.createElement("p");
                newMsg.textContent = "You: " + message;
                chatMessages.appendChild(newMsg);
                chatInput.value = "";
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        });
    </script>



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
        const pieData = [10, 25, 15]; // static values

        const pieColors = [
            "#ffc107", // Yellow for Pending
            "#28a745", // Green for Approved
            "#dc3545" // Red for Sent
        ];

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
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#flash-message").fadeOut('slow');
            }, 5000); // 5000ms = 5 seconds
        });
    </script>
@endsection
