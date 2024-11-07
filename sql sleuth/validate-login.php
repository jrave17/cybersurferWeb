<?php
// Example MySQL connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "challenge_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the user input from the form
$user_input_username = $_POST['username'];
$user_input_password = $_POST['password'];

// **Vulnerable Query** - Susceptible to SQL Injection
$sql = "SELECT * FROM users WHERE username = '$user_input_username' AND password = '$user_input_password'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo "Welcome, " . htmlspecialchars($user_input_username) . "! You've successfully logged in.";
    echo "<br><strong>Flag:</strong> cybersurfer{sql_bypass_success}";
} else {
    echo "Invalid username or password.";
}

// Close the database connection
$conn->close();
?>
