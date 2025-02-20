<?php
$servername = "localhost"; // Change if necessary
$username = "root"; // Default XAMPP MySQL user
$password = ""; // Default XAMPP MySQL password
$database = "campus_events"; // Use your database name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $venue = $_POST["venue"];
    $role = $_POST["role"];

    $stmt = $conn->prepare("INSERT INTO events (name, date, time, venue, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $date, $time, $venue, $role);

    if ($stmt->execute()) {
        echo "Event added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
