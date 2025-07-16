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
        @if (Str::contains(strtolower($report->Duration), '3 month'))
            Quarterly Inspection Report
        @else
            Monthly Inspection Report
        @endif
    </h2>

    <p><strong>Name of Station:</strong> __________________ <strong>Date of Inspection:</strong> __________________</p>

    <h3>1. <u>Booking Office</u> :</h3>

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

    <table>
        <tr>
            <th style="width: 5%;">Sr.No</th>
            <th style="width: 60%;">Checks</th>
            <th style="width: 35%;">Remarks/Action taken</th>

        </tr>
        @foreach ($bookingOfficeAnswers as $key => $answer)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $answer->bookingOffice->checks ?? 'N/A' }}</td>
                <td>
                    {{ $answer->answer ?? '""' }} <br>
                    <strong>Remark:</strong> {{ $answer->remark ?? '""' }}
                </td>
            </tr>
        @endforeach
    </table>

    <h3>2. <u>PRS Office</u> :</h3>

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

    <h3>3. <u>Parcel Office</u> :</h3>

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

</body>

</html>
