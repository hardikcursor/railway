@extends('layouts.backend')

@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            <div class="ibox">
                <div class="ibox-head d-flex justify-content-between align-items-center flex-wrap">
                    <div class="ibox-title">Generate Report Quotation</div>
                </div>

                <div class="ibox-body">
                    <!-- Success Message -->
                    <div id="success-message" class="alert alert-success" style="display: none;">
                        Quotation report created successfully!
                    </div>

                    <form action="{{ route('admin.userstore') }}" method="POST" class="form-horizontal" id="form-sample-1" novalidate="novalidate">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name of Inspection :</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name of Inspector</label>
                            <div class="col-sm-10">
                                <input type="text" name="Inspector" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Station</label>
                            <div class="col-sm-10">
                                <input type="text" name="author" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Type of Inspection</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Duration</label>
                            <div class="col-sm-10">
                                <input type="text" name="category" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 ml-sm-auto">
                                <button class="btn btn-info" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                    <!-- Select Box -->
                    <div class="form-group">
                        <label for="report_type">Select Report Type</label>
                        <select id="report_type" name="report_type" class="form-control" required>
                            <option value="">-- Select Report --</option>
                            <option value="daily">Booking Office :</option>
                            <option value="PRS">PRS Office :</option>
                            <option value="Parcel">Parcel Office :</option>
                            <option value="GoodsShed">Goods Shed/Office :</option>
                            <option value="TicketExaminer">Ticket Examiner Office :</option>
                            <option value="NonFareRevenue">Non Fare Revenue at Stations :</option>
                            <option value="PassengerAmenities">Inspection of Passenger Amenities Items :</option>
                            <option value="StationCleanliness">STATION CLEANLINESS PROFORMA :</option>
                            <option value="PayUseToilet">Inspection of Pay & Use Toilets :</option>
                            <option value="TeaRefreshment">INSPECTION OF TEA & LIGHT REFRESHMENT STALL :</option>
                            <option value="PantryCar">Inspection of Pantry Car :</option>
                            <option value="BaseKitchen">INSPECTION OF BASE KITCHEN :</option>
                        </select>
                    </div>

                    <!-- Booking Office Form -->
                    <form id="daily_form" class="report-form" style="display: none;"> @csrf
                        <input type="hidden" name="report_type" value="BookingOffice">
                        <div class="form-group">
                            <label>Enter Booking Office Report Details</label>
                            <input type="text" name="daily_quotation" class="form-control">
                            <span>
                                @error('daily_quotation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </span>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Generate Booking Office Report</button>
                    </form>

                    <!-- PRS Office Form -->
                    <form id="prs_form" class="report-form" style="display: none;"> @csrf
                        <input type="hidden" name="report_type" value="PRSOffice">
                        <div class="form-group">
                            <label>Enter PRS Office Report Details</label>
                            <input type="text" name="prs_quotation" class="form-control">
                            <span>
                                @error('prs_quotation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </span>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Generate PRS Office Report</button>
                    </form>

                    <!-- Parcel Office Form -->
                    <form id="parcel_form" class="report-form" style="display: none;"> @csrf
                        <input type="hidden" name="report_type" value="ParcelOffice">
                        <div class="form-group">
                            <label>Enter Parcel Office Report Details</label>
                            <input type="text" name="parcel_quotation" class="form-control">
                            <span>
                                @error('parcel_quotation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </span>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Generate Parcel Office Report</button>
                    </form>

                    <!-- Goods Shed/Office Form -->
                    <form id="goods_form" class="report-form" style="display: none;"> @csrf
                        <input type="hidden" name="report_type" value="GoodsShedOffice">
                        <div class="form-group">
                            <label>Enter Goods Shed/Office Report Details</label>
                            <input type="text" name="goods_quotation" class="form-control">
                            <span>
                                @error('goods_quotation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </span>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Generate Goods Shed/Office Report</button>
                    </form>

                    <!-- Ticket Examiner Office Form -->
                    <form id="ticket_form" class="report-form" style="display: none;"> @csrf
                        <input type="hidden" name="report_type" value="TicketExaminerOffice">
                        <div class="form-group">
                            <label>Enter Ticket Examiner Office Report Details</label>
                            <input type="text" name="ticket_quotation" class="form-control">
                            <span>
                                @error('ticket_quotation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </span>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Generate Ticket Examiner Office
                            Report</button>
                    </form>

                    <!-- Non Fare Revenue at Stations Form -->
                    <form id="nonfare_form" class="report-form" style="display: none;"> @csrf
                        <input type="hidden" name="report_type" value="NonFareRevenue">
                        <div class="form-group">
                            <label>Enter Non Fare Revenue at Stations Report Details</label>
                            <input type="text" name="nonfare_quotation" class="form-control">
                            <span>
                                @error('nonfare_quotation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </span>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Generate Non Fare Revenue Report</button>
                    </form>

                    <!-- Inspection of Passenger Amenities Items Form -->
                    <form id="passenger_form" class="report-form" style="display: none;"> @csrf
                        <input type="hidden" name="report_type" value="PassengerAmenities">
                        <div class="form-group">
                            <label>Enter Inspection of Passenger Amenities Items Report Details</label>
                            <input type="text" name="passenger_quotation" class="form-control">
                            <span>
                                @error('passenger_quotation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </span>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Generate Passenger Amenities Report</button>
                    </form>

                    <!-- Station Cleanliness Proforma Form -->
                    <form id="stationcleanliness_form" class="report-form" style="display: none;"> @csrf
                        <input type="hidden" name="report_type" value="StationCleanliness">
                        <div class="form-group">
                            <label>Enter Station Cleanliness Proforma Report Details</label>
                            <input type="text" name="stationcleanliness_quotation" class="form-control">
                            <span>
                                @error('stationcleanliness_quotation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </span>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Generate Station Cleanliness Proforma
                            Report</button>
                    </form>

                    <!-- Inspection of Pay & Use Toilets Form -->
                    <form id="payuse_form" class="report-form" style="display: none;"> @csrf
                        <input type="hidden" name="report_type" value="PayUseToilet">
                        <div class="form-group">
                            <label>Enter Inspection of Pay & Use Toilets Report Details</label>
                            <input type="text" name="payuse_quotation" class="form-control">
                            <span>
                                @error('payuse_quotation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </span>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Generate Inspection of Pay & Use Toilets
                            Report</button>
                    </form>


                    <!-- Tea & Light Refreshment Form -->
                    <form id="tea_form" class="report-form" style="display: none;"> @csrf
                        <input type="hidden" name="report_type" value="TeaRefreshment">
                        <div class="form-group">
                            <label>Enter Inspection of Tea & Light Refreshment Stall</label>
                            <input type="text" name="tea_quotation" class="form-control">
                            <span>
                                @error('tea_quotation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </span>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Generate Tea & Light Refreshment
                            Report</button>
                    </form>

                    <!-- Pantry Car Form -->
                    <form id="pantry_form" class="report-form" style="display: none;"> @csrf
                        <input type="hidden" name="report_type" value="PantryCar">
                        <div class="form-group">
                            <label>Enter Inspection of Pantry Car</label>
                            <input type="text" name="pantry_quotation" class="form-control">
                            <span>
                                @error('pantry_quotation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </span>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Generate Pantry Car Report</button>
                    </form>

                    <!-- Base Kitchen Form -->
                    <form id="base_form" class="report-form" style="display: none;"> @csrf
                        <input type="hidden" name="report_type" value="BaseKitchen">
                        <div class="form-group">
                            <label>Enter Inspection of Base Kitchen</label>
                            <input type="text" name="base_quotation" class="form-control">
                            <span>
                                @error('base_quotation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </span>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Generate Base Kitchen Report</button>
                    </form>

                </div> <!-- /.ibox-body -->
            </div> <!-- /.ibox -->
        </div> <!-- /.page-content -->
    </div> <!-- /.content-wrapper -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#report_type').on('change', function() {
                var selected = $(this).val();
                $('.report-form').hide();

                if (selected === 'daily') {
                    $('#daily_form').show();
                } else if (selected === 'PRS') {
                    $('#prs_form').show();
                } else if (selected === 'Parcel') {
                    $('#parcel_form').show();
                } else if (selected === 'GoodsShed') {
                    $('#goods_form').show();
                } else if (selected === 'TicketExaminer') {
                    $('#ticket_form').show();
                } else if (selected === 'NonFareRevenue') {
                    $('#nonfare_form').show();
                } else if (selected === 'PassengerAmenities') {
                    $('#passenger_form').show();
                } else if (selected === 'StationCleanliness') {
                    $('#stationcleanliness_form').show();
                } else if (selected === 'PayUseToilet') {
                    $('#payuse_form').show();
                } else if (selected === 'TeaRefreshment') {
                    $('#tea_form').show();
                } else if (selected === 'PantryCar') {
                    $('#pantry_form').show();
                } else if (selected === 'BaseKitchen') {
                    $('#base_form').show();
                }
            });

            $('#daily_form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.savequotationreport') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function() {
                        $('#success-message').show().delay(3000).fadeOut();
                        $('#daily_form')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            });

            $('#prs_form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.PRSanswer.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function() {
                        $('#success-message').show().delay(3000).fadeOut();
                        $('#prs_form')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            });

            $('#parcel_form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.Parcelanswer.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function() {
                        $('#success-message').show().delay(3000).fadeOut();
                        $('#parcel_form')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            });

            $('#goods_form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.GoodsShedanswer.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function() {
                        $('#success-message').show().delay(3000).fadeOut();
                        $('#goods_form')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            });

            $('#ticket_form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.TicketExamineranswer.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function() {
                        $('#success-message').show().delay(3000).fadeOut();
                        $('#ticket_form')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            });

            $('#nonfare_form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.nonfareanswer.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function() {
                        $('#success-message').show().delay(3000).fadeOut();
                        $('#nonfare_form')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            });

            $('#passenger_form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.inspectionpassengeranswer.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function() {
                        $('#success-message').show().delay(3000).fadeOut();
                        $('#passenger_form')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            });

            $('#stationcleanliness_form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.stationcleanlinessanswer.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function() {
                        $('#success-message').show().delay(3000).fadeOut();
                        $('#stationcleanliness_form')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            });

            $('#payuse_form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.inspectionpayuseanswer.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function() {
                        $('#success-message').show().delay(3000).fadeOut();
                        $('#payuse_form')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            });

            $('#tea_form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.inspectionteaanswer.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function() {
                        $('#success-message').show().delay(3000).fadeOut();
                        $('#tea_form')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            });

            $('#pantry_form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.inspectionpantrycaranswer.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function() {
                        $('#success-message').show().delay(3000).fadeOut();
                        $('#pantry_form')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            });

            $('#base_form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.inspectionkitchenanswer.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function() {
                        $('#success-message').show().delay(3000).fadeOut();
                        $('#base_form')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            });

        });
    </script>
@endsection
