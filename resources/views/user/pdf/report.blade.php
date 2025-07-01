<!DOCTYPE html>
<html>
<head>
    <title>Report PDF</title>
    <style>
        table {
            width: 100%;
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
    </style>
</head>
<body>
    <h2>Report Details</h2>
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
    <h3>Booking Office Details</h3>
    <table>
        <tr>
            <th>Sr.No</th>
            <th>Checks </th>
            <th>Remarks/Action taken </th>
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

