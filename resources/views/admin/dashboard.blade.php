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
                            <div><i class="fa fa-level-up m-r-5"></i><small>25% higher</small></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-info color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">{{ $pendingCount }}</h2>
                            <div class="m-b-5">PENDING INTRUCTIONS</div><i class="ti-bar-chart widget-stat-icon"></i>
                            <div><i class="fa fa-level-up m-r-5"></i><small>17% higher</small></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-warning color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">{{ $forwardCount }}</h2>
                            <div class="m-b-5">FORWARD CONCERNED</div><i class="fa fa-money widget-stat-icon"></i>
                            <div><i class="fa fa-level-up m-r-5"></i><small>22% higher</small></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ibox bg-danger color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong">{{ $replyPendingCount }}</h2>
                            <div class="m-b-5">TOTAL PENDING</div><i class="ti-user widget-stat-icon"></i>
                            <div><i class="fa fa-level-down m-r-5"></i><small>-12% Lower</small></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="ibox">
                        <div class="ibox-body">
                            <div class="flexbox mb-4">
                                <div>
                                    <h3 class="m-0">Statistics</h3>
                                    <div>Your shop sales analytics</div>
                                </div>
                                <div class="d-inline-flex">
                                    <div class="px-3" style="border-right: 1px solid rgba(0,0,0,.1);">
                                        <div class="text-muted">WEEKLY INCOME</div>
                                        <div>
                                            <span class="h2 m-0">$850</span>
                                            <span class="text-success ml-2"><i class="fa fa-level-up"></i>
                                                +25%</span>
                                        </div>
                                    </div>
                                    <div class="px-3">
                                        <div class="text-muted">WEEKLY SALES</div>
                                        <div>
                                            <span class="h2 m-0">240</span>
                                            <span class="text-warning ml-2"><i class="fa fa-level-down"></i>
                                                -12%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <canvas id="bar_chart" style="height:260px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Statistics</div>
                        </div>
                        <div class="ibox-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <canvas id="doughnut_chart" style="height:160px;"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <div class="m-b-20 text-success"><i class="fa fa-circle-o m-r-10"></i>Desktop
                                        52%</div>
                                    <div class="m-b-20 text-info"><i class="fa fa-circle-o m-r-10"></i>Tablet 27%
                                    </div>
                                    <div class="m-b-20 text-warning"><i class="fa fa-circle-o m-r-10"></i>Mobile 21%
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-divider list-group-full">
                                <li class="list-group-item">Chrome
                                    <span class="float-right text-success"><i class="fa fa-caret-up"></i> 24%</span>
                                </li>
                                <li class="list-group-item">Firefox
                                    <span class="float-right text-success"><i class="fa fa-caret-up"></i> 12%</span>
                                </li>
                                <li class="list-group-item">Opera
                                    <span class="float-right text-danger"><i class="fa fa-caret-down"></i> 4%</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Visitors Statistics</div>
                        </div>
                        <div class="ibox-body">
                            <div id="world-map" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Latest Orders</div>
                            <div class="ibox-tools">
                                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item">option 1</a>
                                    <a class="dropdown-item">option 2</a>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-body ">
                            <table class="table table-striped table-bordered table-hover" id="example-table"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Name of Inspector</th>
                                        <th scope="col">Station</th>
                                        <th scope="col">Type of Inspection</th>
                                        <th scope="col">Duration</th>
                                        <th scope="col">Send To Admin </th>
                                        <th>Download</th>
                                        <th>Approve</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                         
                         
                         
                                    <tr
                                            class="
                                    {{ $report->status == 'pending'
                                        ? 'table-warning'
                                        : ($report->status == 'sent'
                                            ? 'table-danger'
                                            : 'table-success') }}">
                                            <td><input class="form-check-input" type="checkbox"></td>
                                            <td>{{ $report->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $report->NameInspection }}</td>
                                            <td>{{ $report->Station }}</td>
                                            <td>{{ $report->TypeofInspection }}</td>
                                            <td>{{ $report->Duration }}</td>
                                            <td>
                                                <form action="#" >
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa-solid fa-share"></i></button>
                                                </form>
                                            </td>
                                            <td><a class="btn btn-sm btn-primary"
                                                    href="{{ route('admin.reports.download', $report->id) }}">Download</a>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.sendToAdmin', $report->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">ok</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
