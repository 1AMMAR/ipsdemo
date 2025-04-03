<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Path to autoload.php

session_start();  // Start the session to access the session data

// Check if the user is logged in (assuming user ID is stored in the session)
if (!isset($_SESSION['user_id'])) {
    die('You must be logged in to place an order');
}

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize the common input data
    $full_name = mysqli_real_escape_string($conn, $_POST['ink-name']);
    $email = mysqli_real_escape_string($conn, $_POST['ink-email']);
    $phone = mysqli_real_escape_string($conn, $_POST['ink-phone']);
    $additional_notes = mysqli_real_escape_string($conn, $_POST['ink-notes']);
    
    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];
    
    // Initialize an array to store order details for email
    $order_items = [];
    $success_count = 0;
    
    // Process each order item (up to 5)
    for ($i = 1; $i <= 5; $i++) {
        // Check if this item has an ink type selected
        if (isset($_POST["ink-type-$i"]) && !empty($_POST["ink-type-$i"])) {
            $ink_type = mysqli_real_escape_string($conn, $_POST["ink-type-$i"]);
            $quantity = (int)$_POST["ink-quantity-$i"];
            
            // Only process if quantity is greater than 0
            if ($quantity > 0) {
                // Insert the order data into the database
                $query = "INSERT INTO `orders` (`id`, `full name`, `email`, `phone number`, `ink type`, `quantity`, `additional notes`, `status`) 
                VALUES ('$user_id', '$full_name', '$email', '$phone', '$ink_type', '$quantity', '$additional_notes', 'open')";
                
                // Execute the query and check for errors
                if (mysqli_query($conn, $query)) {
                    $success_count++;
                    
                    // Add to order items array for email
                    $order_items[] = [
                        'ink_type' => $ink_type,
                        'quantity' => $quantity
                    ];
                } else {
                    echo "Error with item $i: " . mysqli_error($conn);
                }
            }
        }
    }
    
    // If at least one item was successfully added
    if ($success_count > 0) {
        // Send email notifications
        sendOrderEmails($full_name, $email, $phone, $order_items, $additional_notes);
        
        echo "<h1 style='text-align:center; padding-top:20%;'>Success! $success_count items ordered.</h1>";
        header("refresh:7;url=products.php");
    } else {
        echo "<h1 style='text-align:center; padding-top:20%;'>No valid items in your order.</h1>";
        header("refresh:7;url=products.php");
    }
}

// Function to send order emails
function sendOrderEmails($customer_name, $customer_email, $customer_phone, $order_items, $notes) {
    $email_one = "ammarghazi12@hotmail.com";
    $email_two = "honeysandal666@gmail.com";
    
    // Prepare email body with order details
    $email_body = "New Order from: $customer_name\n";
    $email_body .= "Email: $customer_email\n";
    $email_body .= "Phone: $customer_phone\n\n";
    $email_body .= "Order Items:\n";
    
    foreach ($order_items as $index => $item) {
        $email_body .= ($index + 1) . ". " . $item['ink_type'] . " - Quantity: " . $item['quantity'] . "\n";
    }
    
    if (!empty($notes)) {
        $email_body .= "\nAdditional Notes: $notes\n";
    }
    
    // Send emails to both recipients
    $recipients = [$email_one, $email_two];
    
    foreach ($recipients as $recipient) {
        try {
            $mail = new PHPMailer(true);
            
            // SMTP Settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587; // TLS port
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption
            $mail->SMTPAuth = true;
            $mail->Username = 'honeysandal666@gmail.com'; // Your Gmail
            $mail->Password = 'wsym qplz rxdj abya'; // App Password
        
            // Email Content
            $mail->setFrom('youremail@example.com', $customer_name); // Set the 'From' address properly
            $mail->addAddress($recipient);
            $mail->Subject = 'New Ink Order';
            $mail->Body = $email_body;
        
            $mail->send();
        } catch (Exception $e) {
            echo "Error sending email to $recipient: {$mail->ErrorInfo}";
        }
    }
}
?>

