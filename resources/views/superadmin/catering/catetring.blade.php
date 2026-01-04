<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Catering Dashboard (2024-25)</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f4f6f9;
        }

        /* HEADER */
        header {
            background: #ffffff;
            padding: 12px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header h2 {
            margin: 0;
            font-size: 18px;
        }

        /* NAV */
        nav {
            background: #ffffff;
            border-bottom: 1px solid #ddd;
            display: flex;
            padding: 8px 10px;
            gap: 15px;
        }

        nav a {
            text-decoration: none;
            color: #333;
            font-size: 14px;
            padding: 6px 10px;
        }

        nav a.active {
            border-bottom: 3px solid #0d6efd;
            color: #0d6efd;
            font-weight: bold;
        }

        /* DASHBOARD */
        .container {
            padding: 15px;
        }

        .title {
            text-align: center;
            background: linear-gradient(to right, #d9fdd3, #b9fbc0);
            padding: 8px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* FILTERS + KPI */
        .top-row {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }

        select, .kpi {
            padding: 8px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .kpi {
            text-align: center;
        }

        .kpi strong {
            font-size: 18px;
            display: block;
        }

        /* CHARTS */
        .row {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .card {
            background: #fff;
            padding: 12px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        /* BOTTOM */
        .bottom-row {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 15px;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: center;
        }

        table th {
            background: #f1f1f1;
        }

        footer {
            margin-top: 10px;
            font-size: 11px;
            color: #666;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>

<header>
    <h2>Freight Dashboard - Ahmedabad</h2>
</header>

<nav>
    <a href="#">Freight_Dashboard</a>
    <a href="#">Coaching_Dashboard</a>
    <a href="#">Parcel_Dashboard</a>
    <a href="#">Parking_Contract</a>
    <a href="#">Ticket Checking</a>
    <a href="#" class="active">Catering_Revenue</a>
</nav>

<div class="container">

    <div class="title">CATERING DASHBOARD (2024-2025)</div>

    <!-- FILTERS & KPI -->
    <div class="top-row">
        <select><option>Category</option></select>
        <select><option>Station</option></select>
        <select><option>Type of unit</option></select>

        <div class="kpi">
            Total Units
            <strong>178</strong>
        </div>

        <div class="kpi">
            Annual L/Fee (Cr.)
            <strong>3.6</strong>
        </div>

        <div class="kpi">
            L/Fee Paid (Cr.)
            <strong>1.36</strong>
        </div>
    </div>

    <!-- CHART ROW -->
    <div class="row">
        <div class="card">
            <h4>Month wise License Fee Paid (In Lakh)</h4>
            <canvas id="lineChart"></canvas>
        </div>

        <div class="card">
            <h4>Unit Wise Details (Nos.)</h4>
            <canvas id="donutChart"></canvas>
        </div>
    </div>

    <!-- BAR CHART -->
    <div class="card" style="margin-bottom:15px;">
        <canvas id="barChart"></canvas>
    </div>

    <!-- BOTTOM -->
    <div class="bottom-row">
        <div class="card">
            <h4>Category Wise Station (Nos)</h4>
            <canvas id="pieChart"></canvas>
        </div>

        <div class="card">
            <h4>Station Details</h4>
            <table>
                <thead>
                <tr>
                    <th>Stn</th>
                    <th>Category</th>
                    <th>Unit</th>
                    <th>Licensee</th>
                    <th>Annual (Cr.)</th>
                    <th>Paid (Cr.)</th>
                </tr>
                </thead>
                <tbody>
                <tr><td>ADI</td><td>NSG1</td><td>Stall</td><td>Sharifan Khan</td><td>1.45</td><td>0.06</td></tr>
                <tr><td>ADI</td><td>NSG1</td><td>Milk Stall</td><td>Narmada Food</td><td>0.95</td><td>0.04</td></tr>
                <tr><td>ADI</td><td>NSG1</td><td>Stall</td><td>Jayaben Caterers</td><td>0.87</td><td>0.04</td></tr>
                <tr><td>MSH</td><td>NSG2</td><td>Stall</td><td>Express Food</td><td>0.62</td><td>0.01</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <div>Data Last Updated: 25/12/2025 12:30 PM</div>
        <div>Privacy Policy</div>
    </footer>

</div>

<script>
    /* LINE CHART */
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: ['APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB'],
            datasets: [{
                label: 'Fee Paid',
                data: [8.03,6.44,9.05,10.13,14.43,14.68,12.31,16.17,16.46,14.43,14.07],
                borderColor: '#ff7f0e',
                fill: false,
                tension: 0.3
            }]
        }
    });

    /* DONUT */
    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: ['ADI','PNU','VG','GIM','SBIB','MSH'],
            datasets: [{
                data: [73,18,15,15,11,11],
                backgroundColor: ['#0d6efd','#ffc107','#fd7e14','#20c997','#6f42c1','#dc3545']
            }]
        }
    });

    /* BAR */
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC','JAN','FEB'],
            datasets: [
                {
                    label: 'Annual Fee',
                    data: [3.36,3.36,3.36,3.36,3.36,3.36,3.32,3.35,3.35,3.30,3.27],
                    backgroundColor: '#198754'
                },
                {
                    label: 'Fee Paid',
                    data: [0.08,0.06,0.09,0.10,0.14,0.15,0.12,0.16,0.16,0.14,0.14],
                    backgroundColor: '#a61e4d'
                }
            ]
        }
    });

    /* PIE */
    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: ['NSG1','NSG2','NSG5','NSG6'],
            datasets: [{
                data: [11,6,8,1],
                backgroundColor: ['#0dcaf0','#ff006e','#ffbe0b','#3a86ff']
            }]
        }
    });
</script>

</body>
</html>
