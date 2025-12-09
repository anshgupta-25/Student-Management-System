<?php
// Database configuration
$host = 'localhost';
$user = 'root'; // Default user for XAMPP/WAMP
$password = ''; // Set your MySQL password if different
$database = 'student_management';

// Create a new mysqli connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}
?>
