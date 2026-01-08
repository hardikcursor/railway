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


    .section-title {
        background: #e9ecef;
        padding: 10px;
        font-weight: bold;
        border-radius: 5px;
        margin-bottom: 15px;
    }
</style>
@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">

            <div class="ibox">


                <div class="card p-4">

                    <form method="POST" action="{{ route('superadmin.ticketchecking.store')  }}" class="bg-white p-4 rounded shadow-sm border">
                        @csrf

                        <!-- ================= Checking Squad ================= -->
                        <div class="section-title">Checking Squad</div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Date *</label>
                                <input type="date" name="checking[date]" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Staff *</label>
                                <input type="number" name="checking[staff]" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Case *</label>
                                <input type="number" name="checking[case]" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Amount *</label>
                                <input type="number" name="checking[amount]" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>AVG Case *</label>
                                <input type="text" name="checking[avg_case]" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>AVG Amt *</label>
                                <input type="text" name="checking[avg_amt]" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>AMT L.Y *</label>
                                <input type="number" name="checking[amt_ly]" class="form-control" required>
                            </div>
                        </div>

                        <!-- ================= Sleeper ================= -->
                        <div class="section-title mt-4">Sleeper (Coach Manning Duty)</div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Staff *</label>
                                <input type="number" name="sleeper[staff]" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Case *</label>
                                <input type="number" name="sleeper[case]" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Amount *</label>
                                <input type="number" name="sleeper[amount]" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>AVG Case *</label>
                                <input type="text" name="sleeper[avg_case]" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>AVG Amt *</label>
                                <input type="text" name="sleeper[avg_amt]" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>AMT L.Y *</label>
                                <input type="number" name="sleeper[amt_ly]" class="form-control" required>
                            </div>
                        </div>

                        <!-- ================= Stationery ================= -->
                        <div class="section-title mt-4">Stationery (On Station Duty)</div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Staff *</label>
                                <input type="number" name="stationery[staff]" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Case *</label>
                                <input type="number" name="stationery[case]" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Amount *</label>
                                <input type="number" name="stationery[amount]" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>AVG Case *</label>
                                <input type="text" name="stationery[avg_case]" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>AVG Amt *</label>
                                <input type="text" name="stationery[avg_amt]" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>AMT L.Y *</label>
                                <input type="number" name="stationery[amt_ly]" class="form-control" required>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <button type="submit" class="btn btn-success px-5">Save Data</button>
                        </div>
                    </form>

                    {{-- <form action="{{ route('superadmin.ticketchecking.store') }}" method="POST"
                        class="bg-white p-4 rounded shadow-sm border">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">
                                Cadre/Type <span class="text-danger">*</span>
                            </label>

                            <select name="cadre" id=""
                                class="form-control @error('cadre') is-invalid @enderror">
                                <option value="">Enter Cadre/Type</option>
                                <option value="Sleeper" {{ old('cadre') == 'Sleeper' ? 'selected' : '' }}>Sleeper</option>
                                <option value="Squad" {{ old('cadre') == 'Squad' ? 'selected' : '' }}>Squad</option>
                                <option value="Rahul" {{ old('cadre') == 'Rahul' ? 'selected' : '' }}>Rahul</option>
                                <option value="Goods" {{ old('cadre') == 'Goods' ? 'selected' : '' }}>Goods</option>
                                <option value="Mail" {{ old('cadre') == 'Mail' ? 'selected' : '' }}>Mail</option>
                            </select>

                            @error('cadre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">
                                Location <span class="text-danger">*</span>
                            </label>

                            <select name="location" id="location"
                                class="form-control @error('location') is-invalid @enderror">
                                <option value="" selected non-visible>Enter Location</option>
                                <option value="ADI" {{ old('ADI') == 'ADI' ? 'selected' : '' }}>ADI</option>
                                <option value="CTI-SBIB" {{ old('CTI-SBIB') == 'CTI-SBIB' ? 'selected' : '' }}>CTI-SBIB
                                </option>
                                <option value="Sr DCM" {{ old('Sr DCM') == 'Sr DCM' ? 'selected' : '' }}>Sr DCM</option>
                                <option value="CTI-MS-ADI" {{ old('CTI-MS-ADI') == 'CTI-MS-ADI' ? 'selected' : '' }}>
                                    CTI-MS-ADI</option>
                                <option value="DRM" {{ old('DRM') == 'DRM' ? 'selected' : '' }}>DRM</option>
                                <option value="GIM" {{ old('GIM') == 'GIM' ? 'selected' : '' }}>GIM</option>
                                <option value="MAN" {{ old('MAN') == 'MAN' ? 'selected' : '' }}>MAN</option>
                                <option value="MSH" {{ old('MSH') == 'MSH' ? 'selected' : '' }}>MSH</option>
                                <option value="PNU" {{ old('PNU') == 'PNU' ? 'selected' : '' }}>PNU</option>
                                <option value="VG" {{ old('VG') == 'VG' ? 'selected' : '' }}>VG</option>
                                <option value="SBI" {{ old('SBI') == 'SBI' ? 'selected' : '' }}>SBI</option>
                                <option value="GNC" {{ old('GNC') == 'GNC' ? 'selected' : '' }}>GNC</option>
                                <option value="NBVJ" {{ old('NBVJ') == 'NBVJ' ? 'selected' : '' }}>NBVJ</option>
                                <option value="KLL" {{ old('KLL') == 'KLL' ? 'selected' : '' }}>KLL</option>
                                <option value="NHM" {{ old('NHM') == 'NHM' ? 'selected' : '' }}>NHM</option>
                                <option value="UNJA" {{ old('UNJA') == 'UNJA' ? 'selected' : '' }}>UNJA</option>
                                <option value="SID" {{ old('SID') == 'SID' ? 'selected' : '' }}>SID</option>
                                <option value="BLDI" {{ old('BLDI') == 'BLDI' ? 'selected' : '' }}>BLDI</option>
                                <option value="PTN" {{ old('PTN') == 'PTN' ? 'selected' : '' }}>PTN</option>
                                <option value="CTI-MSH" {{ old('CTI-MSH') == 'CTI-MSH' ? 'selected' : '' }}>CTI-MSH
                                </option>
                            </select>

                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cases" class="form-label fw-bold">Cases <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="cases"
                                class="form-control @error('cases') is-invalid @enderror" id="cases"
                                value="{{ old('cases') }}" placeholder="Enter Cases">
                            @error('cases')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="revenue" class="form-label fw-bold">Revenue<span
                                    class="text-danger">*</span></label>
                            <input type="number" name="revenue"
                                class="form-control @error('revenue') is-invalid @enderror" id="revenue"
                                value="{{ old('revenue') }}" placeholder="Enter Revenue" min="0">
                            @error('revenue')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success px-5">
                                <i class="fa fa-upload me-2"></i> Import Data
                            </button>
                        </div>
                    </form> --}}
                </div>
            </div>

        </div>
    </div>

    <script>
        // Numbers only
        document.querySelectorAll('.numbers-only').forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });

        // Decimal numbers only
        document.querySelectorAll('.decimal-only').forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9.]/g, '');
                if ((this.value.match(/\./g) || []).length > 1) {
                    this.value = this.value.slice(0, -1);
                }
            });
        });
    </script>
@endsection
