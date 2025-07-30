<!DOCTYPE html>
<html>

<head>
    <title>Report PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .cover-page {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding-top: 120px;
            /* Adjust top padding */
            padding-bottom: 100px;
            /* Optional bottom spacing */
            box-sizing: border-box;
        }

        .cover-page h1 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .cover-page img {
            width: 200px;
            margin-bottom: 30px;
        }

        .cover-page h3 {
            font-size: 24px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .cover-page h4 {
            font-size: 20px;
            margin-bottom: 5px;
            font-weight: normal;
        }

        .cover-page .month {
            margin-top: 30px;
            font-size: 18px;
            font-style: italic;
        }

        table {
            width: 80%;
            margin: 40px auto;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }

        td,
        th {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .page-break {
            page-break-after: always;
        }

        h2,
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
        }

        .no-border {
            border: none !important;
        }
    </style>
</head>

<body>

    <!-- Cover Page -->
    <div class="cover-page">
        <h1>WESTERN RAILWAY</h1>
        <img src="{{ public_path('Backend/assets/img/logo.png') }}" alt="Western Railway Logo">
        <h3>Commercial Inspection Report</h3>
        <h4>( ADI DIVISION )</h4>
        <div class="month">Month: ......................</div>
    </div>

    <!-- Page Break -->
    <div class="page-break"></div>

    <!-- Report Table -->

    <table>
        <tr>
            <th>Name</th>
            <td>{{ $report->NameInspector }}</td>
        </tr>
        <tr>
            <th>Station</th>
            <td>{{ $report->Station }}</td>
        </tr>
        <tr>
            <th>Type of Inspection</th>
            <td>{{ $report->TypeofInspection }}</td>
        </tr>
        <tr>
            <th>Duration</th>
            <td>{{ $report->Duration }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($report->status) }}</td>
        </tr>
    </table>

    <h2>
        @php
            $duration = strtolower($report->Duration);
        @endphp

        @if (Str::contains($duration, '6 month') || Str::contains($duration, 'half'))
            Half Yearly Inspection Report
        @elseif (Str::contains($duration, '3 month') || Str::contains($duration, 'quarter'))
            Quarterly Inspection Report
        @else
            Monthly Inspection Report
        @endif
    </h2>


    <p><strong>Name of Station:</strong> __________________ <strong>Date of Inspection:</strong> __________________</p>

    @if ($bookingOfficeAnswers->isEmpty())
        {{-- No Booking Office data available --}}
    @else
        <div style="page-break-before: always;"></div>
        <h3 style="text-align: left;">1. <u>Booking Office</u> :</h3>

        <div style="font-size: 14px; line-height: 1.8;">

            <div style="margin-bottom: 10px;">
                <span style="text-align: left; width: 30px;">I.</span>
                <span style="text-align: left; width: 180px;">Name of CBS:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 300px;">{{ $bookingOffice->name_of_cbs ?? '' }}</span>
            </div>

            <div style="margin-bottom: 10px;">
                <span style="text-align: left; width: 30px;">II.</span>
                <span style="text-align: left; width: 180px;">No. of on duty staff:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 300px;">{{ $bookingOffice->duty_staff_no ?? '' }}</span>
            </div>

            <div style="display: flex; flex-wrap: wrap; margin-bottom: 10px;">
                <span style="text-align: left; width: 30px;">III.</span>
                <span style="text-align: left; width: 180px;">Sanctioned Cadre:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 150px; margin-right: 15px;">{{ $bookingOffice->sanctioned_cadre ?? '' }}</span>

                <span style="display: inline-block; width: 100px;">Available:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 150px; margin-right: 15px;">{{ $bookingOffice->available ?? '' }}</span>

                <span style="display: inline-block;text-align: left; width: 130px;">Vacancy/Excess:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 150px;">{{ $bookingOffice->vacancy_excess ?? '' }}</span>
            </div>

            <div style="display: flex; flex-wrap: wrap;">
                <span style="display: inline-block; width: 30px;">IV.</span>
                <span style="display: inline-block; width: 180px;">No. of Counters:</span>

                <span>(1) UTS:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 60px; margin-right: 15px;">{{ $bookingOffice->uts_counter ?? '' }}</span>

                <span>(2) PRS:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 60px; margin-right: 15px;">{{ $bookingOffice->prs_counter ?? '' }}</span>

                <span>(3) UTS-cum-PRS:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 80px;">{{ $bookingOffice->uts_prs_counter ?? '' }}</span>
            </div>

        </div>

        <table border="1" cellspacing="0" cellpadding="6" width="100%">
            <thead>
                <tr>
                    <th style="width: 5%;">Sr.No</th>
                    <th style="width: 60%;">Checks</th>
                    <th style="width: 35%;">Remarks/Action Taken</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookingOfficeAnswers as $key => $answer)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $answer->bookingOffice->checks ?? 'N/A' }}</td>
                        <td>
                            {{ $answer->answer }}<br>
                            <strong>Remark:</strong> {{ $answer->remark ?? 'N/A' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if ($PRS_office_answers->isEmpty())
        {{-- No PRS Office data available --}}
    @else
        <div style="page-break-before: always;"></div>
        <h3 style="text-align: left;">2. <u>PRS Office</u> :</h3>

        <div style="font-size: 14px; line-height: 1.8;">

            <div style="margin-bottom: 10px;">
                <span style="display: inline-block; width: 30px;">I.</span>
                <span style="display: inline-block; width: 180px;">Name of CBS:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 300px;">{{ $bookingOffice->name_of_cbs ?? '' }}</span>
            </div>

            <div style="margin-bottom: 10px;">
                <span style="display: inline-block; width: 30px;">II.</span>
                <span style="display: inline-block; width: 180px;">No. of on duty staff:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 300px;">{{ $bookingOffice->duty_staff_no ?? '' }}</span>
            </div>

            <div style="display: flex; flex-wrap: wrap; margin-bottom: 10px;">
                <span style="display: inline-block; width: 30px;">III.</span>
                <span style="display: inline-block; width: 180px;">Sanctioned Cadre:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 150px; margin-right: 15px;">{{ $bookingOffice->sanctioned_cadre ?? '' }}</span>

                <span style="display: inline-block; width: 100px;">Available:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 150px; margin-right: 15px;">{{ $bookingOffice->available ?? '' }}</span>

                <span style="display: inline-block; width: 130px;">Vacancy/Excess:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 150px;">{{ $bookingOffice->vacancy_excess ?? '' }}</span>
            </div>

            <div style="display: flex; flex-wrap: wrap;">
                <span style="display: inline-block; width: 30px;">IV.</span>
                <span style="display: inline-block; width: 180px;">No. of Counters:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 60px; margin-right: 15px;">{{ $bookingOffice->uts_counter ?? '' }}</span>

                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 60px; margin-right: 15px;">{{ $bookingOffice->prs_counter ?? '' }}</span>

                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 80px;">{{ $bookingOffice->uts_prs_counter ?? '' }}</span>
            </div>

        </div>

        <table>
            <tr>
                <th style="width: 5%;">Sr.No</th>
                <th style="width: 60%;">Checks</th>
                <th style="width: 35%;">Remarks/Action taken</th>

            </tr>
            @foreach ($PRS_office_answers as $key => $answer)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $answer->PRS_office->checks ?? 'N/A' }}</td>
                    <td>
                        {{ $answer->answer ?? '""' }} <br>
                        <strong>Remark:</strong> {{ $answer->remark ?? '-' }}
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
    @if ($Parcel_answer->isEmpty())
        {{-- No Parcel Office data available --}}
    @else
        <div style="page-break-before: always;"></div>

        <h3 style="text-align: left;">3. <u>Parcel Office</u> :</h3>

        <div style="font-size: 14px; line-height: 1.8;">

            <div style="margin-bottom: 10px;">
                <span style="display: inline-block; width: 30px;">I.</span>
                <span style="display: inline-block; width: 180px;">Name of CBS:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 300px;">{{ $bookingOffice->name_of_cbs ?? '' }}</span>
            </div>

            <div style="margin-bottom: 10px;">
                <span style="display: inline-block; width: 30px;">II.</span>
                <span style="display: inline-block; width: 180px;">No. of on duty staff:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 300px;">{{ $bookingOffice->duty_staff_no ?? '' }}</span>
            </div>

            <div style="display: flex; flex-wrap: wrap; margin-bottom: 10px;">
                <span style="display: inline-block; width: 30px;">III.</span>
                <span style="display: inline-block; width: 180px;">Sanctioned Cadre:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 150px; margin-right: 15px;">{{ $bookingOffice->sanctioned_cadre ?? '' }}</span>

                <span style="display: inline-block; width: 100px;">Available:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 150px; margin-right: 15px;">{{ $bookingOffice->available ?? '' }}</span>

                <span style="display: inline-block; width: 130px;">Vacancy/Excess:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 150px;">{{ $bookingOffice->vacancy_excess ?? '' }}</span>
            </div>


        </div>

        <table>
            <tr>
                <th style="width: 5%;">Sr.No</th>
                <th style="width: 60%;">Checks</th>
                <th style="width: 35%;">Remarks/Action taken</th>

            </tr>
            @foreach ($Parcel_answer as $key => $answer)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $answer->parcelOffice->checks ?? 'N/A' }}</td>
                    <td>
                        {{ $answer->answer ?? '""' }} <br>
                        <strong>Remark:</strong> {{ $answer->remark ?? '-' }}
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

    @if ($Goods_office_answer->isEmpty())
        {{-- No Goods Shed/Office data available --}}
    @else
        <div style="page-break-before: always;"></div>

        <h3 style="text-align: left;">4. <u>Goods Shed/Office</u> :</h3>

        <div style="font-size: 14px; line-height: 1.8;">

            <div style="margin-bottom: 10px;">
                <span style="display: inline-block; width: 30px;">I.</span>
                <span style="display: inline-block; width: 180px;">Name of CGS:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 300px;">{{ $bookingOffice->name_of_cbs ?? '' }}</span>
            </div>

            <div style="margin-bottom: 10px;">
                <span style="display: inline-block; width: 30px;">II.</span>
                <span style="display: inline-block; width: 180px;">No. of on duty staff:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 300px;">{{ $bookingOffice->duty_staff_no ?? '' }}</span>
            </div>

            <div style="display: flex; flex-wrap: wrap; margin-bottom: 10px;">
                <span style="display: inline-block; width: 30px;">III.</span>
                <span style="display: inline-block; width: 180px;">Sanctioned Cadre:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 150px; margin-right: 15px;">{{ $bookingOffice->sanctioned_cadre ?? '' }}</span>

                <span style="display: inline-block; width: 100px;">Available:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 150px; margin-right: 15px;">{{ $bookingOffice->available ?? '' }}</span>

                <span style="display: inline-block; width: 130px;">Vacancy/Excess:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 150px;">{{ $bookingOffice->vacancy_excess ?? '' }}</span>
            </div>


        </div>

        <table>
            <tr>
                <th style="width: 5%;">Sr.No</th>
                <th style="width: 60%;">Checks</th>
                <th style="width: 35%;">Remarks/Action taken</th>

            </tr>
            @foreach ($Goods_office_answer as $key => $answer)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $answer->goodsOffice->checks ?? 'N/A' }}</td>
                    <td>
                        {{ $answer->answer ?? '""' }} <br>
                        <strong>Remark:</strong> {{ $answer->remark ?? '-' }}
                    </td>
                </tr>
            @endforeach
        </table>
    @endif


    @if ($Ticket_office_answer->isEmpty())
    @else
        <div style="page-break-before: always;"></div>
        <h3 style="text-align: left;">5. <u>Ticket Examiner office </u> :</h3>

        <div style="font-size: 14px; line-height: 1.8;">

            <div style="margin-bottom: 10px;">
                <span style="display: inline-block; width: 30px;">I.</span>
                <span style="display: inline-block; width: 180px;">Name of CTI:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 300px;">{{ $bookingOffice->name_of_cbs ?? '' }}</span>
            </div>

            <div style="margin-bottom: 10px;">
                <span style="display: inline-block; width: 30px;">II.</span>
                <span style="display: inline-block; width: 180px;">No. of on duty staff:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 300px;">{{ $bookingOffice->duty_staff_no ?? '' }}</span>
            </div>

            <div style="display: flex; flex-wrap: wrap; margin-bottom: 10px;">
                <span style="display: inline-block; width: 30px;">III.</span>
                <span style="display: inline-block; width: 180px;">Sanctioned Cadre:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 150px; margin-right: 15px;">{{ $bookingOffice->sanctioned_cadre ?? '' }}</span>

                <span style="display: inline-block; width: 100px;">Available:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 150px; margin-right: 15px;">{{ $bookingOffice->available ?? '' }}</span>

                <span style="display: inline-block; width: 130px;">Vacancy/Excess:</span>
                <span
                    style="display: inline-block; border-bottom: 1px solid #000; min-width: 150px;">{{ $bookingOffice->vacancy_excess ?? '' }}</span>
            </div>


        </div>

        <table>
            <tr>
                <th style="width: 5%;">Sr.No</th>
                <th style="width: 60%;">Checks</th>
                <th style="width: 35%;">Remarks/Action taken</th>

            </tr>
            @foreach ($Ticket_office_answer as $key => $answer)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $answer->ticketOffice->checks ?? 'N/A' }}</td>
                    <td>
                        {{ $answer->answer ?? '""' }} <br>
                        <strong>Remark:</strong> {{ $answer->remark ?? '-' }}
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

    @if ($NonFare_Revenue_answer->isEmpty())
    @else
        <div style="page-break-before: always;"></div>
        <h3 style="text-align: left;">6. <u>Non Fare Revenue at stations </u> :</h3>

        <table>
            <tr>
                <th style="width: 5%;">Sr.No</th>
                <th style="width: 60%;">Checks</th>
                <th style="width: 35%;">Remarks/Action taken</th>

            </tr>
            @foreach ($NonFare_Revenue_answer as $key => $answer)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $answer->nonFareRevenueOffice->checks ?? 'N/A' }}</td>
                    <td>
                        {{ $answer->answer ?? '""' }} <br>
                        <strong>Remark:</strong> {{ $answer->remark ?? '-' }}
                    </td>
                </tr>
            @endforeach
        </table>
    @endif



    @if ($InspectionPassenger_items__answer->isEmpty())
    @else
        <div style="page-break-before: always;"></div>

        <h3 style="text-align: left;">7. <u>Inspection of Passenger Amenities items </u> :</h3>


        <table>
            <thead>
                <tr>
                    <th>Sr.No.</th>
                    <th>Items</th>
                    <th>Yes</th>
                    <th>No</th>
                    <th>Remarks/Action Taken</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($InspectionPassenger_items__answer as $key => $answer)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $answer->inspectionPassengerItems->checks ?? 'N/A' }}</td>

                        {{-- Yes Column --}}
                        <td class="text-center">
                            {{ $answer->yes_no == 1 ? 'Yes' : '' }}
                        </td>

                        {{-- No Column --}}
                        <td class="text-center">
                            {{ $answer->yes_no != 1 ? 'No' : '' }}
                        </td>

                        <td>{{ $answer->remark ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if ($StationCleanliness_answer->isEmpty())
    @else
        <div style="page-break-before: always;"></div>
        <h3 style="text-align: left;">8. <u>Station Cleanliness</u> :</h3>
        <table border="1" cellspacing="0" cellpadding="5"
            style="border-collapse: collapse; width: 100%; margin: 0; padding: 0;">
            <thead>
                <tr>
                    <th style="width: 25%;">Sr.No.</th>
                    <th style="width: 70%;">ITEMS</th>
                    <th style="width: 25%;">Remarks/Action taken</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Arrangements for housekeeping (details thereon)</td>
                    <td></td>
                </tr>
                @foreach ($StationCleanliness_answer as $index => $answer)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            Availability of dust bins (separately Black, Blue & Green).<br>
                            Mention number of dustbins individually.
                        </td>
                        <td style="padding: 0; margin: 0; vertical-align: top;">
                            <table border="1" cellspacing="0" cellpadding="0"
                                style="width: 100%; border-collapse: collapse; table-layout: fixed; margin: 0; padding: 0; line-height: 1;">
                                <thead>
                                    <tr>
                                        <th style="width: 33.33%; padding: 5px;">Black</th>
                                        <th style="width: 33.33%; padding: 5px;">Blue</th>
                                        <th style="width: 33.33%; padding: 5px;">Green</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="margin: 0; padding: 0;">
                                        <td style="height: 30px; padding: 5px; margin: 0; line-height: 1;">
                                            {{ $answer->black ?? '' }}
                                        </td>
                                        <td style="padding: 5px; margin: 0; line-height: 1;">
                                            {{ $answer->blue ?? '' }}
                                        </td>
                                        <td style="padding: 5px; margin: 0; line-height: 1;">
                                            {{ $answer->green ?? '' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif

    @if ($InspectionPayUseToilets_answer->isEmpty())
    @else
        <div style="page-break-before: always;"></div>
        <div style="page-break-before: always;">
            <h3 style="text-align: left;"> <u>9. Inspection of Pay & Use Toilets</u></h3>

            <table border="1" cellspacing="0" cellpadding="5"
                style="border-collapse: collapse; width: 100%; text-align: center;">
                <thead>
                    <tr>
                        <th rowspan="2">Sr.</th>
                        <th rowspan="2">Location</th>
                        <th colspan="2">No. of WC</th>
                        <th colspan="2">No. of Urinals</th>
                        <th rowspan="2">Divyang</th>
                    </tr>
                    <tr>
                        <th>Gents</th>
                        <th>Ladies</th>
                        <th>Gents</th>
                        <th>Ladies</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <p>During the inspection of the above toilet block on dated ......................... following
                observations
                were made:</p>

            <table border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse; width: 100%;">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Particulars</th>
                        <th>Remarks/Observations</th>
                        <th>In case of minor deficiencies TDC</th>
                        <th>In case of Major deficiencies Action Proposed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($InspectionPayUseToilets_answer as $key => $answer)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $answer->inspectionPayUseToilets->checks ?? 'N/A' }}</td>
                            <td>{{ $answer->Remar_Observations ?? 'N/A' }}</td>
                            <td>{{ $answer->Minor_deficiencies ?? 'N/A' }}</td>
                            <td>{{ $answer->Major_deficiencies_Proposed ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif




    @if ($inspection_tea_answer->isEmpty())
    @else
        <div style="page-break-before: always;"></div>
        <h3 style="text-align: left;"> <u>10. INSPECTION OF TEA & LIGHT REFRESHMENT STALL</u></h3>

        <table border="1" cellspacing="0" cellpadding="5"
            style="border-collapse: collapse; width: 100%; text-align: left;">
            <thead>
                <tr>
                    <th style="width: 5%;">Sr.No</th>
                    <th style="width: 50%;">Particulars</th>
                    <th style="width: 15%;">Yes/No</th>
                    <th style="width: 30%;">Remarks/Action taken</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inspection_tea_answer as $key => $answer)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $answer->inspectionTea->checks ?? 'N/A' }}</td>
                        <td class="text-center">
                            {{ $answer->yes_no == 1 ? 'Yes' : 'No' }}
                        </td>
                        <td>{{ $answer->remark ?? 'N/A' }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @endif



    @if ($InspectionPantryCar_answer->isEmpty())
    @else
        <div style="page-break-before: always;"></div>

        <h3 style="text-align: left;"><u>11. Inspection of Pantry Car</u></h3>

        <div style="text-align: left; margin-left: 0; padding-left: 0;">
            <h5><b>Date of Inspection :-</b> </h5>
            <h5><b>Train No :-</b> </h5>
            <h5><b>Train Name :-</b> </h5>
            <h5><b>Name of Inspecting Official :-</b> </h5>
            <h5><b>Designation :-</b> </h5>
            <h5><b>Pantry Car No :-</b> </h5>
            <h5><b>Name of Pantry Car Manager :-</b> </h5>
            <h5><b>Contractor Name :-</b> </h5>
            <h5><b>Name of IRCTC Supervisor :-</b> </h5>
        </div>

        <table border="1" cellspacing="0" cellpadding="5"
            style="border-collapse: collapse; width: 100%; font-size: 14px; margin-top: 20px;">
            <thead>
                <tr>
                    <th style="width: 10%;">Sr. No</th>
                    <th style="width: 60%;">Items to be Check</th>
                    <th style="width: 30%;">Remarks/Action Taken</th>
                </tr>
            </thead>
            <tbody>
                <!-- Items -->
                @foreach ($InspectionPantryCar_answer as $key => $answer)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $answer->inspectionPantryCar->checks ?? 'N/A' }}</td>
                        <td>{{ $answer->remark ?? 'N/A' }}</td>
                    </tr>
                @endforeach

                <!-- Empty space row for spacing before signatures -->
                <tr>
                    <td colspan="3" style="height: 30px; border: none;"></td>
                </tr>

                <!-- Signature Row -->
                <tr>
                    <td colspan="2" style="padding-top: 10px;">
                        <strong>Official Signature:</strong><br><br>
                        __________________________<br>
                        Inspecting Official
                    </td>
                    <td style="text-align: right; padding-top: 10px;">
                        <strong>Pantry Car Representative:</strong><br><br>
                        __________________________<br>
                        Pantry Car Manager
                    </td>
                </tr>
            </tbody>
        </table>
    @endif


    @if ($inspectionkitchen_answer->isEmpty())
    @else
        <div style="page-break-before: always;"></div>

        <h3 style="text-align: left;"><u>12. INSPECTION OF BASE KITCHEN</u></h3>


        <table border="1" cellspacing="0" cellpadding="5"
            style="border-collapse: collapse; width: 100%; font-size: 14px; margin-top: 20px;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="width: 10%; text-align: center;">Sr. No</th>
                    <th style="width: 60%; text-align: left;">Particulars</th>
                    <th style="width: 15%; text-align: center;">Yes/No</th>
                    <th style="width: 15%; text-align: left;">Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inspectionkitchen_answer as $key => $answer)
                    <tr>
                        <td style="text-align: center;">{{ ++$key }}</td>
                        <td>{{ $answer->inspectionKitchen->checks ?? 'N/A' }}</td>
                        <td style="text-align: center;">
                            {{ $answer->yes_no == 1 ? 'Yes' : ($answer->yes_no == 0 ? 'No' : 'N/A') }}
                        </td>
                        <td>{{ $answer->remark ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif









</body>

</html>
