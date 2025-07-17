@extends('layouts.backend')
@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Quarterly Records</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr class="text-dark">
                                <th>Sr.No</th>
                                <th>Date</th>
                                <th>Name of Inspector</th>
                                <th>Station</th>
                                <th>Type of Inspection</th>
                                {{-- <th>Duration</th>
                                <th>Send To Admin </th>
                                <th>Download</th> --}}
                                {{-- <th>Approve</th> --}}
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
                                    {{-- <td>{{ $report->Duration }}</td>
                                    <td>
                                        <form action="{{ route('posts.sendToAdmin', $report->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa-solid fa-share"></i></button>
                                        </form>
                                    </td> --}}
                                    {{-- <td><a class="btn btn-sm btn-primary"
                                            href="{{ route('reports.download', $report->id) }}">Download</a></td> --}}
                                    {{-- <td>
                                        <form action="{{ route('admin.approval', $report->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success">ok</button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
