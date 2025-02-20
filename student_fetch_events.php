<?php
$servername = "localhost"; // Change if using a remote database
$username = "root"; // Change this to your actual database username
$password = ""; // Change this if your database has a password
$dbname = "campus_events"; // Ensure this matches your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch upcoming events
$sql = "SELECT name, DATE_FORMAT(date, '%M %d, %Y') AS formatted_date, time, venue, role 
        FROM events 
        WHERE date >= CURDATE() 
        ORDER BY date ASC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='event-card'>";
        echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
        echo "<p>Date: " . htmlspecialchars($row['formatted_date']) . "</p>";
        echo "<p>Time: " . htmlspecialchars($row['time']) . "</p>";
        echo "<p>Venue: " . htmlspecialchars($row['venue']) . "</p>";
        echo "<p>Role: " . htmlspecialchars($row['role']) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No upcoming events found.</p>";
}

$conn->close();
?>
