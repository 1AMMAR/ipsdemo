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

// Check if we need to add the column
$result = $conn->query("SHOW COLUMNS FROM `maintenance` LIKE 'report_image'");
if ($result->num_rows == 0) {
    // Add the column if it doesn't exist
    $conn->query("ALTER TABLE `maintenance` ADD `report_image` VARCHAR(255) NULL AFTER `image`");
}

$sql = "SELECT `maintenance id`, `id`, `full name`, `email`, `phone number`, `address`, `issue`, `preferred date`, `date received`, `image`, `report_image`, `status` FROM `maintenance`";
$result = $conn->query($sql);

$orders = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPS - Maintenance Requests</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 100%;
            max-width: 500px;
            transform : scale(1.8);
            border-radius: 8px;
        }
        .close {

            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover {
            color: black;
        }
        .preview-image {
            max-width: 100%;
            max-height: 100%;
            max-height: 300px;
            display: block;
        
            margin: 10px auto;
        }
    </style>
</head>
<body class="bg-light text-dark">
    <main class="container mx-auto px-4 pt-28 pb-16 max-w-7xl">
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
            <h1 class="text-3xl font-bold text-primary mb-4">Maintenance Requests</h1>
            
            <div class="flex flex-wrap gap-4 mb-4">
                <input type="text" id="search" class="border border-gray-300 rounded-lg px-4 py-2 w-full md:w-1/2" placeholder="Search by name, email, or phone...">
                <select id="statusFilter" class="border border-gray-300 rounded-lg px-4 py-2">
                    <option value="all">All Requests</option>
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
                </select>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="px-4 py-3 font-semibold">Maintenance ID</th>
                            <th class="px-4 py-3 font-semibold">ID</th>
                            <th class="px-4 py-3 font-semibold">Full Name</th>
                            <th class="px-4 py-3 font-semibold">Email</th>
                            <th class="px-4 py-3 font-semibold">Phone</th>
                            <th class="px-4 py-3 font-semibold">Address</th>
                            <th class="px-4 py-3 font-semibold">Issue</th>
                            <th class="px-4 py-3 font-semibold">Preferred Date</th>
                            <th class="px-4 py-3 font-semibold">Date Received</th>
                            <th class="px-4 py-3 font-semibold">Image</th>
                            <th class="px-4 py-3 font-semibold">Report Image</th>
                            <th class="px-4 py-3 font-semibold">Status</th>
                            <th class="px-4 py-3 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="ordersTable">
                        <?php foreach ($orders as $order): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50" data-status="<?= htmlspecialchars($order['status']) ?>">
                                <td class="px-4 py-3"> <?= htmlspecialchars($order['maintenance id']) ?> </td>
                                <td class="px-4 py-3"> <?= htmlspecialchars($order['id']) ?> </td>
                                <td class="px-4 py-3"> <?= htmlspecialchars($order['full name']) ?> </td>
                                <td class="px-4 py-3"> <?= htmlspecialchars($order['email']) ?> </td>
                                <td class="px-4 py-3"> <?= htmlspecialchars($order['phone number']) ?> </td>
                                <td class="px-4 py-3"> <?= htmlspecialchars($order['address']) ?> </td>
                                <td class="px-4 py-3"> <?= htmlspecialchars($order['issue']) ?> </td>
                                <td class="px-4 py-3"> <?= htmlspecialchars($order['preferred date']) ?> </td>
                                <td class="px-4 py-3"> <?= htmlspecialchars($order['date received']) ?> </td>
                                <td class="px-4 py-3">
                                    <?php if (!empty($order['image'])): ?>
                                        <a href="<?= htmlspecialchars($order['image']) ?>" target="_blank" style="color: green;">Show Image</a>
                                    <?php else: ?>
                                        No Image
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3">
                                    <?php if (!empty($order['report_image'])): ?>
                                        <button class="view-image bg-blue-500 text-white px-2 py-1 rounded text-sm" 
                                                data-image="<?= htmlspecialchars($order['report_image']) ?>">
                                            View Image
                                        </button>
                                    <?php else: ?>
                                        <button class="upload-report-image bg-green-500 text-white px-2 py-1 rounded text-sm"
                                                data-id="<?= htmlspecialchars($order['maintenance id']) ?>">
                                            Upload Image
                                        </button>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3">
                                    <button class="status-toggle px-3 py-1 rounded-full text-sm font-medium <?= ($order['status'] == 'closed') ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800'; ?>" data-id="<?= $order['maintenance id'] ?>" data-status="<?= $order['status'] ?>">
                                        <?= ($order['status'] == 'closed') ? 'Closed' : 'Open' ?>
                                    </button>
                                </td>
                                <td class="px-4 py-3">
                                    <button class="confirm-order bg-green-500 text-white px-4 py-2 rounded-lg" data-id="<?= htmlspecialchars($order['email']) ?>">
                                        Confirm
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Upload Image Modal -->
    <div id="uploadModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 class="text-xl font-bold mb-4">Upload Report Image</h2>
            <form id="uploadForm" enctype="multipart/form-data">
                <input type="hidden" id="maintenance_id" name="maintenance_id">
                <div class="mb-4">
                    <label for="report_image" class="block text-sm font-medium text-gray-700 mb-1">Select Image</label>
                    <input type="file" id="report_image" name="report_image" accept="image/*" class="w-full border border-gray-300 rounded p-2" required>
                    <div id="imagePreview" class="mt-2"></div>
                </div>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg w-full">Upload</button>
            </form>
        </div>
    </div>

    <!-- View Image Modal -->
    <div id="viewImageModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 class="text-xl font-bold mb-4">Report Image</h2>
            <img id="reportImage" class="preview-image" src="/placeholder.svg" alt="Report Image">
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Upload report image
            $('.upload-report-image').click(function() {
                const maintenanceId = $(this).data('id');
                $('#maintenance_id').val(maintenanceId);
                $('#uploadModal').css('display', 'block');
            });

            // View image
            $('.view-image').click(function() {
                const imagePath = $(this).data('image');
                $('#reportImage').attr('src', imagePath);
                $('#viewImageModal').css('display', 'block');
            });

            // Close modals
            $('.close').click(function() {
                $('.modal').css('display', 'none');
            });

            $(window).click(function(e) {
                if ($(e.target).hasClass('modal')) {
                    $('.modal').css('display', 'none');
                }
            });

            // Image preview
            $('#report_image').change(function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').html('<img src="' + e.target.result + '" class="preview-image" />');
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Submit form
            $('#uploadForm').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                
                $.ajax({
                    url: 'upload-report-image.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response === 'success') {
                            alert('Report image uploaded successfully!');
                            location.reload();
                        } else {
                            alert('Failed to upload image: ' + response);
                        }
                    },
                    error: function() {
                        alert('An error occurred during upload.');
                    }
                });
            });

            // confirm order
            $('.confirm-order').click(function() {
                var orderId = $(this).data('id');
                if (confirm("Are you sure you want to send a confirmation email?")) {
                    $.post('email-maintenance.php', { order_id: orderId }, function(response) {
                        if (response === 'success') {
                            alert('Confirmation email sent successfully!');
                            location.reload();
                        } else {
                            alert('Failed to send confirmation email: ' + response);
                        }
                    });
                }
            });

            // Toggle status
            $('.status-toggle').click(function() {
                var button = $(this);
                var orderId = button.data('id');
                var currentStatus = button.data('status');
                var newStatus = (currentStatus === 'open') ? 'closed' : 'open';

                $.post('update-status-maintenance.php', { order_id: orderId, status: newStatus }, function(response) {
                    if (response === 'success') {
                        button.data('status', newStatus);
                        button.text(newStatus === 'closed' ? 'Closed' : 'Open');
                        button.toggleClass('bg-blue-100 text-blue-800 bg-green-100 text-green-800');
                    } else {
                        alert('Failed to update status.');
                    }
                });
            });

            $('#search, #statusFilter').on("input change", function() {
                const searchValue = $("#search").val().toLowerCase();
                const statusValue = $("#statusFilter").val();

                $("#ordersTable tr").each(function() {
                    const name = $(this).find("td:eq(2)").text().toLowerCase();
                    const email = $(this).find("td:eq(3)").text().toLowerCase();
                    const phone = $(this).find("td:eq(4)").text().toLowerCase();
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