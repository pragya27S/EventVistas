<?php
$conn = new mysqli("localhost", "root", "", "campus_events");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $budget = $_POST["budget"];
    $food = $_POST["food"];
    $venue = $_POST["venue"];
    $misc = $_POST["misc"];

    $stmt = $conn->prepare("INSERT INTO event_funding (name, budget, food, venue, misc) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("siiii", $name, $budget, $food, $venue, $misc);
    $stmt->execute();
    $stmt->close();
}
$conn->close();
?>
