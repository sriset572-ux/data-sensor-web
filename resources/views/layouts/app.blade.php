<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <title>@yield('title', 'SensorData')</title>
    <script src="{{ asset('assets/js/color-modes.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('../../../assets/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('../../../assets/vendors/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('../../../assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('../../../assets/css/demo1/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('../../../assets/images/favicon.png') }}" />
    @stack('styles')
</head>
<body>
    <div class="main-wrapper">
        <nav class="sidebar">
            <div class="sidebar-header">
                <a href="#" class="sidebar-brand">
                    Sensor<span>Data</span>
                </a>
                <div class="sidebar-toggler">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="sidebar-body">
                <ul class="nav" id="sidebarNav">
                    <li class="nav-item nav-category">Main</li>
                    <li class="nav-item">
                        <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                            <i class="link-icon feather" data-feather="box"></i>
                            <span class="link-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/sensor" class="nav-link {{ request()->is('sensor') ? 'active' : '' }}">
                            <i class="link-icon feather" data-feather="activity"></i>
                            <span class="link-title">Sensor V4</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/sensor-s3" class="nav-link {{ request()->is('sensor-s3') ? 'active' : '' }}">
                            <i class="link-icon feather" data-feather="activity"></i>
                            <span class="link-title">Sensor S3</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="page-wrapper">
            <nav class="navbar">
                <a href="#" class="sidebar-toggler">
                    <i data-feather="menu"></i>
                </a>
                <div class="navbar-content">
                    <ul class="navbar-nav">
                        <li class="theme-switcher-wrapper nav-item">
                            <input type="checkbox" value="" id="theme-switcher">
                            <label for="theme-switcher">
                                <div class="box">
                                    <div class="ball"></div>
                                    <div class="icons">
                                        <i class="feather icon-sun"></i>
                                        <i class="feather icon-moon"></i>
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="wd-30 ht-30 rounded-circle" src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile">
                            </a>
                            <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                                <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                                    <div class="mb-3">
                                        <img class="wd-80 ht-80 rounded-circle" src="{{ asset('assets/images/faces/face1.jpg') }}" alt="">
                                    </div>
                                    <div class="text-center">
                                        <p class="tx-16 fw-bolder">Amiah Burton</p>
                                        <p class="tx-12 text-muted">amiahburton@gmail.com</p>
                                    </div>
                                </div>
                                <ul class="list-unstyled p-1">
                                    <li class="dropdown-item py-2">
                                        <a href="#" class="text-body ms-0">
                                            <i class="me-2 icon-md" data-feather="user"></i>
                                            <span>Profile</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-item py-2">
                                        <a href="#" class="text-body ms-0">
                                            <i class="me-2 icon-md" data-feather="edit"></i>
                                            <span>Edit Profile</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-item py-2">
                                        <a href="#" class="text-body ms-0">
                                            <i class="me-2 icon-md" data-feather="repeat"></i>
                                            <span>Switch User</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-item py-2">
                                        <a href="#" class="text-body ms-0">
                                            <i class="me-2 icon-md" data-feather="log-out"></i>
                                            <span>Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="page-content">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('../../../assets/vendors/core/core.js') }}"></script>
    <script src="{{ asset('../../../assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('../../../assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('../../../assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('../../../assets/js/app.js') }}"></script>
    <script src="{{ asset('../../../assets/js/dashboard.js') }}"></script>
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            feather.replace();
        });
    </script>
</body>
</html> 