<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Path to autoload.php

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ipstest";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$full_name = isset($_POST['complaint-name']) ? $_POST['complaint-name'] : '';
$email = isset($_POST['complaint-email']) ? $_POST['complaint-email'] : '';
$order_id = isset($_POST['complaint-order']) ? $_POST['complaint-order'] : '';
$complaint_type = isset($_POST['complaint-type']) ? $_POST['complaint-type'] : '';
$complaint_details = isset($_POST['complaint-details']) ? $_POST['complaint-details'] : '';
$desired_resolution = isset($_POST['complaint-resolution']) ? $_POST['complaint-resolution'] : '';


$mail = new PHPMailer(true);

try {
    // SMTP Settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587; // TLS port
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption
    $mail->SMTPAuth = true;
    $mail->Username = 'honeysandal666@gmail.com'; // Your Gmail
    $mail->Password = 'wsym qplz rxdj abya'; // App Password

    // Email Content
    $mail->setFrom('youremail@example.com', 'Your Company Name'); // Set sender email & name
    $mail->addAddress("ammarghazi12@hotmail.com"); // Add recipient email
    $mail->Subject = 'Complaint Received  ';
    $mail->Body = "Dear $full_name,\n\nWe have received your complaint.\n\nType: $complaint_type\nDetails: $complaint_details\n With preferred resolution : $desired_resolution \n\n\nWe will get back to you shortly.\n\nBest Regards,\nYour Company Name";

    if ($mail->send()) {
        echo 'success';
    } else {
        echo 'Error sending email';
    }
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}

$conn->close();
?>
