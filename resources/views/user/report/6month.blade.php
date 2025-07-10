@extends('layouts.backend')
@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">6 Month Records</div>
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
                                <th scope="col">Send To Admin </th>
                                <th>Download</th>
                                <th>Approve</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                                <tr
                                    class="{{ $report->status == 'pending' ? 'table-warning' : ($report->status == 'sent' ? 'table-danger' : 'table-success') }}">
                                    <td><input class="form-check-input" type="checkbox"></td>
                                    <td>{{ $report->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $report->NameInspector }}</td>
                                    <td>{{ $report->Station }}</td>
                                    <td>{{ $report->TypeofInspection }}</td>
                                    <td>{{ $report->Duration }}</td>
                                    <td>
                                        <form action="{{ route('posts.sendToAdmin', $report->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa-solid fa-share"></i></button>
                                        </form>
                                    </td>
                                    <td><a class="btn btn-sm btn-primary"
                                            href="{{ route('reports.download', $report->id) }}">Download</a></td>
                                    <td>
                                        <form action="{{ route('admin.approval', $report->id) }}" method="POST">
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
