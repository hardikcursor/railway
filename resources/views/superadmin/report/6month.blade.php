@extends('layouts.backend')
@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Half Yearly Records</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">Sr.No</th>
                                <th scope="col">Date</th>
                                <th scope="col">Name of Inspector</th>
                                <th scope="col">Station</th>
                                <th scope="col">Type of Inspection</th>
                                <th>Download</th>
                                <th>Approve</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $key => $report)
                                <tr
                                    class="{{ $report->status == 'pending' ? 'table-warning' : ($report->status == 'sent' ? 'table-danger' : 'table-success') }}">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $report->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $report->NameInspector }}</td>
                                    <td>{{ $report->Station }}</td>
                                    <td>{{ $report->TypeofInspection }}</td>
                                
                                    <td><a class="btn btn-sm btn-primary"
                                            href="{{ route('admin.reports.download', $report->id) }}">Download</a></td>
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
@endsection
