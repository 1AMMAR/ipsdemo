<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ipstest";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['order_id']) && isset($_POST['status'])) { // Check 'order_id' instead of 'id'
    $order_id = intval($_POST['order_id']); // Ensure to use 'order_id'
    $status = $_POST['status'];

    // Corrected SQL query to update based on 'order_id'
    $sql = "UPDATE `orders` SET `status` = ? WHERE `order_id` = ?"; // Use prepared statements
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $order_id); // Bind 'order_id' and 'status'
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
}

$conn->close();
?>
