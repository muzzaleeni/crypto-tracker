<?php
// autocomplete.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = $_POST['input'];

    // Check if the input is not empty before executing the query
    if (!empty($input)) {
        // Modify your SQL query for autocomplete with prefix matching
        $sql = "SELECT u.Username
                FROM User u
                WHERE u.Username LIKE ?"; // Use LIKE for partial matching
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $input = $input . '%'; // Add '%' only after the input for prefix matching
            $stmt->bind_param('s', $input);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                // Output autocomplete suggestions
                while ($row = $result->fetch_assoc()) {
                    echo '<div>' . $row['Username'] . '</div>';
                }

                $stmt->close();
            } else {
                echo 'Error executing query: ' . $stmt->error;
            }
        } else {
            echo 'Prepare failed: ' . $mysqli->error;
        }
    } // No else block needed for an empty input
} else {
    echo 'Invalid request method';
}

$mysqli->close();
?>
