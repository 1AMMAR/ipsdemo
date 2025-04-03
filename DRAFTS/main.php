<?php

session_start();
// Database connection
$conn = new mysqli("localhost", "root", "", "ipstest");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all data from 'users' table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);


// Check if the session is set and the email is available
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    $email = "Guest"; // or you could redirect the user if session is not found
}

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else {
    $id = "null"; // or you could redirect the user if session is not found
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<h1><?php echo htmlspecialchars ($id); ?></h1>
<br><br><br>
<h5 ><?php echo htmlspecialchars($email); ?></h5>

   
    <form action="upload-data.php" method="post">

    <input type="hidden" name="id" id="" value="<?php echo htmlspecialchars ($id);?>">
        <input type="text" name="fullname" id="" value="fname">
        <input type="text" name="email" id="" value="email">
        <input type="text" name="notes" id="" value="notes">
        <input type="text" name="orders" id="" value="orders">
        <input type="submit">
        <a href="data-view.php"> show </a>


    </form>
 
</body>
</html>