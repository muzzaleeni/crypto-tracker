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
        echo "You have to be registered to be able to have watchlist. Sign in function is still under development!";
        echo '<a href="pages/maintenance.html">Back to Maintenance Page</a>';
    }
}

$mysqli->close(); // Close the MySQLi connection when done
?>