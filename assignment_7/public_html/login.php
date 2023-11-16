<?php
// Set error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the authentication function
require_once('auth.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Authenticate the user
    if (authenticate($username, $password) && $username == 'admin' && $password == 'admin') {
        // Start the session
        session_start();

        header('Location: pages/maintenance.php');
        exit();
    } else {
        // Display an error message
        echo "Invalid admin username or password";
        echo '<br><a href="pages/maintenance.php">Back to Maintenance Page</a>';
    }
} else {
    // If the form is not submitted, show an error message
    echo "Invalid access. Please submit the login form.";
}
?>