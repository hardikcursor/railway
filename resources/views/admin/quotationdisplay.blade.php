@extends('layouts.backend')
@section('main')
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
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
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">Quotation</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                      <tbody>
                                    <tr>
                                        <td colspan="3">
                                            <h5 class="text-primary mb-2 mt-2">Booking Office Quotations</h5>
                                        </td>
                                    </tr>
                                    @foreach ($quotation as $key => $quotations)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $quotations->checks }}</td>
                                            <td>
                                                <div style="display: flex; align-items: center;">
                                                    <a href="#" class="text-success" style="margin-right: 10px;">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </a>
                                                    <a href="{{ route('admin.quotation.delete', ['model' => 'booking', 'id' => $quotations->id]) }}"
                                                        class="text-danger">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tbody>
                                    <tr>
                                        <td colspan="3">
                                            <h5 class="text-primary mb-2 mt-4">PRS Office Quotations</h5>
                                        </td>
                                    </tr>
                                    @foreach ($PRS_office as $key => $PRS_offices)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $PRS_offices->checks }}</td>
                                            <td>
                                                <div style="display: flex; align-items: center;">
                                                    <a href="#" class="text-success" style="margin-right: 10px;">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </a>
                                                    <a href="{{ route('admin.quotation.delete', ['model' => 'prs', 'id' => $PRS_offices->id]) }}"
                                                        class="text-danger">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>


                                <tbody>
                                    <tr>
                                        <td colspan="3">
                                            <h5 class="text-primary mb-2 mt-4">Parcel Office Quotations</h5>
                                        </td>
                                    </tr>
                                    @foreach ($Parcel_Office as $key => $Parcel_Offices)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $Parcel_Offices->checks }}</td>
                                            <td>
                                                <div style="display: flex; align-items: center;">
                                                    <a href="#" class="text-success" style="margin-right: 10px;">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </a>
                                                    <a href="{{ route('admin.quotation.delete', ['model' => 'parcel', 'id' => $Parcel_Offices->id]) }}"
                                                        class="text-danger">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </div>
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

    <script>
        setTimeout(function() {
            $('#flash-message').fadeOut('slow');
        }, 5000); // 5 seconds
    </script>
@endsection
