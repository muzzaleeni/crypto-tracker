<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db_connection.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $x = $_POST['x']; // Retrieve the value of X from the client-side input
    if (empty($x)) {
        echo "Please provide a valid username.";
    } else {
        $sql = "SELECT u.Username
                FROM User u
                WHERE u.Username = ?";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $mysqli->error);
        }

        $stmt->bind_param('s', $x); // Bind the value of X as a string
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            // Fetch and display the results
            echo "<table>";
            echo "<tr><th>Username</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td><a href='queries/highest_price.html?username=" . urlencode($row['Username']) . "'>" . $row['Username'] . "</a></td></tr>";
            }
            echo "</table>";

            echo '<a href="pages/queries.html">Back to Queries Page</a>';
        } else {
            echo "Error: " . $mysqli->error;
        }
    }
}

$mysqli->close(); // Close the MySQLi connection when done
?>
