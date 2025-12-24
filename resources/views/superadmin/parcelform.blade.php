@extends('layouts.backend')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Parcel Form</div>
                            <div class="ibox-tools">
                                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <form action="{{ route('parcel.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm border">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">
                                        Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Enter Name">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        Revenue <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="revenue" class="form-control number-only"
                                        placeholder="Enter Revenue">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        Weight <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="weight" class="form-control number-only"
                                        placeholder="Enter Weight">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        Package <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="package" class="form-control number-only"
                                        placeholder="Enter Package Count">
                                </div>

                                <div class="mb-3">
                                    <label for="date" class="form-label fw-bold">
                                        Select Date <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="date" id="date" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        Items <span class="text-danger">*</span>
                                    </label>
                                    <select name="items" class="form-select">
                                        <option value="">Select Item</option>
                                        <option value="Leasing">Leasing</option>
                                        <option value="Luggage">Luggage</option>
                                        <option value="Non- Perishable">Non- Perishable</option>
                                        <option value="Non-Perishable">Non-Perishable</option>
                                        <option value="Perishable">Perishable</option>
                                        <option value="RMT">RMT</option>
                                        <option value="luggage">luggage</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        Station <span class="text-danger">*</span>
                                    </label>
                                    <select name="station" class="form-select">
                                        <option value="">Select Station</option>
                                        <option value="ADI">ADI</option>
                                        <option value="ASV">ASV</option>
                                        <option value="CLDY">CLDY</option>
                                        <option value="CWCJ">CWCJ</option>
                                        <option value="DHG">DHG</option>
                                        <option value="GIMB">GIMB</option>
                                        <option value="GNC">GNC</option>
                                        <option value="HMT">HMT</option>
                                        <option value="LCH">LCH</option>
                                        <option value="MSH">MSH</option>
                                        <option value="NBVJ">NBVJ</option>
                                        <option value="PNU">PNU</option>
                                        <option value="SBI">SBI</option>
                                        <option value="SBIB">SBIB</option>
                                        <option value="SIOB">SIOB</option>
                                    </select>
                                </div>

                            

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-success px-5">
                                        Save Data
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.number-only').forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
@endsection
