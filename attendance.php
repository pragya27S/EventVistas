<?php
$host = "localhost";
$user = "root"; 
$password = ""; 
$dbname = "campus_events"; 




$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch Event-wise Attendance (Bar Chart)
$eventData = [];
$sql = "SELECT event_name, COUNT(CASE WHEN attendance_status = 'Present' THEN 1 END) AS present_count FROM attendance GROUP BY event_name";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $eventData[$row['event_name']] = $row['present_count'];
}

// Fetch Student-wise Attendance (Pie Chart)
$studentData = [];
$sql = "SELECT student_name, COUNT(CASE WHEN attendance_status = 'Present' THEN 1 END) AS present_count FROM attendance GROUP BY student_name";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $studentData[$row['student_name']] = $row['present_count'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Charts</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: #f4f4f4;
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        .chart-container {
            width: 50%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

    <h2>Event-wise Attendance (Bar Chart)</h2>
    <div class="chart-container">
        <canvas id="eventChart"></canvas>
    </div>

    <h2>Student-wise Attendance (Pie Chart)</h2>
    <div class="chart-container">
        <canvas id="studentChart"></canvas>
    </div>

    <script>
        // Event-wise Attendance Data
        var eventLabels = <?php echo json_encode(array_keys($eventData)); ?>;
        var eventCounts = <?php echo json_encode(array_values($eventData)); ?>;

        var ctx1 = document.getElementById('eventChart').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: eventLabels,
                datasets: [{
                    label: 'Present Students',
                    data: eventCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Student-wise Attendance Data
        var studentLabels = <?php echo json_encode(array_keys($studentData)); ?>;
        var studentCounts = <?php echo json_encode(array_values($studentData)); ?>;

        var ctx2 = document.getElementById('studentChart').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: studentLabels,
                datasets: [{
                    data: studentCounts,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

</body>
</html>