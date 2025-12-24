<!DOCTYPE html>
<html lang="vi" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>HRM Pro - Hệ thống Quản lý Nhân sự Toàn diện</title>

    <meta name="description" content="Giải pháp quản lý nhân sự 4.0, chấm công, tính lương, KPI tự động." />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #696cff;
            --primary-dark: #5f61e6;
            --secondary-color: #8592a3;
            --dark-bg: #232333;
        }
        
        body {
            font-family: 'Public Sans', sans-serif;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar-landing {
            transition: all 0.4s ease;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            padding: 1rem 0;
        }
        .navbar-landing.scrolled {
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            background: rgba(255, 255, 255, 0.98);
            padding: 0.7rem 0;
        }
        .nav-link {
            font-weight: 500;
            color: #566a7f;
            margin: 0 0.5rem;
            position: relative;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--primary-color);
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--primary-color);
            transition: width 0.3s;
        }
        .nav-link:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .landing-hero {
            background: linear-gradient(135deg, #f5f5f9 0%, #e6e6fa 100%);
            padding-top: 140px;
            padding-bottom: 100px;
            position: relative;
            overflow: hidden;
        }
        .hero-blob {
            position: absolute;
            top: -10%;
            right: -5%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(105,108,255,0.15) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            z-index: 0;
        }
        .hero-img-wrapper {
            position: relative;
            z-index: 2;
            perspective: 1000px;
        }
        .hero-dashboard-img {
            border-radius: 16px;
            box-shadow: 0 25px 80px rgba(105, 108, 255, 0.2);
            transform: rotateY(-10deg) rotateX(5deg);
            transition: transform 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);
            background: white;
            padding: 10px;
        }
        .hero-dashboard-img:hover {
            transform: rotateY(0) rotateX(0) scale(1.02);
        }
        .floating-card {
            position: absolute;
            background: white;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 10px;
            animation: float 3s ease-in-out infinite;
            z-index: 3;
        }
        .floating-card.card-1 { top: 20%; left: -30px; animation-delay: 0s; }
        .floating-card.card-2 { bottom: 15%; right: -20px; animation-delay: 1.5s; }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        /* Features */
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 1rem;
        }
        .section-title::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background: var(--primary-color);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }
        .feature-card {
            border: none;
            border-radius: 16px;
            background: #fff;
            padding: 2rem;
            height: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            position: relative;
            overflow: hidden;
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(105, 108, 255, 0.15);
        }
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--primary-color);
            transform: scaleX(0);
            transition: transform 0.3s ease;
            transform-origin: left;
        }
        .feature-card:hover::before {
            transform: scaleX(1);
        }
        .feature-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            background: rgba(105, 108, 255, 0.1);
            color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin-bottom: 1.5rem;
            transition: all 0.3s;
        }
        .feature-card:hover .feature-icon {
            background: var(--primary-color);
            color: white;
            transform: rotateY(180deg);
        }

        /* Stats */
        .stats-section {
            background: url('https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/landing-page/bg-shape.png');
            background-size: cover;
            background-position: center;
            background-color: var(--primary-color);
            color: white;
        }
        .stat-item h2 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        /* Process Steps */
        .process-step {
            position: relative;
            z-index: 1;
        }
        .step-number {
            width: 50px;
            height: 50px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            margin: 0 auto 1rem;
            box-shadow: 0 0 0 8px rgba(105, 108, 255, 0.2);
        }
        .process-line {
            position: absolute;
            top: 25px;
            left: 50%;
            width: 100%;
            height: 2px;
            background: #e7e7e8;
            z-index: -1;
        }
        .process-step:last-child .process-line {
            display: none;
        }

        /* Pricing */
        .pricing-card {
            border: 1px solid #ebe9f1;
            border-radius: 16px;
            padding: 2rem;
            transition: all 0.3s;
            background: white;
        }
        .pricing-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 15px 30px rgba(105, 108, 255, 0.1);
        }
        .pricing-card.popular {
            border: 2px solid var(--primary-color);
            position: relative;
            transform: scale(1.05);
            z-index: 2;
            box-shadow: 0 15px 40px rgba(105, 108, 255, 0.15);
        }
        .popular-badge {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary-color);
            color: white;
            padding: 5px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        .price-value {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        /* Testimonials */
        .testimonial-card {
            background: #f8f9fa;
            border-radius: 16px;
            padding: 2rem;
            position: relative;
            margin-top: 30px;
        }
        .testimonial-img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            position: absolute;
            top: -35px;
            left: 2rem;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* Footer */
        .footer-landing {
            background-color: #2b2c40;
            color: #a3a4cc;
            padding-top: 5rem;
            padding-bottom: 2rem;
        }
        .footer-title {
            color: #fff;
            font-weight: 600;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        .footer-link {
            color: #a3a4cc;
            text-decoration: none;
            display: block;
            margin-bottom: 0.8rem;
            transition: all 0.3s;
        }
        .footer-link:hover {
            color: #fff;
            transform: translateX(5px);
        }
        .social-icon {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white;
            margin-right: 10px;
            transition: all 0.3s;
        }
        .social-icon:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }
    </style>

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-landing fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary fs-3 d-flex align-items-center" href="{{ url('/') }}">
                <i class='bx bxs-cube-alt me-2 fs-2'></i>HRM Pro
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="bx bx-menu fs-2 text-primary"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Tính năng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#process">Quy trình</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#contact">Liên hệ</a>
                    </li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary px-4 shadow-sm">
                                    <i class='bx bxs-dashboard me-1'></i> Dashboard
                                </a>
                            </li>
                        @else
                            <li class="nav-item me-2">
                                <a href="{{ route('login') }}" class="btn btn-outline-primary px-4">Đăng nhập</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="btn btn-primary px-4 shadow-sm">Đăng ký</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="landing-hero">
        <div class="hero-blob"></div>
        <div class="container position-relative z-1">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 animate__animated animate__fadeInLeft">
                    <span class="badge bg-label-primary mb-3 px-3 py-2 rounded-pill">
                        <i class='bx bx-star me-1'></i> Giải pháp HRM số 1 Việt Nam
                    </span>
                    <h1 class="display-4 fw-bold mb-4 lh-base text-dark">
                        Quản trị Nhân sự 5.0 <br>
                        <span class="text-primary">Đơn giản hóa</span> mọi quy trình
                    </h1>
                    <p class="lead mb-5 text-muted" style="max-width: 500px;">
                        Tự động hóa chấm công, tính lương, quản lý hồ sơ và đánh giá hiệu suất. 
                        Giúp doanh nghiệp tiết kiệm 60% thời gian và chi phí vận hành.
                    </p>
                    <div class="d-flex gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg px-5 shadow-lg hover-lift">
                                Truy cập hệ thống
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 shadow-lg hover-lift">
                                Đăng ký ngay
                            </a>
                            <a href="{{ url('/login') }}" class="btn btn-outline-secondary btn-lg px-4">
                                <i class='bx bx-play-circle me-2'></i> Truy cập hệ thống
                            </a>
                        @endauth
                    </div>
                    <div class="mt-5 d-flex align-items-center gap-4">
                        <div class="d-flex align-items-center">
                            <i class='bx bxs-check-circle text-success fs-4 me-2'></i>
                            <span class="text-muted">Setup trong 5 phút</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class='bx bxs-check-circle text-success fs-4 me-2'></i>
                            <span class="text-muted">Không cần thẻ tín dụng</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center animate__animated animate__fadeInRight">
                    <div class="hero-img-wrapper">
                        <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/front-pages/landing-page/hero-dashboard-light.png" 
                             alt="HRM Dashboard" class="img-fluid hero-dashboard-img">
                        
                        <!-- Floating Elements -->
                        <div class="floating-card card-1">
                            <div class="avatar avatar-sm bg-success rounded-circle text-white d-flex align-items-center justify-content-center">
                                <i class='bx bx-check'></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-dark">Lương tháng 12</h6>
                                <small class="text-success">Đã thanh toán</small>
                            </div>
                        </div>
                        <div class="floating-card card-2">
                            <div class="avatar avatar-sm bg-warning rounded-circle text-white d-flex align-items-center justify-content-center">
                                <i class='bx bx-time'></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-dark">Chấm công</h6>
                                <small class="text-muted">08:30 AM - Đúng giờ</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Clients Section -->
    <section class="py-4 border-bottom bg-white">
        <div class="container">
            <p class="text-center text-muted mb-4 small fw-bold text-uppercase tracking-wider">Được tin dùng bởi hơn 500+ doanh nghiệp</p>
            <div class="row justify-content-center align-items-center opacity-50 grayscale-hover">
                <div class="col-6 col-md-2 text-center mb-3 mb-md-0">
                    <h4 class="fw-bold text-secondary mb-0"><i class='bx bxl-google'></i> Google</h4>
                </div>
                <div class="col-6 col-md-2 text-center mb-3 mb-md-0">
                    <h4 class="fw-bold text-secondary mb-0"><i class='bx bxl-microsoft'></i> Microsoft</h4>
                </div>
                <div class="col-6 col-md-2 text-center mb-3 mb-md-0">
                    <h4 class="fw-bold text-secondary mb-0"><i class='bx bxl-airbnb'></i> Airbnb</h4>
                </div>
                <div class="col-6 col-md-2 text-center mb-3 mb-md-0">
                    <h4 class="fw-bold text-secondary mb-0"><i class='bx bxl-spotify'></i> Spotify</h4>
                </div>
                <div class="col-6 col-md-2 text-center mb-3 mb-md-0">
                    <h4 class="fw-bold text-secondary mb-0"><i class='bx bxl-slack'></i> Slack</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <span class="badge bg-label-primary mb-2">TÍNH NĂNG NỔI BẬT</span>
                <h2 class="fw-bold display-6">Giải pháp toàn diện cho doanh nghiệp</h2>
                <p class="text-muted fs-5">Tất cả công cụ bạn cần để quản lý đội ngũ nhân sự hiệu quả</p>
            </div>

            <div class="row g-4">
                <!-- Feature 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class='bx bx-id-card'></i>
                        </div>
                        <h4 class="mb-3">Hồ sơ nhân sự số</h4>
                        <p class="text-muted mb-0">
                            Lưu trữ tập trung, tra cứu nhanh chóng. Quản lý hợp đồng, quá trình công tác và thông tin cá nhân bảo mật tuyệt đối.
                        </p>
                    </div>
                </div>
                <!-- Feature 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class='bx bx-time-five'></i>
                        </div>
                        <h4 class="mb-3">Chấm công thông minh</h4>
                        <p class="text-muted mb-0">
                            Hỗ trợ chấm công qua GPS, Wifi, FaceID. Tự động tổng hợp công, tăng ca, đi muộn về sớm chính xác từng phút.
                        </p>
                    </div>
                </div>
                <!-- Feature 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class='bx bx-money'></i>
                        </div>
                        <h4 class="mb-3">Tính lương tự động</h4>
                        <p class="text-muted mb-0">
                            Thiết lập công thức lương linh hoạt. Tự động tính lương, thuế, bảo hiểm và gửi phiếu lương qua email/app.
                        </p>
                    </div>
                </div>
                <!-- Feature 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class='bx bx-calendar-check'></i>
                        </div>
                        <h4 class="mb-3">Quản lý nghỉ phép</h4>
                        <p class="text-muted mb-0">
                            Đăng ký và phê duyệt nghỉ phép online. Tự động trừ phép năm, cập nhật công chuẩn xác không cần nhập liệu thủ công.
                        </p>
                    </div>
                </div>
                <!-- Feature 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class='bx bx-bar-chart-alt-2'></i>
                        </div>
                        <h4 class="mb-3">Báo cáo quản trị</h4>
                        <p class="text-muted mb-0">
                            Hệ thống báo cáo đa chiều về biến động nhân sự, quỹ lương, chi phí... giúp lãnh đạo ra quyết định đúng đắn.
                        </p>
                    </div>
                </div>
                <!-- Feature 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class='bx bx-shield-quarter'></i>
                        </div>
                        <h4 class="mb-3">Bảo mật & Phân quyền</h4>
                        <p class="text-muted mb-0">
                            Phân quyền chi tiết đến từng chức năng, dữ liệu. Mã hóa dữ liệu chuẩn quốc tế, backup định kỳ hàng ngày.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section py-5">
        <div class="container py-5">
            <div class="row text-center g-4">
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <h2 class="counter">500+</h2>
                        <p class="opacity-75 mb-0 fs-5">Doanh nghiệp tin dùng</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <h2 class="counter">10k+</h2>
                        <p class="opacity-75 mb-0 fs-5">Nhân sự được quản lý</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <h2 class="counter">1M+</h2>
                        <p class="opacity-75 mb-0 fs-5">Lượt chấm công/tháng</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <h2 class="counter">99%</h2>
                        <p class="opacity-75 mb-0 fs-5">Khách hàng hài lòng</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section id="process" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <span class="badge bg-label-primary mb-2">QUY TRÌNH</span>
                <h2 class="fw-bold display-6">Bắt đầu thật dễ dàng</h2>
                <p class="text-muted fs-5">Chỉ mất 3 bước để chuyển đổi số quy trình nhân sự của bạn</p>
            </div>

            <div class="row text-center mt-5">
                <div class="col-md-4 process-step mb-4 mb-md-0">
                    <div class="process-line d-none d-md-block"></div>
                    <div class="step-number">1</div>
                    <h4 class="fw-bold">Đăng ký tài khoản</h4>
                    <p class="text-muted px-4">Đăng ký tài khoản doanh nghiệp miễn phí và thiết lập thông tin cơ bản.</p>
                </div>
                <div class="col-md-4 process-step mb-4 mb-md-0">
                    <div class="process-line d-none d-md-block"></div>
                    <div class="step-number">2</div>
                    <h4 class="fw-bold">Nhập liệu nhân sự</h4>
                    <p class="text-muted px-4">Import danh sách nhân viên từ Excel hoặc nhập trực tiếp vào hệ thống.</p>
                </div>
                <div class="col-md-4 process-step">
                    <div class="step-number">3</div>
                    <h4 class="fw-bold">Vận hành tự động</h4>
                    <p class="text-muted px-4">Bắt đầu chấm công, tính lương và quản lý nhân sự hoàn toàn tự động.</p>
                </div>
            </div>
        </div>
    </section>

    

    <!-- Testimonials -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold display-6">Khách hàng nói gì về chúng tôi?</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card h-100">
                        <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/avatars/1.png" alt="User" class="testimonial-img">
                        <div class="mt-4">
                            <div class="mb-3 text-warning">
                                <i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i>
                            </div>
                            <p class="text-muted fst-italic">"HRM Pro đã giúp chúng tôi giảm 80% thời gian tính lương hàng tháng. Giao diện rất dễ sử dụng, nhân viên ai cũng thích."</p>
                            <h6 class="fw-bold mb-0">Nguyễn Văn A</h6>
                            <small class="text-muted">CEO, TechStart</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card h-100">
                        <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/avatars/6.png" alt="User" class="testimonial-img">
                        <div class="mt-4">
                            <div class="mb-3 text-warning">
                                <i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i>
                            </div>
                            <p class="text-muted fst-italic">"Tính năng chấm công GPS rất tuyệt vời cho đội ngũ sales thị trường của chúng tôi. Không còn lo lắng về việc gian lận công."</p>
                            <h6 class="fw-bold mb-0">Trần Thị B</h6>
                            <small class="text-muted">HR Manager, GlobalCorp</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card h-100">
                        <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/avatars/5.png" alt="User" class="testimonial-img">
                        <div class="mt-4">
                            <div class="mb-3 text-warning">
                                <i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star'></i><i class='bx bxs-star-half'></i>
                            </div>
                            <p class="text-muted fst-italic">"Dịch vụ hỗ trợ khách hàng rất nhiệt tình. Mọi thắc mắc đều được giải quyết nhanh chóng. Rất đáng tiền!"</p>
                            <h6 class="fw-bold mb-0">Lê Văn C</h6>
                            <small class="text-muted">Director, CreativeAgency</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

 

    <!-- Footer -->
    <footer class="footer-landing" id="contact">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-4">
                        <i class='bx bxs-cube-alt fs-2 text-primary me-2'></i>
                        <h4 class="text-white mb-0 fw-bold">HRM Pro</h4>
                    </div>
                    <p class="text-secondary mb-4">
                        Nền tảng quản trị nhân sự toàn diện, giúp doanh nghiệp Việt Nam vươn tầm quốc tế thông qua chuyển đổi số hiệu quả. Phát triển bởi Nguyễn Duy Hùng
                    </p>
                    <div class="d-flex">
                        <a href="#" class="social-icon"><i class='bx bxl-facebook'></i></a>
                        <a href="#" class="social-icon"><i class='bx bxl-twitter'></i></a>
                        <a href="#" class="social-icon"><i class='bx bxl-linkedin'></i></a>
                        <a href="#" class="social-icon"><i class='bx bxl-youtube'></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <h5 class="footer-title">Sản phẩm</h5>
                    <a href="#" class="footer-link">Tính năng</a>
                    <a href="#" class="footer-link">Bảng giá</a>
                    <a href="#" class="footer-link">Khách hàng</a>
                    <a href="#" class="footer-link">API Docs</a>
                </div>
                <div class="col-lg-2 col-6">
                    <h5 class="footer-title">Công ty</h5>
                    <a href="#" class="footer-link">Về chúng tôi</a>
                    <a href="#" class="footer-link">Tuyển dụng</a>
                    <a href="#" class="footer-link">Blog</a>
                    <a href="#" class="footer-link">Liên hệ</a>
                </div>
                <div class="col-lg-4">
                    <h5 class="footer-title">Đăng ký nhận tin</h5>
                    <p class="text-secondary mb-3">Nhận thông tin cập nhật và ưu đãi mới nhất.</p>
                    <form class="d-flex gap-2">
                        <input type="email" class="form-control bg-dark border-secondary text-white" placeholder="Email của bạn">
                        <button class="btn btn-primary">Gửi</button>
                    </form>
                    <div class="mt-4">
                        <p class="text-secondary mb-1"><i class='bx bx-phone me-2 text-primary'></i> (028) 1234 5678</p>
                        <p class="text-secondary mb-0"><i class='bx bx-envelope me-2 text-primary'></i> support@hrmpro.com</p>
                    </div>
                </div>
            </div>
            <hr class="border-secondary my-5 opacity-25">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <small class="text-secondary">&copy; {{ date('Y') }} HRM Pro. All rights reserved.</small>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-secondary text-decoration-none me-3 small">Điều khoản</a>
                    <a href="#" class="text-secondary text-decoration-none small">Bảo mật</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    
    <!-- Navbar Scroll Effect -->
    <script>
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar-landing').classList.add('scrolled');
            } else {
                document.querySelector('.navbar-landing').classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>
