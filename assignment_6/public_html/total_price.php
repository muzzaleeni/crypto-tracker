<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db_connection.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $x = $_POST['x']; // Retrieve the value of X from the client-side input
    if (!is_numeric($x) || $x <= 0) {
        echo "Please provide a valid positive number for X.";
    } else {
        $sql = "SELECT u.Username, SUM(c.Price) AS Total_Price
                FROM User u
                JOIN Basic_User bu ON u.UserID = bu.UserID
                JOIN Basic_User_Crypto buc ON bu.UserID = buc.UserID
                JOIN Cryptocurrency c ON buc.CryptoID = c.CryptoID
                GROUP BY u.Username
                LIMIT ?"; // Add the LIMIT clause here

        $stmt = $mysqli->prepare($sql);
        if (!$stmt)
            die("Prepare failed: " . $mysqli->error);

        $stmt->bind_param('i', $x); // Bind the value of X as an integer
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            // Fetch and display the results
            echo "<table>";
            echo "<tr><th>Username</th><th>Total Price</th></tr>";
            while ($row = $result->fetch_assoc()) {
                $username = $row['Username'];
                $totalPrice = $row['Total_Price'];

                echo "<tr><td><a href='queries/highest_price.html?username=" . urlencode($username) . "'>" . $username . "</a></td><td>" . $totalPrice . "</td></tr>";
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
