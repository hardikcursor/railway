@extends('layouts.backend')
<style>
    .custom-select-box {
        position: relative;
        width: 180px;
        user-select: none;
    }

    .custom-select-selected {
        padding: 7px 10px;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .custom-select-options {
        display: none;
        position: absolute;
        background: #fff;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 6px;
        margin-top: 4px;
        z-index: 100;
    }

    .custom-option {
        padding: 7px 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .custom-option:hover {
        background: #f2f2f2;
    }

    .icon {
        font-size: 17px;
    }

    .table-wrapper-fixed {
        width: 100%;
        overflow-x: auto !important;
        overflow-y: hidden;
        display: block;
        white-space: nowrap !important;
        -webkit-overflow-scrolling: touch;
    }

    .table-wrapper-fixed table {
        width: 100%;
        min-width: 1500px !important;
    }

    .table th,
    .table td {
        white-space: nowrap !important;
        vertical-align: middle !important;
    }
</style>
@section('main')
    <div class="content-wrapper">
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

                        
                            <div class="table-wrapper-fixed">
                                <table class="table table-striped table-bordered table-hover align-middle text-nowrap"
                                    id="example-table" cellspacing="0" width="100%">

                                    <thead class="table-dark">
                                        <tr>
                                            <th><input class="form-check-input" type="checkbox"></th>
                                            <th>Date</th>
                                            <th>Name of Inspector</th>
                                            <th>Station</th>
                                            <th>Type of Inspection</th>
                                            <th>Duration</th>
                                            <th>Send To Officer</th>
                                            <th>Current Status</th>
                                            <th>Download</th>
                                            <th>Checked</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($reports as $key => $report)
                                            <tr
                                                class="
                                                        @if ($report->last_clicked_by_role == 'user' || $report->last_clicked_by_role == 'admin') table-danger
                                                        @elseif($report->status == 'pending') table-warning
                                                        @elseif($report->status == 'sent') table-danger
                                                        @else table-success @endif
                                                    ">
                                                <td>{{ ++$key }}</td>

                                                <td>{{ $report->created_at->format('d-m-Y') }}</td>

                                                <td>{{ $report->NameInspector }}</td>

                                                <td>{{ $report->Station }}</td>

                                                <td>{{ $report->TypeofInspection }}</td>

                                                <td>{{ $report->Duration }}</td>

                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm showTextareaBtn"
                                                        data-id="{{ $report->id }}">
                                                        <i class="ti-control-forward"></i>
                                                    </button>

                                                    <form action="{{ route('admin.sendToAdmin', $report->id) }}"
                                                        method="POST" class="textareaForm mt-2 d-none">
                                                        @csrf

                                                        <label class="form-label fw-semibold">Select Officer</label>

                                                        <select name="officer" class="form-select form-select-sm mb-2"
                                                            required>
                                                            <option value="">-- Select Officer --</option>
                                                            @foreach ($officers as $officer)
                                                                <option value="{{ $officer->id }}">{{ $officer->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        <textarea name="remarks" class="form-control form-control-sm" rows="2" placeholder="Enter remarks"></textarea>

                                                        <button type="submit"
                                                            class="btn btn-success btn-sm mt-2">Send</button>
                                                    </form>
                                                </td>

                                                <td>
                                                    <div class="custom-select-box w-100">
                                                        <div class="custom-select-selected">Status</div>

                                                        <div class="custom-select-options">
                                                            @foreach ($report->forwardAdmins as $admin)
                                                                <div class="custom-option"
                                                                    data-value="{{ $admin->id }}">
                                                                    <span class="icon">
                                                                        @if ($admin->hasApproved)
                                                                            ✔️
                                                                        @else
                                                                            ❌
                                                                        @endif
                                                                    </span>
                                                                    <span>{{ $admin->name }}</span>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        <input type="hidden" name="forward_admin_status"
                                                            class="statusInput">
                                                    </div>
                                                </td>

                                                <td>
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('admin.reports.download', $report->id) }}">
                                                        Download
                                                    </a>
                                                </td>

                                                <td>
                                                    <form action="{{ route('admin.sendToApprove', $report->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-success btn-sm">Checked</button>
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
    </div>
    <!-- Chat Button -->
    <!-- Chat Open Button -->
    {{-- <button id="openChatBtn" style="position: fixed; bottom: 20px; right: 20px; padding: 10px 20px;">💬 Chat</button> --}}

    <!-- Overlay (hidden by default) -->
    {{-- <div id="chatOverlay"
        style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
    background: rgba(0, 0, 0, 0.3); z-index: 999;">
    </div> --}}

    <!-- Chat Box -->
    {{-- <div id="chatBox"
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
    </div> --}}

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
        const pieData = [10, 25, 15]; 

        const pieColors = [
            "#ffc107", 
            "#28a745", 
            "#dc3545" 
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
            }, 5000);
        });
    </script>

    <script>
        document.querySelectorAll('.showTextareaBtn').forEach(btn => {
            btn.addEventListener('click', function() {

                let form = this.closest('td').querySelector('.textareaForm');
                form.classList.toggle('d-none');
            });
        });
    </script>

    <script>
        document.querySelectorAll('.custom-select-box').forEach(selectBox => {
            const selected = selectBox.querySelector('.custom-select-selected');
            const options = selectBox.querySelector('.custom-select-options');
            const input = selectBox.querySelector('.statusInput');

            selected.addEventListener('click', () => {
                options.style.display =
                    options.style.display === "block" ? "none" : "block";
            });

            selectBox.querySelectorAll('.custom-option').forEach(option => {

                option.addEventListener('click', () => {
                    const icon = option.querySelector('.icon').innerHTML;
                    const text = option.innerText.trim();

                    selected.innerHTML = icon + " " + text;

                    input.value = option.dataset.value;

                    options.style.display = "none";
                });
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            document.querySelectorAll('.custom-select-box').forEach(selectBox => {
                if (!selectBox.contains(e.target)) {
                    selectBox.querySelector('.custom-select-options').style.display = 'none';
                }
            });
        });
    </script>
@endsection
