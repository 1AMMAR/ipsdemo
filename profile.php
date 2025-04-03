<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "ipstest");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the session is set and get user ID
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "Guest";
$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

// Fetch count of inks only for the logged-in user
$total_inks = 0;
if ($id !== null) {
    $sql2 = "SELECT COUNT(*) AS total FROM `orders` WHERE id = ?";
    $stmt = $conn->prepare($sql2);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result2 = $stmt->get_result();
    if ($row2 = $result2->fetch_assoc()) {
        $total_inks = $row2['total'];
    }
    $stmt->close();
}

// Fetch count of maintenance requests
$total_maintenance = 0;
if ($id !== null) {
    $sql5 = "SELECT COUNT(*) AS total FROM `maintenance` WHERE id = ?";
    $stmt2 = $conn->prepare($sql5);
    $stmt2->bind_param("i", $id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    if ($row2 = $result2->fetch_assoc()) {
        $total_maintenance = $row2['total'];
    }
    $stmt2->close();
}

// Fetch all maintenance records for logged-in user with image fields
$sql4 = "SELECT `maintenance id`, `id`, `full name`, `email`, `phone number`, `address`, `issue`, 
         `preferred date`, `date received`, `image`, `report_image`, `status` 
         FROM `maintenance` WHERE id = ?";
$stmt4 = $conn->prepare($sql4);
$stmt4->bind_param("i", $id);
$stmt4->execute();
$result4 = $stmt4->get_result();

// Fetch all ink orders for logged-in user
$sql3 = "SELECT order_id, id, `full name`, `ink type`, quantity, `additional notes` ,`status` FROM `orders` WHERE id = ?";
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param("i", $id);
$stmt3->execute();
$result3 = $stmt3->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPS - Customer Reports</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Variables */
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: rgba(37, 99, 235, 0.1);
            --secondary: #f97316;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --gray-light: #e2e8f0;
            --success: #22c55e;
            --warning: #eab308;
            --error: #ef4444;
            --transition: all 0.3s ease;
        }

        /* Reset & Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light);
            color: var(--dark);
            height: 100%;
            display: flex;
            flex-direction: column;
           
        }

        body.rtl {
            direction: rtl;
            text-align: right;
        }

        h1, h2, h3, h4 {
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            flex: 1;
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: var(--primary);
            color: white;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            font-size: 0.9rem;
        }

        .btn:hover {
            background-color: var(--primary-dark);
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
        }

        /* Navbar */
        .navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
           
        }

        .navbar-container {
            margin: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
        }

        .logo i {
            margin-right: 0.5rem;
        }

        .nav-links {
            display: flex;
            list-style: none;
        }

        .nav-links li {
            margin-left: 1.5rem;
        }

        .lang-switch {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 0.3rem 0.8rem;
            border-radius: 4px;
            background-color: var(--light);
            border: 1px solid var(--gray-light);
            font-size: 0.9rem;
        }

        .lang-switch i {
            margin-right: 0.5rem;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--dark);
        }

        /* Header */
        .header {
            background-color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--gray-light);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 1rem;
        }

        .body.rtl .user-avatar {
            margin-right: 0;
            margin-left: 1rem;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-name {
            font-size: 1.2rem;
            margin-bottom: 0.2rem;
        }

        .user-email {
            color: var(--gray);
            font-size: 0.9rem;
        }

        /* Reports Section */
        .reports-section {
            margin-bottom: 3rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.5rem;
            color: var(--dark);
        }

        .report-tabs {
            display: flex;
            border-bottom: 1px solid var(--gray-light);
            margin-bottom: 1.5rem;
        }

        .report-tab {
            padding: 0.8rem 1.2rem;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.95rem;
            border-bottom: 2px solid transparent;
        }

        .report-tab.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Report Table */
        .report-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 4px;

        }

        .report-table th {
            background-color: var(--primary-light);
            padding: 0.8rem 1rem;
            text-align: left;
            font-weight: 600;
            color: var(--dark);
            font-size: 0.9rem;
        }

        .body.rtl .report-table th {
            text-align: right;
        }

        .report-table td {
            padding: 0.8rem 1rem;
            border-top: 1px solid var(--gray-light);
            font-size: 0.9rem;
        }

        .report-table tr:hover {
            background-color: var(--light);
        }

        .status-badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-completed {
            background-color: rgba(34, 197, 94, 0.1);
            color: var(--success);
        }

        .status-pending {
            background-color: rgba(234, 179, 8, 0.1);
            color: var(--warning);
        }

        .status-cancelled {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 0.3rem 0.6rem;
            font-size: 0.8rem;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Summary Cards */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .summary-card {
            background-color: white;
            padding: 1.2rem;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .summary-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .summary-label {
            color: var(--gray);
            font-size: 0.9rem;
        }

        /* Footer */
        .footer {
            background-color: var(--dark);
            color: white;
            padding: 2rem 0;
            margin-top: 5.5rem;
            
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-logo {
            font-size: 1.2rem;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .footer-logo i {
            margin-right: 0.5rem;
        }

        .footer-links {
            display: flex;
            gap: 1.5rem;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .footer-link:hover {
            color: white;
        }

        .copyright {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.8rem;
            margin-top: 1rem;
            text-align: center;
        }

        /* Modal Styles */
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
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
            position: relative;
            transform : scale(1.8);
        }
        
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 10px;
        }
        
        .close:hover {
            color: black;
        }
        
        .image-preview {
            max-width: 100%;
            max-height: 500px;
            display: block;
            margin: 20px auto;
            border-radius: 4px;
        }
        
        .view-image-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.8rem;
        }
        
        .view-image-btn:hover {
            background-color: var(--primary-dark);
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .header-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-actions {
                margin-top: 1rem;
                width: 100%;
                display: flex;
                justify-content: space-between;
            }

            .report-tabs {
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 0.5rem;
            }

            .report-table {
                display: block;
                overflow-x: auto;
            }

            .footer-content {
                flex-direction: column;
                gap: 1rem;
            }

            .footer-links {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .modal-content {
                width: 95%;
                margin: 10% auto;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="ips.php" class="logo">
                <img src="assets/logo.svg" style="height: 50%; width: 50%;" alt="">
            </a>
            <ul class="nav-links">
                <li><a href="ips.php" class="en">Home</a><a href="#" class="ar" style="display: none;">الرئيسية</a></li>
                <li><a href="products.php" class="en">Services</a><a href="products.php" class="ar" style="display: none;">المنتجات</a></li>
                <li><a href="#contact" class="en">Contact</a><a href="#contact" class="ar" style="display: none;">اتصل بنا</a></li>
                <li><a href="profile.php" class="en">Profile</a><a href="profile.php" class="ar" style="display: none;">الملف الشخصي</a></li>
            </ul>
            <button class="lang-switch">
                <i class="fas fa-globe"></i>
                <span class="en">العربية</span>
                <span class="ar" style="display: none;">English</span>
            </button>
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>
    <!-- Header -->
    <header class="header">
        <div class="container header-container">
            <div class="user-info">
                <div class="user-avatar">
            </div>
                <div>
                    <h3 class="user-name">client id : <?php echo htmlspecialchars ($id); ?></h3>
                    <h1 class="user-email">Welcome <?php echo htmlspecialchars($email); ?> !</h1>
                </div>
            </div>
            
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <!-- Summary Cards -->
        <div class="summary-cards">
        <div class="summary-card">
                <div class="summary-value">
                <div class="summary-value">
    <?php echo $total_inks; ?>
</div>

                </div>
                <div class="summary-label">Total Inks Orders</div>
            </div>

            <div class="summary-card">
                <div class="summary-value"> <?php echo $total_maintenance; ?></div>
                <div class="summary-label en">Maintenance Requests</div>
                <div class="summary-label ar" style="display: none;">طلبات الصيانة</div>
            </div>
           
        </div>

        <!-- Reports Section -->
        <section class="reports-section">
            <div class="section-header">
                <h2 class="section-title en">Customer Reports</h2>
                <h2 class="section-title ar" style="display: none;">تقارير العملاء</h2>
            </div>

            <div class="report-tabs">
                <div class="report-tab active" data-tab="orders">
                    <span class="en">Orders and Maintenance </span>
                    <span class="ar" style="display: none;">الطلبات و الصيانة </span>
                </div>
              
            </div>

            <!-- Orders Tab -->
            <div class="tab-content active" id="orders-tab">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th data-en="Order ID" data-ar="رقم الطلب">Order ID</th>
                            <th data-en="id" data-ar="id">id</th>
                            <th data-en="fullname" data-ar="الاسم">fullname</th>
                            <th data-en="ink type" data-ar="نوع الحبر">ink type</th>
                            <th data-en="quantity `liter`" data-ar="الكمية">quantity "liter"</th>
                            <th data-en="additional notes" data-ar="ملاحظات">additional notes</th>
                            <th data-en="status" data-ar="الحالة">status</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    <?php
                    if ($result3->num_rows > 0) {
                        while ($row = $result3->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['order_id']) . "</td>
                                    <td>" . htmlspecialchars($row['id']) . "</td>
                                    <td>" . htmlspecialchars($row['full name']) . "</td>
                                    <td>" . htmlspecialchars($row['ink type']) . "</td>
                                    <td>" . htmlspecialchars($row['quantity']) . "</td>
                                    <td>" . htmlspecialchars($row['additional notes']) . "</td>
                                    <td>" . htmlspecialchars($row['status']) . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No records found</td></tr>";
                    }
                    ?>

                    </tbody>
                </table>
            </div>

            <!-- Maintenance Tab -->
          
            <table class="report-table">
                <thead>
                    <tr>
                        <th data-en="Order ID" data-ar="رقم طلب الصيانة">Maintenance ID</th>
                        <th data-en="id" data-ar="id">id</th>
                        <th data-en="fullname" data-ar="الاسم">fullname</th>
                        <th data-en="email" data-ar="الايميل">email</th>
                        <th data-en="phone number" data-ar="الهاتف">phone number</th>
                        <th data-en="address" data-ar="العنوان">address</th>
                        <th data-en="issue" data-ar="المشكلة">issue</th>
                        <th data-en="date preferred" data-ar="التاريخ المتوقع">date preferred</th>
                        <th data-en="date received" data-ar="تاريخ تلقي الطلب">date received</th>
                        <th data-en="report image" data-ar="صورة التقرير">Report Image</th>
                        <th data-en="status" data-ar="حالة طلب الصيانة">status</th>
                    </tr>
                </thead>
                <tbody>
                   
                <?php
                if ($result4->num_rows > 0) {
                    while ($row = $result4->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['maintenance id']) . "</td>
                                <td>" . htmlspecialchars($row['id']) . "</td>
                                <td>" . htmlspecialchars($row['full name']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>" . htmlspecialchars($row['phone number']) . "</td>
                                <td>" . htmlspecialchars($row['address']) . "</td>
                                <td>" . htmlspecialchars($row['issue']) . "</td>
                                <td>" . htmlspecialchars($row['preferred date']) . "</td>
                                <td>" . htmlspecialchars($row['date received']) . "</td>
                                <td>";
                        
                        // Check if there are any images to display
                        $hasUserImage = !empty($row['image']);
                        $hasReportImage = !empty($row['report_image']);
                        
                        if ($hasUserImage || $hasReportImage) {
                            
                            
                            if ($hasReportImage) {
                                echo $hasUserImage ? "<br>" : "";
                                echo "<button class='view-image-btn' data-image='" . htmlspecialchars($row['report_image']) . "' data-type='Report Image'>View Report Image</button>";
                            }
                        } else {
                            echo "No images";
                        }
                        
                        echo "</td>
                                <td>" . htmlspecialchars($row['status']) . "</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>No records found</td></tr>";
                }
                ?>
                </tbody>
            </table>
            </div>
        </section>
    </main>

    <!-- Image Modal -->
    <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="imageTitle" class="text-xl font-bold mb-4">Image Preview</h2>
            <img id="modalImage" class="image-preview" src="/placeholder.svg" alt="Image Preview">
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    
                    <span>IPS</span>
                </div>
                <div class="footer-links">
                    <a href="#" class="footer-link en">Privacy Policy</a>
                    <a href="#" class="footer-link ar" style="display: none;">سياسة الخصوصية</a>
                    <a href="#" class="footer-link en">Terms of Service</a>
                    <a href="#" class="footer-link ar" style="display: none;">شروط الخدمة</a>
                    <a href="#" class="footer-link en">Contact Support</a>
                    <a href="#" class="footer-link ar" style="display: none;">اتصل بالدعم</a>
                </div>
            </div>
            <div class="copyright">
                <p class="en">&copy; 2025 IPS - Innovative Printing Solutions. All rights reserved.</p>
                <p class="ar" style="display: none;">&copy; 2025 آي بي إس - حلول طباعة مبتكرة. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navLinks = document.querySelector('.nav-links');

        mobileMenuBtn.addEventListener('click', function() {
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
            const icon = mobileMenuBtn.querySelector('i');
            if (navLinks.style.display === 'flex') {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        // Language switch
        const langSwitch = document.querySelector('.lang-switch');
        const enElements = document.querySelectorAll('.en');
        const arElements = document.querySelectorAll('.ar');
        const tableHeaders = document.querySelectorAll('th[data-en][data-ar]');

        langSwitch.addEventListener('click', function() {
            document.body.classList.toggle('rtl');
            
            // Toggle regular elements
            enElements.forEach(el => {
                el.style.display = el.style.display === 'none' ? 'block' : 'none';
            });
            
            arElements.forEach(el => {
                el.style.display = el.style.display === 'none' ? 'block' : 'none';
            });
            
            // Handle table headers specially
            const isArabic = document.body.classList.contains('rtl');
            tableHeaders.forEach(th => {
                th.textContent = isArabic ? th.getAttribute('data-ar') : th.getAttribute('data-en');
            });
        });

        // Image Modal Functionality
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const imageTitle = document.getElementById('imageTitle');
        const closeBtn = document.querySelector('.close');
        
        // Add event listeners to all view image buttons
        document.addEventListener('DOMContentLoaded', function() {
            const viewImageBtns = document.querySelectorAll('.view-image-btn');
            
            viewImageBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const imageSrc = this.getAttribute('data-image');
                    const imageType = this.getAttribute('data-type');
                    
                    modalImage.src = imageSrc;
                    imageTitle.textContent = imageType;
                    modal.style.display = 'block';
                });
            });
            
            // Close modal when clicking the X
            closeBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });
            
            // Close modal when clicking outside the modal content
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>