@extends('layouts.backend')
@section('main')
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
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
                            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr class="text-dark">
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">Quotation</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @if ($quotation->count())
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <h5 class="text-primary mb-2 mt-4">Booking Office Quations</h5>
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
                                                <h5 class="text-primary mb-2 mt-4">PRS Office Quations</h5>
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
                                                <h5 class="text-primary mb-2 mt-4">Parcel Office Quations</h5>
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
                                                <h5 class="text-primary mb-2 mt-4">Goods Shed Office Quations</h5>
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
                                                <h5 class="text-primary mb-2 mt-4">Ticket Examiner Quations</h5>
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
                                                <h5 class="text-primary mb-2 mt-4">Non-Fare Revenue Quations</h5>
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
                                                <h5 class="text-primary mb-2 mt-4">Inspection Passenger Items Quations</h5>
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
                                                <h5 class="text-primary mb-2 mt-4">Station Cleanliness Quations</h5>
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
                                                <h5 class="text-primary mb-2 mt-4">Inspection Pay Use Toilets Quations</h5>
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
                                                <h5 class="text-primary mb-2 mt-4">Inspection Tea Quations</h5>
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
                                                <h5 class="text-primary mb-2 mt-4">Inspection Pantry Car Quations</h5>
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
                                                    <h5 class="text-primary mb-2 mt-4">Inspection Kitchen Quations</h5>
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
@endsection
