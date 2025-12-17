@extends('layouts.backend')

@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">

            <div class="ibox">
                <div class="header1">
                    Coaching Excel Import
                </div>

                <div class="card p-4">
                    <form action="{{ route('superadminexcel.coaching') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row align-items-end">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    Select Excel File <span class="text-danger">*</span>
                                </label>
                                <input type="file" name="file" class="form-control" accept=".xls,.xlsx,.csv" required>
                            </div>

                            <div class="col-md-3 mb-3">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fa fa-upload"></i> Import Excel
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Error Message --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
@endsection
