<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPS - Products & Services</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Variables */
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #f97316;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --transition: all 0.3s ease;
            --error: #ef4444;
            --success: #22c55e;
        }

        /* Reset & Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--light);
            color: var(--dark);
            overflow-x: hidden;
        }

        body.rtl {
            direction: rtl;
            text-align: right;
        }

        h1, h2, h3, h4, h5, h6 {
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        p {
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .btn {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background-color: var(--primary);
            color: white;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            outline: none;
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
        }

        .btn-secondary {
            background-color: var(--secondary);
        }

        .btn-secondary:hover {
            background-color: #ea580c;
        }

        .section {
            padding: 5rem 0;
        }

        .section-title {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: var(--primary);
            border-radius: 2px;
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        .navbar.scrolled {
            padding: 0.5rem 0;
            background-color: white;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }

        .logo {
            font-size: 1.8rem;
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
            margin-left: 2rem;
        }

        .nav-links a {
            font-weight: 500;
            position: relative;
            transition: var(--transition);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary);
            transition: var(--transition);
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .lang-switch {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            background-color: var(--light);
            border: 1px solid var(--gray);
            transition: var(--transition);
        }

        .lang-switch:hover {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
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

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(249, 115, 22, 0.1) 100%);
            padding: 8rem 0 4rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--primary) 0%, rgba(37, 99, 235, 0) 70%);
            opacity: 0.3;
            animation: float 15s infinite ease-in-out;
        }

        .page-header::after {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--secondary) 0%, rgba(249, 115, 22, 0) 70%);
            opacity: 0.3;
            animation: float 20s infinite ease-in-out reverse;
        }

        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(30px, 30px) rotate(5deg); }
            100% { transform: translate(0, 0) rotate(0deg); }
        }

        .page-title {
            font-size: 3rem;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .page-subtitle {
            font-size: 1.2rem;
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        /* Products Section */
        .products {
            background-color: white;
            position: relative;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .product-image {
            height: 200px;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .product-card:hover .product-image img {
            transform: scale(1.1);
        }

        .product-content {
            padding: 1.5rem;
        }

        .product-tag {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background-color: var(--primary);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .body.rtl .product-tag {
            right: auto;
            left: 1rem;
        }

        .product-title {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }

        .product-desc {
            color: var(--gray);
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .product-btn {
            width: 100%;
            text-align: center;
        }

        /* Forms Section */
        .forms-section {
            background-color: var(--light);
            position: relative;
        }

        .forms-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><circle cx="3" cy="3" r="3" fill="%232563eb" opacity="0.1"/></svg>');
            opacity: 0.5;
        }

        .forms-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .form-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        .form-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .form-header {
            background-color: var(--primary);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        .form-title {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .form-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            outline: none;
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-select {
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="%23475569" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>');
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }

        .body.rtl .form-select {
            background-position: left 1rem center;
        }

        .form-submit {
            width: 100%;
            padding: 1rem;
            font-size: 1rem;
        }

        .form-message {
            padding: 1rem;
            margin-top: 1rem;
            border-radius: 5px;
            font-weight: 500;
            display: none;
        }

        .form-message.success {
            background-color: rgba(34, 197, 94, 0.1);
            color: var(--success);
            border: 1px solid var(--success);
        }

        .form-message.error {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error);
            border: 1px solid var(--error);
        }

        /* Footer */
        .footer {
            background-color: var(--dark);
            color: white;
            padding: 4rem 0 2rem;
        }

        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .footer-logo {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .footer-logo i {
            margin-right: 0.5rem;
        }

        .footer-desc {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 1.5rem;
        }

        .footer-title {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .footer-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 3px;
            background-color: var(--primary);
        }

        .body.rtl .footer-title::after {
            left: auto;
            right: 0;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }

        .body.rtl .footer-links a:hover {
            padding-left: 0;
            padding-right: 5px;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .contact-icon {
            margin-right: 0.8rem;
            color: var(--primary);
            font-size: 1.2rem;
        }

        .body.rtl .contact-icon {
            margin-right: 0;
            margin-left: 0.8rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transition: var(--transition);
        }

        .social-link:hover {
            background-color: var(--primary);
            transform: translateY(-5px);
        }

        .copyright {
            text-align: center;
            padding-top: 2rem;
            margin-top: 3rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
        }

        /* Animations */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .fade-in.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Tab styles for ink order form */
        .item-tab {
            transition: background-color 0.3s ease;
        }

        .item-tab.active {
            font-weight: bold;
            border-color: var(--primary) !important;
        }

        .order-summary {
            transition: all 0.3s ease;
        }

        .order-summary:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .page-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .navbar-container {
                padding: 1rem;
            }

            .nav-links {
                position: fixed;
                top: 70px;
                left: 0;
                width: 100%;
                background-color: white;
                flex-direction: column;
                align-items: center;
                padding: 2rem 0;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
                transform: translateY(-150%);
                transition: var(--transition);
                z-index: 999;
            }

            .nav-links.active {
                transform: translateY(0);
            }

            .nav-links li {
                margin: 1rem 0;
            }

            .mobile-menu-btn {
                display: block;
            }

            .page-header {
                padding: 7rem 0 3rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .section-title {
                font-size: 2rem;
            }
            
            .item-tab {
                font-size: 0.9rem;
                padding: 6px 10px !important;
            }
        }

        @media (max-width: 576px) {
            .page-title {
                font-size: 1.8rem;
            }

            .product-grid {
                grid-template-columns: 1fr;
            }

            .forms-container {
                grid-template-columns: 1fr;
            }

            .footer-container {
                grid-template-columns: 1fr;
            }
            
            .item-tab {
                min-width: 60px !important;
                padding: 5px 8px !important;
                font-size: 0.8rem;
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
                <li><a href="ips.php" class="en">Home</a><a href="ips.php" class="ar" style="display: none;">الرئيسية</a></li>
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

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1 class="page-title en fade-in">Our Products & Services</h1>
            <h1 class="page-title ar fade-in" style="display: none;">منتجاتنا وخدماتنا</h1>
            <p class="page-subtitle en fade-in">Discover our range of cutting-edge printing solutions and services designed to meet your every need.</p>
            <p class="page-subtitle ar fade-in" style="display: none;">اكتشف مجموعتنا من حلول وخدمات الطباعة المتطورة المصممة لتلبية جميع احتياجاتك.</p>
        </div>
    </header>

    <!-- Products Section -->
    <section class="section products">
        <div class="container">
            <h2 class="section-title en fade-in">Premium Printings</h2>
            <h2 class="section-title ar fade-in" style="display: none;">طابعات متميزة</h2>
            <div class="product-grid">
                <div class="product-card fade-in">
                
                   
                    <div class="product-image">
                        <img src="assets/obj1.jpg" alt="obj1">
                    </div>
                    <div class="product-content">
                        <h3 class="product-title">IPS Food Packaging Print</h3>
                     
                        <p class="product-desc en">High-quality printing solutions for food packaging with vibrant colors and durable prints.</p>
                        <p class="product-desc ar" style="display: none;">حلول طباعة عالية الجودة لتغليف الطعام بألوان زاهية وطبعات متينة. <br><br></p>
             
                  
                    </div>
                </div>
                <div class="product-card fade-in">
                 
                    <div class="product-image">
                        <img src="assets/obj2.jpg" alt="obj2">
                    </div>
                    <div class="product-content">
                        <h3 class="product-title">IPS Small Packagings</h3>
                        <p class="product-desc en">Precision label printing for small packaging with clear and long-lasting prints.</p>
                        <p class="product-desc ar" style="display: none;">طباعة الملصقات بدقة عالية على العبوات الصغيرة بطبعات واضحة وطويلة الأمد.</p>
                   
                  
                    </div>
                </div>
                <div class="product-card fade-in">
                    <div class="product-image">
                        <img src="assets/obj3.jpg" alt="obj3">
                    </div>
                    <div class="product-content">
                        <h3 class="product-title">IPS Direct Bottle Print</h3>
                        <p class="product-desc en">Advanced printing solutions for direct printing on bottles with multi-material compatibility.</p>
                        <p class="product-desc ar" style="display: none;">
                            حلول طباعة متطورة للطباعة المباشرة على الزجاجات مع دعم لمواد متعددة.</p>
                     
                       
                    </div>
                </div>
                <div class="product-card fade-in">
                 
                    <div class="product-image">
                        <img src="assets/obj4.jpg" alt="IPS LaserJet Pro">
                    </div>
                    <div class="product-content">
                        <h3 class="product-title">IPS Industrial Printing</h3>
                        <p class="product-desc en">High-speed industrial printing solutions for durable and resistant labels on plastic containers.</p>
                        <p class="product-desc ar" style="display: none;">حلول طباعة صناعية عالية السرعة لملصقات متينة ومقاومة على الحاويات البلاستيكية.</p>
             
                 
                    </div>
                </div>
                <div class="product-card fade-in">
                    <div class="product-image">
                        <img src="assets/obj5.jpg" alt="IPS MobilePrint Mini">
                    </div>
                    <div class="product-content">
                        <h3 class="product-title">IPS PharmaPrint</h3>
                        <p class="product-desc en">Precision printing for pharmaceutical labels with clear and long-lasting text.</p>
                        <p class="product-desc ar" style="display: none;">
                            طباعة دقيقة لملصقات المنتجات الدوائية مع نصوص واضحة وطويلة الأمد.</p>
                    </div>
                </div>
                <div class="product-card fade-in">
              
                    <div class="product-image">
                        <img src="assets/obj6.jpg" alt="IPS EcoSmart Pro">
                    </div>
                    <div class="product-content">
                        <h3 class="product-title">IPS TubeMark</h3>
                        <p class="product-desc en">Advanced printing for industrial hoses and pipes with high durability and readability.</p>
                        <p class="product-desc ar" style="display: none;">طباعة متطورة على الخراطيم والأنابيب الصناعية مع متانة عالية ووضوح ممتاز.</p>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Forms Section -->
    <section class="section forms-section">
        <div class="container">
            <h2 class="section-title en fade-in">Our Services</h2>
            <h2 class="section-title ar fade-in" style="display: none;">خدماتنا</h2>
            <div class="forms-container">
                
<!-- Ink Order Form -->
<div class="form-card fade-in">
    <div class="form-header">
        <h3 class="form-title en">Order Ink Supplies</h3>
        <h3 class="form-title ar" style="display: none;">طلب مستلزمات الحبر</h3>
        <p class="form-subtitle en">Get high-quality ink delivered to your doorstep</p>
        <p class="form-subtitle ar" style="display: none;">احصل على حبر عالي الجودة يتم توصيله إلى باب منزلك</p>
    </div>
    <div class="form-body">
        <form id="ink-order-form" action="submit_order.php" method="POST">
            <!-- Customer Information -->
            <div class="form-group">
                <label for="ink-name" class="form-label en">Full Name</label>
                <label for="ink-name" class="form-label ar" style="display: none;">الاسم الكامل</label>
                <input type="text" id="ink-name" name="ink-name" class="form-input" required>
            </div>
            
            <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                <div class="form-group" style="flex: 1; min-width: 250px;">
                    <label for="ink-email" class="form-label en">Email Address</label>
                    <label for="ink-email" class="form-label ar" style="display: none;">البريد الإلكتروني</label>
                    <input type="text" id="ink-email" name="ink-email" class="form-input" required>
                </div>
                <div class="form-group" style="flex: 1; min-width: 250px;">
                    <label for="ink-phone" class="form-label en">Phone Number</label>
                    <label for="ink-phone" class="form-label ar" style="display: none;">رقم الهاتف</label>
                    <input type="text" id="ink-phone" name="ink-phone" class="form-input" required>
                </div>
            </div>
            
            <!-- Order Items Section -->
            <div class="order-items-container">
                <h4 class="en" style="margin: 20px 0 10px;">Order Items</h4>
                <h4 class="ar" style="margin: 20px 0 10px; display: none;">عناصر الطلب</h4>
                
                <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px;">
                    <!-- Tabs for items -->
                    <button type="button" class="item-tab active" data-item="1" style="padding: 8px 15px; border: 1px solid #e2e8f0; background-color: #f8fafc; border-radius: 5px; cursor: pointer; flex: 1; min-width: 80px; max-width: 120px; text-align: center;">
                        <span class="en">Item 1</span>
                        <span class="ar" style="display: none;">العنصر 1</span>
                    </button>
                    <button type="button" class="item-tab" data-item="2" style="padding: 8px 15px; border: 1px solid #e2e8f0; background-color: white; border-radius: 5px; cursor: pointer; flex: 1; min-width: 80px; max-width: 120px; text-align: center;">
                        <span class="en">Item 2</span>
                        <span class="ar" style="display: none;">العنصر 2</span>
                    </button>
                    <button type="button" class="item-tab" data-item="3" style="padding: 8px 15px; border: 1px solid #e2e8f0; background-color: white; border-radius: 5px; cursor: pointer; flex: 1; min-width: 80px; max-width: 120px; text-align: center;">
                        <span class="en">Item 3</span>
                        <span class="ar" style="display: none;">العنصر 3</span>
                    </button>
                    <button type="button" class="item-tab" data-item="4" style="padding: 8px 15px; border: 1px solid #e2e8f0; background-color: white; border-radius: 5px; cursor: pointer; flex: 1; min-width: 80px; max-width: 120px; text-align: center;">
                        <span class="en">Item 4</span>
                        <span class="ar" style="display: none;">العنصر 4</span>
                    </button>
                    <button type="button" class="item-tab" data-item="5" style="padding: 8px 15px; border: 1px solid #e2e8f0; background-color: white; border-radius: 5px; cursor: pointer; flex: 1; min-width: 80px; max-width: 120px; text-align: center;">
                        <span class="en">Item 5</span>
                        <span class="ar" style="display: none;">العنصر 5</span>
                    </button>
                </div>
                
                <!-- Item content panels -->
                <div class="item-panel" id="item-panel-1" style="border: 1px solid #e2e8f0; padding: 15px; margin-bottom: 15px; border-radius: 5px;">
                    <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                        <div class="form-group" style="flex: 2; min-width: 250px;">
                            <label for="ink-type-1" class="form-label en">Ink Type</label>
                            <label for="ink-type-1" class="form-label ar" style="display: none;">نوع الحبر</label>
                            <select id="ink-type-1" name="ink-type-1" class="form-select" required>
                                <option value="" class="en">Select your ink type</option>
                                <option value="" class="ar" style="display: none;">اختر نوع الحبر</option>
                                <option value="IR-295BK" class="en">- IR-295BK / Black Ink Reservoir</option>
                                <option value="IR-295BK" class="ar" style="display: none;">- IR-295BK / خزان حبر أسود</option>
                                <option value="IC-295BK" class="en">- IC-295BK / Black Ink Cartridge</option>
                                <option value="IC-295BK" class="ar" style="display: none;">- IC-295BK / عبوة حبر أسود</option>
                                <option value="MC-295BK" class="en">- MC-295BK / Black Make-Up Cartridge</option>
                                <option value="MC-295BK" class="ar" style="display: none;">- MC-295BK / عبوة مذيب أسود</option>
                                <option value="IR-369BK" class="en">- IR-369BK / Red Ink Reservoir</option>
                                <option value="IR-369BK" class="ar" style="display: none;">- IR-369BK / خزان حبر أحمر</option>
                                <option value="IC-369BK" class="en">- IC-369BK / Red Ink Cartridge</option>
                                <option value="IC-369BK" class="ar" style="display: none;">- IC-369BK / عبوة حبر أحمر</option>
                                <option value="MC-369BK" class="en">- MC-369BK / Red Make-Up Cartridge</option>
                                <option value="MC-369BK" class="ar" style="display: none;">- MC-369BK / عبوة مذيب أحمر</option>
                                <option value="IR-261YL" class="en">- IR-261YL / Yellow Ink Reservoir</option>
                                <option value="IR-261YL" class="ar" style="display: none;">- IR-261YL / خزان حبر أصفر</option>
                                <option value="IC-261YL" class="en">- IC-261YL / Yellow Ink Cartridge</option>
                                <option value="IC-261YL" class="ar" style="display: none;">- IC-261YL / عبوة حبر أصفر</option>
                                <option value="MC-261YL" class="en">- MC-261YL / Yellow Make-Up Cartridge</option>
                                <option value="MC-261YL" class="ar" style="display: none;">- MC-261YL / عبوة مذيب أصفر</option>
                                <option value="IR-236BK" class="en">- IR-236BK / Black Ink Reservoir</option>
                                <option value="IR-236BK" class="ar" style="display: none;">- IR-236BK / خزان حبر أسود</option>
                                <option value="IC-236BK" class="en">- IC-236BK / Black Ink Cartridge</option>
                                <option value="IC-236BK" class="ar" style="display: none;">- IC-236BK / عبوة حبر أسود</option>
                                <option value="MC-236BK" class="en">- MC-236BK / Black Make-Up Cartridge</option>
                                <option value="MC-236BK" class="ar" style="display: none;">- MC-236BK / عبوة مذيب أسود</option>
                                <option value="IR-280BK" class="en">- IR-280BK / Black Ink Reservoir</option>
                                <option value="IR-280BK" class="ar" style="display: none;">- IR-280BK / خزان حبر أسود</option>
                                <option value="IC-280BK" class="en">- IC-280BK / Black Ink Cartridge</option>
                                <option value="IC-280BK" class="ar" style="display: none;">- IC-280BK / عبوة حبر أسود</option>
                                <option value="MC-280CL" class="en">- MC-280CL / Black Make-Up Cartridge</option>
                                <option value="MC-280CL" class="ar" style="display: none;">- MC-280CL / عبوة مذيب أسود</option>
                                <option value="IR-064RG" class="en">- IR-064RG / Red Ink Reservoir</option>
                                <option value="IR-064RG" class="ar" style="display: none;">- IR-064RG / خزان حبر أحمر</option>
                                <option value="IC-064RG" class="en">- IC-064RG / Red Ink Cartridge</option>
                                <option value="IC-064RG" class="ar" style="display: none;">- IC-064RG / عبوة حبر أحمر</option>
                                <option value="MC-064RG" class="en">- MC-064RG / Red Make-Up Cartridge</option>
                                <option value="MC-064RG" class="ar" style="display: none;">- MC-064RG / عبوة مذيب أحمر</option>
                                <option value="IR-299YL" class="en">- IR-299YL / Yellow Ink Reservoir</option>
                                <option value="IR-299YL" class="ar" style="display: none;">- IR-299YL / خزان حبر أصفر</option>
                                <option value="IC-299YL" class="en">- IC-299YL / Yellow Ink Cartridge</option>
                                <option value="IC-299YL" class="ar" style="display: none;">- IC-299YL / عبوة حبر أصفر</option>
                                <option value="MC-299YL" class="en">- MC-299YL / Yellow Make-Up Cartridge</option>
                                <option value="MC-299YL" class="ar" style="display: none;">- MC-299YL / عبوة مذيب أصفر</option>
                                <option value="WL-211 (4 Liter)" class="en">- WL-211 (4 Liter) / Wash Solution</option>
                                <option value="WL-211 (4 Liter)" class="ar" style="display: none;">- WL-211 (4 Liter) / سائل تنظيف</option>
                                <option value="IC-2BK106" class="en">- IC-2BK106 / Black Ink Cartridge</option>
                                <option value="IC-2BK106" class="ar" style="display: none;">- IC-2BK106 / عبوة حبر أسود</option>
                                <option value="MC-2BK106" class="en">- MC-2BK106 / Black Make-Up Cartridge</option>
                                <option value="MC-2BK106" class="ar" style="display: none;">- MC-2BK106 / عبوة مذيب أسود</option>
                                <option value="IC-2BK009" class="en">- IC-2BK009 / Black Ink Cartridge</option>
                                <option value="IC-2BK009" class="ar" style="display: none;">- IC-2BK009 / عبوة حبر أسود</option>
                                <option value="MC-2BK009" class="en">- MC-2BK009 / Black Make-Up Cartridge</option>
                                <option value="MC-2BK009" class="ar" style="display: none;">- MC-2BK009 / عبوة مذيب أسود</option>
                                <option value="other" class="en">Other</option>
                                <option value="other" class="ar" style="display: none;">أخرى</option>
                            </select>
                        </div>
                        <div class="form-group" style="flex: 1; min-width: 100px;">
                            <label for="ink-quantity-1" class="form-label en">Quantity</label>
                            <label for="ink-quantity-1" class="form-label ar" style="display: none;">الكمية</label>
                            <input type="number" id="ink-quantity-1" name="ink-quantity-1" class="form-input" min="1" value="1" required>
                        </div>
                    </div>
                </div>
                
                <div class="item-panel" id="item-panel-2" style="border: 1px solid #e2e8f0; padding: 15px; margin-bottom: 15px; border-radius: 5px; display: none;">
                    <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                        <div class="form-group" style="flex: 2; min-width: 250px;">
                            <label for="ink-type-2" class="form-label en">Ink Type</label>
                            <label for="ink-type-2" class="form-label ar" style="display: none;">نوع الحبر</label>
                            <select id="ink-type-2" name="ink-type-2" class="form-select">
                                <option value="" class="en">Select your ink type</option>
                                <option value="" class="ar" style="display: none;">اختر نوع الحبر</option>
                                <option value="IR-295BK" class="en">- IR-295BK / Black Ink Reservoir</option>
                                <option value="IR-295BK" class="ar" style="display: none;">- IR-295BK / خزان حبر أسود</option>
                                <option value="IC-295BK" class="en">- IC-295BK / Black Ink Cartridge</option>
                                <option value="IC-295BK" class="ar" style="display: none;">- IC-295BK / عبوة حبر أسود</option>
                                <option value="MC-295BK" class="en">- MC-295BK / Black Make-Up Cartridge</option>
                                <option value="MC-295BK" class="ar" style="display: none;">- MC-295BK / عبوة مذيب أسود</option>
                                <option value="IR-369BK" class="en">- IR-369BK / Red Ink Reservoir</option>
                                <option value="IR-369BK" class="ar" style="display: none;">- IR-369BK / خزان حبر أحمر</option>
                                <option value="IC-369BK" class="en">- IC-369BK / Red Ink Cartridge</option>
                                <option value="IC-369BK" class="ar" style="display: none;">- IC-369BK / عبوة حبر أحمر</option>
                                <option value="MC-369BK" class="en">- MC-369BK / Red Make-Up Cartridge</option>
                                <option value="MC-369BK" class="ar" style="display: none;">- MC-369BK / عبوة مذيب أحمر</option>
                                <option value="IR-261YL" class="en">- IR-261YL / Yellow Ink Reservoir</option>
                                <option value="IR-261YL" class="ar" style="display: none;">- IR-261YL / خزان حبر أصفر</option>
                                <option value="IC-261YL" class="en">- IC-261YL / Yellow Ink Cartridge</option>
                                <option value="IC-261YL" class="ar" style="display: none;">- IC-261YL / عبوة حبر أصفر</option>
                                <option value="MC-261YL" class="en">- MC-261YL / Yellow Make-Up Cartridge</option>
                                <option value="MC-261YL" class="ar" style="display: none;">- MC-261YL / عبوة مذيب أصفر</option>
                                <option value="IR-236BK" class="en">- IR-236BK / Black Ink Reservoir</option>
                                <option value="IR-236BK" class="ar" style="display: none;">- IR-236BK / خزان حبر أسود</option>
                                <option value="IC-236BK" class="en">- IC-236BK / Black Ink Cartridge</option>
                                <option value="IC-236BK" class="ar" style="display: none;">- IC-236BK / عبوة حبر أسود</option>
                                <option value="MC-236BK" class="en">- MC-236BK / Black Make-Up Cartridge</option>
                                <option value="MC-236BK" class="ar" style="display: none;">- MC-236BK / عبوة مذيب أسود</option>
                                <option value="IR-280BK" class="en">- IR-280BK / Black Ink Reservoir</option>
                                <option value="IR-280BK" class="ar" style="display: none;">- IR-280BK / خزان حبر أسود</option>
                                <option value="IC-280BK" class="en">- IC-280BK / Black Ink Cartridge</option>
                                <option value="IC-280BK" class="ar" style="display: none;">- IC-280BK / عبوة حبر أسود</option>
                                <option value="MC-280CL" class="en">- MC-280CL / Black Make-Up Cartridge</option>
                                <option value="MC-280CL" class="ar" style="display: none;">- MC-280CL / عبوة مذيب أسود</option>
                                <option value="IR-064RG" class="en">- IR-064RG / Red Ink Reservoir</option>
                                <option value="IR-064RG" class="ar" style="display: none;">- IR-064RG / خزان حبر أحمر</option>
                                <option value="IC-064RG" class="en">- IC-064RG / Red Ink Cartridge</option>
                                <option value="IC-064RG" class="ar" style="display: none;">- IC-064RG / عبوة حبر أحمر</option>
                                <option value="MC-064RG" class="en">- MC-064RG / Red Make-Up Cartridge</option>
                                <option value="MC-064RG" class="ar" style="display: none;">- MC-064RG / عبوة مذيب أحمر</option>
                                <option value="IR-299YL" class="en">- IR-299YL / Yellow Ink Reservoir</option>
                                <option value="IR-299YL" class="ar" style="display: none;">- IR-299YL / خزان حبر أصفر</option>
                                <option value="IC-299YL" class="en">- IC-299YL / Yellow Ink Cartridge</option>
                                <option value="IC-299YL" class="ar" style="display: none;">- IC-299YL / عبوة حبر أصفر</option>
                                <option value="MC-299YL" class="en">- MC-299YL / Yellow Make-Up Cartridge</option>
                                <option value="MC-299YL" class="ar" style="display: none;">- MC-299YL / عبوة مذيب أصفر</option>
                                <option value="WL-211 (4 Liter)" class="en">- WL-211 (4 Liter) / Wash Solution</option>
                                <option value="WL-211 (4 Liter)" class="ar" style="display: none;">- WL-211 (4 Liter) / سائل تنظيف</option>
                                <option value="IC-2BK106" class="en">- IC-2BK106 / Black Ink Cartridge</option>
                                <option value="IC-2BK106" class="ar" style="display: none;">- IC-2BK106 / عبوة حبر أسود</option>
                                <option value="MC-2BK106" class="en">- MC-2BK106 / Black Make-Up Cartridge</option>
                                <option value="MC-2BK106" class="ar" style="display: none;">- MC-2BK106 / عبوة مذيب أسود</option>
                                <option value="IC-2BK009" class="en">- IC-2BK009 / Black Ink Cartridge</option>
                                <option value="IC-2BK009" class="ar" style="display: none;">- IC-2BK009 / عبوة حبر أسود</option>
                                <option value="MC-2BK009" class="en">- MC-2BK009 / Black Make-Up Cartridge</option>
                                <option value="MC-2BK009" class="ar" style="display: none;">- MC-2BK009 / عبوة مذيب أسود</option>
                                <option value="other" class="en">Other</option>
                                <option value="other" class="ar" style="display: none;">أخرى</option>
                            </select>
                        </div>
                        <div class="form-group" style="flex: 1; min-width: 100px;">
                            <label for="ink-quantity-2" class="form-label en">Quantity</label>
                            <label for="ink-quantity-2" class="form-label ar" style="display: none;">الكمية</label>
                            <input type="number" id="ink-quantity-2" name="ink-quantity-2" class="form-input" min="1" value="1">
                        </div>
                    </div>
                </div>
                
                <div class="item-panel" id="item-panel-3" style="border: 1px solid #e2e8f0; padding: 15px; margin-bottom: 15px; border-radius: 5px; display: none;">
                    <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                        <div class="form-group" style="flex: 2; min-width: 250px;">
                            <label for="ink-type-3" class="form-label en">Ink Type</label>
                            <label for="ink-type-3" class="form-label ar" style="display: none;">نوع الحبر</label>
                            <select id="ink-type-3" name="ink-type-3" class="form-select">
                                <option value="" class="en">Select your ink type</option>
                                <option value="" class="ar" style="display: none;">اختر نوع الحبر</option>
                                <option value="IR-295BK" class="en">- IR-295BK / Black Ink Reservoir</option>
                                <option value="IR-295BK" class="ar" style="display: none;">- IR-295BK / خزان حبر أسود</option>
                                <option value="IC-295BK" class="en">- IC-295BK / Black Ink Cartridge</option>
                                <option value="IC-295BK" class="ar" style="display: none;">- IC-295BK / عبوة حبر أسود</option>
                                <option value="MC-295BK" class="en">- MC-295BK / Black Make-Up Cartridge</option>
                                <option value="MC-295BK" class="ar" style="display: none;">- MC-295BK / عبوة مذيب أسود</option>
                                <option value="IR-369BK" class="en">- IR-369BK / Red Ink Reservoir</option>
                                <option value="IR-369BK" class="ar" style="display: none;">- IR-369BK / خزان حبر أحمر</option>
                                <option value="IC-369BK" class="en">- IC-369BK / Red Ink Cartridge</option>
                                <option value="IC-369BK" class="ar" style="display: none;">- IC-369BK / عبوة حبر أحمر</option>
                                <option value="MC-369BK" class="en">- MC-369BK / Red Make-Up Cartridge</option>
                                <option value="MC-369BK" class="ar" style="display: none;">- MC-369BK / عبوة مذيب أحمر</option>
                                <option value="IR-261YL" class="en">- IR-261YL / Yellow Ink Reservoir</option>
                                <option value="IR-261YL" class="ar" style="display: none;">- IR-261YL / خزان حبر أصفر</option>
                                <option value="IC-261YL" class="en">- IC-261YL / Yellow Ink Cartridge</option>
                                <option value="IC-261YL" class="ar" style="display: none;">- IC-261YL / عبوة حبر أصفر</option>
                                <option value="MC-261YL" class="en">- MC-261YL / Yellow Make-Up Cartridge</option>
                                <option value="MC-261YL" class="ar" style="display: none;">- MC-261YL / عبوة مذيب أصفر</option>
                                <option value="IR-236BK" class="en">- IR-236BK / Black Ink Reservoir</option>
                                <option value="IR-236BK" class="ar" style="display: none;">- IR-236BK / خزان حبر أسود</option>
                                <option value="IC-236BK" class="en">- IC-236BK / Black Ink Cartridge</option>
                                <option value="IC-236BK" class="ar" style="display: none;">- IC-236BK / عبوة حبر أسود</option>
                                <option value="MC-236BK" class="en">- MC-236BK / Black Make-Up Cartridge</option>
                                <option value="MC-236BK" class="ar" style="display: none;">- MC-236BK / عبوة مذيب أسود</option>
                                <option value="IR-280BK" class="en">- IR-280BK / Black Ink Reservoir</option>
                                <option value="IR-280BK" class="ar" style="display: none;">- IR-280BK / خزان حبر أسود</option>
                                <option value="IC-280BK" class="en">- IC-280BK / Black Ink Cartridge</option>
                                <option value="IC-280BK" class="ar" style="display: none;">- IC-280BK / عبوة حبر أسود</option>
                                <option value="MC-280CL" class="en">- MC-280CL / Black Make-Up Cartridge</option>
                                <option value="MC-280CL" class="ar" style="display: none;">- MC-280CL / عبوة مذيب أسود</option>
                                <option value="IR-064RG" class="en">- IR-064RG / Red Ink Reservoir</option>
                                <option value="IR-064RG" class="ar" style="display: none;">- IR-064RG / خزان حبر أحمر</option>
                                <option value="IC-064RG" class="en">- IC-064RG / Red Ink Cartridge</option>
                                <option value="IC-064RG" class="ar" style="display: none;">- IC-064RG / عبوة حبر أحمر</option>
                                <option value="MC-064RG" class="en">- MC-064RG / Red Make-Up Cartridge</option>
                                <option value="MC-064RG" class="ar" style="display: none;">- MC-064RG / عبوة مذيب أحمر</option>
                                <option value="IR-299YL" class="en">- IR-299YL / Yellow Ink Reservoir</option>
                                <option value="IR-299YL" class="ar" style="display: none;">- IR-299YL / خزان حبر أصفر</option>
                                <option value="IC-299YL" class="en">- IC-299YL / Yellow Ink Cartridge</option>
                                <option value="IC-299YL" class="ar" style="display: none;">- IC-299YL / عبوة حبر أصفر</option>
                                <option value="MC-299YL" class="en">- MC-299YL / Yellow Make-Up Cartridge</option>
                                <option value="MC-299YL" class="ar" style="display: none;">- MC-299YL / عبوة مذيب أصفر</option>
                                <option value="WL-211 (4 Liter)" class="en">- WL-211 (4 Liter) / Wash Solution</option>
                                <option value="WL-211 (4 Liter)" class="ar" style="display: none;">- WL-211 (4 Liter) / سائل تنظيف</option>
                                <option value="IC-2BK106" class="en">- IC-2BK106 / Black Ink Cartridge</option>
                                <option value="IC-2BK106" class="ar" style="display: none;">- IC-2BK106 / عبوة حبر أسود</option>
                                <option value="MC-2BK106" class="en">- MC-2BK106 / Black Make-Up Cartridge</option>
                                <option value="MC-2BK106" class="ar" style="display: none;">- MC-2BK106 / عبوة مذيب أسود</option>
                                <option value="IC-2BK009" class="en">- IC-2BK009 / Black Ink Cartridge</option>
                                <option value="IC-2BK009" class="ar" style="display: none;">- IC-2BK009 / عبوة حبر أسود</option>
                                <option value="MC-2BK009" class="en">- MC-2BK009 / Black Make-Up Cartridge</option>
                                <option value="MC-2BK009" class="ar" style="display: none;">- MC-2BK009 / عبوة مذيب أسود</option>
                                <option value="other" class="en">Other</option>
                                <option value="other" class="ar" style="display: none;">أخرى</option>
                            </select>
                        </div>
                        <div class="form-group" style="flex: 1; min-width: 100px;">
                            <label for="ink-quantity-3" class="form-label en">Quantity</label>
                            <label for="ink-quantity-3" class="form-label ar" style="display: none;">الكمية</label>
                            <input type="number" id="ink-quantity-3" name="ink-quantity-3" class="form-input" min="1" value="1">
                        </div>
                    </div>
                </div>
                
                <div class="item-panel" id="item-panel-4" style="border: 1px solid #e2e8f0; padding: 15px; margin-bottom: 15px; border-radius: 5px; display: none;">
                    <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                        <div class="form-group" style="flex: 2; min-width: 250px;">
                            <label for="ink-type-4" class="form-label en">Ink Type</label>
                            <label for="ink-type-4" class="form-label ar" style="display: none;">نوع الحبر</label>
                            <select id="ink-type-4" name="ink-type-4" class="form-select">
                                <option value="" class="en">Select your ink type</option>
                                <option value="" class="ar" style="display: none;">اختر نوع الحبر</option>
                                <option value="IR-295BK" class="en">- IR-295BK / Black Ink Reservoir</option>
                                <option value="IR-295BK" class="ar" style="display: none;">- IR-295BK / خزان حبر أسود</option>
                                <option value="IC-295BK" class="en">- IC-295BK / Black Ink Cartridge</option>
                                <option value="IC-295BK" class="ar" style="display: none;">- IC-295BK / عبوة حبر أسود</option>
                                <option value="MC-295BK" class="en">- MC-295BK / Black Make-Up Cartridge</option>
                                <option value="MC-295BK" class="ar" style="display: none;">- MC-295BK / عبوة مذيب أسود</option>
                                <option value="IR-369BK" class="en">- IR-369BK / Red Ink Reservoir</option>
                                <option value="IR-369BK" class="ar" style="display: none;">- IR-369BK / خزان حبر أحمر</option>
                                <option value="IC-369BK" class="en">- IC-369BK / Red Ink Cartridge</option>
                                <option value="IC-369BK" class="ar" style="display: none;">- IC-369BK / عبوة حبر أحمر</option>
                                <option value="MC-369BK" class="en">- MC-369BK / Red Make-Up Cartridge</option>
                                <option value="MC-369BK" class="ar" style="display: none;">- MC-369BK / عبوة مذيب أحمر</option>
                                <option value="IR-261YL" class="en">- IR-261YL / Yellow Ink Reservoir</option>
                                <option value="IR-261YL" class="ar" style="display: none;">- IR-261YL / خزان حبر أصفر</option>
                                <option value="IC-261YL" class="en">- IC-261YL / Yellow Ink Cartridge</option>
                                <option value="IC-261YL" class="ar" style="display: none;">- IC-261YL / عبوة حبر أصفر</option>
                                <option value="MC-261YL" class="en">- MC-261YL / Yellow Make-Up Cartridge</option>
                                <option value="MC-261YL" class="ar" style="display: none;">- MC-261YL / عبوة مذيب أصفر</option>
                                <option value="IR-236BK" class="en">- IR-236BK / Black Ink Reservoir</option>
                                <option value="IR-236BK" class="ar" style="display: none;">- IR-236BK / خزان حبر أسود</option>
                                <option value="IC-236BK" class="en">- IC-236BK / Black Ink Cartridge</option>
                                <option value="IC-236BK" class="ar" style="display: none;">- IC-236BK / عبوة حبر أسود</option>
                                <option value="MC-236BK" class="en">- MC-236BK / Black Make-Up Cartridge</option>
                                <option value="MC-236BK" class="ar" style="display: none;">- MC-236BK / عبوة مذيب أسود</option>
                                <option value="IR-280BK" class="en">- IR-280BK / Black Ink Reservoir</option>
                                <option value="IR-280BK" class="ar" style="display: none;">- IR-280BK / خزان حبر أسود</option>
                                <option value="IC-280BK" class="en">- IC-280BK / Black Ink Cartridge</option>
                                <option value="IC-280BK" class="ar" style="display: none;">- IC-280BK / عبوة حبر أسود</option>
                                <option value="MC-280CL" class="en">- MC-280CL / Black Make-Up Cartridge</option>
                                <option value="MC-280CL" class="ar" style="display: none;">- MC-280CL / عبوة مذيب أسود</option>
                                <option value="IR-064RG" class="en">- IR-064RG / Red Ink Reservoir</option>
                                <option value="IR-064RG" class="ar" style="display: none;">- IR-064RG / خزان حبر أحمر</option>
                                <option value="IC-064RG" class="en">- IC-064RG / Red Ink Cartridge</option>
                                <option value="IC-064RG" class="ar" style="display: none;">- IC-064RG / عبوة حبر أحمر</option>
                                <option value="MC-064RG" class="en">- MC-064RG / Red Make-Up Cartridge</option>
                                <option value="MC-064RG" class="ar" style="display: none;">- MC-064RG / عبوة مذيب أحمر</option>
                                <option value="IR-299YL" class="en">- IR-299YL / Yellow Ink Reservoir</option>
                                <option value="IR-299YL" class="ar" style="display: none;">- IR-299YL / خزان حبر أصفر</option>
                                <option value="IC-299YL" class="en">- IC-299YL / Yellow Ink Cartridge</option>
                                <option value="IC-299YL" class="ar" style="display: none;">- IC-299YL / عبوة حبر أصفر</option>
                                <option value="MC-299YL" class="en">- MC-299YL / Yellow Make-Up Cartridge</option>
                                <option value="MC-299YL" class="ar" style="display: none;">- MC-299YL / عبوة مذيب أصفر</option>
                                <option value="WL-211 (4 Liter)" class="en">- WL-211 (4 Liter) / Wash Solution</option>
                                <option value="WL-211 (4 Liter)" class="ar" style="display: none;">- WL-211 (4 Liter) / سائل تنظيف</option>
                                <option value="IC-2BK106" class="en">- IC-2BK106 / Black Ink Cartridge</option>
                                <option value="IC-2BK106" class="ar" style="display: none;">- IC-2BK106 / عبوة حبر أسود</option>
                                <option value="MC-2BK106" class="en">- MC-2BK106 / Black Make-Up Cartridge</option>
                                <option value="MC-2BK106" class="ar" style="display: none;">- MC-2BK106 / عبوة مذيب أسود</option>
                                <option value="IC-2BK009" class="en">- IC-2BK009 / Black Ink Cartridge</option>
                                <option value="IC-2BK009" class="ar" style="display: none;">- IC-2BK009 / عبوة حبر أسود</option>
                                <option value="MC-2BK009" class="en">- MC-2BK009 / Black Make-Up Cartridge</option>
                                <option value="MC-2BK009" class="ar" style="display: none;">- MC-2BK009 / عبوة مذيب أسود</option>
                                <option value="other" class="en">Other</option>
                                <option value="other" class="ar" style="display: none;">أخرى</option>
                            </select>
                        </div>
                        <div class="form-group" style="flex: 1; min-width: 100px;">
                            <label for="ink-quantity-4" class="form-label en">Quantity</label>
                            <label for="ink-quantity-4" class="form-label ar" style="display: none;">الكمية</label>
                            <input type="number" id="ink-quantity-4" name="ink-quantity-4" class="form-input" min="1" value="1">
                        </div>
                    </div>
                </div>
                
                <div class="item-panel" id="item-panel-5" style="border: 1px solid #e2e8f0; padding: 15px; margin-bottom: 15px; border-radius: 5px; display: none;">
                    <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                        <div class="form-group" style="flex: 2; min-width: 250px;">
                            <label for="ink-type-5" class="form-label en">Ink Type</label>
                            <label for="ink-type-5" class="form-label ar" style="display: none;">نوع الحبر</label>
                            <select id="ink-type-5" name="ink-type-5" class="form-select">
                                <option value="" class="en">Select your ink type</option>
                                <option value="" class="ar" style="display: none;">اختر نوع الحبر</option>
                                <option value="IR-295BK" class="en">- IR-295BK / Black Ink Reservoir</option>
                                <option value="IR-295BK" class="ar" style="display: none;">- IR-295BK / خزان حبر أسود</option>
                                <option value="IC-295BK" class="en">- IC-295BK / Black Ink Cartridge</option>
                                <option value="IC-295BK" class="ar" style="display: none;">- IC-295BK / عبوة حبر أسود</option>
                                <option value="MC-295BK" class="en">- MC-295BK / Black Make-Up Cartridge</option>
                                <option value="MC-295BK" class="ar" style="display: none;">- MC-295BK / عبوة مذيب أسود</option>
                                <option value="IR-369BK" class="en">- IR-369BK / Red Ink Reservoir</option>
                                <option value="IR-369BK" class="ar" style="display: none;">- IR-369BK / خزان حبر أحمر</option>
                                <option value="IC-369BK" class="en">- IC-369BK / Red Ink Cartridge</option>
                                <option value="IC-369BK" class="ar" style="display: none;">- IC-369BK / عبوة حبر أحمر</option>
                                <option value="MC-369BK" class="en">- MC-369BK / Red Make-Up Cartridge</option>
                                <option value="MC-369BK" class="ar" style="display: none;">- MC-369BK / عبوة مذيب أحمر</option>
                                <option value="IR-261YL" class="en">- IR-261YL / Yellow Ink Reservoir</option>
                                <option value="IR-261YL" class="ar" style="display: none;">- IR-261YL / خزان حبر أصفر</option>
                                <option value="IC-261YL" class="en">- IC-261YL / Yellow Ink Cartridge</option>
                                <option value="IC-261YL" class="ar" style="display: none;">- IC-261YL / عبوة حبر أصفر</option>
                                <option value="MC-261YL" class="en">- MC-261YL / Yellow Make-Up Cartridge</option>
                                <option value="MC-261YL" class="ar" style="display: none;">- MC-261YL / عبوة مذيب أصفر</option>
                                <option value="IR-236BK" class="en">- IR-236BK / Black Ink Reservoir</option>
                                <option value="IR-236BK" class="ar" style="display: none;">- IR-236BK / خزان حبر أسود</option>
                                <option value="IC-236BK" class="en">- IC-236BK / Black Ink Cartridge</option>
                                <option value="IC-236BK" class="ar" style="display: none;">- IC-236BK / عبوة حبر أسود</option>
                                <option value="MC-236BK" class="en">- MC-236BK / Black Make-Up Cartridge</option>
                                <option value="MC-236BK" class="ar" style="display: none;">- MC-236BK / عبوة مذيب أسود</option>
                                <option value="IR-280BK" class="en">- IR-280BK / Black Ink Reservoir</option>
                                <option value="IR-280BK" class="ar" style="display: none;">- IR-280BK / خزان حبر أسود</option>
                                <option value="IC-280BK" class="en">- IC-280BK / Black Ink Cartridge</option>
                                <option value="IC-280BK" class="ar" style="display: none;">- IC-280BK / عبوة حبر أسود</option>
                                <option value="MC-280CL" class="en">- MC-280CL / Black Make-Up Cartridge</option>
                                <option value="MC-280CL" class="ar" style="display: none;">- MC-280CL / عبوة مذيب أسود</option>
                                <option value="IR-064RG" class="en">- IR-064RG / Red Ink Reservoir</option>
                                <option value="IR-064RG" class="ar" style="display: none;">- IR-064RG / خزان حبر أحمر</option>
                                <option value="IC-064RG" class="en">- IC-064RG / Red Ink Cartridge</option>
                                <option value="IC-064RG" class="ar" style="display: none;">- IC-064RG / عبوة حبر أحمر</option>
                                <option value="MC-064RG" class="en">- MC-064RG / Red Make-Up Cartridge</option>
                                <option value="MC-064RG" class="ar" style="display: none;">- MC-064RG / عبوة مذيب أحمر</option>
                                <option value="IR-299YL" class="en">- IR-299YL / Yellow Ink Reservoir</option>
                                <option value="IR-299YL" class="ar" style="display: none;">- IR-299YL / خزان حبر أصفر</option>
                                <option value="IC-299YL" class="en">- IC-299YL / Yellow Ink Cartridge</option>
                                <option value="IC-299YL" class="ar" style="display: none;">- IC-299YL / عبوة حبر أصفر</option>
                                <option value="MC-299YL" class="en">- MC-299YL / Yellow Make-Up Cartridge</option>
                                <option value="MC-299YL" class="ar" style="display: none;">- MC-299YL / عبوة مذيب أصفر</option>
                                <option value="WL-211 (4 Liter)" class="en">- WL-211 (4 Liter) / Wash Solution</option>
                                <option value="WL-211 (4 Liter)" class="ar" style="display: none;">- WL-211 (4 Liter) / سائل تنظيف</option>
                                <option value="IC-2BK106" class="en">- IC-2BK106 / Black Ink Cartridge</option>
                                <option value="IC-2BK106" class="ar" style="display: none;">- IC-2BK106 / عبوة حبر أسود</option>
                                <option value="MC-2BK106" class="en">- MC-2BK106 / Black Make-Up Cartridge</option>
                                <option value="MC-2BK106" class="ar" style="display: none;">- MC-2BK106 / عبوة مذيب أسود</option>
                                <option value="IC-2BK009" class="en">- IC-2BK009 / Black Ink Cartridge</option>
                                <option value="IC-2BK009" class="ar" style="display: none;">- IC-2BK009 / عبوة حبر أسود</option>
                                <option value="MC-2BK009" class="en">- MC-2BK009 / Black Make-Up Cartridge</option>
                                <option value="MC-2BK009" class="ar" style="display: none;">- MC-2BK009 / عبوة مذيب أسود</option>
                                <option value="other" class="en">Other</option>
                                <option value="other" class="ar" style="display: none;">أخرى</option>
                            </select>
                        </div>
                        <div class="form-group" style="flex: 1; min-width: 100px;">
                            <label for="ink-quantity-5" class="form-label en">Quantity</label>
                            <label for="ink-quantity-5" class="form-label ar" style="display: none;">الكمية</label>
                            <input type="number" id="ink-quantity-5" name="ink-quantity-5" class="form-input" min="1" value="1">
                        </div>
                    </div>
                </div>
                
                <!-- Order summary section -->
                <div class="order-summary" style="margin-top: 20px; padding: 15px; border: 1px solid #e2e8f0; border-radius: 5px; background-color: #f8fafc;">
                    <h4 class="en" style="margin-bottom: 10px;">Order Summary</h4>
                    <h4 class="ar" style="margin-bottom: 10px; display: none;">ملخص الطلب</h4>
                    <div id="order-summary-content">
                        <!-- Will be populated by JavaScript -->
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="ink-notes" class="form-label en">Additional Notes</label>
                <label for="ink-notes" class="form-label ar" style="display: none;">ملاحظات إضافية</label>
                <textarea id="ink-notes" name="ink-notes" class="form-textarea"></textarea>
            </div>
            <button type="submit" class="btn form-submit en">Submit Order</button>
            <button type="submit" class="btn form-submit ar" style="display: none;">تقديم الطلب</button>
            <div id="ink-form-message" class="form-message"></div>
        </form>
    </div>
</div>

<!-- Maintenance Form -->
<div class="form-card fade-in">
    <div class="form-header" style="background-color: var(--secondary);">
        <h3 class="form-title en">Request Maintenance</h3>
        <h3 class="form-title ar" style="display: none;">طلب صيانة</h3>
        <p class="form-subtitle en">Professional service for your printer</p>
        <p class="form-subtitle ar" style="display: none;">خدمة احترافية لطابعتك</p>
    </div>
    <div class="form-body">
        <form id="maintenance-form" action="submit_maintenance.php" method="POST" enctype="multipart/form-data" >
            <div class="form-group">
                <label for="maintenance-name" class="form-label en">Full Name</label>
                <label for="maintenance-name" class="form-label ar" style="display: none;">الاسم الكامل</label>
                <input type="text" id="maintenance-name" name="full_name" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="maintenance-email" class="form-label en">Email Address</label>
                <label for="maintenance-email" class="form-label ar" style="display: none;">البريد الإلكتروني</label>
                <input type="email" id="maintenance-email" name="email" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="maintenance-phone" class="form-label en">Phone Number</label>
                <label for="maintenance-phone" class="form-label ar" style="display: none;">رقم الهاتف</label>
                <input type="tel" id="maintenance-phone" name="phone" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="maintenance-address" class="form-label en">Address</label>
                <label for="maintenance-address" class="form-label ar" style="display: none;">العنوان</label>
                <input type="text" id="maintenance-address" name="address" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="maintenance-issue" class="form-label en">Issue Description</label>
                <label for="maintenance-issue" class="form-label ar" style="display: none;">وصف المشكلة</label>
                <textarea id="maintenance-issue" name="issue" class="form-textarea" required></textarea>
            </div>
            <div class="form-group">
                <label for="maintenance-date" class="form-label en">Preferred Service Date</label>
                <label for="maintenance-date" class="form-label ar" style="display: none;">تاريخ الخدمة المفضل</label>
                <input type="date" id="maintenance-date" name="preferred_date" class="form-input" required min="<?= date('Y-m-d'); ?>">
                </div>
            <div class="form-group">
                <label for="maintenance-image" class="form-label en">Upload an Image</label>
                <label for="maintenance-image" class="form-label ar" style="display: none;">تحميل صورة</label>
                <input type="file" id="maintenance-image" name="image" class="form-input" accept="image/*">
            </div>
            <button type="submit" class="btn form-submit btn-secondary en">Request Service</button>
            <button type="submit" class="btn form-submit btn-secondary ar" style="display: none;">طلب الخدمة</button>
            <div id="maintenance-form-message" class="form-message"></div>
        </form>
    </div>
</div>

<!-- Complaint Form -->
<div class="form-card fade-in">
    <div class="form-header" style="background-color: var(--dark);">
        <h3 class="form-title en">Submit a Complaint</h3>
        <h3 class="form-title ar" style="display: none;">تقديم شكوى</h3>
        <p class="form-subtitle en">We value your feedback</p>
        <p class="form-subtitle ar" style="display: none;">نحن نقدر ملاحظاتك</p>
    </div>
    <div class="form-body">
        <form id="complaint-form" action="submit_complaint.php" METHOD="POST">
            <div class="form-group">
                <label for="complaint-name" class="form-label en">Full Name</label>
                <label for="complaint-name" class="form-label ar" style="display: none;">الاسم الكامل</label>
                <input type="text" id="complaint-name" name="complaint-name" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="complaint-email" class="form-label en">Email Address</label>
                <label for="complaint-email" class="form-label ar" style="display: none;">البريد الإلكتروني</label>
                <input type="email" id="complaint-email" name="complaint-email" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="complaint-order" class="form-label en">Order/Reference Number</label>
                <label for="complaint-order" class="form-label ar" style="display: none;">رقم الطلب/المرجع</label>
                <input type="text" id="complaint-order" name="complaint-order" class="form-input">
            </div>
            <div class="form-group">
                <label for="complaint-type" class="form-label en">Complaint Type</label>
                <label for="complaint-type" class="form-label ar" style="display: none;">نوع الشكوى</label>
                <select id="complaint-type" name="complaint-type" class="form-select" required>
                    <option value="" class="en">Select complaint type</option>
                    <option value="" class="ar" style="display: none;">اختر نوع الشكوى</option>
                    <option value="product" class="en">Product Issue</option>
                    <option value="product" class="ar" style="display: none;">مشكلة في المنتج</option>
                    <option value="service" class="en">Service Issue</option>
                    <option value="service" class="ar" style="display: none;">مشكلة في الخدمة</option>
                    <option value="delivery" class="en">Delivery Issue</option>
                    <option value="delivery" class="ar" style="display: none;">مشكلة في التوصيل</option>
                    <option value="billing" class="en">Billing Issue</option>
                    <option value="billing" class="ar" style="display: none;">مشكلة في الفواتير</option>
                    <option value="other" class="en">Other</option>
                    <option value="other" class="ar" style="display: none;">أخرى</option>
                </select>
            </div>
            <div class="form-group">
                <label for="complaint-details" class="form-label en">Complaint Details</label>
                <label for="complaint-details" class="form-label ar" style="display: none;">تفاصيل الشكوى</label>
                <textarea id="complaint-details" name="complaint-details" class="form-textarea" required></textarea>
            </div>
            <div class="form-group">
                <label for="complaint-resolution" class="form-label en">Desired Resolution</label>
                <label for="complaint-resolution" class="form-label ar" style="display: none;">الحل المطلوب</label>
                <textarea id="complaint-resolution" name="complaint-resolution" class="form-textarea"></textarea>
            </div>
            <br><br>
            <button type="submit" class="btn form-submit en" style="background-color: var(--dark);">Submit Complaint</button>
            <button type="submit" class="btn form-submit ar" style="display: none;" style="background-color: var(--dark);">تقديم الشكوى</button>
            <div id="complaint-form-message" class="form-message"></div>
        </form>
    </div>
</div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="container">
            <div class="footer-container">
                <div class="footer-col">
                    <div class="footer-logo">
                        <img src="assets/logo.svg" style="height: 20%; width: 20%;" alt="">
                    </div>
                 
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h3 class="footer-title en">Quick Links</h3>
                    <h3 class="footer-title ar" style="display: none;">روابط سريعة</h3>
                    <ul class="footer-links">
                        <li><a href="index.html" class="en">Home</a><a href="index.html" class="ar" style="display: none;">الرئيسية</a></li>
                        <li><a href="index.html#about" class="en">About Us</a><a href="index.html#about" class="ar" style="display: none;">عن الشركة</a></li>
                        <li><a href="products.php" class="en">Products</a><a href="products.php" class="ar" style="display: none;">المنتجات</a></li>
                        <li><a href="#" class="en">Services</a><a href="#" class="ar" style="display: none;">الخدمات</a></li>
                        <li><a href="#" class="en">Blog</a><a href="#" class="ar" style="display: none;">المدونة</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h3 class="footer-title en">Contact Us</h3>
                    <h3 class="footer-title ar" style="display: none;">اتصل بنا</h3>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt contact-icon"></i>
                        <span>123 Innovation Drive, Tech City, TC 12345</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone-alt contact-icon"></i>
                        <span>+1 (555) 123-4567</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope contact-icon"></i>
                        <span>info@ipscompany.com</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock contact-icon"></i>
                        <span class="en">Mon-Fri: 9AM - 6PM</span>
                        <span class="ar" style="display: none;">الاثنين-الجمعة: 9 صباحًا - 6 مساءً</span>
                    </div>
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

document.addEventListener("DOMContentLoaded", function () {
        let today = new Date().toISOString().split('T')[0];
        document.getElementById("maintenance-date").setAttribute("min", today);
    });
    
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navLinks = document.querySelector('.nav-links');

        mobileMenuBtn.addEventListener('click', function() {
            navLinks.classList.toggle('active');
            const icon = mobileMenuBtn.querySelector('i');
            if (navLinks.classList.contains('active')) {
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

        langSwitch.addEventListener('click', function() {
            document.body.classList.toggle('rtl');
            
            enElements.forEach(el => {
                el.style.display = el.style.display === 'none' ? 'block' : 'none';
            });
            
            arElements.forEach(el => {
                el.style.display = el.style.display === 'none' ? 'block' : 'none';
            });
        });

        // Scroll animation
        const fadeElements = document.querySelectorAll('.fade-in');

        function checkFade() {
            fadeElements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementBottom = element.getBoundingClientRect().bottom;
                const isVisible = (elementTop < window.innerHeight - 100) && (elementBottom > 0);
                
                if (isVisible) {
                    element.classList.add('active');
                }
            });
        }

        // Initial check
        checkFade();

        // Check on scroll
        window.addEventListener('scroll', checkFade);

        // Tab switching functionality for ink order form
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching functionality
            const itemTabs = document.querySelectorAll('.item-tab');
            const itemPanels = document.querySelectorAll('.item-panel');
            
            // Function to update order summary
            function updateOrderSummary() {
                const summaryContent = document.getElementById('order-summary-content');
                let html = '';
                let hasItems = false;
                
                // Check if English or Arabic is active
                const isEnglish = document.querySelector('.en').style.display !== 'none';
                
                for (let i = 1; i <= 5; i++) {
                    const inkTypeSelect = document.getElementById(`ink-type-${i}`);
                    const inkType = inkTypeSelect.value;
                    const quantity = document.getElementById(`ink-quantity-${i}`).value;
                    
                    if (inkType) {
                        hasItems = true;
                        // Get the selected option text
                        const selectedOption = inkTypeSelect.options[inkTypeSelect.selectedIndex];
                        const inkTypeText = selectedOption ? selectedOption.text : inkType;
                        
                        html += `
                            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                <span>${i}. ${inkTypeText}</span>
                                <span>${quantity}</span>
                            </div>
                        `;
                    }
                }
                
                if (!hasItems) {
                    html = `<p class="en" ${!isEnglish ? 'style="display: none;"' : ''}>No items selected yet.</p>
                           <p class="ar" ${isEnglish ? 'style="display: none;"' : ''}>لم يتم اختيار أي عناصر بعد.</p>`;
                }
                
                summaryContent.innerHTML = html;
            }
            
            // Initialize tabs
            itemTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const itemNumber = this.getAttribute('data-item');
                    
                    // Deactivate all tabs and panels
                    itemTabs.forEach(t => {
                        t.classList.remove('active');
                        t.style.backgroundColor = 'white';
                    });
                    itemPanels.forEach(p => p.style.display = 'none');
                    
                    // Activate selected tab and panel
                    this.classList.add('active');
                    this.style.backgroundColor = '#f8fafc';
                    document.getElementById(`item-panel-${itemNumber}`).style.display = 'block';
                });
            });
            
            // Initialize form fields change listeners
            for (let i = 1; i <= 5; i++) {
                const inkTypeSelect = document.getElementById(`ink-type-${i}`);
                const quantityInput = document.getElementById(`ink-quantity-${i}`);
                
                inkTypeSelect.addEventListener('change', updateOrderSummary);
                quantityInput.addEventListener('change', updateOrderSummary);
            }
            
            // Initial update of order summary
            updateOrderSummary();
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu if open
                    if (navLinks.classList.contains('active')) {
                        navLinks.classList.remove('active');
                        const icon = mobileMenuBtn.querySelector('i');
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                }
            });
        });


        // Add this function to your existing JavaScript code
function showOrderReview() {
  // Get form data
  const fullName = document.getElementById('ink-name').value;
  const email = document.getElementById('ink-email').value;
  const phone = document.getElementById('ink-phone').value;
  const notes = document.getElementById('ink-notes').value;
  
  // Create review modal
  const modal = document.createElement('div');
  modal.className = 'order-review-modal';
  modal.style.position = 'fixed';
  modal.style.top = '0';
  modal.style.left = '0';
  modal.style.width = '100%';
  modal.style.height = '100%';
  modal.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
  modal.style.display = 'flex';
  modal.style.justifyContent = 'center';
  modal.style.alignItems = 'center';
  modal.style.zIndex = '1000';
  
  // Create modal content
  const modalContent = document.createElement('div');
  modalContent.className = 'order-review-content';
  modalContent.style.backgroundColor = 'white';
  modalContent.style.padding = '2rem';
  modalContent.style.borderRadius = '10px';
  modalContent.style.maxWidth = '600px';
  modalContent.style.width = '90%';
  modalContent.style.maxHeight = '90vh';
  modalContent.style.overflowY = 'auto';
  modalContent.style.boxShadow = '0 10px 25px rgba(0, 0, 0, 0.2)';
  
  // Check if English or Arabic is active
  const isEnglish = document.querySelector('.en').style.display !== 'none';
  
  // Create modal header
  const modalHeader = document.createElement('div');
  modalHeader.style.borderBottom = '1px solid #e2e8f0';
  modalHeader.style.marginBottom = '1.5rem';
  modalHeader.style.paddingBottom = '1rem';
  
  const modalTitle = document.createElement('h3');
  modalTitle.style.fontSize = '1.5rem';
  modalTitle.style.fontWeight = 'bold';
  modalTitle.textContent = isEnglish ? 'Order Review' : 'مراجعة الطلب';
  
  modalHeader.appendChild(modalTitle);
  modalContent.appendChild(modalHeader);
  
  // Create customer info section
  const customerSection = document.createElement('div');
  customerSection.style.marginBottom = '1.5rem';
  
  const customerTitle = document.createElement('h4');
  customerTitle.style.fontSize = '1.2rem';
  customerTitle.style.fontWeight = 'bold';
  customerTitle.style.marginBottom = '0.5rem';
  customerTitle.textContent = isEnglish ? 'Customer Information' : 'معلومات العميل';
  
  const customerInfo = document.createElement('div');
  customerInfo.style.padding = '0.5rem';
  customerInfo.style.backgroundColor = '#f8fafc';
  customerInfo.style.borderRadius = '5px';
  
  customerInfo.innerHTML = `
    <p><strong>${isEnglish ? 'Name' : 'الاسم'}:</strong> ${fullName}</p>
    <p><strong>${isEnglish ? 'Email' : 'البريد الإلكتروني'}:</strong> ${email}</p>
    <p><strong>${isEnglish ? 'Phone' : 'الهاتف'}:</strong> ${phone}</p>
  `;
  
  customerSection.appendChild(customerTitle);
  customerSection.appendChild(customerInfo);
  modalContent.appendChild(customerSection);
  
  // Create order items section
  const itemsSection = document.createElement('div');
  itemsSection.style.marginBottom = '1.5rem';
  
  const itemsTitle = document.createElement('h4');
  itemsTitle.style.fontSize = '1.2rem';
  itemsTitle.style.fontWeight = 'bold';
  itemsTitle.style.marginBottom = '0.5rem';
  itemsTitle.textContent = isEnglish ? 'Order Items' : 'عناصر الطلب';
  
  const itemsList = document.createElement('div');
  itemsList.style.padding = '0.5rem';
  itemsList.style.backgroundColor = '#f8fafc';
  itemsList.style.borderRadius = '5px';
  
  // Get order items
  let hasItems = false;
  let itemsHTML = '';
  
  for (let i = 1; i <= 5; i++) {
    const inkTypeSelect = document.getElementById(`ink-type-${i}`);
    if (!inkTypeSelect) continue;
    
    const inkType = inkTypeSelect.value;
    if (!inkType) continue;
    
    hasItems = true;
    const quantity = document.getElementById(`ink-quantity-${i}`).value;
    const selectedOption = inkTypeSelect.options[inkTypeSelect.selectedIndex];
    const inkTypeText = selectedOption ? selectedOption.text : inkType;
    
    itemsHTML += `
      <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #e2e8f0;">
        <div style="flex: 3;">
          <strong>${i}.</strong> ${inkTypeText}
        </div>
        <div style="flex: 1; text-align: right;">
          <strong>${isEnglish ? 'Qty' : 'الكمية'}:</strong> ${quantity}
        </div>
      </div>
    `;
  }
  
  if (!hasItems) {
    itemsHTML = `<p>${isEnglish ? 'No items selected.' : 'لم يتم اختيار أي عناصر.'}</p>`;
  }
  
  itemsList.innerHTML = itemsHTML;
  
  itemsSection.appendChild(itemsTitle);
  itemsSection.appendChild(itemsList);
  modalContent.appendChild(itemsSection);
  
  // Add notes section if provided
  if (notes) {
    const notesSection = document.createElement('div');
    notesSection.style.marginBottom = '1.5rem';
    
    const notesTitle = document.createElement('h4');
    notesTitle.style.fontSize = '1.2rem';
    notesTitle.style.fontWeight = 'bold';
    notesTitle.style.marginBottom = '0.5rem';
    notesTitle.textContent = isEnglish ? 'Additional Notes' : 'ملاحظات إضافية';
    
    const notesContent = document.createElement('div');
    notesContent.style.padding = '0.5rem';
    notesContent.style.backgroundColor = '#f8fafc';
    notesContent.style.borderRadius = '5px';
    notesContent.textContent = notes;
    
    notesSection.appendChild(notesTitle);
    notesSection.appendChild(notesContent);
    modalContent.appendChild(notesSection);
  }
  
  // Add buttons
  const buttonsContainer = document.createElement('div');
  buttonsContainer.style.display = 'flex';
  buttonsContainer.style.justifyContent = 'space-between';
  buttonsContainer.style.marginTop = '1.5rem';
  
  const cancelButton = document.createElement('button');
  cancelButton.className = 'btn';
  cancelButton.style.backgroundColor = '#64748b';
  cancelButton.textContent = isEnglish ? 'Edit Order' : 'تعديل الطلب';
  cancelButton.onclick = function() {
    document.body.removeChild(modal);
  };
  
  const confirmButton = document.createElement('button');
  confirmButton.className = 'btn';
  confirmButton.style.backgroundColor = 'var(--primary)';
  confirmButton.textContent = isEnglish ? 'Confirm & Submit' : 'تأكيد وإرسال';
  confirmButton.onclick = function() {
    document.getElementById('ink-order-form').submit();
  };
  
  buttonsContainer.appendChild(cancelButton);
  buttonsContainer.appendChild(confirmButton);
  modalContent.appendChild(buttonsContainer);
  
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
}

// Modify the form submission to show review first
document.addEventListener('DOMContentLoaded', function() {
  const inkOrderForm = document.getElementById('ink-order-form');
  if (inkOrderForm) {
    inkOrderForm.addEventListener('submit', function(e) {
      e.preventDefault();
      showOrderReview();
    });
  }
});

    </script>
</body>
</html>