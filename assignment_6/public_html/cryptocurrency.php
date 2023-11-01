<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db_connection.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cryptocurrency = $_POST;
    $sql = "INSERT INTO Cryptocurrency (Rating, Name, Price, Sales_Volume) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('isdd', $cryptocurrency['rating'], $cryptocurrency['name'], $cryptocurrency['price'], $cryptocurrency['sales_volume']);
    if ($stmt->execute()) {
        echo json_encode(["message" => "Cryptocurrency added successfully"]);
        echo '<a href="pages/maintenance.html">Back to Maintenance Page</a>';
    } else {
        echo "Error: " . $mysqli->error;
    }
}

$mysqli->close(); // Close the MySQLi connection when done
?>