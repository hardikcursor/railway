@extends('layouts.backend')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .ibox .card {
        border-radius: 10px;
        background: #ffffff;
    }

    .ibox h5 {
        display: flex;
        align-items: center;
    }

    .ibox input[type="file"] {
        padding: 10px;
    }
</style>
@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">

            <div class="ibox">
                <div class="card p-4">
                    <form action="{{ route('superadmin.catering.store') }}" method="POST"
                        class="bg-white p-4 rounded shadow-sm border">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Name *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Name of Unit *</label>
                            <input type="text" name="name_of_unit" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Station *</label>
                            <input type="text" name="station" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Category *</label>
                            <input type="text" name="category" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Type of Unit *</label>
                            <input type="text" name="type_of_unit" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Platform No *</label>
                            <input type="number" name="platform_no" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Annual License Fee *</label>
                            <input type="number" name="annual_license_fee" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Category of Unit *</label>
                            <input type="text" name="category_of_unit" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Unit Allotted *</label>
                            <input type="text" name="unit_allotted" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Date of Commencement *</label>
                            <input type="date" name="date_of_commencement" class="form-control" required>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success px-5">
                                Save Data
                            </button>
                        </div>
                    </form>

                    {{-- <form action="{{ route('superadmin.catering.store') }}" method="POST"
                        class="bg-white p-4 rounded shadow-sm border">
                        @csrf
                        <!-- NAME -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>

                        <!-- CATEGORY -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category</label>
                            <select name="category" class="form-select">
                                <option value="">Select Category</option>
                                <option value="NSG1">NSG1</option>
                                <option value="NSG2">NSG2</option>
                                <option value="NSG5">NSG5</option>
                                <option value="NSG6">NSG6</option>
                            </select>
                        </div>

                        <!-- STATION -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Station</label>
                            <select name="station" class="form-select">
                                <option value="">Select Station</option>
                                <option value="BLDI">BLDI</option>
                                <option value="RDHP">RDHP</option>
                                <option value="ASV">ASV</option>
                                <option value="UMN">UMN</option>
                                <option value="DHG">DHG</option>
                                <option value="AAR">AAR</option>
                                <option value="CLDY">CLDY</option>
                                <option value="SID">SID</option>
                                <option value="PTN">PTN</option>
                                <option value="TOD">TOD</option>
                                <option value="HMT">HMT</option>
                                <option value="KTRD">KTRD</option>
                                <option value="NHM">NHM</option>
                                <option value="RKH">RKH</option>
                                <option value="SDGM">SDGM</option>
                            </select>
                        </div>

                        <!-- TYPE OF UNIT -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Type of Unit</label>
                            <select name="unit_type" class="form-select">
                                <option value="">Select Unit Type</option>
                                <option value="Stall">Stall</option>
                                <option value="Trolley">Trolley</option>
                                <option value="Milk Stall">Milk Stall</option>
                                <option value="MPS">MPS</option>
                                <option value="Apple Juice Stall">Apple Juice Stall</option>
                                <option value="KIOSK">KIOSK</option>
                            </select>
                        </div>

                        <!-- TOTAL UNITS -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Total Units</label>
                            <input type="text" name="total_units" class="form-control number-dot-only"
                                placeholder="Enter Total Units">
                        </div>

                        <!-- ANNUAL L/FEE -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Annual L/Fee (in Cr.)</label>
                            <input type="text" name="annual_fee" class="form-control number-dot-only"
                                placeholder="Enter Annual L/Fee">
                        </div>

                        <!-- L/FEE PAID -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">L/Fee Paid (in Cr.)</label>
                            <input type="text" name="fee_paid" class="form-control number-dot-only"
                                placeholder="Enter L/Fee Paid">
                        </div>

                        <!-- BUTTON -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success px-5">
                                Submit Data
                            </button>
                        </div>

                    </form> --}}
                </div>

                <div class="ibox mt-4">
                    <div class="card p-4 shadow-sm border">

                        <h5 class="mb-3 fw-bold text-primary">
                            <i class="fa fa-file-excel-o me-2"></i> Excel File Upload
                        </h5>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('superadmin.catering.import') }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            <div class="row align-items-end">
                                <div class="col-md-8">
                                    <label class="form-label fw-bold">Upload Excel File</label>
                                    <input type="file" name="file" class="form-control" accept=".xls,.xlsx"
                                        required>
                                    <small class="text-muted">
                                        Allowed formats: .xls, .xlsx
                                    </small>
                                </div>

                                <div class="col-md-4 mt-3 mt-md-0">
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="fa fa-upload me-1"></i> Import Excel
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
