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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['maintenance_id']) && isset($_FILES['report_image'])) {
    $maintenance_id = $_POST['maintenance_id'];
    $file = $_FILES['report_image'];
    
    // Check for errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo "Upload error: " . $file['error'];
        exit;
    }
    
    // Validate file type
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file['type'], $allowed_types)) {
        echo "Invalid file type. Only JPG, PNG, GIF, and WEBP are allowed.";
        exit;
    }
    
    // Create uploads directory if it doesn't exist
    $upload_dir = 'uploads/reports/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    // Generate unique filename
    $filename = 'report_' . $maintenance_id . '_' . time() . '_' . basename($file['name']);
    $filepath = $upload_dir . $filename;
    
    // Move the uploaded file
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        // Update database
        $sql = "UPDATE `maintenance` SET `report_image` = ? WHERE `maintenance id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $filepath, $maintenance_id);
        
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "Database update failed: " . $conn->error;
        }
        
        $stmt->close();
    } else {
        echo "Failed to move uploaded file.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>