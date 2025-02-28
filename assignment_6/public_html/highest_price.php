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
        $sql = "SELECT u.Username, MAX(c.Price) AS Highest_Price
                FROM User u
                JOIN Premium_User pu ON u.UserID = pu.UserID
                JOIN Premium_User_Watchlist pw ON pu.UserID = pw.UserID
                JOIN Watchlist_Crypto wc ON pw.WatchlistID = wc.WatchlistID
                JOIN Cryptocurrency c ON wc.CryptoID = c.CryptoID
                GROUP BY u.Username
                ORDER BY Highest_Price DESC
                LIMIT ?";
        
        $stmt = $mysqli->prepare($sql);
        if (!$stmt)
            die("Prepare failed: " . $mysqli->error);
        
        $stmt->bind_param('i', $x); // Bind the value of X as an integer
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            
            // Fetch and display the results
            echo "<table>";
            echo "<tr><th>Username</th><th>Highest Price</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td><a href='queries/highest_price.html?username=" . urlencode($row['Username']) . "'>" . $row['Username'] . "</a></td><td>" . $row['Highest_Price'] . "</td></tr>";
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
