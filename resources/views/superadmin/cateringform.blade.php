@extends('layouts.backend')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">

            <div class="ibox">


                <div class="card p-4">

                    <form action="{{ route('superadmin.catering.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm border">
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
                            <input type="text" name="total_units" class="form-control number-dot-only" placeholder="Enter Total Units">
                        </div>

                        <!-- ANNUAL L/FEE -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Annual L/Fee (in Cr.)</label>
                            <input type="text" name="annual_fee" class="form-control number-dot-only" placeholder="Enter Annual L/Fee">
                        </div>

                        <!-- L/FEE PAID -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">L/Fee Paid (in Cr.)</label>
                            <input type="text" name="fee_paid" class="form-control number-dot-only" placeholder="Enter L/Fee Paid">
                        </div>

                        <!-- BUTTON -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success px-5">
                                Submit Data
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
