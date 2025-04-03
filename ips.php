<?php

session_start();
// Database connection
$conn = new mysqli("localhost", "root", "", "ipstest");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all data from 'users' table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);



// Check if the session is set and the email is available
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    $email = "Guest"; // or you could redirect the user if session is not found
}

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
} else {
    $id = "null"; // or you could redirect the user if session is not found
   
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPS - Innovative Printing Solutions</title>
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
            bottom: -30px;
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

        /* Hero Section */
        .hero {
            height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(236, 236, 235, 0.1) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--primary) 0%, rgba(37, 99, 235, 0) 70%);
            opacity: 0.5;
            animation: float 10s infinite ease-in-out;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, var(--secondary) 0%, rgba(249, 115, 22, 0) 70%);
            opacity: 0.5;
            animation: float 13s infinite ease-in-out reverse;
        }

        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(50%, 50px) rotate(2deg); }
            100% { transform: translate(0, 0) rotate(0deg); }
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 600px;
        }

        .hero-title {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            animation: fadeInUp 1s ease;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--gray);
            margin-bottom: 2rem;
            animation: fadeInUp 1s ease 0.2s forwards;
            opacity: 0;
        }

        .hero-btns {
            display: flex;
            gap: 1rem;
            animation: fadeInUp 1s ease 0.4s forwards;
            opacity: 0;
        }

        .hero-image {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 50%;
            max-width: 600px;
            animation: fadeInRight 1s ease 0.6s forwards;
            opacity: 0;
            z-index: 1;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translate(30px, -50%);
            }
            to {
                opacity: 1;
                transform: translate(0, -50%);
            }
        }

        /* About Section */
        .about {
            background-color: white;
            position: relative;
            overflow: hidden;
        }

        .about-container {
            display: flex;
            flex-wrap: wrap;
            align-items: start;
            gap: 2rem;
        }

        .about-image  {
            flex: 1;
            min-width: 300px;
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transform: perspective(1000px) rotateY(-5deg);
            transition: var(--transition);
        }

      
        .about-image img:hover {
            transform: perspective(100000px) rotateY(0);
        }

        .about-image img {
            
            
            display: block;
        }
        
        .about-content {
            flex: 1;
            min-width: 300px;
        }

        .about-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .about-text {
            margin-bottom: 1.5rem;
        }

        .values {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
            
        }

        

        .value-item {
            background-color: var(--light);
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
           
        }

     
        .value-item:hover {
            transform: translateY(-10px) ;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
           
        }

        .value-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .value-title {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        /* Products Section */
        .products {
            background-color: var(--light);
            position: relative;
        }

        .products::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><circle cx="3" cy="3" r="3" fill="%232563eb" opacity="0.1"/></svg>');
            opacity: 0.5;
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
            
            transition-duration: 0.5s;
        }

        .product-card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            transform: translateY(-10px) scale(1.5);
            

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

        /* Responsive Styles */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.8rem;
            }

            .hero-image {
                width: 45%;
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

            .hero {
                height: auto;
                padding: 8rem 0 4rem;
            }

            .hero-content {
                text-align: center;
                margin: 0 auto;
            }

            .hero-btns {
                justify-content: center;
            }

            .hero-image {
                position: relative;
                width: 80%;
                margin: 3rem auto 0;
                transform: none;
                top: auto;
                right: auto;
            }

            .about-container {
                flex-direction: column;
            }

            .about-image img {
                margin-bottom: 2rem;
                display: none;
                
            }

            .section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .hero-btns {
                flex-direction: column;
                width: 100%;
                max-width: 300px;
                margin: 0 auto;
            }

            .btn {
                width: 100%;
                text-align: center;
                margin-bottom: 1rem;
            }

            .product-grid {
                grid-template-columns: 1fr;
            }

            .footer-container {
                grid-template-columns: 1fr;
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



                <li><a href="#" class="en">Home</a><a href="#" class="ar" style="display: none;">الرئيسية</a></li>
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

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title en">Innovative Printing Solutions</h1>
                <h1 class="hero-title ar" style="display: none;">حلول طباعة مبتكرة</h1>
                <p class="hero-subtitle en">Transforming ideas into reality with cutting-edge printing technology and unmatched quality.</p>
                <p class="hero-subtitle ar" style="display: none;">تحويل الأفكار إلى واقع مع تقنية طباعة متطورة وجودة لا مثيل لها.</p>
                <div class="hero-btns">
                    <a href="#products" class="btn en">Explore Products</a>
                    <a href="#products" class="btn ar" style="display: none;">استكشف المنتجات</a>
                    <a href="#contact" class="btn btn-outline en">Contact Us</a>
                    <a href="#contact" class="btn btn-outline ar" style="display: none;">اتصل بنا</a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="section about" id="about">
        <div class="container">
            <h2 class="section-title en fade-in">Our History & Values</h2>
            <h2 class="section-title ar fade-in" style="display: none;">تاريخنا وقيمنا</h2>
            <br><br>
            <div class="about-container">
                <div class="about-image fade-in">
                    <img src="assets/blister.jpg" alt="IPS History">
                </div>
              
                <div class="about-content">
                    <h3 class="about-title en fade-in">Our Journey</h3>
                    <h3 class="about-title ar fade-in" style="display: none;">رحلتنا</h3>
                    <p class="about-text en fade-in">
                        Founded in 1995, IPS began as a small printing shop with a vision to revolutionize the printing industry. Over the past 28 years, we've grown into a global leader in printing solutions, serving clients across 30 countries.
                    </p>
                    <p class="about-text ar fade-in" style="display: none;">
                        تأسست شركة آي بي إس في عام 1995، وبدأت كمتجر طباعة صغير برؤية لإحداث ثورة في صناعة الطباعة. على مدار الـ 28 عامًا الماضية، نمونا لنصبح رائدًا عالميًا في حلول الطباعة، ونخدم العملاء في 30 دولة.
                    </p>
                    <p class="about-text en fade-in">
                        Our commitment to innovation, quality, and customer satisfaction has been the cornerstone of our success. We continuously invest in cutting-edge technology and talented professionals to deliver exceptional printing solutions.
                    </p>
                    <p class="about-text ar fade-in" style="display: none;">
                        كان التزامنا بالابتكار والجودة ورضا العملاء حجر الزاوية في نجاحنا. نستثمر باستمرار في التكنولوجيا المتطورة والمهنيين الموهوبين لتقديم حلول طباعة استثنائية.
                    </p>
                    <div class="values">
                        <div class="value-item fade-in">
                            <div class="value-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <h4 class="value-title en">Innovation</h4>
                            <h4 class="value-title ar" style="display: none;">الابتكار</h4>
                            <p class="en">Pushing boundaries with creative solutions</p>
                            <p class="ar" style="display: none;">دفع الحدود بحلول إبداعية</p>
                        </div>
                        <div class="value-item fade-in">
                            <div class="value-icon">
                                <i class="fas fa-gem"></i>
                            </div>
                            <h4 class="value-title en">Quality</h4>
                            <h4 class="value-title ar" style="display: none;">الجودة</h4>
                            <p class="en">Uncompromising excellence in every print</p>
                            <p class="ar" style="display: none;">التميز دون مساومة في كل طباعة</p>
                        </div>
                        <div class="value-item fade-in">
                            <div class="value-icon">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <h4 class="value-title en">Sustainability</h4>
                            <h4 class="value-title ar" style="display: none;">الاستدامة</h4>
                            <p class="en">Eco-friendly practices and materials</p>
                            <p class="ar" style="display: none;">ممارسات ومواد صديقة للبيئة</p>
                        </div>
                        <div class="value-item fade-in">
                            <div class="value-icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <h4 class="value-title en">Speed</h4>
                            <h4 class="value-title ar" style="display: none;">السرعة</h4>
                            <p class="en">Delivering needs as quick as possible</p>
                            <p class="ar" style="display: none;">تقديم الخدمات باسرع ما يمكن</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="section products" id="products">
        <div class="container">
            <h2 class="section-title en fade-in"> Our Products</h2>
            <h2 class="section-title ar fade-in" style="display: none;">بعض من منتجاتنا </h2>
            <div class="product-grid">
                <div class="product-card fade-in">
                
                   
                    <div class="product-image">
                        <img src="assets/obj1.jpg" alt="obj1">
                    </div>
                    <div class="product-content">
                        <h3 class="product-title">IPS Food Packaging Print</h3>
                     
                        <p class="product-desc en">High-quality printing solutions for food packaging with vibrant colors and durable prints.</p>
                        <p class="product-desc ar" style="display: none;">حلول طباعة عالية الجودة لتغليف الطعام بألوان زاهية وطبعات متينة. <br><br></p>
                <br><br>
                        <a href="products.php" class="btn product-btn en">Show More</a>
                        <a href="products.php" class="btn product-btn ar" style="display: none;">عرض المزيد</a>
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
                       <br><br><br>
                        <a href="products.php" class="btn product-btn en">Show More</a>
                        <a href="products.php" class="btn product-btn ar" style="display: none;">عرض المزيد</a>
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
                      <br><br><br>
                        <a href="products.php" class="btn product-btn en">Show More</a>
                        <a href="products.php" class="btn product-btn ar" style="display: none;">عرض المزيد</a>
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
                    <p class="footer-desc en">Transforming ideas into reality with cutting-edge printing technology and unmatched quality since 1995.</p>
                    <p class="footer-desc ar" style="display: none;">تحويل الأفكار إلى واقع مع تقنية طباعة متطورة وجودة لا مثيل لها منذ عام 1995.</p>
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
                        <li><a href="#" class="en">Home</a><a href="#" class="ar" style="display: none;">الرئيسية</a></li>
                        <li><a href="#about" class="en">About Us</a><a href="#about" class="ar" style="display: none;">عن الشركة</a></li>
                        <li><a href="#products" class="en">Products</a><a href="#products" class="ar" style="display: none;">المنتجات</a></li>
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

    

    </script>
</body>
</html>