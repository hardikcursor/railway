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

</body>
</html>
