<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <title>Lifespring Drugstore</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/templatemo-chain-app-dev.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">

    <style>
        .logo {
            display: flex;
            align-items: center;
        }

        .logo-img {
            width: 150px;
            height: auto;
            margin-right: 10px;
        }

        .right-image {
            width: 150%;
            max-width: 10000px;
            height: auto;
        }
    </style>
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav d-flex justify-content-between align-items-center">
                        <!-- ***** Logo Start ***** -->
                        <a href="#welcomeblade" class="logo">
                            <img src="assets/images/logo.png" alt="Chain App Dev" class="logo-img">
                        </a>
                        <!-- ***** Logo End ***** -->

                        <!-- ***** Navigation Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="/">Home</a></li>
                            <li><a href="#services">About Us</a></li>
                        </ul>
                        <!-- ***** Navigation Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- Tambahkan id "welcomeblade" pada bagian utama halaman -->
    <div class="main-banner wow fadeIn" id="welcomeblade" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2>Lifespring Drugstore</h2>
                                        <p>Lifespring Drugstore hadir sebagai solusi lengkap untuk kesehatan,
                                            menyediakan layanan ramah dan produk unggulan yang mendukung kesejahteraan Anda</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="white-button first-button scroll-to-section">
                                            <!-- Ubah href ke route login -->
                                            <a href="{{ route('login') }}">Login</a>
                                        </div>
                                        <div class="white-button scroll-to-section">
                                            <!-- Ubah href ke route evaluasi -->
                                            <a href="{{ route('evaluasiapotek') }}">Evaluasi</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                                <img src="assets/images/3.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section "services" tetap untuk About Us -->
    <div id="services" class="services section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
                        <h4>Apotek <em>Aman dan &amp; Terpercaya</em> untuk Anda</h4>
                        <p>Lifespring Drugstore</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="service-item first-service">
                        <div class="icon"></div>
                        <h4>Obat Berkualitas</h4>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="service-item second-service">
                        <div class="icon"></div>
                        <h4>Apoteker Professional</h4>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="service-item third-service">
                        <div class="icon"></div>
                        <h4>Pelayanan Ramah</h4>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="service-item fourth-service">
                        <div class="icon"></div>
                        <h4>Terpercaya</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/animation.js"></script>
    <script src="assets/js/imagesloaded.js"></script>
    <script src="assets/js/popup.js"></script>
    <script src="assets/js/custom.js"></script>

</body>
</html>
