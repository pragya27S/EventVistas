<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "campus_events";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Validate POST data
if (!isset($_POST['email'], $_POST['password'])) {
    die("Invalid Request: Missing Data");
}

$email = trim($_POST['email']);
$password = trim($_POST['password']);

if (empty($email) || empty($password)) {
    die("Email and Password are required.");
}

// Check in faculty table first
$sql_faculty = "SELECT id, name, password FROM faculty WHERE email = ?";
$stmt_faculty = $conn->prepare($sql_faculty);
$stmt_faculty->bind_param("s", $email);
$stmt_faculty->execute();
$result_faculty = $stmt_faculty->get_result();

if ($result_faculty->num_rows === 1) {
    $row = $result_faculty->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_type'] = 'faculty';
        echo "faculty"; // Redirect to faculty page
        exit;
    }
}

// Check in student table
$sql_student = "SELECT id, name, password FROM student WHERE email = ?";
$stmt_student = $conn->prepare($sql_student);
$stmt_student->bind_param("s", $email);
$stmt_student->execute();
$result_student = $stmt_student->get_result();

if ($result_student->num_rows === 1) {
    $row = $result_student->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_type'] = 'student';
        echo "student"; // Redirect to student page
        exit;
    }
}

// If no match found
echo "Invalid email or password.";
$stmt_faculty->close();
$stmt_student->close();
$conn->close();
?>