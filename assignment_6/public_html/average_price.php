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
        $sql = "SELECT w.WatchlistID, AVG(c.Price) AS AveragePrice
                FROM Watchlist w
                JOIN Watchlist_Crypto wc ON w.WatchlistID = wc.WatchlistID
                JOIN Cryptocurrency c ON wc.CryptoID = c.CryptoID
                GROUP BY w.WatchlistID
                LIMIT ?"; // Add the LIMIT clause here
        
        $stmt = $mysqli->prepare($sql);
        if (!$stmt)
            die("Prepare failed: " . $mysqli->error);
        
        $stmt->bind_param('i', $x); // Bind the value of X as an integer
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            
            // Fetch and display the results
            echo "<table>";
            echo "<tr><th>Watchlist ID</th><th>Average Price</th></tr>";
            while ($row = $result->fetch_assoc()) {
                $watchlistID = $row['WatchlistID'];
                $averagePrice = $row['AveragePrice'];
                
                // Create a hyperlink to the watchlist item
                echo "<tr><td><a href='queries/average_price.html?watchlistID=$watchlistID'>$watchlistID</a></td><td>$averagePrice</td></tr>";
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
