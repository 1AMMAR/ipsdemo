<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

$con = mysqli_connect('localhost', 'root', '','ipstest');

// get the post records
$email = $_POST['email'];
$password = $_POST['password'];


// database insert SQL code
$sql = "INSERT INTO `users` (`id`, `email`, `password`) VALUES ('', '$email', '$password')";

// insert in database 
$rs = mysqli_query($con, $sql);

if($rs)
{
	echo "<h1 style='text-align:center; padding-top:20%;'>Contact Records Inserted</h1>";
}

header( "refresh:1;url=add-user.php" );

?>