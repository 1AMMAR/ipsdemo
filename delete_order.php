<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ipstest";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['order_id'])) { // Changed to check for 'order_id'
    $orderId = $_POST['order_id'];

    // Corrected SQL query to delete by 'order_id'
    $sql = "DELETE FROM `orders` WHERE `order_id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orderId); // Bind 'order_id' parameter

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'failure';
    }

    $stmt->close();
}

$conn->close();
?>
