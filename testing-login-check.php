<?php
// Start the session
session_start();

// Establish a database connection
$con = mysqli_connect('localhost', 'root', '', 'ipstest');

// Check if the connection is successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the POST data
$email = $_POST['email'];
$password = $_POST['password'];

// Sanitize input to prevent SQL injection
$email = mysqli_real_escape_string($con, $email);
$password = mysqli_real_escape_string($con, $password);

// Query the database to check if the user exists with the given email and password
$query = mysqli_query($con, "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'");

// Check if the query returns any result
if (mysqli_num_rows($query) > 0) {
    // Fetch the user data from the result
    $row = mysqli_fetch_assoc($query);
    
    $_SESSION["user_id"] = $row["id"]; 
    // Store the user's email in the session
    $_SESSION['email'] = $row['email'];
    $_SESSION['id'] = $row['id'];
    
    // Display a welcome message
    echo "<h1 style='text-align:center; padding-top:20%;'>Welcome</h1>";
    
    // Redirect to the next page after 1 second
    header("refresh:1;url=ips.php");
} else {
    // If no matching user is found, display an error message
    echo "<h1 style='text-align:center; padding-top:20%;'>User Does Not Exist</h1>";
    
    // Redirect back to the login page after 1 second
    header("refresh:1;url=login.php");
}

// Close the database connection
mysqli_close($con);
?>
