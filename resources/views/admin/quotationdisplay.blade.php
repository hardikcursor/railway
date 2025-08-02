@extends('layouts.backend')
@section('main')
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            <div class="ibox-body">
                <!-- Success Message -->
                <div id="success-message" class="alert alert-success" style="display: none;">
                    Quation report created successfully!
                </div>
                {{-- 
                    <form action="" method="POST" class="form-horizontal" id="form-sample-1" novalidate="novalidate">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name of Inspection :</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">
                                <span class="text-danger">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name of Inspector</label>
                            <div class="col-sm-10">
                                <input type="text" name="Inspector" class="form-control @error('Inspector') is-invalid @enderror">
                                <span class="text-danger">
                                    @error('Inspector')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Station</label>
                            <div class="col-sm-10">
                                <input type="text" name="author" class="form-control @error('author') is-invalid @enderror">
                                <span class="text-danger">
                                    @error('author')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Type of Inspection</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                                <span class="text-danger">
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Duration</label>
                            <div class="col-sm-10">
                                <input type="text" name="category" class="form-control @error('category') is-invalid @enderror">
                                <span class="text-danger">
                                    @error('category')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 ml-sm-auto">
                                <button class="btn btn-info" type="submit">Submit</button>
                            </div>
                        </div>
                    </form> --}}
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
                        <label>Enter Add Question</label>
                        <input type="text" name="daily_quotation" class="form-control">
                        <span>
                            @error('daily_quotation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-success mt-2 mb-3">Submit Question</button>
                </form>

                <!-- PRS Office Form -->
                <form id="prs_form" class="report-form" style="display: none;"> @csrf
                    <input type="hidden" name="report_type" value="PRSOffice">
                    <div class="form-group">
                        <label>Enter Add Question</label>
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
                        <label>Enter Add Question</label>
                        <input type="text" name="parcel_quotation" class="form-control">
                        <span>
                            @error('parcel_quotation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Submit Question</button>
                </form>

                <!-- Goods Shed/Office Form -->
                <form id="goods_form" class="report-form" style="display: none;"> @csrf
                    <input type="hidden" name="report_type" value="GoodsShedOffice">
                    <div class="form-group">
                        <label>Enter Add Question</label>
                        <input type="text" name="goods_quotation" class="form-control">
                        <span>
                            @error('goods_quotation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Submit Question</button>
                </form>

                <!-- Ticket Examiner Office Form -->
                <form id="ticket_form" class="report-form" style="display: none;"> @csrf
                    <input type="hidden" name="report_type" value="TicketExaminerOffice">
                    <div class="form-group">
                        <label>Enter Add Question</label>
                        <input type="text" name="ticket_quotation" class="form-control">
                        <span>
                            @error('ticket_quotation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Submit Question</button>
                </form>

                <!-- Non Fare Revenue at Stations Form -->
                <form id="nonfare_form" class="report-form" style="display: none;"> @csrf
                    <input type="hidden" name="report_type" value="NonFareRevenue">
                    <div class="form-group">
                        <label>Enter Add Question</label>
                        <input type="text" name="nonfare_quotation" class="form-control">
                        <span>
                            @error('nonfare_quotation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Submit Question</button>
                </form>

                <!-- Inspection of Passenger Amenities Items Form -->
                <form id="passenger_form" class="report-form" style="display: none;"> @csrf
                    <input type="hidden" name="report_type" value="PassengerAmenities">
                    <div class="form-group">
                        <label>Enter Add Question</label>
                        <input type="text" name="passenger_quotation" class="form-control">
                        <span>
                            @error('passenger_quotation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Submit Question</button>
                </form>

                <!-- Station Cleanliness Proforma Form -->
                <form id="stationcleanliness_form" class="report-form" style="display: none;"> @csrf
                    <input type="hidden" name="report_type" value="StationCleanliness">
                    <div class="form-group">
                        <label>Enter Add Question</label>
                        <input type="text" name="stationcleanliness_quotation" class="form-control">
                        <span>
                            @error('stationcleanliness_quotation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Submit Question</button>
                </form>

                <!-- Inspection of Pay & Use Toilets Form -->
                <form id="payuse_form" class="report-form" style="display: none;"> @csrf
                    <input type="hidden" name="report_type" value="PayUseToilet">
                    <div class="form-group">
                        <label>Enter Add Question</label>
                        <input type="text" name="payuse_quotation" class="form-control">
                        <span>
                            @error('payuse_quotation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Submit Question</button>
                </form>


                <!-- Tea & Light Refreshment Form -->
                <form id="tea_form" class="report-form" style="display: none;"> @csrf
                    <input type="hidden" name="report_type" value="TeaRefreshment">
                    <div class="form-group">
                        <label>Enter Add Question</label>
                        <input type="text" name="tea_quotation" class="form-control">
                        <span>
                            @error('tea_quotation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Submit Question</button>
                </form>

                <!-- Pantry Car Form -->
                <form id="pantry_form" class="report-form" style="display: none;"> @csrf
                    <input type="hidden" name="report_type" value="PantryCar">
                    <div class="form-group">
                        <label>Enter Add Question</label>
                        <input type="text" name="pantry_quotation" class="form-control">
                        <span>
                            @error('pantry_quotation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Submit Question</button>
                </form>

                <!-- Base Kitchen Form -->
                <form id="base_form" class="report-form" style="display: none;"> @csrf
                    <input type="hidden" name="report_type" value="BaseKitchen">
                    <div class="form-group">
                        <label>Enter Add Question</label>
                        <input type="text" name="base_quotation" class="form-control">
                        <span>
                            @error('base_quotation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Submit Question</button>
                </form>

            </div>
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
                            <table class="table table-striped table-bordered table-hover" id="example-table"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">Question</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @if ($quotation->count())
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <h5 class="text-primary mb-2 mt-4">Booking Office Questions</h5>
                                            </td>
                                        </tr>
                                        @foreach ($quotation as $key => $quotations)
                                            <tr>
                                                <td>{{ $quotation->firstItem() + $key }}</td>
                                                <td>{{ $quotations->checks }}</td>
                                                <td>
                                                    <div style="display: flex; align-items: center;">
                                                        <a href="{{ route('admin.quotation.edit', ['model' => 'booking', 'id' => $quotations->id]) }}"
                                                            class="text-success" style="margin-right: 10px;">
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
                                        <tr>
                                            <td colspan="3">
                                                {{ $quotation->appends(['prs_page' => request('prs_page'), 'parcel_page' => request('parcel_page')])->links() }}
                                            </td>
                                        </tr>
                                    </tbody>
                                @endif


                                @if ($PRS_office->count())
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <h5 class="text-primary mb-2 mt-4">PRS Office Questions</h5>
                                            </td>
                                        </tr>
                                        @foreach ($PRS_office as $key => $PRS_offices)
                                            <tr>
                                                <td>{{ $PRS_office->firstItem() + $key }}</td>
                                                <td>{{ $PRS_offices->checks }}</td>
                                                <td>
                                                    <div style="display: flex; align-items: center;">
                                                        <a href="{{ route('admin.quotation.edit', ['model' => 'prs', 'id' => $PRS_offices->id]) }}"
                                                            class="text-success" style="margin-right: 10px;">
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
                                        <tr>
                                            <td colspan="3">
                                                {{ $PRS_office->appends(['booking_page' => request('booking_page'), 'parcel_page' => request('parcel_page')])->links() }}
                                            </td>
                                        </tr>
                                    </tbody>
                                @endif



                                @if ($Parcel_Office->count())
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <h5 class="text-primary mb-2 mt-4">Parcel Office Questions</h5>
                                            </td>
                                        </tr>
                                        @foreach ($Parcel_Office as $key => $Parcel_Offices)
                                            <tr>
                                                <td>{{ $Parcel_Office->firstItem() + $key }}</td>
                                                <td>{{ $Parcel_Offices->checks }}</td>
                                                <td>
                                                    <div style="display: flex; align-items: center;">
                                                        <a href="{{ route('admin.quotation.edit', ['model' => 'parcel', 'id' => $Parcel_Offices->id]) }}"
                                                            class="text-success" style="margin-right: 10px;">
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
                                        <tr>
                                            <td colspan="3">
                                                {{ $Parcel_Office->appends(['booking_page' => request('booking_page'), 'prs_page' => request('prs_page')])->links() }}
                                            </td>
                                        </tr>
                                    </tbody>
                                @endif
                                </tbody>

                                @if ($Goods_Shed_office->count())
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <h5 class="text-primary mb-2 mt-4">Goods Shed Office Questions</h5>
                                            </td>
                                        </tr>
                                        @foreach ($Goods_Shed_office as $key => $Goods_Shed_offices)
                                            <tr>
                                                <td>{{ $Goods_Shed_office->firstItem() + $key }}</td>
                                                <td>{{ $Goods_Shed_offices->checks }}</td>
                                                <td>
                                                    <div style="display: flex; align-items: center;">
                                                        <a href="{{ route('admin.quotation.edit', ['model' => 'goods_shed', 'id' => $Goods_Shed_offices->id]) }}"
                                                            class="text-success" style="margin-right: 10px;">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('admin.quotation.delete', ['model' => 'goods_shed', 'id' => $Goods_Shed_offices->id]) }}"
                                                            class="text-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3">
                                                {{ $Goods_Shed_office->appends(['booking_page' => request('booking_page'), 'prs_page' => request('prs_page'), 'parcel_page' => request('parcel_page')])->links() }}
                                            </td>
                                        </tr>
                                    </tbody>
                                @endif

                                @if ($Ticket_Examineroffice->count())
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <h5 class="text-primary mb-2 mt-4">Ticket Examiner Questions</h5>
                                            </td>
                                        </tr>
                                        @foreach ($Ticket_Examineroffice as $key => $Ticket_Examiners)
                                            <tr>
                                                <td>{{ $Ticket_Examineroffice->firstItem() + $key }}</td>
                                                <td>{{ $Ticket_Examiners->checks }}</td>
                                                <td>
                                                    <div style="display: flex; align-items: center;">
                                                        <a href="{{ route('admin.quotation.edit', ['model' => 'ticket', 'id' => $Ticket_Examiners->id]) }}"
                                                            class="text-success" style="margin-right: 10px;">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('admin.quotation.delete', ['model' => 'ticket', 'id' => $Ticket_Examiners->id]) }}"
                                                            class="text-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3">
                                                {{ $Ticket_Examineroffice->appends(['booking_page' => request('booking_page'), 'prs_page' => request('prs_page'), 'parcel_page' => request('parcel_page'), 'goods_shed_page' => request('goods_shed_page')])->links() }}
                                            </td>
                                        </tr>
                                    </tbody>
                                @endif


                                @if ($NonFare_Revenue->count())
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <h5 class="text-primary mb-2 mt-4">Non-Fare Revenue Questions</h5>
                                            </td>
                                        </tr>
                                        @foreach ($NonFare_Revenue as $key => $NonFare_Revenue_quotation)
                                            <tr>
                                                <td>{{ $NonFare_Revenue->firstItem() + $key }}</td>
                                                <td>{{ $NonFare_Revenue_quotation->checks }}</td>
                                                <td>
                                                    <div style="display: flex; align-items: center;">
                                                        <a href="{{ route('admin.quotation.edit', ['model' => 'nonfare', 'id' => $NonFare_Revenue_quotation->id]) }}"
                                                            class="text-success" style="margin-right: 10px;">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('admin.quotation.delete', ['model' => 'nonfare', 'id' => $NonFare_Revenue_quotation->id]) }}"
                                                            class="text-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3">
                                                {{ $NonFare_Revenue->appends(['booking_page' => request('booking_page'), 'prs_page' => request('prs_page'), 'parcel_page' => request('parcel_page'), 'goods_shed_page' => request('goods_shed_page'), 'nonfare_page' => request('nonfare_page')])->links() }}
                                            </td>
                                        </tr>
                                    </tbody>
                                @endif

                                @if ($InspectionPassenger_items->count())
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <h5 class="text-primary mb-2 mt-4">Inspection Passenger Items Questions</h5>
                                            </td>
                                        </tr>
                                        @foreach ($InspectionPassenger_items as $key => $InspectionPassenger_item)
                                            <tr>
                                                <td>{{ $InspectionPassenger_items->firstItem() + $key }}</td>
                                                <td>{{ $InspectionPassenger_item->checks }}</td>
                                                <td>
                                                    <div style="display: flex; align-items: center;">
                                                        <a href="{{ route('admin.quotation.edit', ['model' => 'inspection_passenger', 'id' => $InspectionPassenger_item->id]) }}"
                                                            class="text-success" style="margin-right: 10px;">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('admin.quotation.delete', ['model' => 'inspection_passenger', 'id' => $InspectionPassenger_item->id]) }}"
                                                            class="text-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3">
                                                {{ $InspectionPassenger_items->appends(['booking_page' => request('booking_page'), 'prs_page' => request('prs_page'), 'parcel_page' => request('parcel_page'), 'goods_shed_page' => request('goods_shed_page'), 'nonfare_page' => request('nonfare_page')])->links() }}
                                            </td>
                                        </tr>
                                    </tbody>
                                @endif

                                @if ($StationCleanliness->count())
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <h5 class="text-primary mb-2 mt-4">Station Cleanliness Questions</h5>
                                            </td>
                                        </tr>
                                        @foreach ($StationCleanliness as $key => $StationCleanliness_item)
                                            <tr>
                                                <td>{{ $StationCleanliness->firstItem() + $key }}</td>
                                                <td>{{ $StationCleanliness_item->checks }}</td>
                                                <td>
                                                    <div style="display: flex; align-items: center;">
                                                        <a href="{{ route('admin.quotation.edit', ['model' => 'station_cleanliness', 'id' => $StationCleanliness_item->id]) }}"
                                                            class="text-success" style="margin-right: 10px;">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('admin.quotation.delete', ['model' => 'station_cleanliness', 'id' => $StationCleanliness_item->id]) }}"
                                                            class="text-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3">
                                                {{ $StationCleanliness->appends(['booking_page' => request('booking_page'), 'prs_page' => request('prs_page'), 'parcel_page' => request('parcel_page'), 'goods_shed_page' => request('goods_shed_page'), 'nonfare_page' => request('nonfare_page'), 'inspection_passenger_items_page' => request('inspection_passenger_items_page')])->links() }}
                                            </td>
                                        </tr>
                                    </tbody>
                                @endif

                                @if ($InspectionPayUseToilets->count())
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <h5 class="text-primary mb-2 mt-4">Inspection Pay Use Toilets Questions</h5>
                                            </td>
                                        </tr>
                                        @foreach ($InspectionPayUseToilets as $key => $InspectionPayUseToilets_item)
                                            <tr>
                                                <td>{{ $InspectionPayUseToilets->firstItem() + $key }}</td>
                                                <td>{{ $InspectionPayUseToilets_item->checks }}</td>
                                                <td>
                                                    <div style="display: flex; align-items: center;">
                                                        <a href="{{ route('admin.quotation.edit', ['model' => 'inspection_payuse', 'id' => $InspectionPayUseToilets_item->id]) }}"
                                                            class="text-success" style="margin-right: 10px;">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('admin.quotation.delete', ['model' => 'inspection_payuse', 'id' => $InspectionPayUseToilets_item->id]) }}"
                                                            class="text-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3">
                                                {{ $InspectionPayUseToilets->appends(['booking_page' => request('booking_page'), 'prs_page' => request('prs_page'), 'parcel_page' => request('parcel_page'), 'goods_shed_page' => request('goods_shed_page'), 'nonfare_page' => request('nonfare_page'), 'inspection_passenger_items_page' => request('inspection_passenger_items_page'), 'inspection_payuse_page' => request('inspection_payuse_page')])->links() }}
                                            </td>
                                        </tr>
                                    </tbody>
                                @endif


                                @if ($INSPECTION_TEA->count())
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <h5 class="text-primary mb-2 mt-4">Inspection Tea Questions</h5>
                                            </td>
                                        </tr>
                                        @foreach ($INSPECTION_TEA as $key => $INSPECTION_TEA_item)
                                            <tr>
                                                <td>{{ $INSPECTION_TEA->firstItem() + $key }}</td>
                                                <td>{{ $INSPECTION_TEA_item->checks }}</td>
                                                <td>
                                                    <div style="display: flex; align-items: center;">
                                                        <a href="{{ route('admin.quotation.edit', ['model' => 'inspection_tea', 'id' => $INSPECTION_TEA_item->id]) }}"
                                                            class="text-success" style="margin-right: 10px;">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('admin.quotation.delete', ['model' => 'inspection_tea', 'id' => $INSPECTION_TEA_item->id]) }}"
                                                            class="text-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3">
                                                {{ $INSPECTION_TEA->appends(['booking_page' => request('booking_page'), 'prs_page' => request('prs_page'), 'parcel_page' => request('parcel_page'), 'goods_shed_page' => request('goods_shed_page'), 'nonfare_page' => request('nonfare_page'), 'inspection_passenger_items_page' => request('inspection_passenger_items_page'), 'inspection_payuse_page' => request('inspection_payuse_page')])->links() }}
                                            </td>
                                        </tr>
                                    </tbody>
                                @endif

                                @if ($InspectionPantryCar->count())
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <h5 class="text-primary mb-2 mt-4">Inspection Pantry Car Questions</h5>
                                            </td>
                                        </tr>
                                        @foreach ($InspectionPantryCar as $key => $InspectionPantryCar_item)
                                            <tr>
                                                <td>{{ $InspectionPantryCar->firstItem() + $key }}</td>
                                                <td>{{ $InspectionPantryCar_item->checks }}</td>
                                                <td>
                                                    <div style="display: flex; align-items: center;">
                                                        <a href="{{ route('admin.quotation.edit', ['model' => 'inspection_pantry', 'id' => $InspectionPantryCar_item->id]) }}"
                                                            class="text-success" style="margin-right: 10px;">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('admin.quotation.delete', ['model' => 'inspection_pantry', 'id' => $InspectionPantryCar_item->id]) }}"
                                                            class="text-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3">
                                                {{ $InspectionPantryCar->appends(['booking_page' => request('booking_page'), 'prs_page' => request('prs_page'), 'parcel_page' => request('parcel_page'), 'goods_shed_page' => request('goods_shed_page'), 'nonfare_page' => request('nonfare_page'), 'inspection_passenger_items_page' => request('inspection_passenger_items_page'), 'inspection_payuse_page' => request('inspection_payuse_page'), 'inspection_tea_page' => request('inspection_tea_page')])->links() }}
                                            </td>
                                        </tr>
                                    </tbody>
                                @endif

                                @if ($INSPECTIONKITCHEN->count())
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <h5 class="text-primary mb-2 mt-4">Inspection Kitchen Questions</h5>
                                            </td>
                                        </tr>
                                        @foreach ($INSPECTIONKITCHEN as $key => $INSPECTIONKITCHEN_item)
                                            <tr>
                                                <td>{{ $INSPECTIONKITCHEN->firstItem() + $key }}</td>
                                                <td>{{ $INSPECTIONKITCHEN_item->checks }}</td>
                                                <td>
                                                    <div style="display: flex; align-items: center;">
                                                        <a href="{{ route('admin.quotation.edit', ['model' => 'inspection_kitchen', 'id' => $INSPECTIONKITCHEN_item->id]) }}"
                                                            class="text-success" style="margin-right: 10px;">
                                                            <i class="fa-solid fa-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('admin.quotation.delete', ['model' => 'inspection_kitchen', 'id' => $INSPECTIONKITCHEN_item->id]) }}"
                                                            class="text-danger">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3">
                                                {{ $INSPECTIONKITCHEN->appends(['booking_page' => request('booking_page'), 'prs_page' => request('prs_page'), 'parcel_page' => request('parcel_page'), 'goods_shed_page' => request('goods_shed_page'), 'nonfare_page' => request('nonfare_page'), 'inspection_passenger_items_page' => request('inspection_passenger_items_page'), 'inspection_payuse_page' => request('inspection_payuse_page'), 'inspection_tea_page' => request('inspection_tea_page'), 'inspection_pantry_page' => request('inspection_pantry_page')])->links() }}
                                            </td>
                                        </tr>
                                    </tbody>
                                @endif

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
