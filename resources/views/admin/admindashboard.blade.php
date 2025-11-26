@extends('layouts.backend')
@section('main')
    <div class="content-wrapper">
        <h2>INSPECTION DASHBOARD</H2>
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
             <h2>PAY AND PARK DASHBOARD</H2>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-success color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">22</h2>
                            <div class="m-b-5">TOTAL REVENUE</div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-info color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">12</h2>
                            <div class="m-b-5">DAILY REVENUE</div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-warning color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">34</h2>
                            <div class="m-b-5">CATEGORY REVENUE</div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-danger color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">34</h2>
                            <div class="m-b-5">BLANK</div>
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
            <h2>CATERING DASHBOARD</H2>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-success color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">12</h2>
                            <div class="m-b-5">MONTH WISE LICENSE FEE PAID</div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-info color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">23</h2>
                            <div class="m-b-5">BLANK</div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-warning color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">13</h2>
                            <div class="m-b-5">BLANK</div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-danger color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">34</h2>
                            <div class="m-b-5">BLANK</div>
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
            <H2>CLEANING DASHBOARD</H2>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-success color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">23</h2>
                            <div class="m-b-5">QUERY SLOVED</div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-info color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">12</h2>
                            <div class="m-b-5">QUERY PENDING </div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-warning color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">22</h2>
                            <div class="m-b-5">DAILY PENALTY REVENUE</div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-danger color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">23</h2>
                            <div class="m-b-5">TOTAL REVENUE</div>
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
@endsection
