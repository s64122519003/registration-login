<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Hi, <b><?php echo $_SESSION["username"]; ?></b>. Welcome to our site.</h1>
    <p>
        <a href="reset.php">Reset password</a>
        <a href="logout.php">Sign out</a>
    </p>
</body>
</html>