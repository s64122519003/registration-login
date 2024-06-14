<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Username and password sent from form 
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM users WHERE username = '$username'";
        
    // Check if username exists and password is matched
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    // If there is a matched $username and $password, the number of row will be 1
    if($count == 1) {
        // Start a new session and assign variables
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
       header("location: welcome.php");
    }else {
       echo "Either username or password is incorrect.";
    }

    // Close connection
    mysqli_close($conn);
}
?>
 
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Username: </label><input type="text" name="username"><br><br>
        <label>Password: </label><input type="text" name="password"><br><br>
        <input type="submit" value="Submit">
    </form>

</body>
</html>