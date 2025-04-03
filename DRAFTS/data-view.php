<?php
session_start(); // Start session

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    die("Access denied. Please log in. <a href='login.php'>Login</a>");
}

$user_id = $_SESSION["user_id"]; // Get logged-in user's ID

// Database connection
$con = mysqli_connect('localhost', 'root', '', 'ipstest');

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch data for the logged-in user
$sql = "SELECT id, fullname, email, notes, orders FROM inks WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Inks Data</title>
</head>
<body>

<h2>My Inks Data</h2>

<table >
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Notes</th>
        <th>Orders</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['id']) . "</td>
                    <td>" . htmlspecialchars($row['fullname']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>" . htmlspecialchars($row['notes']) . "</td>
                    <td>" . htmlspecialchars($row['orders']) . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No records found</td></tr>";
    }

    $stmt->close();
    mysqli_close($con);
    ?>
</table>

</body>
</html>
