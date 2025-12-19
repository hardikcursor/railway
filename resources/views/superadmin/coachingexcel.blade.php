@extends('layouts.backend')
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">

            <div class="ibox">
                <div class="header1">
                    Coaching Excel Import
                </div>

                <div class="card p-4">
                    <form action="{{ route('superadmincoachingstore.coaching') }}" method="POST"
                        class="bg-white p-4 rounded shadow-sm border">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" value="{{ old('name') }}" placeholder="Enter Name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="station_name" class="form-label fw-bold">Station <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="station_name"
                                class="form-control @error('station_name') is-invalid @enderror" id="station_name"
                                value="{{ old('station_name') }}" placeholder="Enter Station Name">
                            @error('station_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="unreserved_passengers" class="form-label fw-bold">Unreserved Passengers <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="unreserved_passengers"
                                class="form-control @error('unreserved_passengers') is-invalid @enderror"
                                id="unreserved_passengers" value="{{ old('unreserved_passengers') }}"
                                placeholder="Enter Unreserved Passengers" min="0">
                            @error('unreserved_passengers')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="unreserved_earning" class="form-label fw-bold">Unreserved Earning <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="unreserved_earning"
                                class="form-control @error('unreserved_earning') is-invalid @enderror"
                                id="unreserved_earning" value="{{ old('unreserved_earning') }}"
                                placeholder="Enter Unreserved Earning" min="0" step="0.01">
                            @error('unreserved_earning')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="reserved_passengers" class="form-label fw-bold">Reserved Passengers <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="reserved_passengers"
                                class="form-control @error('reserved_passengers') is-invalid @enderror"
                                id="reserved_passengers" value="{{ old('reserved_passengers') }}"
                                placeholder="Enter Reserved Passengers" min="0">
                            @error('reserved_passengers')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="reserved_earning" class="form-label fw-bold">Reserved Earning <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="reserved_earning"
                                class="form-control @error('reserved_earning') is-invalid @enderror" id="reserved_earning"
                                value="{{ old('reserved_earning') }}" placeholder="Enter Reserved Earning" min="0"
                                step="0.01">
                            @error('reserved_earning')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_passengers" class="form-label fw-bold">Total Passengers <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="total_passengers"
                                class="form-control @error('total_passengers') is-invalid @enderror" id="total_passengers"
                                value="{{ old('total_passengers') }}" placeholder="Enter Total Passengers" min="0">
                            @error('total_passengers')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_earning" class="form-label fw-bold">Total Earning <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="total_earning"
                                class="form-control @error('total_earning') is-invalid @enderror" id="total_earning"
                                value="{{ old('total_earning') }}" placeholder="Enter Total Earning" min="0"
                                step="0.01">
                            @error('total_earning')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label fw-bold">Select Date <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="date" class="form-control @error('date') is-invalid @enderror"
                                id="date" value="{{ old('date') }}">
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success px-5">
                                <i class="fa fa-upload me-2"></i> Import Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
