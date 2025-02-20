<?php
$conn = new mysqli("localhost", "root", "", "campus_events");

$result = $conn->query("SELECT * FROM event_funding");
$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}
echo json_encode($events);

$conn->close();
?>
