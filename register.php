<?php
// Include config file
require_once "config.php";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // username and password sent from form 
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New user created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign up</title>
</head>
<body>
    <h2>Sign up</h2>
        <p>Please fill this form to create an account.</p>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label>Username: </label><input type="text" name="username"><br><br>
            <label>Password: </label><input type="text" name="password"><br><br>
            <input type="submit" value="Submit">
        </form>
        
</body>
</html>