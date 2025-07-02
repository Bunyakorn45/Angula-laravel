<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background: #f4f6fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 700px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(44,62,80,0.10);
            padding: 40px 32px 32px 32px;
        }
        h2 {
            color: #34495e;
            margin-bottom: 18px;
            text-align: center;
        }
        h4 {
            color: #2980b9;
            margin-top: 32px;
            margin-bottom: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            margin-bottom: 32px;
        }
        th, td {
            padding: 12px 14px;
            border: 1px solid #e1e4ea;
            text-align: center;
        }
        th {
            background: #2980b9;
            color: #fff;
            font-weight: 500;
        }
        tr:nth-child(even) {
            background: #f8fafc;
        }
        .logout-btn {
            margin-top: 24px;
            display: inline-block;
            padding: 10px 28px;
            background: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            transition: background 0.2s;
        }
        .logout-btn:hover {
            background: #c0392b;
        }
        .chart-container {
            margin-top: 32px;
            background: #f8fafc;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(44,62,80,0.05);
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Welcome, {{ $user->Username ?? 'User' }}</h2>

    <h4>User Information</h4>
    <table>
        <tr>
            <th>Id_User</th>
            <th>Username</th>
            <th>Employee_Id</th>
            <th>Hospital_Id</th>
            <th>Permission_Id</th>
        </tr>
        <tr>
            <td>{{ $user->Id_User ?? '-' }}</td>
            <td>{{ $user->Username ?? '-' }}</td>
            <td>{{ $user->Employee_Id ?? '-' }}</td>
            <td>{{ $user->Hospital_Id ?? '-' }}</td>
            <td>{{ $user->Permission_Id ?? '-' }}</td>
        </tr>
    </table>

    <div class="chart-container">
        <canvas id="userChart" width="400" height="180"></canvas>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>

<script>
    // ตัวอย่างข้อมูลกราฟ (สามารถปรับให้ดึงจาก backend ได้)
    const ctx = document.getElementById('userChart').getContext('2d');
    const userChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Employee_Id', 'Hospital_Id', 'Permission_Id'],
            datasets: [{
                label: 'User Info',
                data: [
                    {{ $user->Employee_Id ?? 0 }},
                    {{ $user->Hospital_Id ?? 0 }},
                    {{ $user->Permission_Id ?? 0 }}
                ],
                backgroundColor: [
                    '#2980b9',
                    '#27ae60',
                    '#e67e22'
                ],
                borderRadius: 8
            }]
        },
        options: {
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
</script>
</body>
</html>