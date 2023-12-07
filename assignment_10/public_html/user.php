<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db_connection.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST;
    $sql = "INSERT INTO User (Email, Username, Password, Is_Premium) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    if (!$stmt)
        die("Prepare failed: " . $mysqli->error);
    $stmt->bind_param('sssi', $user['email'], $user['username'], $user['password'], $user['premium']);
    if ($stmt->execute()) {
        echo json_encode(["message" => "User added successfully"]);
        echo '<a href="pages/maintenance.php">Back to Maintenance Page</a>';
    } else {
        echo "Error: " . $mysqli->error;
    }
}

$mysqli->close(); // Close the MySQLi connection when done
?>