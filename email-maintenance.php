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

// Check if order_id is set
if (!isset($_POST['order_id'])) {
    die("Invalid request");
}

$order_id = $_POST['order_id'];

// Fetch the email for the specific order
$sql = "SELECT `id`, `full name`, `email`, `issue` FROM `maintenance` WHERE `email` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $order_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No record found");
}

$row = $result->fetch_assoc();
$full_name = $row['full name'];
$email = $row['email'];
$issue = $row['issue'];
$id = $row['id'];

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
    $mail->addAddress($email); // Add recipient email
    $mail->Subject = 'Your Maintenance Submission is Done';
    $mail->Body = "Maintenance Request ID: $id\nName: $full_name\nIssue: $issue";

    if ($mail->send()) {
        echo 'success';
    } else {
        echo 'Error sending email';
    }
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}

$stmt->close();
$conn->close();
?>
