<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "campus_events";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => "Error deleting event: " . $stmt->error]);
    }
    
    $stmt->close();
}

$conn->close();
?>