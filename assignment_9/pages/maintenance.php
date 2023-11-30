<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../auth.php');

// Check if the user is authenticated
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
  $authenticated = 'notauthenticated';
} else {
  $authenticated = 'authenticated';
}

// Handle logout
if (isset($_POST['logout'])) {
  // Unset all of the session variables
  $_SESSION = array();

  // Destroy the session
  session_destroy();

  // Redirect to the login page or any other desired page
  header('Location: maintenance.php');
  exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Alpine Crypto Tracker</title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../style.css" />
</head>

<body>
  <!-- Navigation Bar -->
  <div class="topnav">
    <a class="left-section" href="../index.html">Alpine Crypto Tracker</a>
    <div class="right-section">
      <a href="./queries.html" class="button">Queries</a>
      <a href="./maintenance.php" class="button"> Maintenance </a>
      <a href="./disclaimer.html" class="button"> Disclaimer </a>

      <?php if ($authenticated === 'notauthenticated') { ?>
        <!-- Sign-in Form -->
        <div class="button" id="signin-main-btn">Sign in</div>
      <?php } else { ?>
        <!-- Log out Button -->
        <form method="post" style="display: inline;">
          <input type="submit" name="logout" value="Log out" class="button" />
        </form>
      <?php } ?>
    </div>
  </div>

  <!-- Form -->
  <div class="overlay" id="form">
    <div class="wrapper">
      <div class="topnav" id="in-nav">
        <div class="pop-up-nav active" id="signin-btn">Sign in</div>
        <div class="pop-up-nav" id="signup-btn">Sign up</div>
      </div>
      <div class="content" id="signin">
        <div class="container">
          <form action="../login.php" method="post">
            <p>Admin Login: admin<br> Admin Password: admin<br></p>
            <input type="text" name="username" placeholder="Username" />
            <input type="text" name="password" placeholder="Password" />
            <input type="submit" value="Submit" class="center-button" />
          </form>
        </div>
      </div>
      <div class="content" id="signup">
        <div class="container">
          <form action="../user.php" method="post">
            <input type="text" name="username" required placeholder="Username" />

            <input type="text" name="email" required placeholder="Email" />

            <input type="text" name="password" required placeholder="Password" />

            <div class="checkb">
              <label for="premium">Wish to enjoy premium subscription benefits?</label>
              <input type="checkbox" name="premium" id="premium" />
            </div>
            <input type="submit" value="Submit" class="center-button" />
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Maintenance Section -->
  <?php if ($authenticated === 'notauthenticated') { ?>
    <div class="message center-align-elem">
      <h1>Sign in as Admin to view Maintenance page!</h1>
    </div>
  <?php } ?>

  <div class="maintenance <?php echo $authenticated; ?>">
    <ul>
      <li><a href="../input/users-input.html">Input for Users Page</a></li>
      <li><a href="../input/crypto-input.html">Input for Cryptocurrency Page</a></li>
      <li><a href="../input/wl-input.html">Input for Watchlist Page</a></li>
    </ul>
  </div>

  <script src="../js/script.js"></script>
</body>

</html>