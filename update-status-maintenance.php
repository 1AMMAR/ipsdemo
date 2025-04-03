<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ipstest";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the order ID and status from the request
$order_id = isset($_POST['order_id']) ? $_POST['order_id'] : null;
$status = isset($_POST['status']) ? $_POST['status'] : null;

if ($order_id && $status) {
    // Update the status of the order in the database
    $sql = "UPDATE `maintenance` SET `status` = ? WHERE `maintenance id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $order_id);
    
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
}

$conn->close();
?>
