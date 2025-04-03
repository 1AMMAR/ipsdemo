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

// Fixing SQL query to include order_id
$sql = "SELECT `order_id`, `id`, `full name`, `email`, `phone number`, `ink type`, `quantity`, `additional notes`, `status` FROM `orders`";
$result = $conn->query($sql);

$orders = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row; // Store each row in the array
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPS - Orders Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        'primary-dark': '#1d4ed8',
                        secondary: '#f97316',
                        dark: '#1e293b',
                        light: '#f8fafc',
                        gray: '#64748b',
                    },
                },
            },
        }
    </script>
</head>
<body class="bg-light text-dark">
    <main class="container mx-auto px-4 pt-28 pb-16 max-w-7xl">
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
            <h1 class="text-3xl font-bold text-primary mb-4">Orders Management</h1>

            <!-- Search and Filter Section -->
            <div class="flex flex-wrap gap-4 mb-4">
                <input type="text" id="search" class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-1/2" placeholder="Search by name, email, or phone...">
                
                <select id="statusFilter" class="border border-gray-300 rounded-lg px-4 py-2">
                    <option value="all">All Orders</option>
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
                </select>
            </div>

            <!-- Orders Table -->
            <div class="overflow-x-auto">
            <table class="w-full border-collapse">
    <thead>
        <tr class="bg-gray-100 text-left">
            <th class="px-4 py-3 font-semibold">Order ID</th> <!-- Added Order ID column -->
            <th class="px-4 py-3 font-semibold">ID</th>
            <th class="px-4 py-3 font-semibold">Full Name</th>
            <th class="px-4 py-3 font-semibold">Email</th>
            <th class="px-4 py-3 font-semibold">Phone</th>
            <th class="px-4 py-3 font-semibold">Ink Type</th>
            <th class="px-4 py-3 font-semibold">Quantity</th>
            <th class="px-4 py-3 font-semibold">Status</th>
            <th class="px-4 py-3 font-semibold">Additional Notes</th> <!-- New Column -->
            <th class="px-4 py-3 font-semibold">Actions</th>
        </tr>
    </thead>
    <tbody id="ordersTable">
        <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order): ?>
                <tr class="border-b border-gray-200 hover:bg-gray-50" 
                    data-status="<?= htmlspecialchars($order['status']) ?>" 
                    data-order-id="<?= htmlspecialchars($order['order_id']) ?>"> <!-- Ensure it's order_id -->
                    <td class="px-4 py-3"> <?= htmlspecialchars($order['order_id']) ?> </td> <!-- Display Order ID -->
                    <td class="px-4 py-3"> <?= htmlspecialchars($order['id']) ?> </td>
                    <td class="px-4 py-3"> <?= htmlspecialchars($order['full name']) ?> </td>
                    <td class="px-4 py-3"> <?= htmlspecialchars($order['email']) ?> </td>
                    <td class="px-4 py-3"> <?= htmlspecialchars($order['phone number']) ?> </td>
                    <td class="px-4 py-3"> <?= htmlspecialchars($order['ink type']) ?> </td>
                    <td class="px-4 py-3"> <?= htmlspecialchars($order['quantity']) ?> </td>
                    <td class="px-4 py-3">
                        <button class="status-toggle px-3 py-1 rounded-full text-sm font-medium <?= ($order['status'] == 'closed') ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800'; ?>" data-status="<?= $order['status'] ?>">
                            <?= ($order['status'] == 'closed') ? 'Closed' : 'Open' ?>
                        </button>
                    </td>
                    <td class="px-4 py-3"> <?= htmlspecialchars($order['additional notes']) ?> </td> <!-- Display Additional Notes -->
                    <td class="px-4 py-3">
                        <button class="confirm-order bg-green-500 text-white px-4 py-2 rounded-lg" data-id="<?= htmlspecialchars($order['email']) ?>"> <!-- Keep using 'id' for delete -->
                            Ready
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="10" class="px-4 py-3 text-center">No orders found.</td></tr> <!-- Adjusted colspan to 10 -->
        <?php endif; ?>
    </tbody>
</table>

            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            // Delete order
            $('.confirm-order').click(function() {
    var orderId = $(this).data('id');
    if (confirm("Are you sure you want to send a confirmation email?")) {
        $.post('email-order.php', { order_id: orderId }, function(response) {
            if (response === 'success') {
                alert('Confirmation email sent successfully!');
              
                location.reload();
            } else {
                alert('Failed to send confirmation email: ' + response);
            }
        });
    }
});


$('.status-toggle').click(function() {
    var button = $(this);
    var row = button.closest("tr");
    var orderId = row.data('order-id'); // Fetch order_id from the row
    var currentStatus = button.data('status');
    var newStatus = (currentStatus === 'open') ? 'closed' : 'open';

    $.ajax({
        url: 'update_status.php',
        type: 'POST',
        data: { order_id: orderId, status: newStatus }, // Send order_id
        success: function(response) {
            if (response === 'success') {
                button.data('status', newStatus);
                row.attr("data-status", newStatus); // Update table row status attribute
                button.toggleClass('bg-blue-100 text-blue-800 bg-green-100 text-green-800');
                button.text(newStatus === 'closed' ? 'Closed' : 'Open');
            } else {
                alert('Failed to update status.');
            }
        }
    });
});


            $('#search, #statusFilter').on("input change", function() {
                const searchValue = $("#search").val().toLowerCase();
                const statusValue = $("#statusFilter").val();

                $("#ordersTable tr").each(function() {
                    const name = $(this).find("td:eq(1)").text().toLowerCase();
                    const email = $(this).find("td:eq(2)").text().toLowerCase();
                    const phone = $(this).find("td:eq(3)").text().toLowerCase();
                    const status = $(this).attr("data-status");

                    const matchesSearch = name.includes(searchValue) || email.includes(searchValue) || phone.includes(searchValue);
                    const matchesStatus = (statusValue === "all" || status === statusValue);

                    $(this).toggle(matchesSearch && matchesStatus);
                });
            });
        });
    </script>
</body>
</html>
    