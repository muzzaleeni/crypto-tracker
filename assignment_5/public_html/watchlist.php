<?php
include 'db_connection.php'; // Include the database connection file

class Watchlist
{
    public $Watchlist_Name;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $watchlist = $_POST;
    $user_id = $_POST['user_id'];
    $sql = "INSERT INTO Watchlist (Watchlist_Name, UserID) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('si', $watchlist['name'], $user_id);
    if ($stmt->execute()) {
        echo json_encode(["message" => "Watchlist added successfully"]);
    } else {
        echo "Error: " . $mysqli->error;
    }
}

$mysqli->close(); // Close the MySQLi connection when done
?>