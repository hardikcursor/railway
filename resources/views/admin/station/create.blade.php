@extends('layouts.backend')
@section('main')
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-heading">
            <h1 class="page-title">Station Form</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html"><i class="la la-home font-20"></i></a>
                </li>
            </ol>
        </div>
        <div class="page-content fade-in-up">
            <div class="row">

                <div class="col-md-6">
                    <div>
                        @if (session('success'))
                            <div class="alert alert-info alert-dismissible fade show" id="flash-message">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Station form</div>
                        </div>
                        <div class="ibox-body">
                            <form action="{{ route('admin.station.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Station Name</label>
                                    <input class="form-control @error('station') is-invalid @enderror" type="text"
                                        name="station" placeholder="Enter Station Name">
                                    <span class="text-danger">
                                        @error('station')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-default" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="col-md-12 mt-4">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Station List</div>
                        </div>
                        <div class="ibox-body">
                            <table cclass="table table-striped table-bordered table-hover" id="example-table"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">Question</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($stations as $index => $station)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $station->station }}</td>
                                            <td>{{ $station->created_at->format('d-m-Y H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No stations found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <!-- End Table -->

            </div>
        </div>
    </div>

    <script>
        // Flash message auto hide after 2 sec
        setTimeout(function() {
            let flash = document.getElementById('flash-message');
            if (flash) {
                flash.classList.remove('show'); // fade-out
                flash.classList.add('fade');
                setTimeout(() => flash.remove(), 500); // remove from DOM
            }
        }, 2000); // 2 sec
    </script>
@endsection
