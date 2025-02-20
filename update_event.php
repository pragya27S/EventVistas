<?php
include "db_config.php";

$id = $_POST['id'];
$name = $_POST['name'];
$date = $_POST['date'];
$time = $_POST['time'];
$venue = $_POST['venue'];
$role = $_POST['role'];

$sql = "UPDATE events SET name=?, date=?, time=?, venue=?, role=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $name, $date, $time, $venue, $role, $id);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
