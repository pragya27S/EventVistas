<?php
// test_connection.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$servername = "localhost";
$username = "root";
$password = "";
$database = "campus_events";

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
    }

    // Test query
    $sql = "SELECT * FROM events";
    $result = $conn->query($sql);

    if ($result) {
        $events = [];
        while($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
        echo json_encode([
            "status" => "success",
            "connection" => "OK",
            "row_count" => count($events),
            "data" => $events
        ]);
    } else {
        echo json_encode(["error" => "Query failed: " . $conn->error]);
    }

    $conn->close();
} catch (Exception $e) {
    echo json_encode(["error" => "Exception: " . $e->getMessage()]);
}
?>