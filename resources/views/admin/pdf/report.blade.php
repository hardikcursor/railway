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
            padding-top: 120px; /* Adjust top padding */
            padding-bottom: 100px; /* Optional bottom spacing */
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
        td, th {
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
          h2, h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }
        th, td {
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
    <h2>Monthly Inspection Report </h2>
    <table>
        <tr>
            <th>Name</th>
            <td>{{ $report->NameInspection }}</td>
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

       <h2>Monthly Inspection Report</h2>

    <p><strong>Name of Station:</strong> __________________ <strong>Date of Inspection:</strong> __________________</p>

    <h3>1. <u>Booking Office</u> :</h3>

    <table class="no-border">
        <tr>
            <td class="no-border" style="width: 3%;">I.</td>
            <td class="no-border" style="width: 40%;">Name of CBS:</td>
            <td class="no-border" style="border-bottom: 1px solid #000;">{{ $bookingOffice->name_of_cbs ?? '' }}</td>
        </tr>
        <tr>
            <td class="no-border">II.</td>
            <td class="no-border">No. of on duty staff:</td>
            <td class="no-border" style="border-bottom: 1px solid #000;">{{ $bookingOffice->duty_staff_no ?? '' }}</td>
        </tr>
        <tr>
            <td class="no-border">III.</td>
            <td class="no-border">Sanctioned Cadre:</td>
            <td class="no-border" style="border-bottom: 1px solid #000;">{{ $bookingOffice->sanctioned_cadre ?? '' }}</td>
            <td class="no-border">Available:</td>
            <td class="no-border" style="border-bottom: 1px solid #000;">{{ $bookingOffice->available ?? '' }}</td>
            <td class="no-border">Vacancy/Excess:</td>
            <td class="no-border" style="border-bottom: 1px solid #000;">{{ $bookingOffice->vacancy_excess ?? '' }}</td>
        </tr>
        <tr>
            <td class="no-border">IV.</td>
            <td class="no-border">No. of Counters:</td>
            <td class="no-border">(1) UTS:</td>
            <td class="no-border" style="border-bottom: 1px solid #000;">{{ $bookingOffice->uts_counter ?? '' }}</td>
            <td class="no-border">(2) PRS:</td>
            <td class="no-border" style="border-bottom: 1px solid #000;">{{ $bookingOffice->prs_counter ?? '' }}</td>
            <td class="no-border">(3) UTS-cum-PRS:</td>
            <td class="no-border" style="border-bottom: 1px solid #000;">{{ $bookingOffice->uts_prs_counter ?? '' }}</td>
        </tr>
    </table>

    <table>
        <tr>
            <th style="width: 5%;">S.No</th>
            <th style="width: 60%;">Checks</th>
            <th style="width: 35%;">Remarks/Action taken</th>
        </tr>
        @foreach($bookingOfficeAnswers as $key => $answer)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $answer->bookingOffice->checks ?? 'N/A' }}</td>
                  <td>{{ $answer->remarks }}</td>
            </tr>
        @endforeach
    </table>

</body>
</html>
