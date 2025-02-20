<?php
// student_fetch_events.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$servername = "localhost";
$username = "root";
$password = "";
$database = "campus_events";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Set charset to handle special characters
$conn->set_charset("utf8");

try {
    // Fetch events
    $sql = "SELECT id, name, date, time, venue, role FROM events ORDER BY date ASC";
    $result = $conn->query($sql);

    if ($result) {
        $events = array();
        while ($row = $result->fetch_assoc()) {
            // Ensure date is in correct format
            $row['date'] = date('Y-m-d', strtotime($row['date']));
            $events[] = $row;
        }
        echo json_encode($events);
    } else {
        echo json_encode(["error" => "Query failed: " . $conn->error]);
    }
} catch (Exception $e) {
    echo json_encode(["error" => "Exception: " . $e->getMessage()]);
} finally {
    $conn->close();
}
?>