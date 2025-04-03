<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ipstest";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete Functionality
if (isset($_GET['delete']) && isset($_GET['table']) && isset($_GET['id_column'])) {
    $id = intval($_GET['delete']);
    $table = $_GET['table'];
    $id_column = $_GET['id_column'];
    
    $sql = "DELETE FROM `$table` WHERE `$id_column`=$id";
    $conn->query($sql);
    header("Location: admin.php");
    exit();
}

// Search Functionality
function displayTable($conn, $table, $columns, $id_column) {
    $search = isset($_GET['search_' . $table]) ? trim($_GET['search_' . $table]) : '';
    
    $sql = "SELECT * FROM `$table`";
    if (!empty($search)) {
        $search = $conn->real_escape_string($search);
        $columns_with_backticks = array_map(fn($col) => "`$col` LIKE '%$search%'", $columns);
        $sql .= " WHERE " . implode(" OR ", $columns_with_backticks);
    }
    $result = $conn->query($sql);

    echo "<div class='table-container overflow-x-auto bg-white rounded-xl shadow-sm border border-slate-200 p-6'>";

    echo "<div class='flex justify-between items-center mb-6'>";
    echo "<h2 class='text-xl font-semibold text-slate-800 capitalize'>" . htmlspecialchars($table) . "</h2>";
    
    // Table-specific search form
    echo "<form method='get' class='relative w-72'>";
    echo "<input type='text' name='search_$table' placeholder='Search " . htmlspecialchars($table) . "...' value='" . htmlspecialchars($search) . "' 
          class='w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all'>";
    echo "<i class='fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400'></i>";
    echo "</form>";
    echo "</div>";

    echo "<div class='overflow-x-auto rounded-lg border border-slate-200'>";
    echo "<table class='min-w-full divide-y divide-slate-200'>";
    echo "<thead class='bg-slate-50'><tr>";
    
    foreach ($columns as $col) {
        echo "<th class='px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider'>" . htmlspecialchars($col) . "</th>";
    }
    echo "<th class='px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider'>Actions</th></tr></thead>";
    
    echo "<tbody class='bg-white divide-y divide-slate-200'>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='hover:bg-slate-50 transition-colors duration-150'>";
        foreach ($columns as $col) {
            if ($col == 'status') {
                $statusClass = getStatusColor($row[$col]);
                echo "<td class='px-6 py-4 whitespace-nowrap'>";
                echo "<span class='px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full " . $statusClass . "'>";
                echo htmlspecialchars($row[$col]);
                echo "</span></td>";
            } else if ($col == 'image') {
                echo "<td class='px-6 py-4 whitespace-nowrap'>";
                if (!empty($row[$col])) {
                    echo "<a href='" . htmlspecialchars($row[$col]) . "' target='_blank' class='relative group inline-block'>";
                    echo "<img src='" . htmlspecialchars($row[$col]) . "' alt='User Image' class='w-16 h-16 object-cover rounded-lg shadow-sm transition-transform group-hover:scale-105'>";
                    echo "<div class='absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-200'></div>";
                    echo "</a>";
                } else {
                    echo "<span class='text-slate-400'>No image</span>";
                }
                echo "</td>";
            } else if ($col == 'report_image') {
                echo "<td class='px-6 py-4 whitespace-nowrap'>";
                if (!empty($row[$col])) {
                    echo "<a href='" . htmlspecialchars($row[$col]) . "' target='_blank' class='relative group inline-block'>";
                    echo "<img src='" . htmlspecialchars($row[$col]) . "' alt='Report Image' class='w-16 h-16 object-cover rounded-lg shadow-sm transition-transform group-hover:scale-105'>";
                    echo "<div class='absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all duration-200'></div>";
                    echo "</a>";
                } else {
                    echo "<span class='text-slate-400'>No report image</span>";
                }
                echo "</td>";
            } else {
                echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-slate-600'>" . htmlspecialchars($row[$col]) . "</td>";
            }
        }
        
        echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-slate-500 text-right'>";
        if (isset($row[$id_column])) {
            echo "<button onclick='showDeleteModal(\"" . $row[$id_column] . "\", \"$table\", \"$id_column\")' 
                    class='inline-flex items-center px-3 py-1 rounded-md text-red-600 hover:text-red-700 hover:bg-red-50 transition-colors duration-150'>
                    <i class='fas fa-trash-alt mr-2'></i>
                    <span>Delete</span>
                </button>";
        }
        echo "</td></tr>";
    }
    echo "</tbody></table></div></div>";
}

function getStatusColor($status) {
    $status = strtolower($status);
    $statusMap = [
        'pending' => 'bg-yellow-100 text-yellow-800',
        'in progress' => 'bg-blue-100 text-blue-800',
        'completed' => 'bg-green-100 text-green-800'
    ];
    return $statusMap[$status] ?? 'bg-slate-100 text-slate-800';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .table-container {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f1f5f9;
        }
        .table-container::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        .table-container::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        .table-container::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 4px;
            border: 2px solid #f1f5f9;
        }
        .table-container::-webkit-scrollbar-thumb:hover {
            background-color: #94a3b8;
        }
        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-layer-group text-indigo-600 text-2xl"></i>
                    <span class="ml-2 text-xl font-semibold text-slate-800">Admin Dashboard</span>
                </div>
               
                    <div class="flex items-center space-x-4">
                        <a href="add-user.php" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Add Users</a>
                        <a href="ips.php" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">IPS</a>
                    </div>
        
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Tables -->
        <div class="space-y-8">
            <?php
            displayTable($conn, "users", ["id", "email", "password"], "id");
            displayTable($conn, "orders", ["order_id", "id", "full name", "email", "phone number", "ink type", "quantity", "additional notes", "status"], "order_id");
            displayTable($conn, "maintenance", ["maintenance id", "ID", "full name", "email", "phone number", "address", "issue", "preferred date", "date received", "image", "report_image", "status"], "maintenance id");
            ?>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-slate-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 max-w-sm mx-4 w-full shadow-lg fade-in">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-2">Confirm Deletion</h3>
                <p class="text-slate-600 mb-6">Are you sure you want to delete this item? This action cannot be undone.</p>
            </div>
            <div class="flex justify-center space-x-3">
                <button onclick="closeDeleteModal()" 
                        class="px-6 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition-colors duration-150">
                    Cancel
                </button>
                <a href="#" id="confirmDelete" 
                   class="px-6 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-sm hover:shadow transition-all duration-150">
                    Delete
                </a>
            </div>
        </div>
    </div>

    <!-- Image Preview Modal -->
    <div id="imageModal" class="hidden fixed inset-0 bg-slate-900 bg-opacity-70 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-4 max-w-3xl mx-4 w-full shadow-lg fade-in">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-slate-800" id="imageModalTitle">Image Preview</h3>
                <button onclick="closeImageModal()" class="text-slate-400 hover:text-slate-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="flex justify-center">
                <img id="previewImage" src="/placeholder.svg" alt="Image Preview" class="max-h-[70vh] max-w-full object-contain rounded-lg">
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal(id, table, idColumn) {
            const modal = document.getElementById('deleteModal');
            const confirmButton = document.getElementById('confirmDelete');
            modal.classList.remove('hidden');
            confirmButton.href = `?delete=${id}&table=${table}&id_column=${idColumn}`;
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('deleteModal')) {
                closeDeleteModal();
            }
        });

        // Image preview functionality
        function showImageModal(src, title) {
            const modal = document.getElementById('imageModal');
            const image = document.getElementById('previewImage');
            const modalTitle = document.getElementById('imageModalTitle');
            
            image.src = src;
            modalTitle.textContent = title || 'Image Preview';
            modal.classList.remove('hidden');
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
        }

        // Close image modal when clicking outside
        document.getElementById('imageModal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('imageModal')) {
                closeImageModal();
            }
        });
    </script>
</body>
</html>
<?php $conn->close(); ?>