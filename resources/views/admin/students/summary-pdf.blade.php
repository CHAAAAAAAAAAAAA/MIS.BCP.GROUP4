<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Account Summary</title>
    <style>
        @page {
            size: 8.5in 11in; /* US Letter / Bond Paper */
            margin: 0.75in;
        }
        body {
            font-family: 'Segoe UI', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
        }
        h2 {
            font-size: 18px;
            margin-bottom: 5px;
            color: #2c3e50;
        }
        h3 {
            font-size: 14px;
            margin-bottom: 6px;
            color: #34495e;
            border-bottom: 1px solid #ccc;
            padding-bottom: 3px;
        }
        .section {
            margin-bottom: 20px;
        }
        .label {
            font-weight: 600;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            font-size: 11px;
        }
        th, td {
            padding: 5px 6px;
            border-bottom: 1px solid #e0e0e0;
        }
        td:last-child {
            text-align: right;
        }
        tr.group-header td {
            background-color: #f4f4f4;
            font-weight: bold;
            color: #2c3e50;
            padding-top: 10px;
        }
        .total-row td {
            font-weight: bold;
            border-top: 1px solid #999;
        }
    </style>
</head>
<body>
    <h2>Student Account Summary</h2>

    <div class="section">
        <h3>Student Information</h3>
        <p><span class="label">Student Number:</span> {{ $student->student_number }}</p>
        <p><span class="label">Name:</span> {{ $student->name }}</p>
        <p><span class="label">Program:</span> {{ $student->program }}</p>
        <p><span class="label">Year Level:</span> {{ $student->year_level }}</p>
        <p><span class="label">Section:</span> {{ $student->section }}</p>
        <p><span class="label">Schedule:</span> {{ $student->schedule }}</p>
    </div>

    <div class="section">
        <h3>Statement of Account</h3>
        <table>
            <tbody>
                <tr><td>Tuition</td><td>13 Units x ₱500</td><td>₱6,500</td></tr>
                <tr><td></td><td>Paid by EJA Foundation</td><td>₱6,500</td></tr>
                <tr class="total-row"><td colspan="2">Balance</td><td>₱0</td></tr>

                <tr class="group-header"><td colspan="3">Miscellaneous Fees</td></tr>
                <tr><td></td><td>Registration</td><td>₱400</td></tr>
                <tr><td></td><td>Library</td><td>₱650</td></tr>
                <tr><td></td><td>Athletics & Sports Dev. Fee</td><td>₱500</td></tr>
                <tr><td></td><td>Medical & Dental</td><td>₱400</td></tr>
                <tr><td></td><td>Cultural Fee</td><td>₱400</td></tr>
                <tr><td></td><td>Guidance & Counseling</td><td>₱400</td></tr>
                <tr><td></td><td>Energy Fee</td><td>₱1,000</td></tr>
                <tr><td></td><td>Laboratory Fee</td><td>₱600</td></tr>
                <tr><td></td><td>Community & Students Dev. Fee</td><td>₱600</td></tr>
                <tr><td></td><td>Insurance</td><td>₱25</td></tr>
                <tr class="total-row"><td colspan="2">Total Miscellaneous</td><td>₱4,975</td></tr>

                <tr class="group-header"><td colspan="3">Supplementary Fee</td></tr>
                <tr><td></td><td>School ID with Lace</td><td>₱350</td></tr>

                <tr class="group-header"><td colspan="3">Other Fee</td></tr>
                <tr><td></td><td>Medical Laboratory Fee</td><td>₱500</td></tr>

                <tr class="group-header"><td colspan="3">Less Payment</td></tr>
                <tr><td></td><td>O.R: 054796A</td><td>₱500</td></tr>
                <tr><td></td><td>O.R: 054796A</td><td>₱1,000</td></tr>
            </tbody>
        </table>
    </div>
</body>
</html>