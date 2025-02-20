<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campus_events";

// Enable MySQL error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database Connection Failed: " . $conn->connect_error]));
}

// Validate POST data
if (!isset($_POST['name'], $_POST['email'], $_POST['password'])) {
    die(json_encode(["status" => "error", "message" => "Invalid Request: Missing Data"]));
}

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);

if (empty($name) || empty($email) || empty($password)) {
    die(json_encode(["status" => "error", "message" => "All fields are required."]));
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Check if email already exists
$check_sql = "SELECT email FROM faculty WHERE email = ? UNION SELECT email FROM student WHERE email = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ss", $email, $email);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Email already exists"]);
    $check_stmt->close();
    exit;
}

$check_stmt->close();

// Insert into student table
$insert_sql = "INSERT INTO student (name, email, password) VALUES (?, ?, ?)";
$insert_stmt = $conn->prepare($insert_sql);
$insert_stmt->bind_param("sss", $name, $email, $hashed_password);

if ($insert_stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Signup successful"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $insert_stmt->error]);
}

$insert_stmt->close();
$conn->close();
?>