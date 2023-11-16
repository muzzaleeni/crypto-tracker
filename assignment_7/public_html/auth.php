<?php
// Include this file at the top of your maintenance pages
session_start();

// Set error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Function to authenticate users
function authenticate($username, $password)
{
    include 'db_connection.php'; // Include the database connection file

    // Fetch user details
    $query = "SELECT * FROM User WHERE Username='$username' AND Password='$password'";
    $result = $mysqli->query($query);

    if (!$result) {
        // Query execution failed
        echo json_encode(["error" => "Database query failed: " . $result->error]);
        $mysqli->close();
        return false;
    }

    if ($result->num_rows === 1) {
        // User authenticated
        $_SESSION['authenticated'] = true;
        $mysqli->close();
        return true;
    } else {
        // Authentication failed
        $_SESSION['authenticated'] = false;
        $mysqli->close();
        echo json_encode(["error" => "Invalid username or password"]);
        return false;
    }
}
?>