<!DOCTYPE html>
<!--[if IE 8]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->


<!-- Mirrored from themesflat.co/html/proty/blog-details by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Dec 2024 18:14:40 GMT -->
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8" />
    <!--[if IE ]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->
    <title>Proty - Real Estate HTML Template</title>

    <meta name="description"
        content="Propty is a website specializing in buying and renting properties, connecting buyers and tenants with trusted property owners. With an easy-to-use interface and detailed information, Propty offers a fast and convenient property search experience.">

    <meta name="keywords"
        content=" RealEstate, RealEstate, Buy, Rent, Homes, Apartment, Listings, Sale, Rental, Housing">

    <meta name="author" content="themesflat.com" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/sib-styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/styles.css') }}" />

    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="{{ url('icons/icomoon/style.css') }}" />

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ url('icons/favicon.svg') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ url('icons/favicon.svg') }}" />
</head>

<body>
    <!-- wrapper -->
    <div id="wrapper">

        <!-- .preload -->
        <div id="loading">
            <div id="loading-center">
                <div class="loader-container">
                    <div class="wrap-loader">
                        <div class="loader">
                        </div>
                        <div class="icon">
                            <img src="{{ url('images/logo/loading.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.preload -->

        <!-- .header -->
        @include('layout.header')
        <!-- /header -->

        <!-- flat-title -->
        <section class="flat-title ">
            <div class="tf-container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title-inner ">
                            <ul class="breadcrumb">
                                <li><a class="home fw-6 text-color-3" href="index">Home</a></li>
                                <li>Property Listing</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /flat-title -->

        <!-- .main-content -->
        <div class="page-content">
            <!-- page-blog-details -->
            <section class="section-blog-details ">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="heading">
                                <h2 class="title-heading ">Building gains into housing stocks and how to trade the
                                    sector</h2>
                                <div class="meta flex">
                                    <div class="meta-item flex align-center">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14.25 15.75V14.25C14.25 13.4544 13.9339 12.6913 13.3713 12.1287C12.8087 11.5661 12.0456 11.25 11.25 11.25H6.75C5.95435 11.25 5.19129 11.5661 4.62868 12.1287C4.06607 12.6913 3.75 13.4544 3.75 14.25V15.75"
                                                stroke="#A8ABAE" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M9 8.25C10.6569 8.25 12 6.90685 12 5.25C12 3.59315 10.6569 2.25 9 2.25C7.34315 2.25 6 3.59315 6 5.25C6 6.90685 7.34315 8.25 9 8.25Z"
                                                stroke="#A8ABAE" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <p class=" text-color-primary ">Kathryn Murphy</p>
                                    </div>
                                    <div class="meta-item flex align-center">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15 15C15.3978 15 15.7794 14.842 16.0607 14.5607C16.342 14.2794 16.5 13.8978 16.5 13.5V6C16.5 5.60218 16.342 5.22064 16.0607 4.93934C15.7794 4.65804 15.3978 4.5 15 4.5H9.075C8.82414 4.50246 8.57666 4.44196 8.35523 4.32403C8.13379 4.20611 7.94547 4.03453 7.8075 3.825L7.2 2.925C7.06342 2.7176 6.87748 2.54736 6.65887 2.42955C6.44027 2.31174 6.19583 2.25004 5.9475 2.25H3C2.60218 2.25 2.22064 2.40804 1.93934 2.68934C1.65804 2.97064 1.5 3.35218 1.5 3.75V13.5C1.5 13.8978 1.65804 14.2794 1.93934 14.5607C2.22064 14.842 2.60218 15 3 15H15Z"
                                                stroke="#A8ABAE" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <p class=" text-color-primary">Furniture</p>
                                    </div>
                                    <div class="meta-item flex align-center">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M5.925 15C7.35643 15.7343 9.00306 15.9332 10.5682 15.5609C12.1333 15.1885 13.5139 14.2694 14.4613 12.9692C15.4087 11.6689 15.8606 10.0731 15.7354 8.46916C15.6103 6.86524 14.9164 5.35876 13.7789 4.22118C12.6413 3.0836 11.1348 2.38972 9.53088 2.2646C7.92697 2.13947 6.3311 2.59132 5.03086 3.53872C3.73063 4.48612 2.81152 5.86677 2.43917 7.43187C2.06682 8.99697 2.26571 10.6436 3 12.075L1.5 16.5L5.925 15Z"
                                                stroke="#A8ABAE" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <p>0 comment</p>
                                    </div>
                                    <div class="meta-item flex align-center">
                                        <p>26 August, 2024</p>
                                    </div>
                                </div>
                            </div>
                            <p class="fw-5 text-color-heading mb-30">The housing sector has long been a focal point
                                for investors seeking stability and growth. Understanding the dynamics of housing
                                stocks and effectively trading within this sector can lead to substantial gains.</p>
                            <div class="image-wrap mb-30">
                                <img class="lazyload" data-src="{{ url('images/blog/blog-details.jpg') }}"
                                    src="{{ url('images/blog/blog-details.jpg') }}" alt="">
                            </div>
                            <div class="wrap-content mb-20">
                                <h4 class="mb-18">Understanding Housing Stocks</h4>
                                <p class="mb-20">Housing stocks encompass companies involved in various aspects of
                                    the real estate industry, including homebuilders, developers, and related
                                    service providers. Factors influencing these stocks range from interest rates
                                    and economic indicators to trends in homeownership rates.</p>
                                <p>Pay close attention to economic indicators such as employment rates, GDP growth,
                                    and consumer confidence. A strong economy often correlates with increased demand
                                    for housing, benefiting related stocks.</p>
                            </div>
                            <div class="quote">
                                <p>“Lower rates can boost homebuying activity, benefiting housing stocks, while
                                    higher rates may have the opposite effect.”</p>
                                <p class="author">
                                    said Mike Fratantoni, MBA’s chief economist.
                                </p>
                            </div>
                            <div class="group-image">
                                <div class="image-wrap ">
                                    <img class="lazyload" data-src="{{ url('images/blog/blog-details-1.jpg') }}"
                                        src="{{ url('images/blog/blog-details-1.jpg') }}" alt="">
                                </div>
                                <div class="image-wrap">
                                    <img class="lazyload" data-src="{{ url('images/blog/blog-details-2.jpg') }}"
                                        src="{{ url('images/blog/blog-details-2.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="wrap-content mb-30">
                                <h4 class="mb-16 font-manrope">Identify Emerging Trends</h4>
                                <p class="mb-22">Stay informed about emerging trends in the housing market, such as the
                                    demand for sustainable homes, technological advancements, and demographic shifts.
                                    Companies aligning with these trends may present attractive investment
                                    opportunities.</p>
                                <p>Take a long-term investment approach if you believe in the stability and growth
                                    potential of the housing sector. Look for companies with solid fundamentals and a
                                    track record of success. For short-term traders, capitalize on market fluctuations
                                    driven by economic reports, interest rate changes, or industry-specific news. Keep a
                                    close eye on earnings reports and government housing data releases.</p>
                            </div>
                            <div class="tag-wrap flex justify-between items-center">
                                <div class="tags">
                                    <p>Tags:</p>
                                    <div class="tags ">
                                        <a href="#">Personal</a>
                                        <a href="#">Business</a>
                                    </div>
                                </div>
                                <div class="wrap-social">
                                    <p>Share this post:</p>
                                    <ul class="tf-social style-1">
                                        <li>
                                            <a href="#">
                                                <i class="icon-fb"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="icon-X"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="icon-linked"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="icon-ins"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="wrap-comment">
                                <h4 class="title">Comment (4)</h4>
                                <ul class="comment-list">
                                    <li>
                                        <div class="comment-item">
                                            <div class="image-wrap">
                                                <img src="{{ url('images/avatar/avatar-1.jpg') }}" alt="">
                                            </div>
                                            <div class="content">
                                                <div class="user">
                                                    <div class="author ">
                                                        <h6 class="name">Viola Lucas</h6>
                                                        <div class="time">
                                                            August 13, 2023
                                                        </div>
                                                    </div>
                                                    <div class="ratings">
                                                        <i class="icon-start"></i>
                                                        <i class="icon-start"></i>
                                                        <i class="icon-start"></i>
                                                        <i class="icon-start"></i>
                                                        <i class="icon-start"></i>
                                                    </div>
                                                </div>
                                                <div class="comment">
                                                    <p>It's really easy to use and it is exactly what I am looking for.
                                                        A lot of good looking templates & it's highly customizable. Live
                                                        support is helpful, solved my issue in no time.</p>
                                                    <div class="group-image">
                                                        <img src="{{ url('images/blog/comment-1.jpg') }}" alt="">
                                                        <img src="{{ url('images/blog/comment-2.jpg') }}" alt="">
                                                        <img src="{{ url('images/blog/comment-3.jpg') }}" alt="">
                                                    </div>
                                                    <div class="action action-button-list">
                                                        <div class="action-item action-button btn-action">
                                                            <div class="icons">
                                                                <svg width="18" height="18" viewBox="0 0 18 18"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12.375 6.75H10.6875M4.66949 14.0625C4.66124 14.025 4.64849 13.9875 4.63049 13.9515C4.18724 13.0515 3.93749 12.039 3.93749 10.9687C3.93587 9.89238 4.19282 8.83136 4.68674 7.875M4.66949 14.0625C4.72649 14.3362 4.53224 14.625 4.23824 14.625H3.55724C2.89049 14.625 2.27249 14.2365 2.07824 13.599C1.82399 12.7665 1.68749 11.8837 1.68749 10.9687C1.68749 9.804 1.90874 8.69175 2.31074 7.67025C2.54024 7.08975 3.12524 6.75 3.74999 6.75H4.53974C4.89374 6.75 5.09849 7.167 4.91474 7.47C4.83434 7.60234 4.7578 7.73742 4.68674 7.875M4.66949 14.0625H5.63999C6.0027 14.0623 6.36307 14.1205 6.70724 14.235L9.04274 15.015C9.38691 15.1295 9.74728 15.1877 10.11 15.1875H13.122C13.5855 15.1875 14.0347 15.0022 14.3257 14.6407C15.6143 13.0434 16.3156 11.0523 16.3125 9C16.3125 8.6745 16.2952 8.35275 16.2615 8.03625C16.1797 7.2705 15.4905 6.75 14.721 6.75H12.3765C11.913 6.75 11.6332 6.207 11.8327 5.7885C12.191 5.03444 12.3763 4.20985 12.375 3.375C12.375 2.92745 12.1972 2.49823 11.8807 2.18176C11.5643 1.86529 11.135 1.6875 10.6875 1.6875C10.5383 1.6875 10.3952 1.74676 10.2897 1.85225C10.1843 1.95774 10.125 2.10082 10.125 2.25V2.72475C10.125 3.1545 10.0425 3.57975 9.88349 3.97875C9.65549 4.54875 9.18599 4.97625 8.64374 5.265C7.81128 5.7092 7.0807 6.32228 6.49874 7.065C6.12524 7.5405 5.57924 7.875 4.97474 7.875H4.68674"
                                                                        stroke="#A8ABAE" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                            </div>
                                                            <div class="text-2">Useful</div>
                                                        </div>
                                                        <div class="action-item action-button btn-action">
                                                            <div class="icons">
                                                                <svg width="18" height="18" viewBox="0 0 18 18"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M5.62501 11.25H7.31251M13.3305 3.9375C13.3388 3.975 13.3515 4.0125 13.3695 4.0485C13.8128 4.9485 14.0625 5.961 14.0625 7.03125C14.0641 8.10762 13.8072 9.16864 13.3133 10.125M13.3305 3.9375C13.2735 3.66375 13.4678 3.375 13.7618 3.375H14.4428C15.1095 3.375 15.7275 3.7635 15.9218 4.401C16.176 5.2335 16.3125 6.11625 16.3125 7.03125C16.3125 8.196 16.0913 9.30825 15.6893 10.3298C15.4598 10.9103 14.8748 11.25 14.25 11.25H13.4603C13.1063 11.25 12.9015 10.833 13.0853 10.53C13.1657 10.3977 13.2422 10.2626 13.3133 10.125M13.3305 3.9375H12.36C11.9973 3.93772 11.6369 3.87948 11.2928 3.765L8.95726 2.985C8.61309 2.87053 8.25272 2.81228 7.89001 2.8125H4.87801C4.41451 2.8125 3.96526 2.99775 3.67426 3.35925C2.38572 4.95658 1.68441 6.94774 1.68751 9C1.68751 9.3255 1.70476 9.64725 1.73851 9.96375C1.82026 10.7295 2.50951 11.25 3.27901 11.25H5.62351C6.08701 11.25 6.36676 11.793 6.16726 12.2115C5.80897 12.9656 5.6237 13.7902 5.62501 14.625C5.62501 15.0726 5.8028 15.5018 6.11927 15.8182C6.43574 16.1347 6.86496 16.3125 7.31251 16.3125C7.46169 16.3125 7.60477 16.2532 7.71026 16.1477C7.81575 16.0423 7.87501 15.8992 7.87501 15.75V15.2753C7.87501 14.8455 7.95751 14.4203 8.11651 14.0213C8.34451 13.4513 8.81401 13.0238 9.35626 12.735C10.1887 12.2908 10.9193 11.6777 11.5013 10.935C11.8748 10.4595 12.4208 10.125 13.0253 10.125H13.3133"
                                                                        stroke="#A8ABAE" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                            </div>
                                                            <div class="text-2">Not helpful</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="comment-item">
                                            <div class="image-wrap">
                                                <img src="{{ url('images/avatar/avatar-2.jpg') }}" alt="">
                                            </div>
                                            <div class="content">
                                                <div class="user">
                                                    <div class="author ">
                                                        <h6 class="name">Viola Lucas</h6>
                                                        <div class="time">
                                                            August 13, 2023
                                                        </div>
                                                    </div>
                                                    <div class="ratings">
                                                        <i class="icon-start"></i>
                                                        <i class="icon-start"></i>
                                                        <i class="icon-start"></i>
                                                        <i class="icon-start"></i>
                                                        <i class="icon-start"></i>
                                                    </div>
                                                </div>
                                                <div class="comment">
                                                    <p>It's really easy to use and it is exactly what I am looking for.
                                                        A lot of good looking templates & it's highly customizable. Live
                                                        support is helpful, solved my issue in no time.</p>
                                                    <div class="action action-button-list">
                                                        <div class="action-item action-button btn-action">
                                                            <div class="icons">
                                                                <svg width="18" height="18" viewBox="0 0 18 18"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12.375 6.75H10.6875M4.66949 14.0625C4.66124 14.025 4.64849 13.9875 4.63049 13.9515C4.18724 13.0515 3.93749 12.039 3.93749 10.9687C3.93587 9.89238 4.19282 8.83136 4.68674 7.875M4.66949 14.0625C4.72649 14.3362 4.53224 14.625 4.23824 14.625H3.55724C2.89049 14.625 2.27249 14.2365 2.07824 13.599C1.82399 12.7665 1.68749 11.8837 1.68749 10.9687C1.68749 9.804 1.90874 8.69175 2.31074 7.67025C2.54024 7.08975 3.12524 6.75 3.74999 6.75H4.53974C4.89374 6.75 5.09849 7.167 4.91474 7.47C4.83434 7.60234 4.7578 7.73742 4.68674 7.875M4.66949 14.0625H5.63999C6.0027 14.0623 6.36307 14.1205 6.70724 14.235L9.04274 15.015C9.38691 15.1295 9.74728 15.1877 10.11 15.1875H13.122C13.5855 15.1875 14.0347 15.0022 14.3257 14.6407C15.6143 13.0434 16.3156 11.0523 16.3125 9C16.3125 8.6745 16.2952 8.35275 16.2615 8.03625C16.1797 7.2705 15.4905 6.75 14.721 6.75H12.3765C11.913 6.75 11.6332 6.207 11.8327 5.7885C12.191 5.03444 12.3763 4.20985 12.375 3.375C12.375 2.92745 12.1972 2.49823 11.8807 2.18176C11.5643 1.86529 11.135 1.6875 10.6875 1.6875C10.5383 1.6875 10.3952 1.74676 10.2897 1.85225C10.1843 1.95774 10.125 2.10082 10.125 2.25V2.72475C10.125 3.1545 10.0425 3.57975 9.88349 3.97875C9.65549 4.54875 9.18599 4.97625 8.64374 5.265C7.81128 5.7092 7.0807 6.32228 6.49874 7.065C6.12524 7.5405 5.57924 7.875 4.97474 7.875H4.68674"
                                                                        stroke="#A8ABAE" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                            </div>
                                                            <div class="text-2">Useful</div>
                                                        </div>
                                                        <div class="action-item action-button btn-action">
                                                            <div class="icons">
                                                                <svg width="18" height="18" viewBox="0 0 18 18"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M5.62501 11.25H7.31251M13.3305 3.9375C13.3388 3.975 13.3515 4.0125 13.3695 4.0485C13.8128 4.9485 14.0625 5.961 14.0625 7.03125C14.0641 8.10762 13.8072 9.16864 13.3133 10.125M13.3305 3.9375C13.2735 3.66375 13.4678 3.375 13.7618 3.375H14.4428C15.1095 3.375 15.7275 3.7635 15.9218 4.401C16.176 5.2335 16.3125 6.11625 16.3125 7.03125C16.3125 8.196 16.0913 9.30825 15.6893 10.3298C15.4598 10.9103 14.8748 11.25 14.25 11.25H13.4603C13.1063 11.25 12.9015 10.833 13.0853 10.53C13.1657 10.3977 13.2422 10.2626 13.3133 10.125M13.3305 3.9375H12.36C11.9973 3.93772 11.6369 3.87948 11.2928 3.765L8.95726 2.985C8.61309 2.87053 8.25272 2.81228 7.89001 2.8125H4.87801C4.41451 2.8125 3.96526 2.99775 3.67426 3.35925C2.38572 4.95658 1.68441 6.94774 1.68751 9C1.68751 9.3255 1.70476 9.64725 1.73851 9.96375C1.82026 10.7295 2.50951 11.25 3.27901 11.25H5.62351C6.08701 11.25 6.36676 11.793 6.16726 12.2115C5.80897 12.9656 5.6237 13.7902 5.62501 14.625C5.62501 15.0726 5.8028 15.5018 6.11927 15.8182C6.43574 16.1347 6.86496 16.3125 7.31251 16.3125C7.46169 16.3125 7.60477 16.2532 7.71026 16.1477C7.81575 16.0423 7.87501 15.8992 7.87501 15.75V15.2753C7.87501 14.8455 7.95751 14.4203 8.11651 14.0213C8.34451 13.4513 8.81401 13.0238 9.35626 12.735C10.1887 12.2908 10.9193 11.6777 11.5013 10.935C11.8748 10.4595 12.4208 10.125 13.0253 10.125H13.3133"
                                                                        stroke="#A8ABAE" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                            </div>
                                                            <div class="text-2">Not helpful</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="comment-item">
                                            <div class="image-wrap">
                                                <img src="{{ url('images/avatar/avatar-3.jpg') }}" alt="">
                                            </div>
                                            <div class="content">
                                                <div class="user">
                                                    <div class="author ">
                                                        <h6 class="name">Viola Lucas</h6>
                                                        <div class="time">
                                                            August 13, 2023
                                                        </div>
                                                    </div>
                                                    <div class="ratings">
                                                        <i class="icon-start"></i>
                                                        <i class="icon-start"></i>
                                                        <i class="icon-start"></i>
                                                        <i class="icon-start"></i>
                                                        <i class="icon-start"></i>
                                                    </div>
                                                </div>
                                                <div class="comment">
                                                    <p>It's really easy to use and it is exactly what I am looking for.
                                                        A lot of good looking templates & it's highly customizable. Live
                                                        support is helpful, solved my issue in no time.</p>
                                                    <div class="action action-button-list">
                                                        <div class="action-item action-button btn-action">
                                                            <div class="icons">
                                                                <svg width="18" height="18" viewBox="0 0 18 18"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12.375 6.75H10.6875M4.66949 14.0625C4.66124 14.025 4.64849 13.9875 4.63049 13.9515C4.18724 13.0515 3.93749 12.039 3.93749 10.9687C3.93587 9.89238 4.19282 8.83136 4.68674 7.875M4.66949 14.0625C4.72649 14.3362 4.53224 14.625 4.23824 14.625H3.55724C2.89049 14.625 2.27249 14.2365 2.07824 13.599C1.82399 12.7665 1.68749 11.8837 1.68749 10.9687C1.68749 9.804 1.90874 8.69175 2.31074 7.67025C2.54024 7.08975 3.12524 6.75 3.74999 6.75H4.53974C4.89374 6.75 5.09849 7.167 4.91474 7.47C4.83434 7.60234 4.7578 7.73742 4.68674 7.875M4.66949 14.0625H5.63999C6.0027 14.0623 6.36307 14.1205 6.70724 14.235L9.04274 15.015C9.38691 15.1295 9.74728 15.1877 10.11 15.1875H13.122C13.5855 15.1875 14.0347 15.0022 14.3257 14.6407C15.6143 13.0434 16.3156 11.0523 16.3125 9C16.3125 8.6745 16.2952 8.35275 16.2615 8.03625C16.1797 7.2705 15.4905 6.75 14.721 6.75H12.3765C11.913 6.75 11.6332 6.207 11.8327 5.7885C12.191 5.03444 12.3763 4.20985 12.375 3.375C12.375 2.92745 12.1972 2.49823 11.8807 2.18176C11.5643 1.86529 11.135 1.6875 10.6875 1.6875C10.5383 1.6875 10.3952 1.74676 10.2897 1.85225C10.1843 1.95774 10.125 2.10082 10.125 2.25V2.72475C10.125 3.1545 10.0425 3.57975 9.88349 3.97875C9.65549 4.54875 9.18599 4.97625 8.64374 5.265C7.81128 5.7092 7.0807 6.32228 6.49874 7.065C6.12524 7.5405 5.57924 7.875 4.97474 7.875H4.68674"
                                                                        stroke="#A8ABAE" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                            </div>
                                                            <div class="text-2">Useful</div>
                                                        </div>
                                                        <div class="action-item action-button btn-action">
                                                            <div class="icons">
                                                                <svg width="18" height="18" viewBox="0 0 18 18"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M5.62501 11.25H7.31251M13.3305 3.9375C13.3388 3.975 13.3515 4.0125 13.3695 4.0485C13.8128 4.9485 14.0625 5.961 14.0625 7.03125C14.0641 8.10762 13.8072 9.16864 13.3133 10.125M13.3305 3.9375C13.2735 3.66375 13.4678 3.375 13.7618 3.375H14.4428C15.1095 3.375 15.7275 3.7635 15.9218 4.401C16.176 5.2335 16.3125 6.11625 16.3125 7.03125C16.3125 8.196 16.0913 9.30825 15.6893 10.3298C15.4598 10.9103 14.8748 11.25 14.25 11.25H13.4603C13.1063 11.25 12.9015 10.833 13.0853 10.53C13.1657 10.3977 13.2422 10.2626 13.3133 10.125M13.3305 3.9375H12.36C11.9973 3.93772 11.6369 3.87948 11.2928 3.765L8.95726 2.985C8.61309 2.87053 8.25272 2.81228 7.89001 2.8125H4.87801C4.41451 2.8125 3.96526 2.99775 3.67426 3.35925C2.38572 4.95658 1.68441 6.94774 1.68751 9C1.68751 9.3255 1.70476 9.64725 1.73851 9.96375C1.82026 10.7295 2.50951 11.25 3.27901 11.25H5.62351C6.08701 11.25 6.36676 11.793 6.16726 12.2115C5.80897 12.9656 5.6237 13.7902 5.62501 14.625C5.62501 15.0726 5.8028 15.5018 6.11927 15.8182C6.43574 16.1347 6.86496 16.3125 7.31251 16.3125C7.46169 16.3125 7.60477 16.2532 7.71026 16.1477C7.81575 16.0423 7.87501 15.8992 7.87501 15.75V15.2753C7.87501 14.8455 7.95751 14.4203 8.11651 14.0213C8.34451 13.4513 8.81401 13.0238 9.35626 12.735C10.1887 12.2908 10.9193 11.6777 11.5013 10.935C11.8748 10.4595 12.4208 10.125 13.0253 10.125H13.3133"
                                                                        stroke="#A8ABAE" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                            </div>
                                                            <div class="text-2">Not helpful</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <a href="#" class="tf-btn style-border fw-7 pd-1">
                                    <span>View all comment </span>
                                </a>
                            </div>
                            <div class="box-send ">
                                <div class="heading-box">
                                    <h4 class="title fw-7">Leave A Comment</h4>
                                    <p>Your email address will not be published. Required fields are marked *</p>
                                </div>
                                <form class="form-add-review">
                                    <div class="cols">
                                        <fieldset class="name">
                                            <label class="text-1 fw-6 " for="name">Name</label>
                                            <input type="text" class="tf-input style-2" placeholder="Your Name*"
                                                tabindex="2" aria-required="true" id="name" name="name" required>
                                        </fieldset>
                                        <fieldset class="email">
                                            <label class="text-1 fw-6" for="email">Email</label>
                                            <input type="email" class="tf-input style-2" placeholder="Your Email*"
                                                tabindex="2" aria-required="true" id="email" name="email" required>
                                        </fieldset>
                                    </div>
                                    <div class="checkbox-item style-1">
                                        <label>
                                            <span class="text-1">Save your name, email for the next time review</span>
                                            <input type="checkbox">
                                            <span class="btn-checkbox"></span>
                                        </label>
                                    </div>
                                    <fieldset class="message">
                                        <label class="text-1 fw-6" for="message-comment">Comment</label>
                                        <textarea id="message-comment" class="tf-input" name="message" rows="4"
                                            placeholder="Your comment" tabindex="4" aria-required="true"
                                            required></textarea>
                                    </fieldset>
                                    <button class="tf-btn bg-color-primary pd-2 fw-7" type="submit">
                                        Post Comment
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class=" tf-sidebar">
                                <div class="sidebar-search sidebar-item">
                                    <h4 class="sidebar-title">Search Blog</h4>
                                    <form action="#" class="form-search">
                                        <fieldset>
                                            <input class="" type="text" placeholder="Search" name="text" tabindex="2"
                                                value="" aria-required="true" required="">
                                        </fieldset>
                                        <div class="button-submit">
                                            <button class="" type="submit"><i class="icon-MagnifyingGlass"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="sidebar-item sidebar-categories ">
                                    <h4 class="sidebar-title">Categories</h4>
                                    <ul class="list-categories">
                                        <li class="flex items-center justify-between">
                                            <a href="#" class="text-1 lh-20 fw-5">Market Updates</a>
                                            <div class="number">(50)</div>
                                        </li>
                                        <li class="flex items-center justify-between">
                                            <a href="#" class="text-1 lh-20 fw-5">Buying Tips</a>
                                            <div class="number">(69)</div>
                                        </li>
                                        <li class="flex items-center justify-between">
                                            <a href="#" class="text-1 lh-20 fw-5">Interior Inspiration</a>
                                            <div class="number">(69)</div>
                                        </li>
                                        <li class="flex items-center justify-between">
                                            <a href="#" class="text-1 lh-20 fw-5">Investment Insights</a>
                                            <div class="number">(25)</div>
                                        </li>
                                        <li class="flex items-center justify-between">
                                            <a href="#" class="text-1 lh-20 fw-5">Home Construction</a>
                                            <div class="number">(12)</div>
                                        </li>
                                        <li class="flex items-center justify-between">
                                            <a href="#" class="text-1 lh-20 fw-5">Legal Guidance</a>
                                            <div class="number">(12)</div>
                                        </li>
                                        <li class="flex items-center justify-between">
                                            <a href="#" class="text-1 lh-20 fw-5">Community Spotlight</a>
                                            <div class="number">(69)</div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="sidebar-item sidebar-featured  pb-36">
                                    <h4 class="sidebar-title">Featured Listings</h4>
                                    <ul>
                                        <li class="box-listings hover-img">
                                            <div class="image-wrap">
                                                <img class="lazyload" data-src="{{ url('images/blog/box-listings-1.jpg') }}"
                                                    src="{{ url('images/blog/box-listings-1.jpg') }}" alt="">
                                            </div>
                                            <div class="content">
                                                <div class="text-1 title fw-5">
                                                    <a href="blog-single">Key Real Estate Trends to Watch in
                                                        2024</a>
                                                </div>
                                                <p><span class="icon"><svg width="16" height="17" viewBox="0 0 16 17"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M4.5 2.5V4M11.5 2.5V4M2 13V5.5C2 5.10218 2.15804 4.72064 2.43934 4.43934C2.72064 4.15804 3.10218 4 3.5 4H12.5C12.8978 4 13.2794 4.15804 13.5607 4.43934C13.842 4.72064 14 5.10218 14 5.5V13M2 13C2 13.3978 2.15804 13.7794 2.43934 14.0607C2.72064 14.342 3.10218 14.5 3.5 14.5H12.5C12.8978 14.5 13.2794 14.342 13.5607 14.0607C13.842 13.7794 14 13.3978 14 13M2 13V8C2 7.60218 2.15804 7.22064 2.43934 6.93934C2.72064 6.65804 3.10218 6.5 3.5 6.5H12.5C12.8978 6.5 13.2794 6.65804 13.5607 6.93934C13.842 7.22064 14 7.60218 14 8V13"
                                                                stroke="#A8ABAE" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </span>February 16, 2024</p>
                                            </div>
                                        </li>
                                        <li class="box-listings hover-img">
                                            <div class=" image-wrap">
                                                <img class="lazyload" data-src="{{ url('images/blog/box-listings-2.jpg') }}"
                                                    src="{{ url('images/blog/box-listings-2.jpg') }}" alt="">
                                            </div>
                                            <div class="content">
                                                <div class="text-1 title fw-5">
                                                    <a href="blog-single">Expert Tips for Profitable Real Estate
                                                        Investments.</a>
                                                </div>
                                                <p><span class="icon"><svg width="16" height="17" viewBox="0 0 16 17"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M4.5 2.5V4M11.5 2.5V4M2 13V5.5C2 5.10218 2.15804 4.72064 2.43934 4.43934C2.72064 4.15804 3.10218 4 3.5 4H12.5C12.8978 4 13.2794 4.15804 13.5607 4.43934C13.842 4.72064 14 5.10218 14 5.5V13M2 13C2 13.3978 2.15804 13.7794 2.43934 14.0607C2.72064 14.342 3.10218 14.5 3.5 14.5H12.5C12.8978 14.5 13.2794 14.342 13.5607 14.0607C13.842 13.7794 14 13.3978 14 13M2 13V8C2 7.60218 2.15804 7.22064 2.43934 6.93934C2.72064 6.65804 3.10218 6.5 3.5 6.5H12.5C12.8978 6.5 13.2794 6.65804 13.5607 6.93934C13.842 7.22064 14 7.60218 14 8V13"
                                                                stroke="#A8ABAE" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </span>February 16, 2024</p>

                                            </div>
                                        </li>
                                        <li class="box-listings hover-img">
                                            <div class=" image-wrap">
                                                <img class="lazyload" data-src="{{ url('images/blog/box-listings-3.jpg') }}"
                                                    src="{{ url('images/blog/box-listings-3.jpg') }}" alt="">
                                            </div>
                                            <div class="content">
                                                <div class="text-1 title fw-5">
                                                    <a href="blog-single">10 Steps to Prepare for a Successful Real
                                                        Estate...</a>
                                                </div>
                                                <p><span class="icon"><svg width="16" height="17" viewBox="0 0 16 17"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M4.5 2.5V4M11.5 2.5V4M2 13V5.5C2 5.10218 2.15804 4.72064 2.43934 4.43934C2.72064 4.15804 3.10218 4 3.5 4H12.5C12.8978 4 13.2794 4.15804 13.5607 4.43934C13.842 4.72064 14 5.10218 14 5.5V13M2 13C2 13.3978 2.15804 13.7794 2.43934 14.0607C2.72064 14.342 3.10218 14.5 3.5 14.5H12.5C12.8978 14.5 13.2794 14.342 13.5607 14.0607C13.842 13.7794 14 13.3978 14 13M2 13V8C2 7.60218 2.15804 7.22064 2.43934 6.93934C2.72064 6.65804 3.10218 6.5 3.5 6.5H12.5C12.8978 6.5 13.2794 6.65804 13.5607 6.93934C13.842 7.22064 14 7.60218 14 8V13"
                                                                stroke="#A8ABAE" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </span>February 16, 2024</p>

                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="sidebar-newslatter sidebar-item">
                                    <h4 class="sidebar-title">Join Our Newsletter</h4>
                                    <p>Signup to be the first to hear about exclusive deals, special offers and upcoming
                                        collections</p>
                                    <form action="#" class="form-search">
                                        <fieldset>
                                            <input class="" type="text" placeholder="Search" name="text" tabindex="2"
                                                value="" aria-required="true" required="">
                                        </fieldset>
                                        <div class="button-submit">
                                            <button class="" type="submit"><i class="icon-send-message"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="sidebar-item sidebar-tags ">
                                    <h4 class="sidebar-title">Popular Tags</h4>
                                    <ul class="tags-list">
                                        <li><a href="#" class="tags-item">Property</a></li>
                                        <li><a href="#" class="tags-item">Office</a></li>
                                        <li><a href="#" class="tags-item">Finance</a></li>
                                        <li><a href="#" class="tags-item">Legal</a></li>
                                        <li><a href="#" class="tags-item">Market</a></li>
                                        <li><a href="#" class="tags-item">Invest</a></li>
                                        <li><a href="#" class="tags-item">Renovate</a></li>
                                    </ul>
                                </div>
                                <div class=" sidebar-ads">
                                    <div class="image-wrap">
                                        <img class="lazyload" data-src="{{ url('images/blog/ads.jpg') }}" src="{{ url('images/blog/ads.jpg') }}"
                                            alt="">
                                    </div>
                                    <div class="logo relative z-5">
                                        <img src="{{ url('images/logo/logo-2%402x.png') }}" alt="">
                                    </div>
                                    <div class="box-ads relative z-5">
                                        <div class="content ">
                                            <h4 class="title"><a href="property-detail-v1">We can help you find a
                                                    local real estate agent</a> </h4>
                                            <div class="text-addres ">
                                                <p>Connect with a trusted agent who knows the market inside out -
                                                    whether you’re buying or selling.</p>
                                            </div>
                                        </div>
                                        <a href="#" class="tf-btn fw-6 bg-color-primary w-full">
                                            Connect with an agent
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /page-blog-details -->


            <section class="section-related-posts">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="heading">Related posts</h4>
                            <div class="swiper style-pagination tf-sw-latest" data-preview="3" data-tablet="2"
                                data-mobile-sm="2" data-mobile="1" data-space-lg="40" data-space-md="20"
                                data-space="15">
                                <div class="swiper-wrapper ">
                                    <div class="swiper-slide">
                                        <div class="blog-article-item style-2 hover-img wow animate__fadeInUp animate__animated"
                                            data-wow-duration="2s" data-wow-delay="0s">
                                            <div class=" image-wrap ">
                                                <a href="blog-details">
                                                    <img class="lazyload" data-src="{{ url('images/blog/blog-grid-1.jpg') }}"
                                                        src="{{ url('images/blog/blog-grid-1.jpg') }}" alt="">
                                                </a>
                                                <div class="box-tag">
                                                    <div class="tag-item text-4 text-white fw-6">Real estate</div>
                                                </div>
                                            </div>
                                            <div class="article-content">
                                                <div class="time">
                                                    <div class="icons">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_2450_13848)">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M6.03497 3.8631C6.08651 3.83315 6.12412 3.78402 6.13959 3.72645C6.15505 3.66887 6.14712 3.60751 6.11752 3.55576L5.70832 2.8471C5.67837 2.79555 5.62923 2.75795 5.57164 2.74253C5.51405 2.72711 5.45269 2.73512 5.40098 2.7648C5.34943 2.79475 5.31183 2.8439 5.29641 2.90149C5.28099 2.95908 5.289 3.02044 5.31869 3.07214L5.72788 3.78081C5.75788 3.83224 5.80698 3.86974 5.86449 3.88516C5.922 3.90057 5.98327 3.89264 6.03497 3.8631ZM12.6009 15.2355C12.6524 15.2055 12.69 15.1564 12.7055 15.0988C12.721 15.0412 12.713 14.9799 12.6834 14.9281L12.2742 14.2195C12.2443 14.1679 12.1951 14.1303 12.1376 14.1149C12.08 14.0995 12.0186 14.1075 11.9669 14.1372C11.9154 14.1672 11.8778 14.2163 11.8624 14.2739C11.847 14.3315 11.855 14.3928 11.8846 14.4445L12.2938 15.1532C12.3237 15.2047 12.3728 15.2422 12.4304 15.2576C12.4879 15.273 12.5492 15.2651 12.6009 15.2355ZM3.86377 6.0343C3.89339 5.98258 3.90136 5.92125 3.88595 5.86367C3.87053 5.8061 3.83298 5.75696 3.78148 5.72696L3.07282 5.31776C3.0211 5.28814 2.95976 5.28017 2.90219 5.29559C2.84462 5.311 2.79547 5.34856 2.76548 5.40006C2.73585 5.45178 2.72788 5.51311 2.7433 5.57069C2.75872 5.62826 2.79627 5.6774 2.84777 5.7074L3.55643 6.11659C3.60817 6.14615 3.66948 6.15408 3.72703 6.13867C3.78459 6.12326 3.83373 6.08575 3.86377 6.0343ZM15.2364 12.6C15.266 12.5482 15.274 12.4869 15.2586 12.4293C15.2432 12.3718 15.2056 12.3226 15.1541 12.2926L14.4454 11.8834C14.3937 11.8538 14.3324 11.8458 14.2748 11.8612C14.2172 11.8767 14.1681 11.9142 14.1381 11.9657C14.1084 12.0174 14.1004 12.0788 14.1158 12.1364C14.1312 12.194 14.1688 12.2431 14.2204 12.2731L14.9291 12.6823C14.9808 12.7119 15.0421 12.72 15.0997 12.7045C15.1573 12.6891 15.2064 12.6515 15.2364 12.6ZM3.06926 9.00001C3.06906 8.94038 3.04528 8.88326 3.00312 8.8411C2.96096 8.79894 2.90384 8.77517 2.84422 8.77496H2.02583C1.9662 8.77517 1.90908 8.79894 1.86692 8.8411C1.82476 8.88326 1.80098 8.94038 1.80078 9.00001C1.80078 9.12371 1.90213 9.22505 2.02583 9.22505H2.84422C2.90384 9.22485 2.96096 9.20108 3.00312 9.15892C3.04528 9.11676 3.06906 9.05963 3.06926 9.00001ZM16.2011 9.00001C16.2009 8.94043 16.1771 8.88334 16.135 8.84119C16.0929 8.79904 16.0359 8.77523 15.9763 8.77496H15.1579C15.0983 8.77517 15.0412 8.79894 14.999 8.8411C14.9568 8.88326 14.9331 8.94038 14.9329 9.00001C14.9329 9.12396 15.0342 9.22505 15.1579 9.22505H15.9763C16.0359 9.22479 16.0929 9.20098 16.135 9.15883C16.1771 9.11667 16.2009 9.05959 16.2011 9.00001ZM3.86403 11.966C3.83407 11.9144 3.78495 11.8768 3.72737 11.8614C3.66979 11.8459 3.60844 11.8538 3.55669 11.8834L2.84803 12.2926C2.79647 12.3226 2.75888 12.3717 2.74345 12.4293C2.72803 12.4869 2.73604 12.5483 2.76573 12.6C2.79568 12.6515 2.84482 12.6891 2.90242 12.7045C2.96001 12.72 3.02137 12.7119 3.07307 12.6823L3.78173 12.2731C3.83322 12.2431 3.87076 12.194 3.88618 12.1365C3.9016 12.0789 3.89364 12.0177 3.86403 11.966ZM15.2364 5.40006C15.2064 5.34851 15.1573 5.31091 15.0997 5.29544C15.0422 5.27998 14.9808 5.28791 14.9291 5.31751L14.2204 5.7267C14.1688 5.75665 14.1312 5.8058 14.1158 5.86339C14.1004 5.92098 14.1084 5.98234 14.1381 6.03404C14.168 6.0856 14.2172 6.12319 14.2748 6.13862C14.3324 6.15404 14.3937 6.14603 14.4454 6.11634L15.1541 5.70715C15.2056 5.6772 15.2431 5.6281 15.2585 5.57057C15.274 5.51304 15.266 5.45174 15.2364 5.40006ZM6.03522 14.1372C5.9835 14.1075 5.92217 14.0996 5.8646 14.115C5.80702 14.1304 5.75788 14.168 5.72788 14.2195L5.31869 14.9281C5.28907 14.9798 5.2811 15.0412 5.29651 15.0988C5.31193 15.1563 5.34948 15.2055 5.40098 15.2355C5.4527 15.2651 5.51404 15.2731 5.57161 15.2576C5.62918 15.2422 5.67833 15.2047 5.70832 15.1532L6.11752 14.4445C6.14707 14.3928 6.15501 14.3315 6.1396 14.2739C6.12418 14.2164 6.08667 14.1672 6.03522 14.1372ZM12.6009 2.76455C12.5492 2.73493 12.4878 2.72696 12.4303 2.74237C12.3727 2.75779 12.3235 2.79534 12.2935 2.84685L11.8843 3.55551C11.8547 3.60723 11.8468 3.66856 11.8622 3.72613C11.8776 3.78371 11.9151 3.83285 11.9666 3.86285C12.0183 3.89254 12.0797 3.90055 12.1373 3.88512C12.1949 3.8697 12.244 3.8321 12.274 3.78055L12.6832 3.07189C12.7129 3.02019 12.7209 2.95883 12.7055 2.90124C12.69 2.84364 12.6524 2.7945 12.6009 2.76455ZM9.00093 14.9317C8.94131 14.9319 8.88419 14.9557 8.84203 14.9978C8.79986 15.04 8.77609 15.0971 8.77589 15.1567V15.9751C8.77589 16.0988 8.87723 16.2002 9.00093 16.2002C9.06056 16.2 9.11768 16.1762 9.15984 16.134C9.202 16.0919 9.22578 16.0347 9.22598 15.9751V15.1567C9.22578 15.0971 9.202 15.04 9.15984 14.9978C9.11768 14.9557 9.06056 14.9319 9.00093 14.9317ZM9.00093 1.80011C8.94131 1.80031 8.88419 1.82409 8.84203 1.86625C8.79986 1.90841 8.77609 1.96553 8.77589 2.02515V2.84354C8.77589 2.96724 8.87723 3.06859 9.00093 3.06859C9.06056 3.06839 9.11768 3.04461 9.15984 3.00245C9.202 2.96029 9.22578 2.90317 9.22598 2.84354V2.0249C9.22578 1.9653 9.20199 1.9082 9.15983 1.86608C9.11766 1.82396 9.06053 1.80024 9.00093 1.80011ZM9.00093 3.4567C8.94137 3.45697 8.88433 3.48073 8.84219 3.52282C8.80005 3.56491 8.77622 3.62193 8.77589 3.68149V9.00001C8.77616 9.05961 8.79995 9.1167 8.8421 9.15884C8.88424 9.20099 8.94133 9.22479 9.00093 9.22505C9.06058 9.22492 9.11774 9.20117 9.15992 9.15899C9.20209 9.11682 9.22584 9.05965 9.22598 9.00001V3.68149C9.22571 3.62191 9.20191 3.56485 9.15975 3.52275C9.1176 3.48064 9.06051 3.4569 9.00093 3.4567Z"
                                                                    fill="#5C5E61" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M9.0019 8.54993C9.06189 8.54851 9.12156 8.55909 9.17739 8.58106C9.23323 8.60304 9.28412 8.63595 9.32705 8.67787C9.36998 8.7198 9.40409 8.76988 9.42739 8.82519C9.45068 8.88049 9.46268 8.93989 9.46268 8.99989C9.46268 9.0599 9.45068 9.1193 9.42739 9.1746C9.40409 9.2299 9.36998 9.27999 9.32705 9.32191C9.28412 9.36384 9.23323 9.39675 9.17739 9.41872C9.12156 9.4407 9.06189 9.45128 9.0019 9.44986C8.88441 9.44706 8.77268 9.39843 8.69057 9.31435C8.60846 9.23027 8.5625 9.11741 8.5625 8.99989C8.5625 8.88237 8.60846 8.76952 8.69057 8.68544C8.77268 8.60136 8.88441 8.55272 9.0019 8.54993Z"
                                                                    fill="#5C5E61" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M12.7417 9.00001C12.7414 8.94045 12.7177 8.8834 12.6756 8.84126C12.6335 8.79912 12.5765 8.7753 12.5169 8.77496H8.99848C8.93888 8.77523 8.88179 8.79903 8.83965 8.84117C8.7975 8.88332 8.7737 8.9404 8.77344 9.00001C8.77344 9.12396 8.87478 9.22505 8.99848 9.22505H12.5169C12.5765 9.22485 12.6336 9.20107 12.6757 9.1589C12.7178 9.11673 12.7416 9.05961 12.7417 9.00001Z"
                                                                    fill="#5C5E61" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M9 0C13.9705 0 18 4.02946 18 9C18 13.9705 13.9705 18 9 18C4.02946 18 0 13.9705 0 9C0 4.02946 4.02946 0 9 0ZM9 0.899924C13.4735 0.899924 17.1001 4.52654 17.1001 9C17.1001 13.4735 13.4735 17.1001 9 17.1001C4.52654 17.1001 0.899924 13.4735 0.899924 9C0.899924 4.52654 4.52654 0.899924 9 0.899924Z"
                                                                    fill="#5C5E61" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_2450_13848">
                                                                    <rect width="18" height="18" fill="white" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <p class="fw-5">26 August, 2024</p>
                                                </div>
                                                <h4 class="title  ">
                                                    <a href="blog-details" class="line-clamp-2">Building gains into
                                                        housing
                                                        stocks and how to
                                                        trade the...</a>
                                                </h4>
                                                <a href="blog-details" class="tf-btn-link">
                                                    <span>
                                                        Read More
                                                    </span> <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_2450_13860)">
                                                            <path
                                                                d="M10.0013 18.3334C14.6037 18.3334 18.3346 14.6024 18.3346 10C18.3346 5.39765 14.6037 1.66669 10.0013 1.66669C5.39893 1.66669 1.66797 5.39765 1.66797 10C1.66797 14.6024 5.39893 18.3334 10.0013 18.3334Z"
                                                                stroke="#F1913D" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M6.66797 10H13.3346" stroke="#F1913D"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M10 13.3334L13.3333 10L10 6.66669" stroke="#F1913D"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_2450_13860">
                                                                <rect width="20" height="20" fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="blog-article-item style-2 hover-img wow animate__fadeInUp animate__animated"
                                            data-wow-duration="2s" data-wow-delay="0.1s">
                                            <div class=" image-wrap ">
                                                <a href="blog-details">
                                                    <img class="lazyload" data-src="{{ url('images/blog/blog-grid-2.jpg') }}"
                                                        src="{{ url('images/blog/blog-grid-2.jpg') }}" alt="">
                                                </a>
                                                <div class="box-tag">
                                                    <div class="tag-item text-4 text-white fw-6">News</div>
                                                </div>
                                            </div>
                                            <div class="article-content">
                                                <div class="time">
                                                    <div class="icons">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_2450_13848)">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M6.03497 3.8631C6.08651 3.83315 6.12412 3.78402 6.13959 3.72645C6.15505 3.66887 6.14712 3.60751 6.11752 3.55576L5.70832 2.8471C5.67837 2.79555 5.62923 2.75795 5.57164 2.74253C5.51405 2.72711 5.45269 2.73512 5.40098 2.7648C5.34943 2.79475 5.31183 2.8439 5.29641 2.90149C5.28099 2.95908 5.289 3.02044 5.31869 3.07214L5.72788 3.78081C5.75788 3.83224 5.80698 3.86974 5.86449 3.88516C5.922 3.90057 5.98327 3.89264 6.03497 3.8631ZM12.6009 15.2355C12.6524 15.2055 12.69 15.1564 12.7055 15.0988C12.721 15.0412 12.713 14.9799 12.6834 14.9281L12.2742 14.2195C12.2443 14.1679 12.1951 14.1303 12.1376 14.1149C12.08 14.0995 12.0186 14.1075 11.9669 14.1372C11.9154 14.1672 11.8778 14.2163 11.8624 14.2739C11.847 14.3315 11.855 14.3928 11.8846 14.4445L12.2938 15.1532C12.3237 15.2047 12.3728 15.2422 12.4304 15.2576C12.4879 15.273 12.5492 15.2651 12.6009 15.2355ZM3.86377 6.0343C3.89339 5.98258 3.90136 5.92125 3.88595 5.86367C3.87053 5.8061 3.83298 5.75696 3.78148 5.72696L3.07282 5.31776C3.0211 5.28814 2.95976 5.28017 2.90219 5.29559C2.84462 5.311 2.79547 5.34856 2.76548 5.40006C2.73585 5.45178 2.72788 5.51311 2.7433 5.57069C2.75872 5.62826 2.79627 5.6774 2.84777 5.7074L3.55643 6.11659C3.60817 6.14615 3.66948 6.15408 3.72703 6.13867C3.78459 6.12326 3.83373 6.08575 3.86377 6.0343ZM15.2364 12.6C15.266 12.5482 15.274 12.4869 15.2586 12.4293C15.2432 12.3718 15.2056 12.3226 15.1541 12.2926L14.4454 11.8834C14.3937 11.8538 14.3324 11.8458 14.2748 11.8612C14.2172 11.8767 14.1681 11.9142 14.1381 11.9657C14.1084 12.0174 14.1004 12.0788 14.1158 12.1364C14.1312 12.194 14.1688 12.2431 14.2204 12.2731L14.9291 12.6823C14.9808 12.7119 15.0421 12.72 15.0997 12.7045C15.1573 12.6891 15.2064 12.6515 15.2364 12.6ZM3.06926 9.00001C3.06906 8.94038 3.04528 8.88326 3.00312 8.8411C2.96096 8.79894 2.90384 8.77517 2.84422 8.77496H2.02583C1.9662 8.77517 1.90908 8.79894 1.86692 8.8411C1.82476 8.88326 1.80098 8.94038 1.80078 9.00001C1.80078 9.12371 1.90213 9.22505 2.02583 9.22505H2.84422C2.90384 9.22485 2.96096 9.20108 3.00312 9.15892C3.04528 9.11676 3.06906 9.05963 3.06926 9.00001ZM16.2011 9.00001C16.2009 8.94043 16.1771 8.88334 16.135 8.84119C16.0929 8.79904 16.0359 8.77523 15.9763 8.77496H15.1579C15.0983 8.77517 15.0412 8.79894 14.999 8.8411C14.9568 8.88326 14.9331 8.94038 14.9329 9.00001C14.9329 9.12396 15.0342 9.22505 15.1579 9.22505H15.9763C16.0359 9.22479 16.0929 9.20098 16.135 9.15883C16.1771 9.11667 16.2009 9.05959 16.2011 9.00001ZM3.86403 11.966C3.83407 11.9144 3.78495 11.8768 3.72737 11.8614C3.66979 11.8459 3.60844 11.8538 3.55669 11.8834L2.84803 12.2926C2.79647 12.3226 2.75888 12.3717 2.74345 12.4293C2.72803 12.4869 2.73604 12.5483 2.76573 12.6C2.79568 12.6515 2.84482 12.6891 2.90242 12.7045C2.96001 12.72 3.02137 12.7119 3.07307 12.6823L3.78173 12.2731C3.83322 12.2431 3.87076 12.194 3.88618 12.1365C3.9016 12.0789 3.89364 12.0177 3.86403 11.966ZM15.2364 5.40006C15.2064 5.34851 15.1573 5.31091 15.0997 5.29544C15.0422 5.27998 14.9808 5.28791 14.9291 5.31751L14.2204 5.7267C14.1688 5.75665 14.1312 5.8058 14.1158 5.86339C14.1004 5.92098 14.1084 5.98234 14.1381 6.03404C14.168 6.0856 14.2172 6.12319 14.2748 6.13862C14.3324 6.15404 14.3937 6.14603 14.4454 6.11634L15.1541 5.70715C15.2056 5.6772 15.2431 5.6281 15.2585 5.57057C15.274 5.51304 15.266 5.45174 15.2364 5.40006ZM6.03522 14.1372C5.9835 14.1075 5.92217 14.0996 5.8646 14.115C5.80702 14.1304 5.75788 14.168 5.72788 14.2195L5.31869 14.9281C5.28907 14.9798 5.2811 15.0412 5.29651 15.0988C5.31193 15.1563 5.34948 15.2055 5.40098 15.2355C5.4527 15.2651 5.51404 15.2731 5.57161 15.2576C5.62918 15.2422 5.67833 15.2047 5.70832 15.1532L6.11752 14.4445C6.14707 14.3928 6.15501 14.3315 6.1396 14.2739C6.12418 14.2164 6.08667 14.1672 6.03522 14.1372ZM12.6009 2.76455C12.5492 2.73493 12.4878 2.72696 12.4303 2.74237C12.3727 2.75779 12.3235 2.79534 12.2935 2.84685L11.8843 3.55551C11.8547 3.60723 11.8468 3.66856 11.8622 3.72613C11.8776 3.78371 11.9151 3.83285 11.9666 3.86285C12.0183 3.89254 12.0797 3.90055 12.1373 3.88512C12.1949 3.8697 12.244 3.8321 12.274 3.78055L12.6832 3.07189C12.7129 3.02019 12.7209 2.95883 12.7055 2.90124C12.69 2.84364 12.6524 2.7945 12.6009 2.76455ZM9.00093 14.9317C8.94131 14.9319 8.88419 14.9557 8.84203 14.9978C8.79986 15.04 8.77609 15.0971 8.77589 15.1567V15.9751C8.77589 16.0988 8.87723 16.2002 9.00093 16.2002C9.06056 16.2 9.11768 16.1762 9.15984 16.134C9.202 16.0919 9.22578 16.0347 9.22598 15.9751V15.1567C9.22578 15.0971 9.202 15.04 9.15984 14.9978C9.11768 14.9557 9.06056 14.9319 9.00093 14.9317ZM9.00093 1.80011C8.94131 1.80031 8.88419 1.82409 8.84203 1.86625C8.79986 1.90841 8.77609 1.96553 8.77589 2.02515V2.84354C8.77589 2.96724 8.87723 3.06859 9.00093 3.06859C9.06056 3.06839 9.11768 3.04461 9.15984 3.00245C9.202 2.96029 9.22578 2.90317 9.22598 2.84354V2.0249C9.22578 1.9653 9.20199 1.9082 9.15983 1.86608C9.11766 1.82396 9.06053 1.80024 9.00093 1.80011ZM9.00093 3.4567C8.94137 3.45697 8.88433 3.48073 8.84219 3.52282C8.80005 3.56491 8.77622 3.62193 8.77589 3.68149V9.00001C8.77616 9.05961 8.79995 9.1167 8.8421 9.15884C8.88424 9.20099 8.94133 9.22479 9.00093 9.22505C9.06058 9.22492 9.11774 9.20117 9.15992 9.15899C9.20209 9.11682 9.22584 9.05965 9.22598 9.00001V3.68149C9.22571 3.62191 9.20191 3.56485 9.15975 3.52275C9.1176 3.48064 9.06051 3.4569 9.00093 3.4567Z"
                                                                    fill="#5C5E61" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M9.0019 8.54993C9.06189 8.54851 9.12156 8.55909 9.17739 8.58106C9.23323 8.60304 9.28412 8.63595 9.32705 8.67787C9.36998 8.7198 9.40409 8.76988 9.42739 8.82519C9.45068 8.88049 9.46268 8.93989 9.46268 8.99989C9.46268 9.0599 9.45068 9.1193 9.42739 9.1746C9.40409 9.2299 9.36998 9.27999 9.32705 9.32191C9.28412 9.36384 9.23323 9.39675 9.17739 9.41872C9.12156 9.4407 9.06189 9.45128 9.0019 9.44986C8.88441 9.44706 8.77268 9.39843 8.69057 9.31435C8.60846 9.23027 8.5625 9.11741 8.5625 8.99989C8.5625 8.88237 8.60846 8.76952 8.69057 8.68544C8.77268 8.60136 8.88441 8.55272 9.0019 8.54993Z"
                                                                    fill="#5C5E61" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M12.7417 9.00001C12.7414 8.94045 12.7177 8.8834 12.6756 8.84126C12.6335 8.79912 12.5765 8.7753 12.5169 8.77496H8.99848C8.93888 8.77523 8.88179 8.79903 8.83965 8.84117C8.7975 8.88332 8.7737 8.9404 8.77344 9.00001C8.77344 9.12396 8.87478 9.22505 8.99848 9.22505H12.5169C12.5765 9.22485 12.6336 9.20107 12.6757 9.1589C12.7178 9.11673 12.7416 9.05961 12.7417 9.00001Z"
                                                                    fill="#5C5E61" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M9 0C13.9705 0 18 4.02946 18 9C18 13.9705 13.9705 18 9 18C4.02946 18 0 13.9705 0 9C0 4.02946 4.02946 0 9 0ZM9 0.899924C13.4735 0.899924 17.1001 4.52654 17.1001 9C17.1001 13.4735 13.4735 17.1001 9 17.1001C4.52654 17.1001 0.899924 13.4735 0.899924 9C0.899924 4.52654 4.52654 0.899924 9 0.899924Z"
                                                                    fill="#5C5E61" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_2450_13848">
                                                                    <rect width="18" height="18" fill="white" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <p class="fw-5">26 August, 2024</p>
                                                </div>
                                                <h4 class="title  ">
                                                    <a href="blog-details" class="line-clamp-2">Building gains into
                                                        housing
                                                        stocks and how to
                                                        trade the...</a>
                                                </h4>
                                                <a href="blog-details" class="tf-btn-link">
                                                    <span>
                                                        Read More
                                                    </span> <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_2450_13860)">
                                                            <path
                                                                d="M10.0013 18.3334C14.6037 18.3334 18.3346 14.6024 18.3346 10C18.3346 5.39765 14.6037 1.66669 10.0013 1.66669C5.39893 1.66669 1.66797 5.39765 1.66797 10C1.66797 14.6024 5.39893 18.3334 10.0013 18.3334Z"
                                                                stroke="#F1913D" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M6.66797 10H13.3346" stroke="#F1913D"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M10 13.3334L13.3333 10L10 6.66669" stroke="#F1913D"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_2450_13860">
                                                                <rect width="20" height="20" fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide ">
                                        <div class="blog-article-item style-2 hover-img  wow animate__fadeInUp  animate__animated"
                                            data-wow-duration="2s" data-wow-delay="0.2s">
                                            <div class=" image-wrap ">
                                                <a href="blog-details">
                                                    <img class="lazyload" data-src="{{ url('images/blog/blog-grid-3.jpg') }}"
                                                        src="{{ url('images/blog/blog-grid-3.jpg') }}" alt="">
                                                </a>
                                                <div class="box-tag">
                                                    <div class="tag-item text-4 text-white fw-6">Real estate</div>
                                                </div>
                                            </div>
                                            <div class="article-content">
                                                <div class="time">
                                                    <div class="icons">
                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_2450_13848)">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M6.03497 3.8631C6.08651 3.83315 6.12412 3.78402 6.13959 3.72645C6.15505 3.66887 6.14712 3.60751 6.11752 3.55576L5.70832 2.8471C5.67837 2.79555 5.62923 2.75795 5.57164 2.74253C5.51405 2.72711 5.45269 2.73512 5.40098 2.7648C5.34943 2.79475 5.31183 2.8439 5.29641 2.90149C5.28099 2.95908 5.289 3.02044 5.31869 3.07214L5.72788 3.78081C5.75788 3.83224 5.80698 3.86974 5.86449 3.88516C5.922 3.90057 5.98327 3.89264 6.03497 3.8631ZM12.6009 15.2355C12.6524 15.2055 12.69 15.1564 12.7055 15.0988C12.721 15.0412 12.713 14.9799 12.6834 14.9281L12.2742 14.2195C12.2443 14.1679 12.1951 14.1303 12.1376 14.1149C12.08 14.0995 12.0186 14.1075 11.9669 14.1372C11.9154 14.1672 11.8778 14.2163 11.8624 14.2739C11.847 14.3315 11.855 14.3928 11.8846 14.4445L12.2938 15.1532C12.3237 15.2047 12.3728 15.2422 12.4304 15.2576C12.4879 15.273 12.5492 15.2651 12.6009 15.2355ZM3.86377 6.0343C3.89339 5.98258 3.90136 5.92125 3.88595 5.86367C3.87053 5.8061 3.83298 5.75696 3.78148 5.72696L3.07282 5.31776C3.0211 5.28814 2.95976 5.28017 2.90219 5.29559C2.84462 5.311 2.79547 5.34856 2.76548 5.40006C2.73585 5.45178 2.72788 5.51311 2.7433 5.57069C2.75872 5.62826 2.79627 5.6774 2.84777 5.7074L3.55643 6.11659C3.60817 6.14615 3.66948 6.15408 3.72703 6.13867C3.78459 6.12326 3.83373 6.08575 3.86377 6.0343ZM15.2364 12.6C15.266 12.5482 15.274 12.4869 15.2586 12.4293C15.2432 12.3718 15.2056 12.3226 15.1541 12.2926L14.4454 11.8834C14.3937 11.8538 14.3324 11.8458 14.2748 11.8612C14.2172 11.8767 14.1681 11.9142 14.1381 11.9657C14.1084 12.0174 14.1004 12.0788 14.1158 12.1364C14.1312 12.194 14.1688 12.2431 14.2204 12.2731L14.9291 12.6823C14.9808 12.7119 15.0421 12.72 15.0997 12.7045C15.1573 12.6891 15.2064 12.6515 15.2364 12.6ZM3.06926 9.00001C3.06906 8.94038 3.04528 8.88326 3.00312 8.8411C2.96096 8.79894 2.90384 8.77517 2.84422 8.77496H2.02583C1.9662 8.77517 1.90908 8.79894 1.86692 8.8411C1.82476 8.88326 1.80098 8.94038 1.80078 9.00001C1.80078 9.12371 1.90213 9.22505 2.02583 9.22505H2.84422C2.90384 9.22485 2.96096 9.20108 3.00312 9.15892C3.04528 9.11676 3.06906 9.05963 3.06926 9.00001ZM16.2011 9.00001C16.2009 8.94043 16.1771 8.88334 16.135 8.84119C16.0929 8.79904 16.0359 8.77523 15.9763 8.77496H15.1579C15.0983 8.77517 15.0412 8.79894 14.999 8.8411C14.9568 8.88326 14.9331 8.94038 14.9329 9.00001C14.9329 9.12396 15.0342 9.22505 15.1579 9.22505H15.9763C16.0359 9.22479 16.0929 9.20098 16.135 9.15883C16.1771 9.11667 16.2009 9.05959 16.2011 9.00001ZM3.86403 11.966C3.83407 11.9144 3.78495 11.8768 3.72737 11.8614C3.66979 11.8459 3.60844 11.8538 3.55669 11.8834L2.84803 12.2926C2.79647 12.3226 2.75888 12.3717 2.74345 12.4293C2.72803 12.4869 2.73604 12.5483 2.76573 12.6C2.79568 12.6515 2.84482 12.6891 2.90242 12.7045C2.96001 12.72 3.02137 12.7119 3.07307 12.6823L3.78173 12.2731C3.83322 12.2431 3.87076 12.194 3.88618 12.1365C3.9016 12.0789 3.89364 12.0177 3.86403 11.966ZM15.2364 5.40006C15.2064 5.34851 15.1573 5.31091 15.0997 5.29544C15.0422 5.27998 14.9808 5.28791 14.9291 5.31751L14.2204 5.7267C14.1688 5.75665 14.1312 5.8058 14.1158 5.86339C14.1004 5.92098 14.1084 5.98234 14.1381 6.03404C14.168 6.0856 14.2172 6.12319 14.2748 6.13862C14.3324 6.15404 14.3937 6.14603 14.4454 6.11634L15.1541 5.70715C15.2056 5.6772 15.2431 5.6281 15.2585 5.57057C15.274 5.51304 15.266 5.45174 15.2364 5.40006ZM6.03522 14.1372C5.9835 14.1075 5.92217 14.0996 5.8646 14.115C5.80702 14.1304 5.75788 14.168 5.72788 14.2195L5.31869 14.9281C5.28907 14.9798 5.2811 15.0412 5.29651 15.0988C5.31193 15.1563 5.34948 15.2055 5.40098 15.2355C5.4527 15.2651 5.51404 15.2731 5.57161 15.2576C5.62918 15.2422 5.67833 15.2047 5.70832 15.1532L6.11752 14.4445C6.14707 14.3928 6.15501 14.3315 6.1396 14.2739C6.12418 14.2164 6.08667 14.1672 6.03522 14.1372ZM12.6009 2.76455C12.5492 2.73493 12.4878 2.72696 12.4303 2.74237C12.3727 2.75779 12.3235 2.79534 12.2935 2.84685L11.8843 3.55551C11.8547 3.60723 11.8468 3.66856 11.8622 3.72613C11.8776 3.78371 11.9151 3.83285 11.9666 3.86285C12.0183 3.89254 12.0797 3.90055 12.1373 3.88512C12.1949 3.8697 12.244 3.8321 12.274 3.78055L12.6832 3.07189C12.7129 3.02019 12.7209 2.95883 12.7055 2.90124C12.69 2.84364 12.6524 2.7945 12.6009 2.76455ZM9.00093 14.9317C8.94131 14.9319 8.88419 14.9557 8.84203 14.9978C8.79986 15.04 8.77609 15.0971 8.77589 15.1567V15.9751C8.77589 16.0988 8.87723 16.2002 9.00093 16.2002C9.06056 16.2 9.11768 16.1762 9.15984 16.134C9.202 16.0919 9.22578 16.0347 9.22598 15.9751V15.1567C9.22578 15.0971 9.202 15.04 9.15984 14.9978C9.11768 14.9557 9.06056 14.9319 9.00093 14.9317ZM9.00093 1.80011C8.94131 1.80031 8.88419 1.82409 8.84203 1.86625C8.79986 1.90841 8.77609 1.96553 8.77589 2.02515V2.84354C8.77589 2.96724 8.87723 3.06859 9.00093 3.06859C9.06056 3.06839 9.11768 3.04461 9.15984 3.00245C9.202 2.96029 9.22578 2.90317 9.22598 2.84354V2.0249C9.22578 1.9653 9.20199 1.9082 9.15983 1.86608C9.11766 1.82396 9.06053 1.80024 9.00093 1.80011ZM9.00093 3.4567C8.94137 3.45697 8.88433 3.48073 8.84219 3.52282C8.80005 3.56491 8.77622 3.62193 8.77589 3.68149V9.00001C8.77616 9.05961 8.79995 9.1167 8.8421 9.15884C8.88424 9.20099 8.94133 9.22479 9.00093 9.22505C9.06058 9.22492 9.11774 9.20117 9.15992 9.15899C9.20209 9.11682 9.22584 9.05965 9.22598 9.00001V3.68149C9.22571 3.62191 9.20191 3.56485 9.15975 3.52275C9.1176 3.48064 9.06051 3.4569 9.00093 3.4567Z"
                                                                    fill="#5C5E61" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M9.0019 8.54993C9.06189 8.54851 9.12156 8.55909 9.17739 8.58106C9.23323 8.60304 9.28412 8.63595 9.32705 8.67787C9.36998 8.7198 9.40409 8.76988 9.42739 8.82519C9.45068 8.88049 9.46268 8.93989 9.46268 8.99989C9.46268 9.0599 9.45068 9.1193 9.42739 9.1746C9.40409 9.2299 9.36998 9.27999 9.32705 9.32191C9.28412 9.36384 9.23323 9.39675 9.17739 9.41872C9.12156 9.4407 9.06189 9.45128 9.0019 9.44986C8.88441 9.44706 8.77268 9.39843 8.69057 9.31435C8.60846 9.23027 8.5625 9.11741 8.5625 8.99989C8.5625 8.88237 8.60846 8.76952 8.69057 8.68544C8.77268 8.60136 8.88441 8.55272 9.0019 8.54993Z"
                                                                    fill="#5C5E61" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M12.7417 9.00001C12.7414 8.94045 12.7177 8.8834 12.6756 8.84126C12.6335 8.79912 12.5765 8.7753 12.5169 8.77496H8.99848C8.93888 8.77523 8.88179 8.79903 8.83965 8.84117C8.7975 8.88332 8.7737 8.9404 8.77344 9.00001C8.77344 9.12396 8.87478 9.22505 8.99848 9.22505H12.5169C12.5765 9.22485 12.6336 9.20107 12.6757 9.1589C12.7178 9.11673 12.7416 9.05961 12.7417 9.00001Z"
                                                                    fill="#5C5E61" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M9 0C13.9705 0 18 4.02946 18 9C18 13.9705 13.9705 18 9 18C4.02946 18 0 13.9705 0 9C0 4.02946 4.02946 0 9 0ZM9 0.899924C13.4735 0.899924 17.1001 4.52654 17.1001 9C17.1001 13.4735 13.4735 17.1001 9 17.1001C4.52654 17.1001 0.899924 13.4735 0.899924 9C0.899924 4.52654 4.52654 0.899924 9 0.899924Z"
                                                                    fill="#5C5E61" />
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_2450_13848">
                                                                    <rect width="18" height="18" fill="white" />
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <p class="fw-5">26 August, 2024</p>
                                                </div>
                                                <h4 class="title  ">
                                                    <a href="blog-details" class="line-clamp-2">Building gains into
                                                        housing
                                                        stocks and how to
                                                        trade the...</a>
                                                </h4>
                                                <a href="blog-details" class="tf-btn-link">
                                                    <span>
                                                        Read More
                                                    </span> <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_2450_13860)">
                                                            <path
                                                                d="M10.0013 18.3334C14.6037 18.3334 18.3346 14.6024 18.3346 10C18.3346 5.39765 14.6037 1.66669 10.0013 1.66669C5.39893 1.66669 1.66797 5.39765 1.66797 10C1.66797 14.6024 5.39893 18.3334 10.0013 18.3334Z"
                                                                stroke="#F1913D" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M6.66797 10H13.3346" stroke="#F1913D"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M10 13.3334L13.3333 10L10 6.66669" stroke="#F1913D"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_2450_13860">
                                                                <rect width="20" height="20" fill="white" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="sw-pagination sw-pagination-latest text-center d-lg-none d-block mt-20">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- section-CTA -->
            <section class="section-CTA">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="content-inner">
                                <img src="{{ url('images/section/cta.png') }}" alt="">
                                <div class="content">
                                    <h4 class="text-white mb-8 ">Find a Local Real Estate Agent Today</h4>
                                    <p class="text-white text-1">If you’re looking to buy or sell a home. We’ll help you
                                        make
                                        the most money
                                        possible.</p>
                                </div>
                                <a href="#" class="tf-btn style-2 fw-6 ">Find your location agent <i
                                        class="icon-MagnifyingGlass fw-6"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /section-CTA -->
        </div>
        <!-- /main-content -->

        <!-- #Footer -->
        <footer id="footer">
            <div class="tf-container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-top">
                            <div class="footer-logo">
                                <a href="index">
                                    <img id="logo_footer" src="{{ url('images/logo/logo-2%402x.png') }}" alt="logo-footer">
                                </a>
                            </div>
                            <div class="footer-contact">
                                <div class="contact-item">
                                    <div class="icons">
                                        <svg width="48" height="49" viewBox="0 0 48 49" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M43.9989 34.34V40.34C44.0012 40.897 43.8871 41.4483 43.6639 41.9586C43.4408 42.469 43.1135 42.9271 42.703 43.3037C42.2926 43.6802 41.808 43.9669 41.2804 44.1454C40.7527 44.3238 40.1936 44.3901 39.6389 44.34C33.4846 43.6712 27.5729 41.5682 22.3789 38.2C17.5465 35.1293 13.4496 31.0323 10.3789 26.2C6.99885 20.9824 4.89538 15.0419 4.23889 8.85995C4.18891 8.30688 4.25464 7.74947 4.43189 7.2232C4.60914 6.69693 4.89403 6.21333 5.26842 5.80319C5.64281 5.39306 6.0985 5.06537 6.60647 4.84099C7.11444 4.61662 7.66357 4.50047 8.21889 4.49995H14.2189C15.1895 4.4904 16.1305 4.83411 16.8664 5.46702C17.6024 6.09992 18.083 6.97884 18.2189 7.93995C18.4721 9.86008 18.9418 11.7454 19.6189 13.5599C19.888 14.2758 19.9462 15.0538 19.7867 15.8017C19.6272 16.5496 19.2566 17.2362 18.7189 17.78L16.1789 20.3199C19.026 25.327 23.1718 29.4728 28.1789 32.32L30.7189 29.78C31.2627 29.2422 31.9492 28.8716 32.6971 28.7121C33.4451 28.5526 34.223 28.6109 34.9389 28.8799C36.7534 29.5571 38.6388 30.0267 40.5589 30.28C41.5304 30.417 42.4177 30.9064 43.052 31.6549C43.6862 32.4035 44.0232 33.3591 43.9989 34.34Z"
                                                stroke="#F1913D" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="content">
                                        <div class="title text-1">
                                            Call us
                                        </div>
                                        <h6>
                                            <a href="#"> 0333-1929762</a>
                                        </h6>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <div class="icons">
                                        <svg width="48" height="49" viewBox="0 0 48 49" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M40 8.5H8C5.79086 8.5 4 10.2909 4 12.5V36.5C4 38.7091 5.79086 40.5 8 40.5H40C42.2091 40.5 44 38.7091 44 36.5V12.5C44 10.2909 42.2091 8.5 40 8.5Z"
                                                stroke="#F1913D" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M44 14.5L26.06 25.9C25.4425 26.2869 24.7286 26.492 24 26.492C23.2714 26.492 22.5575 26.2869 21.94 25.9L4 14.5"
                                                stroke="#F1913D" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>

                                    </div>
                                    <div class="content">
                                        <div class="title text-1">
                                            Nee live help
                                        </div>
                                        <h6 class="fw-4">
                                            <a href="#">
                                                info@randhawamarketing.com
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-main">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="footer-menu-list footer-col-block style-2">
                                    <h5 class="title lh-30 title-desktop">About us</h5>
                                    <h5 class="title lh-30 title-mobile">About us</h5>
                                    <ul class="tf-collapse-content">
                                        <li><a href="contact">Contact</a></li>
                                        <li><a href="service-details">Why choose us?</a></li>
                                        <li><a href="#">Customer reviews</a></li>
                                        <li><a href="agents">Our team</a></li>
                                        <li><a href="career">Careers with realty</a></li>
                                        <li><a href="career">Work with us</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="footer-menu-list footer-col-block">
                                    <h5 class="title lh-30 title-desktop">Popular house</h5>
                                    <h5 class="title lh-30 title-mobile">Popular house</h5>
                                    <ul class="tf-collapse-content">
                                        <li><a href="property-gird">#Penthouses</a></li>
                                        <li><a href="property-gird">#Villa</a></li>
                                        <li><a href="property-gird">#Smart home</a></li>
                                        <li><a href="property-gird">#Apartments</a></li>
                                        <li><a href="property-gird">#Office</a></li>
                                        <li><a href="property-gird">#Bungalow</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="footer-menu-list footer-col-block style-2">
                                    <h5 class="title lh-30 title-desktop">Quick links</h5>
                                    <h5 class="title lh-30 title-mobile">Quick links</h5>
                                    <ul class="tf-collapse-content">
                                        <li><a href="#">Terms of use</a></li>
                                        <li><a href="#">Privacy policy</a></li>
                                        <li><a href="#">Our services</a></li>
                                        <li><a href="contact">Contact support</a></li>
                                        <li><a href="#">Pricing plans</a></li>
                                        <li><a href="faq">FAQs</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="footer-menu-list newsletter ">
                                    <h5 class="title lh-30 ">Newsletter</h5>
                                    <div class="sib-form">
                                        <div id="sib-form-container" class="sib-form-container">
                                            <div id="error-message" class="sib-form-message-panel">
                                                <div
                                                    class="sib-form-message-panel__text sib-form-message-panel__text--center">
                                                    <svg viewBox="0 0 512 512" class="sib-icon sib-notification__icon">
                                                        <path
                                                            d="M256 40c118.621 0 216 96.075 216 216 0 119.291-96.61 216-216 216-119.244 0-216-96.562-216-216 0-119.203 96.602-216 216-216m0-32C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm-11.49 120h22.979c6.823 0 12.274 5.682 11.99 12.5l-7 168c-.268 6.428-5.556 11.5-11.99 11.5h-8.979c-6.433 0-11.722-5.073-11.99-11.5l-7-168c-.283-6.818 5.167-12.5 11.99-12.5zM256 340c-15.464 0-28 12.536-28 28s12.536 28 28 28 28-12.536 28-28-12.536-28-28-28z" />
                                                    </svg>
                                                    <span class="sib-form-message-panel__inner-text">
                                                        Your subscription could not be saved. Please try again.
                                                    </span>
                                                </div>
                                            </div>
                                            <div id="success-message" class="sib-form-message-panel">
                                                <div
                                                    class="sib-form-message-panel__text sib-form-message-panel__text--center">
                                                    <svg viewBox="0 0 512 512" class="sib-icon sib-notification__icon">
                                                        <path
                                                            d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 464c-118.664 0-216-96.055-216-216 0-118.663 96.055-216 216-216 118.664 0 216 96.055 216 216 0 118.663-96.055 216-216 216zm141.63-274.961L217.15 376.071c-4.705 4.667-12.303 4.637-16.97-.068l-85.878-86.572c-4.667-4.705-4.637-12.303.068-16.97l8.52-8.451c4.705-4.667 12.303-4.637 16.97.068l68.976 69.533 163.441-162.13c4.705-4.667 12.303-4.637 16.97.068l8.451 8.52c4.668 4.705 4.637 12.303-.068 16.97z" />
                                                    </svg>
                                                    <span class="sib-form-message-panel__inner-text">
                                                        Your subscription has been successful.
                                                    </span>
                                                </div>
                                            </div>
                                            <div id="sib-container"
                                                class="sib-container--large sib-container--vertical">
                                                <form id="sib-form" method="POST"
                                                    action="https://3c02c1a1.sibforms.com/serve/MUIFABjeOIIJNMRgQ-0Mb1bjkLdsnuanXhO94qzsHBwAVG3reSaZ5DIq2ozIM0_PBl7b_lcysdmopwilW1dcjaAmtOu_es-dny_hZggPsstdEuk75SIQ1B7K-NuFEN5hBn9HqJ2SFLbleb-PnrNQY1dGLy7gXPmMlWJfT2Jfc2MeVJg4Ufeezo6UlJhAZwbC5nZ8aV9PghzVQVkE"
                                                    data-type="subscription">
                                                    <div class="sib-form-block">
                                                        <div class="sib-text-form-block">
                                                            <p class="text-1">Sign up to receive the latest articles</p>
                                                        </div>
                                                    </div>
                                                    <div class="sib-input sib-form-block">
                                                        <div class="form__entry entry_block">
                                                            <div class="form__label-row ">
                                                                <fieldset class="entry__field">
                                                                    <input class="input input-nl" type="text" id="EMAIL"
                                                                        name="EMAIL" autocomplete="off"
                                                                        placeholder="Your email address"
                                                                        data-required="true" required />
                                                                </fieldset>
                                                            </div>
                                                            <label class="  entry__error entry__error--primary">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="sib-optin sib-form-block">
                                                        <div class="form__entry entry_mcq">
                                                            <div class="form__label-row ">
                                                                <div class="checkbox-item ">
                                                                    <label>
                                                                        <span class="text-2 text-color-default">I have
                                                                            read and agree to
                                                                            the terms &
                                                                            conditions</span>
                                                                        <input type="checkbox" class="input_replaced"
                                                                            value="1" id="OPT_IN" name="OPT_IN">
                                                                        <span class="btn-checkbox"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <label class="entry__error entry__error--primary">
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="sib-form-block">
                                                        <button
                                                            class="sib-form-block__button sib-form-block__button-with-loader tf-btn bg-color-primary w-full"
                                                            form="sib-form" type="submit">
                                                            <svg class="icon clickable__icon progress-indicator__icon sib-hide-loader-icon"
                                                                viewBox="0 0 512 512">
                                                                <path
                                                                    d="M460.116 373.846l-20.823-12.022c-5.541-3.199-7.54-10.159-4.663-15.874 30.137-59.886 28.343-131.652-5.386-189.946-33.641-58.394-94.896-95.833-161.827-99.676C261.028 55.961 256 50.751 256 44.352V20.309c0-6.904 5.808-12.337 12.703-11.982 83.556 4.306 160.163 50.864 202.11 123.677 42.063 72.696 44.079 162.316 6.031 236.832-3.14 6.148-10.75 8.461-16.728 5.01z" />
                                                            </svg>
                                                            SUBSCRIBE
                                                        </button>
                                                    </div>
                                            </div>
                                            <input type="text" name="email_address_check" value=""
                                                class="input--hidden">
                                            <input type="hidden" name="locale" value="en">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="footer-bottom">
                            <p>Copyright © 2024 <span class="fw-7">PROTY - REAL ESTATE</span> . Designed & Developed
                                by
                                <a href="#">Themesflat</a>
                            </p>
                            <div class="wrap-social">
                                <div class="text-3  fw-6 text-white">Follow us</div>
                                <ul class="tf-social ">
                                    <li>
                                        <a href="#">
                                            <i class="icon-fb"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-X"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-linked"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-ins"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer><!-- /#Footer -->

    </div>
    <!-- /wrapper -->

    <!-- .login -->
    <div class="modal modal-account fade" id="modalLogin">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="flat-account">
                    <div class="banner-account">
                        <img src="{{ url('images/section/banner-login.jpg') }}" alt="banner">
                    </div>
                    <form class="form-account">
                        <div class="title-box">
                            <h4>Login</h4>
                            <span class="close-modal icon-close" data-bs-dismiss="modal"></span>
                        </div>
                        <div class="box">
                            <fieldset class="box-fieldset">
                                <label for="nameAccount">Account</label>
                                <div class="ip-field">
                                    <svg class="icon" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13.4869 14.0435C12.9628 13.3497 12.2848 12.787 11.5063 12.3998C10.7277 12.0126 9.86989 11.8115 9.00038 11.8123C8.13086 11.8115 7.27304 12.0126 6.49449 12.3998C5.71594 12.787 5.03793 13.3497 4.51388 14.0435M13.4869 14.0435C14.5095 13.1339 15.2307 11.9349 15.5563 10.6056C15.8818 9.27625 15.7956 7.87934 15.309 6.60014C14.8224 5.32093 13.9584 4.21986 12.8317 3.44295C11.7049 2.66604 10.3686 2.25 9 2.25C7.63137 2.25 6.29508 2.66604 5.16833 3.44295C4.04158 4.21986 3.17762 5.32093 2.69103 6.60014C2.20443 7.87934 2.11819 9.27625 2.44374 10.6056C2.76929 11.9349 3.49125 13.1339 4.51388 14.0435M13.4869 14.0435C12.2524 15.1447 10.6546 15.7521 9.00038 15.7498C7.3459 15.7523 5.74855 15.1448 4.51388 14.0435M11.2504 7.31228C11.2504 7.90902 11.0133 8.48131 10.5914 8.90327C10.1694 9.32523 9.59711 9.56228 9.00038 9.56228C8.40364 9.56228 7.83134 9.32523 7.40939 8.90327C6.98743 8.48131 6.75038 7.90902 6.75038 7.31228C6.75038 6.71554 6.98743 6.14325 7.40939 5.72129C7.83134 5.29933 8.40364 5.06228 9.00038 5.06228C9.59711 5.06228 10.1694 5.29933 10.5914 5.72129C11.0133 6.14325 11.2504 6.71554 11.2504 7.31228Z"
                                            stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <input type="text" class="form-control" id="nameAccount" placeholder="Your name">
                                </div>
                            </fieldset>
                            <fieldset class="box-fieldset">
                                <label for="pass">Password</label>
                                <div class="ip-field">
                                    <svg class="icon" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.375 7.875V5.0625C12.375 4.16739 12.0194 3.30895 11.3865 2.67601C10.7535 2.04308 9.89511 1.6875 9 1.6875C8.10489 1.6875 7.24645 2.04308 6.61351 2.67601C5.98058 3.30895 5.625 4.16739 5.625 5.0625V7.875M5.0625 16.3125H12.9375C13.3851 16.3125 13.8143 16.1347 14.1307 15.8182C14.4472 15.5018 14.625 15.0726 14.625 14.625V9.5625C14.625 9.11495 14.4472 8.68573 14.1307 8.36926C13.8143 8.05279 13.3851 7.875 12.9375 7.875H5.0625C4.61495 7.875 4.18573 8.05279 3.86926 8.36926C3.55279 8.68573 3.375 9.11495 3.375 9.5625V14.625C3.375 15.0726 3.55279 15.5018 3.86926 15.8182C4.18573 16.1347 4.61495 16.3125 5.0625 16.3125Z"
                                            stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <input type="text" class="form-control" id="pass" placeholder="Your password">
                                </div>
                                <div class="text-forgot text-end"><a href="#">Forgot password</a></div>

                            </fieldset>
                        </div>
                        <div class="box box-btn">
                            <a href="dashboard" class="tf-btn bg-color-primary w-100">Login</a>
                            <div class="text text-center">Don’t you have an account? <a href="#modalRegister"
                                    data-bs-toggle="modal" class="text-color-primary">Register</a></div>
                        </div>
                        <p class="box text-center caption-2">or login with</p>
                        <div class="group-btn">
                            <a href="#" class="btn-social">
                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2478_11334)">
                                        <path
                                            d="M4.93242 12.0863L4.23625 14.6852L1.69176 14.739C0.931328 13.3286 0.5 11.7149 0.5 10C0.5 8.34179 0.903281 6.77804 1.61812 5.40112H1.61867L3.88398 5.81644L4.87633 8.06815C4.66863 8.67366 4.55543 9.32366 4.55543 10C4.55551 10.7341 4.68848 11.4374 4.93242 12.0863Z"
                                            fill="#FBBB00" />
                                        <path
                                            d="M20.3242 8.1319C20.439 8.73682 20.4989 9.36155 20.4989 10C20.4989 10.716 20.4236 11.4143 20.2802 12.088C19.7934 14.3803 18.5214 16.3819 16.7594 17.7984L16.7588 17.7978L13.9055 17.6522L13.5017 15.1314C14.6709 14.4456 15.5847 13.3726 16.066 12.088H10.7188V8.1319H20.3242Z"
                                            fill="#518EF8" />
                                        <path
                                            d="M16.7595 17.7978L16.7601 17.7984C15.0464 19.1758 12.8694 20 10.4996 20C6.69141 20 3.38043 17.8715 1.69141 14.739L4.93207 12.0863C5.77656 14.3401 7.95074 15.9445 10.4996 15.9445C11.5952 15.9445 12.6216 15.6484 13.5024 15.1313L16.7595 17.7978Z"
                                            fill="#28B446" />
                                        <path
                                            d="M16.882 2.30219L13.6425 4.95437C12.7309 4.38461 11.6534 4.05547 10.4991 4.05547C7.89246 4.05547 5.67762 5.73348 4.87543 8.06812L1.61773 5.40109H1.61719C3.28148 2.1923 6.63422 0 10.4991 0C12.9254 0 15.1502 0.864297 16.882 2.30219Z"
                                            fill="#F14336" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2478_11334">
                                            <rect width="20" height="20" fill="white" transform="translate(0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg>

                                Google
                            </a>
                            <a href="#" class="btn-social">
                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.5 10C20.5 14.9914 16.843 19.1285 12.0625 19.8785V12.8906H14.3926L14.8359 10H12.0625V8.12422C12.0625 7.3332 12.45 6.5625 13.6922 6.5625H14.9531V4.10156C14.9531 4.10156 13.8086 3.90625 12.7145 3.90625C10.4305 3.90625 8.9375 5.29063 8.9375 7.79688V10H6.39844V12.8906H8.9375V19.8785C4.15703 19.1285 0.5 14.9914 0.5 10C0.5 4.47734 4.97734 0 10.5 0C16.0227 0 20.5 4.47734 20.5 10Z"
                                        fill="#1877F2" />
                                    <path
                                        d="M14.3926 12.8906L14.8359 10H12.0625V8.12418C12.0625 7.33336 12.4499 6.5625 13.6921 6.5625H14.9531V4.10156C14.9531 4.10156 13.8088 3.90625 12.7146 3.90625C10.4304 3.90625 8.9375 5.29063 8.9375 7.79688V10H6.39844V12.8906H8.9375V19.8785C9.44664 19.9584 9.96844 20 10.5 20C11.0316 20 11.5534 19.9584 12.0625 19.8785V12.8906H14.3926Z"
                                        fill="white" />
                                </svg>

                                Facebook
                            </a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- /.login -->

    <!-- register -->
    <div class="modal modal-account fade" id="modalRegister">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="flat-account">
                    <div class="banner-account">
                        <img src="{{ url('images/section/banner-register.jpg') }}" alt="banner">
                    </div>
                    <form class="form-account">
                        <div class="title-box">
                            <h4>Register</h4>
                            <span class="close-modal icon-close" data-bs-dismiss="modal"></span>
                        </div>
                        <div class="box">
                            <fieldset class="box-fieldset">
                                <label for="username">User name</label>
                                <div class="ip-field">
                                    <svg class="icon" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13.4869 14.0435C12.9628 13.3497 12.2848 12.787 11.5063 12.3998C10.7277 12.0126 9.86989 11.8115 9.00038 11.8123C8.13086 11.8115 7.27304 12.0126 6.49449 12.3998C5.71594 12.787 5.03793 13.3497 4.51388 14.0435M13.4869 14.0435C14.5095 13.1339 15.2307 11.9349 15.5563 10.6056C15.8818 9.27625 15.7956 7.87934 15.309 6.60014C14.8224 5.32093 13.9584 4.21986 12.8317 3.44295C11.7049 2.66604 10.3686 2.25 9 2.25C7.63137 2.25 6.29508 2.66604 5.16833 3.44295C4.04158 4.21986 3.17762 5.32093 2.69103 6.60014C2.20443 7.87934 2.11819 9.27625 2.44374 10.6056C2.76929 11.9349 3.49125 13.1339 4.51388 14.0435M13.4869 14.0435C12.2524 15.1447 10.6546 15.7521 9.00038 15.7498C7.3459 15.7523 5.74855 15.1448 4.51388 14.0435M11.2504 7.31228C11.2504 7.90902 11.0133 8.48131 10.5914 8.90327C10.1694 9.32523 9.59711 9.56228 9.00038 9.56228C8.40364 9.56228 7.83134 9.32523 7.40939 8.90327C6.98743 8.48131 6.75038 7.90902 6.75038 7.31228C6.75038 6.71554 6.98743 6.14325 7.40939 5.72129C7.83134 5.29933 8.40364 5.06228 9.00038 5.06228C9.59711 5.06228 10.1694 5.29933 10.5914 5.72129C11.0133 6.14325 11.2504 6.71554 11.2504 7.31228Z"
                                            stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <input type="text" class="form-control" id="username" placeholder="User name">
                                </div>
                            </fieldset>
                            <fieldset class="box-fieldset">
                                <label for="email">Email address</label>
                                <div class="ip-field">
                                    <svg class="icon" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.3125 5.0625V12.9375C16.3125 13.3851 16.1347 13.8143 15.8182 14.1307C15.5018 14.4472 15.0726 14.625 14.625 14.625H3.375C2.92745 14.625 2.49822 14.4472 2.18176 14.1307C1.86529 13.8143 1.6875 13.3851 1.6875 12.9375V5.0625M16.3125 5.0625C16.3125 4.61495 16.1347 4.18573 15.8182 3.86926C15.5018 3.55279 15.0726 3.375 14.625 3.375H3.375C2.92745 3.375 2.49822 3.55279 2.18176 3.86926C1.86529 4.18573 1.6875 4.61495 1.6875 5.0625M16.3125 5.0625V5.24475C16.3125 5.53286 16.2388 5.81618 16.0983 6.06772C15.9578 6.31926 15.7553 6.53065 15.51 6.68175L9.885 10.143C9.61891 10.3069 9.31252 10.3937 9 10.3937C8.68748 10.3937 8.38109 10.3069 8.115 10.143L2.49 6.6825C2.24469 6.5314 2.04215 6.32001 1.90168 6.06847C1.7612 5.81693 1.68747 5.53361 1.6875 5.2455V5.0625"
                                            stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    <input type="text" class="form-control" id="email" placeholder="Email address">
                                </div>

                            </fieldset>
                            <fieldset class="box-fieldset">
                                <label for="pass2">Password</label>
                                <div class="ip-field">
                                    <svg class="icon" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.375 7.875V5.0625C12.375 4.16739 12.0194 3.30895 11.3865 2.67601C10.7535 2.04308 9.89511 1.6875 9 1.6875C8.10489 1.6875 7.24645 2.04308 6.61351 2.67601C5.98058 3.30895 5.625 4.16739 5.625 5.0625V7.875M5.0625 16.3125H12.9375C13.3851 16.3125 13.8143 16.1347 14.1307 15.8182C14.4472 15.5018 14.625 15.0726 14.625 14.625V9.5625C14.625 9.11495 14.4472 8.68573 14.1307 8.36926C13.8143 8.05279 13.3851 7.875 12.9375 7.875H5.0625C4.61495 7.875 4.18573 8.05279 3.86926 8.36926C3.55279 8.68573 3.375 9.11495 3.375 9.5625V14.625C3.375 15.0726 3.55279 15.5018 3.86926 15.8182C4.18573 16.1347 4.61495 16.3125 5.0625 16.3125Z"
                                            stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <input type="password" class="form-control" id="pass2" placeholder="Your password">
                                </div>
                            </fieldset>
                            <fieldset class="box-fieldset">
                                <label for="confirm">Confirm password</label>
                                <div class="ip-field">
                                    <svg class="icon" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.375 7.875V5.0625C12.375 4.16739 12.0194 3.30895 11.3865 2.67601C10.7535 2.04308 9.89511 1.6875 9 1.6875C8.10489 1.6875 7.24645 2.04308 6.61351 2.67601C5.98058 3.30895 5.625 4.16739 5.625 5.0625V7.875M5.0625 16.3125H12.9375C13.3851 16.3125 13.8143 16.1347 14.1307 15.8182C14.4472 15.5018 14.625 15.0726 14.625 14.625V9.5625C14.625 9.11495 14.4472 8.68573 14.1307 8.36926C13.8143 8.05279 13.3851 7.875 12.9375 7.875H5.0625C4.61495 7.875 4.18573 8.05279 3.86926 8.36926C3.55279 8.68573 3.375 9.11495 3.375 9.5625V14.625C3.375 15.0726 3.55279 15.5018 3.86926 15.8182C4.18573 16.1347 4.61495 16.3125 5.0625 16.3125Z"
                                            stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <input type="password" class="form-control" id="confirm"
                                        placeholder="Confirm password">
                                </div>
                            </fieldset>
                        </div>
                        <div class="box box-btn">
                            <a href="dashboard" class="tf-btn bg-color-primary w-full">Sign Up</a>
                            <div class="text text-center">Don’t you have an account? <a href="#modalLogin"
                                    data-bs-toggle="modal" class="text-color-primary">Sign In</a></div>
                        </div>
                        <p class="box text-center caption-2">or login with</p>
                        <div class="group-btn">
                            <a href="#" class="btn-social">
                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2478_12036)">
                                        <path
                                            d="M4.93242 12.0863L4.23625 14.6852L1.69176 14.739C0.931328 13.3286 0.5 11.7149 0.5 10C0.5 8.34179 0.903281 6.77804 1.61812 5.40112H1.61867L3.88398 5.81644L4.87633 8.06815C4.66863 8.67366 4.55543 9.32366 4.55543 10C4.55551 10.7341 4.68848 11.4374 4.93242 12.0863Z"
                                            fill="#FBBB00" />
                                        <path
                                            d="M20.3242 8.1319C20.439 8.73682 20.4989 9.36155 20.4989 10C20.4989 10.716 20.4236 11.4143 20.2802 12.088C19.7934 14.3803 18.5214 16.3819 16.7594 17.7984L16.7588 17.7978L13.9055 17.6522L13.5017 15.1314C14.6709 14.4456 15.5847 13.3726 16.066 12.088H10.7188V8.1319H20.3242Z"
                                            fill="#518EF8" />
                                        <path
                                            d="M16.7595 17.7978L16.7601 17.7984C15.0464 19.1758 12.8694 20 10.4996 20C6.69141 20 3.38043 17.8715 1.69141 14.739L4.93207 12.0863C5.77656 14.3401 7.95074 15.9445 10.4996 15.9445C11.5952 15.9445 12.6216 15.6484 13.5024 15.1313L16.7595 17.7978Z"
                                            fill="#28B446" />
                                        <path
                                            d="M16.882 2.30219L13.6425 4.95437C12.7309 4.38461 11.6534 4.05547 10.4991 4.05547C7.89246 4.05547 5.67762 5.73348 4.87543 8.06812L1.61773 5.40109H1.61719C3.28148 2.1923 6.63422 0 10.4991 0C12.9254 0 15.1502 0.864297 16.882 2.30219Z"
                                            fill="#F14336" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2478_12036">
                                            <rect width="20" height="20" fill="white" transform="translate(0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg>

                                Google
                            </a>
                            <a href="#" class="btn-social">
                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2478_12044)">
                                        <path
                                            d="M20.5 10C20.5 14.9914 16.843 19.1285 12.0625 19.8785V12.8906H14.3926L14.8359 10H12.0625V8.12422C12.0625 7.3332 12.45 6.5625 13.6922 6.5625H14.9531V4.10156C14.9531 4.10156 13.8086 3.90625 12.7145 3.90625C10.4305 3.90625 8.9375 5.29063 8.9375 7.79688V10H6.39844V12.8906H8.9375V19.8785C4.15703 19.1285 0.5 14.9914 0.5 10C0.5 4.47734 4.97734 0 10.5 0C16.0227 0 20.5 4.47734 20.5 10Z"
                                            fill="#1877F2" />
                                        <path
                                            d="M14.3926 12.8906L14.8359 10H12.0625V8.12418C12.0625 7.33336 12.4499 6.5625 13.6921 6.5625H14.9531V4.10156C14.9531 4.10156 13.8088 3.90625 12.7146 3.90625C10.4304 3.90625 8.9375 5.29063 8.9375 7.79688V10H6.39844V12.8906H8.9375V19.8785C9.44664 19.9584 9.96844 20 10.5 20C11.0316 20 11.5534 19.9584 12.0625 19.8785V12.8906H14.3926Z"
                                            fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2478_12044">
                                            <rect width="20" height="20" fill="white" transform="translate(0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                Facebook
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- register -->

    <!-- mobile-nav -->
    <div class="offcanvas offcanvas-start mobile-nav-wrap " tabindex="-1" id="menu-mobile"
        aria-labelledby="menu-mobile">
        <div class="offcanvas-header top-nav-mobile">
            <div class="offcanvas-title">
                <a href="index"><img src="{{ url('images/logo/logo%402x.png') }}" alt=""></a>
            </div>
            <div data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="icon-close"></i>
            </div>
        </div>
        <div class="offcanvas-body inner-mobile-nav">
            <div class="mb-body">
                <ul id="menu-mobile-menu">
                    <li class="menu-item menu-item-has-children-mobile ">
                        <a href="#dropdown-menu-one" class="item-menu-mobile collapsed" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="dropdown-menu-one">
                            Home
                        </a>
                        <div id="dropdown-menu-one" class="collapse" data-bs-parent="#menu-mobile-menu">
                            <ul class="sub-mobile ">
                                <li class="menu-item "><a href="index">Home Page 01</a></li>
                                <li class="menu-item"><a href="home02">Home Page 02</a></li>
                                <li class="menu-item"><a href="home03">Home Page 03</a></li>
                                <li class="menu-item"><a href="home04">Home Page 04</a></li>
                                <li class="menu-item"><a href="home05">Home Page 05</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item menu-item-has-children-mobile">
                        <a href="#dropdown-menu-two" class="item-menu-mobile collapsed" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="dropdown-menu-two">
                            Listing
                        </a>
                        <div id="dropdown-menu-two" class="collapse" data-bs-parent="#menu-mobile-menu">
                            <ul class="sub-mobile">
                                <li class="menu-item menu-item-has-children-mobile-2">
                                    <a href="#sub-layout" class="item-menu-mobile  collapsed" data-bs-toggle="collapse"
                                        aria-expanded="true" aria-controls="sub-agents">Layout</a>
                                    <div id="sub-layout" class="collapse" data-bs-parent="#dropdown-menu-two">
                                        <ul class="sub-mobile">
                                            <li class="menu-item ">
                                                <a href="property-grid-full-width" class="item-menu-mobile ">Grid
                                                    Style - Full Width</a>
                                            </li>
                                            <li class="menu-item ">
                                                <a href="property-gird-top-search" class="item-menu-mobile ">Grid
                                                    Style - Top Search</a>
                                            </li>
                                            <li class="menu-item ">
                                                <a href="property-gird-left-sidebar" class="item-menu-mobile ">Grid
                                                    Style - Sidebar Left</a>
                                            </li>
                                            <li class="menu-item ">
                                                <a href="property-gird-right-sidebar" class="item-menu-mobile ">
                                                    Grid Style - Sidebar Right</a>
                                            </li>
                                            <li class="menu-item ">
                                                <a href="property-list-full-width" class="item-menu-mobile "> List
                                                    Style - Full Width</a>
                                            </li>
                                            <li class="menu-item ">
                                                <a href="property-list-top-search" class="item-menu-mobile "> List
                                                    Style - Top Search</a>
                                            </li>
                                            <li class="menu-item ">
                                                <a href="property-list-left-sidebar" class="item-menu-mobile ">List
                                                    Style - Sidebar Left</a>
                                            </li>
                                            <li class="menu-item ">
                                                <a href="property-list-right-sidebar" class="item-menu-mobile ">
                                                    List Style - Sidebar Right</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="menu-item menu-item-has-children-mobile-2">
                                    <a href="#sub-feaure" class="item-menu-mobile  collapsed" data-bs-toggle="collapse"
                                        aria-expanded="true" aria-controls="sub-agents">Feature</a>
                                    <div id="sub-feaure" class="collapse" data-bs-parent="#dropdown-menu-two">
                                        <ul class="sub-mobile">
                                            <li class="menu-item">
                                                <a href="property-half-map-grid">Property Half Map Grid</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="property-half-map-list">Property Half Map List</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="property-half-top-map">Property Half Top Map</a>
                                            </li>
                                            <li class="menu-item ">
                                                <a href="property-filter-popup" class="item-menu-mobile ">
                                                    Property Filter Popup</a>
                                            </li>
                                            <li class="menu-item ">
                                                <a href="property-filter-popup-left"
                                                    class="item-menu-mobile ">Property Filter Popup Left</a>
                                            </li>
                                            <li class="menu-item ">
                                                <a href="property-filter-popup-right" class="item-menu-mobile ">
                                                    Property Filter Popup Right</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="menu-item menu-item-has-children-mobile-2">
                                    <a href="#sub-details" class="item-menu-mobile  collapsed" data-bs-toggle="collapse"
                                        aria-expanded="true" aria-controls="sub-agents">Listing Details</a>
                                    <div id="sub-details" class="collapse" data-bs-parent="#dropdown-menu-two">
                                        <ul class="sub-mobile">
                                            <li class="menu-item">
                                                <a href="property-detail-v1">Property Details 1</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="property-detail-v2">Property Details 2</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="property-detail-v3">Property Details 3</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="property-detail-v4">Property Details 4</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="property-detail-v5">Property Details 5</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item menu-item-has-children-mobile">
                        <a href="#dropdown-menu-four" class="item-menu-mobile collapsed" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="dropdown-menu-four">
                            Pages
                        </a>
                        <div id="dropdown-menu-four" class="collapse" data-bs-parent="#menu-mobile-menu">
                            <ul class="sub-mobile">
                                <li class="menu-item menu-item-has-children-mobile-2">
                                    <a href="#sub-agents" class="item-menu-mobile  collapsed" data-bs-toggle="collapse"
                                        aria-expanded="true" aria-controls="sub-agents">Agents</a>
                                    <div id="sub-agents" class="collapse" data-bs-parent="#dropdown-menu-four">
                                        <ul class="sub-mobile">
                                            <li class="menu-item ">
                                                <a href="agents" class="item-menu-mobile "> Agents</a>
                                            </li>
                                            <li class="menu-item ">
                                                <a href="agents-details" class="item-menu-mobile "> Agnet
                                                    Details</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="menu-item menu-item-has-children-mobile-2">
                                    <a href="#sub-agency" class="item-menu-mobile  collapsed" data-bs-toggle="collapse"
                                        aria-expanded="true" aria-controls="sub-agency">Agencies</a>
                                    <div id="sub-agency" class="collapse" data-bs-parent="#dropdown-menu-four">
                                        <ul class="sub-mobile">
                                            <li class="menu-item ">
                                                <a href="agency-grid" class="item-menu-mobile ">Agencies Grid</a>
                                            </li>
                                            <li class="menu-item ">
                                                <a href="agency-list" class="item-menu-mobile "> Agencies List</a>
                                            </li>
                                            <li class="menu-item ">
                                                <a href="agency-details" class="item-menu-mobile "> Agencies
                                                    Details</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="menu-item"><a href="home-loan-process">Home Loan Process</a></li>
                                <li class="menu-item"><a href="career">Career</a></li>
                                <li class="menu-item"><a href="faq">Faq's</a></li>
                                <li class="menu-item"><a href="dashboard">Dashboard</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item menu-item-has-children-mobile current-menu-item">
                        <a href="#dropdown-menu-five" class="item-menu-mobile collapsed" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="dropdown-menu-five">
                            Blogs
                        </a>
                        <div id="dropdown-menu-five" class="collapse" data-bs-parent="#menu-mobile-menu">
                            <ul class="sub-mobile ">
                                <li class="menu-item"><a href="blog-grid">Blog Grid</a></li>
                                <li class="menu-item"><a href="blog-list">Blog List</a></li>
                                <li class="menu-item current-item"><a href="blog-details">Blog Details </a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item ">
                        <a href="contact" class="tem-menu-mobile "> Contact</a>
                    </li>
                </ul>
                <div class="support">
                    <a href="#" class="text-need"> Need help?</a>
                    <ul class="mb-info">
                        <li>Call Us Now: <span class="number">1-555-678-8888</span></li>
                        <li>Support 24/7: <a href="#">info@randhawamarketing.com</a></li>
                        <li>
                            <div class="wrap-social">
                                <p>Follow us:</p>
                                <ul class="tf-social  style-2">
                                    <li>
                                        <a href="#">
                                            <i class="icon-fb"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-X"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-linked"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-ins"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <!-- /mobile-nav -->

    <!-- .prograss -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
            </path>
        </svg>
    </div> <!-- /.prograss -->
    <!-- Javascript -->
    <script type="text/javascript" src="{{ url('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/lazysize.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/swiper.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/main.js') }}"></script>
    <script defer src="../../../sibforms.com/forms/end-form/build/main.js"></script>
    <!-- /Javascript -->

</body>


<!-- Mirrored from themesflat.co/html/proty/blog-details by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Dec 2024 18:14:41 GMT -->
</html>