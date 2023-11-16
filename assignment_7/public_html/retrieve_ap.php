<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db_connection.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve the username (X) passed from the client side
    $username = $_GET['watchlistID'];

    // Prepare a SQL query to retrieve the Email and UserID of the user with the provided username
    $sql = "SELECT Watchlist_Name FROM Watchlist WHERE WatchlistID = ?";
    $stmt = $mysqli->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }

    $stmt->bind_param('s', $username);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            echo json_encode($user);
        } else {
            echo json_encode(["error" => "User not found"]);
        }
    } else {
        echo json_encode(["error" => "Database query failed"]);
    }
}

$mysqli->close(); // Close the MySQLi connection when done
?>