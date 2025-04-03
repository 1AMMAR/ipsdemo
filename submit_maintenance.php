<?php
session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Path to autoload.php


// Database connection details
$servername = "localhost"; // Replace with your database server
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "ipstest"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(["status" => "error", "message" => "User not logged in."]);
        exit;
    }
    
    $id = $_SESSION['user_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $issue = $_POST['issue'];
    $preferred_date = $_POST['preferred_date'];
    $date_received = date('Y-m-d H:i:s');
    $image_path = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Validate file type
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            echo json_encode(["status" => "error", "message" => "Invalid file type."]);
            exit;
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_path = $target_file;
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to upload image."]);
            exit;
        }
    }

    $stmt = $conn->prepare("INSERT INTO maintenance (`id`, `full name`, `email`, `phone number`, `address`, `issue`, `preferred date`, `date received`, `image` ,`status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ? ,'open')");
    $stmt->bind_param("issssssss", $id, $full_name, $email, $phone, $address, $issue, $preferred_date, $date_received, $image_path);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Request submitted successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database error: " . $stmt->error]);
    }
   

$mail = new PHPMailer(true);
$email_one = "ammarghazi12@hotmail.com";
$email_two = "honeysandal666@gmail.com";

$email_addresses = [$email_one, $email_two]; // Store emails in an array

foreach ($email_addresses as $email) {
    try {
        // Clear previous recipients before adding the new one
        $mail->clearAddresses();
        
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587; // TLS port
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption
        $mail->SMTPAuth = true;
        $mail->Username = 'honeysandal666@gmail.com'; // Your Gmail
        $mail->Password = 'wsym qplz rxdj abya'; // App Password (see Step 3)

        // Email Content
        $mail->setFrom('youremail@example.com', $full_name); // Set the 'From' address properly
        $mail->addAddress($email); // Add each email address one by one
        $mail->Subject = 'New Maintenance Submission';
        $mail->Body = $id . $full_name .$issue;

        $mail->send();
        echo 'Email sent to ' . $email . '!';
    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
  }
}
?>