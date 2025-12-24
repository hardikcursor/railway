@extends('layouts.backend')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    .unreserved-box,
    .reserved-box {
        display: none;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 15px;
        margin-top: 15px;
        background: #f9f9f9;
    }
</style>
@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">

            <div class="ibox">


                <div class="card p-4">
              

                    <form action="{{ route('superadmin.coaching.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm border">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Enter Name">
                        </div>

                        <div class="mb-3">
                            <label for="station_name" class="form-label fw-bold">Station <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="station_name" class="form-control" id="station_name"
                                placeholder="Enter Station Name">
                        </div>

                        <div class="mb-3">
                            <label for="unreserved_passengers" class="form-label fw-bold">Unreserved Passengers <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="unreserved_passengers" class="form-control"
                                id="unreserved_passengers" placeholder="Enter Unreserved Passengers" min="0">
                        </div>

                        <div class="mb-3">
                            <label for="unreserved_earning" class="form-label fw-bold">Unreserved Earning <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="unreserved_earning" class="form-control" id="unreserved_earning"
                                placeholder="Enter Unreserved Earning" min="0" step="0.01">
                        </div>

                        <div class="mb-3">
                            <label for="reserved_passengers" class="form-label fw-bold">Reserved Passengers <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="reserved_passengers" class="form-control" id="reserved_passengers"
                                placeholder="Enter Reserved Passengers" min="0">
                        </div>

                        <div class="mb-3">
                            <label for="reserved_earning" class="form-label fw-bold">Reserved Earning <span
                                    class="text-danger">*</span></label>
                            <input type="number" name="reserved_earning" class="form-control" id="reserved_earning"
                                placeholder="Enter Reserved Earning" min="0" step="0.01">
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label fw-bold">Select Date <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="date" class="form-control" id="date">
                        </div>

                        <!-- ================= UNRESERVED SECTION ================= -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Unreserved <span class="text-danger">*</span></label><br>
                            <button type="button" class="btn btn-primary btn-sm" onclick="toggleUnreserved()">
                                + Add
                            </button>
                        </div>

                        <div id="unreservedBox" class="unreserved-box">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Classes</label>
                                <select name="unreserved[class][]" class="form-select">
                                    <option value="">Select Class</option>
                                    <option>FC</option>
                                    <option>NAMO BHARAT RAPID RAIL-AC</option>
                                    <option>AC CHAIR CAR</option>
                                    <option>SL M/EXP.</option>
                                    <option>|| M/EXP</option>
                                    <option>|| ORDY.</option>
                                    <option>||MST(1X50)</option>
                                    <option>|| QST(1X150)</option>
                                    <option>HST/YST</option>
                                    <option>SUPER FAST</option>
                                    <option>TC+TTE FARE</option>
                                    <option>ATVM</option>
                                    <option>JTBS</option>
                                    <option>2S</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Passenger</label>
                                <input type="number" name="unreserved[passenger][]" class="form-control number-only"
                                    placeholder="Enter Passenger Count">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Revenue</label>
                                <input type="number" name="unreserved[revenue][]" class="form-control number-only"
                                    placeholder="Enter Revenue">


                            </div>
                        </div>

                        <!-- ================= RESERVED SECTION ================= -->
                        <div class="mb-3 mt-3">
                            <label class="form-label fw-bold">Reserved <span class="text-danger">*</span></label><br>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="toggleReserved()">
                                + Add
                            </button>
                        </div>

                        <div id="reservedBox" class="reserved-box">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Classes</label>
                                <select name="reserved[class][]" class="form-select">

                                    <option value="">Select Class</option>
                                    <option>EA</option>
                                    <option>1A</option>
                                    <option>EV</option>
                                    <option>2A</option>
                                    <option>FC</option>
                                    <option>3A</option>
                                    <option>3E</option>
                                    <option>VC</option>
                                    <option>CC</option>
                                    <option>SL</option>
                                    <option>2S</option>
                                    <option>CH</option>
                                    <option>SH</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Passenger</label>
                                <input type="number" name="reserved[passenger][]" class="form-control number-only"
                                    placeholder="Enter Passenger Count">

                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Revenue</label>
                                <input type="number" name="reserved[revenue][]" class="form-control number-only"
                                    placeholder="Enter Revenue">

                            </div>
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

    <script>
        function toggleUnreserved() {
            const box = document.getElementById('unreservedBox');
            box.style.display = (box.style.display === 'none' || box.style.display === '') ? 'block' : 'none';
        }

        function toggleReserved() {
            const box = document.getElementById('reservedBox');
            box.style.display = (box.style.display === 'none' || box.style.display === '') ? 'block' : 'none';
        }

        document.querySelectorAll('.number-only').forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
@endsection
