<!DOCTYPE html>
<!--[if IE 8]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->


<!-- Mirrored from themesflat.co/html/proty/property-detail-v3 by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Dec 2024 18:14:07 GMT -->
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
    <link rel="stylesheet" type="text/css" href="{{ url('css/magnific-popup.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/jquery.fancybox.min.css') }}" />
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
        <div class="main-content">


            <!-- section-property-detail -->
            <section class="section-property-detail  style-2">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-7">
                            <div class=" single-property-gallery style-1">
                                <div class="position-relative">
                                    <div class="swiper sw-single">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <a href="{{ url('images/section/property-details-v3-1.jpg') }}"
                                                    data-fancybox="gallery" class="image-wrap d-block">
                                                    <img class="lazyload"
                                                        data-src="{{ url('images/section/property-details-v3-1.jpg') }}"
                                                        src="{{ url('images/section/property-details-v3-1.jpg') }}" alt="">
                                                </a>
                                            </div>
                                            <div class="swiper-slide">
                                                <a href="{{ url('images/section/property-details-v3-2.jpg') }}"
                                                    data-fancybox="gallery" class="image-wrap d-block">
                                                    <img class="lazyload"
                                                        data-src="{{ url('images/section/property-details-v3-2.jpg') }}"
                                                        src="{{ url('images/section/property-details-v3-2.jpg') }}" alt="">
                                                </a>
                                            </div>
                                            <div class="swiper-slide">
                                                <a href="{{ url('images/section/property-details-v3-3.jpg') }}"
                                                    data-fancybox="gallery" class="image-wrap d-block">
                                                    <img class="lazyload"
                                                        data-src="{{ url('images/section/property-details-v3-3.jpg') }}"
                                                        src="{{ url('images/section/property-details-v3-3.jpg') }}" alt="">
                                                </a>
                                            </div>
                                            <div class="swiper-slide">
                                                <a href="{{ url('images/section/property-details-v3-4.jpg') }}"
                                                    data-fancybox="gallery" class="image-wrap d-block">
                                                    <img class="lazyload"
                                                        data-src="{{ url('images/section/property-details-v3-4.jpg') }}"
                                                        src="{{ url('images/section/property-details-v3-4.jpg') }}" alt="">
                                                </a>
                                            </div>
                                            <div class="swiper-slide">
                                                <a href="{{ url('images/section/property-details-v3-5.jpg') }}"
                                                    data-fancybox="gallery" class="image-wrap d-block">
                                                    <img class="lazyload"
                                                        data-src="{{ url('images/section/property-details-v3-5.jpg') }}"
                                                        src="{{ url('images/section/property-details-v3-5.jpg') }}" alt="">
                                                </a>
                                            </div>
                                            <div class="swiper-slide">
                                                <a href="{{ url('images/section/property-details-v3-6.jpg') }}"
                                                    data-fancybox="gallery" class="image-wrap d-block">
                                                    <img class="lazyload"
                                                        data-src="{{ url('images/section/property-details-v3-6.jpg') }}"
                                                        src="{{ url('images/section/property-details-v3-6.jpg') }}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-navigation">
                                        <div class="swiper-button-prev sw-button style-2 sw-thumbs-prev">
                                            <i class="icon-arrow-left-1"></i>
                                        </div>
                                        <div class="swiper-button-next sw-button style-2 sw-thumbs-next">
                                            <i class="icon-arrow-right-1"></i>
                                        </div>
                                    </div>
                                    <div class="swiper thumbs-sw-pagi" data-preview="5" data-space="15"
                                        data-mobile-sm="5">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="img-thumb-pagi">
                                                    <img src="{{ url('images/section/sw-thumbs-1.jpg') }}" alt="images">
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="img-thumb-pagi">
                                                    <img src="{{ url('images/section/sw-thumbs-2.jpg') }}" alt="images">
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="img-thumb-pagi">
                                                    <img src="{{ url('images/section/sw-thumbs-3.jpg') }}" alt="images">
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="img-thumb-pagi">
                                                    <img src="{{ url('images/section/sw-thumbs-4.jpg') }}" alt="images">
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="img-thumb-pagi">
                                                    <img src="{{ url('images/section/sw-thumbs-5.jpg') }}" alt="images">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wg-property box-overview ">
                                <div class="heading flex justify-between">
                                    <div class="title text-5 fw-6 text-color-heading">
                                        Elegant studio flat
                                    </div>
                                    <div class="price text-5 fw-6 text-color-heading">
                                        $250,00
                                        <span class="h5 lh-30 fw-4 text-color-default">/month</span>
                                    </div>
                                </div>
                                <div class="info flex justify-between">
                                    <div class="feature">
                                        <p class="location text-1 flex items-center gap-10">
                                            <i class="icon-location"></i>102 Ingraham St, Brooklyn, NY 11237
                                        </p>
                                        <ul class="meta-list flex">
                                            <li class="text-1 flex"><span>3</span>Bed</li>
                                            <li class="text-1 flex"><span>3</span>Bath</li>
                                            <li class="text-1 flex"><span>4,043</span>Sqft</li>
                                        </ul>
                                    </div>
                                    <div class="action action-button-list">
                                        <ul class="list-action">
                                            <li><a href="#"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M15.75 6.1875C15.75 4.32375 14.1758 2.8125 12.234 2.8125C10.7828 2.8125 9.53625 3.657 9 4.86225C8.46375 3.657 7.21725 2.8125 5.76525 2.8125C3.825 2.8125 2.25 4.32375 2.25 6.1875C2.25 11.6025 9 15.1875 9 15.1875C9 15.1875 15.75 11.6025 15.75 6.1875Z"
                                                            stroke="#5C5E61" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </a></li>
                                            <li><a href="#"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M5.625 15.75L2.25 12.375M2.25 12.375L5.625 9M2.25 12.375H12.375M12.375 2.25L15.75 5.625M15.75 5.625L12.375 9M15.75 5.625H5.625"
                                                            stroke="#5C5E61" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </a></li>
                                            <li><a href="#"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M5.04 10.3718C4.86 10.3943 4.68 10.4183 4.5 10.4438M5.04 10.3718C7.66969 10.0418 10.3303 10.0418 12.96 10.3718M5.04 10.3718L4.755 13.5M12.96 10.3718C13.14 10.3943 13.32 10.4183 13.5 10.4438M12.96 10.3718L13.245 13.5L13.4167 15.3923C13.4274 15.509 13.4136 15.6267 13.3762 15.7378C13.3388 15.8489 13.2787 15.951 13.1996 16.0376C13.1206 16.1242 13.0244 16.1933 12.9172 16.2407C12.8099 16.288 12.694 16.3125 12.5767 16.3125H5.42325C4.92675 16.3125 4.53825 15.8865 4.58325 15.3923L4.755 13.5M4.755 13.5H3.9375C3.48995 13.5 3.06072 13.3222 2.74426 13.0057C2.42779 12.6893 2.25 12.2601 2.25 11.8125V7.092C2.25 6.28125 2.826 5.58075 3.62775 5.46075C4.10471 5.3894 4.58306 5.32764 5.0625 5.2755M13.2435 13.5H14.0618C14.2834 13.5001 14.5029 13.4565 14.7078 13.3718C14.9126 13.287 15.0987 13.1627 15.2555 13.006C15.4123 12.8493 15.5366 12.6632 15.6215 12.4585C15.7063 12.2537 15.75 12.0342 15.75 11.8125V7.092C15.75 6.28125 15.174 5.58075 14.3723 5.46075C13.8953 5.38941 13.4169 5.32764 12.9375 5.2755M12.9375 5.2755C10.3202 4.99073 7.67978 4.99073 5.0625 5.2755M12.9375 5.2755V2.53125C12.9375 2.0655 12.5595 1.6875 12.0938 1.6875H5.90625C5.4405 1.6875 5.0625 2.0655 5.0625 2.53125V5.2755M13.5 7.875H13.506V7.881H13.5V7.875ZM11.25 7.875H11.256V7.881H11.25V7.875Z"
                                                            stroke="#5C5E61" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </a></li>
                                            <li><a href="#"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M5.41251 8.18028C5.23091 7.85351 4.94594 7.5963 4.60234 7.44902C4.25874 7.30173 3.87596 7.27271 3.51408 7.36651C3.1522 7.46032 2.83171 7.67163 2.60293 7.96728C2.37414 8.26293 2.25 8.62619 2.25 9.00003C2.25 9.37387 2.37414 9.73712 2.60293 10.0328C2.83171 10.3284 3.1522 10.5397 3.51408 10.6335C3.87596 10.7273 4.25874 10.6983 4.60234 10.551C4.94594 10.4038 5.23091 10.1465 5.41251 9.81978M5.41251 8.18028C5.54751 8.42328 5.62476 8.70228 5.62476 9.00003C5.62476 9.29778 5.54751 9.57753 5.41251 9.81978M5.41251 8.18028L12.587 4.19478M5.41251 9.81978L12.587 13.8053M12.587 4.19478C12.6922 4.39288 12.8358 4.56803 13.0095 4.70998C13.1832 4.85192 13.3834 4.95782 13.5985 5.02149C13.8135 5.08515 14.0392 5.1053 14.2621 5.08075C14.4851 5.0562 14.7009 4.98745 14.897 4.87853C15.093 4.7696 15.2654 4.62267 15.404 4.44634C15.5427 4.27001 15.6448 4.06781 15.7043 3.85157C15.7639 3.63532 15.7798 3.40937 15.751 3.18693C15.7222 2.96448 15.6494 2.75 15.5368 2.55603C15.3148 2.17378 14.9518 1.89388 14.5256 1.77649C14.0995 1.6591 13.6443 1.71359 13.2579 1.92824C12.8715 2.1429 12.5848 2.50059 12.4593 2.92442C12.3339 3.34826 12.3797 3.80439 12.587 4.19478ZM12.587 13.8053C12.4794 13.9991 12.4109 14.2121 12.3856 14.4324C12.3603 14.6526 12.3787 14.8757 12.4396 15.0888C12.5005 15.3019 12.6028 15.501 12.7406 15.6746C12.8784 15.8482 13.0491 15.993 13.2429 16.1007C13.4367 16.2083 13.6498 16.2767 13.87 16.302C14.0902 16.3273 14.3133 16.309 14.5264 16.2481C14.7396 16.1872 14.9386 16.0849 15.1122 15.9471C15.2858 15.8092 15.4306 15.6386 15.5383 15.4448C15.7557 15.0534 15.8087 14.5917 15.6857 14.1613C15.5627 13.7308 15.2737 13.3668 14.8824 13.1494C14.491 12.932 14.0293 12.879 13.5989 13.002C13.1684 13.125 12.8044 13.4139 12.587 13.8053Z"
                                                            stroke="#5C5E61" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="info-detail ">
                                    <div class="wrap-box">
                                        <div class="box-icon">
                                            <div class="icons">
                                                <i class="icon-HouseLine"></i>
                                            </div>
                                            <div class="content">
                                                <div class="text-4 text-color-default">ID:</div>
                                                <div class="text-1 text-color-heading">2297</div>
                                            </div>
                                        </div>
                                        <div class="box-icon">
                                            <div class="icons">
                                                <i class="icon-Bathtub"></i>
                                            </div>
                                            <div class="content">
                                                <div class="text-4 text-color-default">Bathrooms:</div>
                                                <div class="text-1 text-color-heading">2 Rooms</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wrap-box">
                                        <div class="box-icon">
                                            <div class="icons">
                                                <i class="icon-SlidersHorizontal"></i>
                                            </div>
                                            <div class="content">
                                                <div class="text-4 text-color-default">Type:</div>
                                                <div class="text-1 text-color-heading">Hourse</div>
                                            </div>
                                        </div>
                                        <div class="box-icon">
                                            <div class="icons">
                                                <i class="icon-Crop"></i>
                                            </div>
                                            <div class="content">
                                                <div class="text-4 text-color-default">Land Size:</div>
                                                <div class="text-1 text-color-heading">2,000 SqFt</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wrap-box">
                                        <div class="box-icon">
                                            <div class="icons">
                                                <i class="icon-Garage-1"></i>
                                            </div>
                                            <div class="content">
                                                <div class="text-4 text-color-default">Garages</div>
                                                <div class="text-1 text-color-heading">1</div>
                                            </div>
                                        </div>
                                        <div class="box-icon">
                                            <div class="icons">
                                                <i class="icon-Hammer"></i>
                                            </div>
                                            <div class="content">
                                                <div class="text-4 text-color-default">Year Built:</div>
                                                <div class="text-1 text-color-heading">2023</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wrap-box">
                                        <div class="box-icon">
                                            <div class="icons">
                                                <i class="icon-Bed-2"></i>
                                            </div>
                                            <div class="content">
                                                <div class="text-4 text-color-default">Bedrooms:</div>
                                                <div class="text-1 text-color-heading">2 Rooms</div>
                                            </div>
                                        </div>
                                        <div class="box-icon">
                                            <div class="icons">
                                                <i class="icon-Ruler"></i>
                                            </div>
                                            <div class="content">
                                                <div class="text-4 text-color-default">Size:</div>
                                                <div class="text-1 text-color-heading">900 SqFt</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="tf-btn bg-color-primary pd-21 fw-6">Ask a question</a>
                            </div>
                            <div class=" wg-property video spacing-2">
                                <div class="wg-title text-11 fw-6 text-color-heading">
                                    Video
                                </div>
                                <div class="widget-video">
                                    <img class="lazyload" data-src="{{ url('images/section/property-detail.jpg') }}"
                                        src="{{ url('images/section/property-detail.jpg') }}" alt="">
                                    <a href="https://www.youtube.com/watch?v=MLpWrANjFbI" class="popup-youtube">
                                        <i class="icon-play"></i></a>
                                </div>
                            </div>
                            <div class="wg-property box-property-detail  spacing-1">
                                <div class="wg-title text-11 fw-6 text-color-heading">
                                    Property Details
                                </div>
                                <div class="content">
                                    <p class="description text-1 mb-10">3 Units in North Hollywood with upside
                                        potential
                                        through
                                        construction of an ADU (buyer to verify). Unit mix consists of (3) 3+1 bath
                                        units.
                                        The building is a total of 2, 660 square feet and situated on a 6, 001
                                        square
                                        foot
                                        lot. Easy access to the 101, 170, and 134 freeways. The building is
                                        separately
                                        metered for gas and electricity.</p>
                                    <a href="#" class="tf-btn-link style-hover-rotate">
                                        <span>Read More
                                        </span>
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_2348_5612)">
                                                <path
                                                    d="M1.66732 9.99999C1.66732 14.6024 5.39828 18.3333 10.0007 18.3333C14.603 18.3333 18.334 14.6024 18.334 9.99999C18.334 5.39762 14.603 1.66666 10.0007 1.66666C5.39828 1.66666 1.66732 5.39762 1.66732 9.99999Z"
                                                    stroke="#F1913D" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M10 6.66666L10 13.3333" stroke="#F1913D" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M6.66732 10L10.0007 13.3333L13.334 10" stroke="#F1913D"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_2348_5612">
                                                    <rect width="20" height="20" fill="white"
                                                        transform="translate(20) rotate(90)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </a>
                                </div>
                                <div class="box">
                                    <ul>
                                        <li class="flex">
                                            <p class="fw-6">ID</p>
                                            <p>#1234</p>
                                        </li>
                                        <li class="flex">
                                            <p class="fw-6">Price</p>
                                            <p>$7,500</p>
                                        </li>
                                        <li class="flex">
                                            <p class="fw-6">Size</p>
                                            <p>150 sqft</p>
                                        </li>
                                        <li class="flex">
                                            <p class="fw-6">Rooms</p>
                                            <p>9</p>
                                        </li>
                                        <li class="flex">
                                            <p class="fw-6">Baths</p>
                                            <p>3</p>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li class="flex">
                                            <p class="fw-6">Beds</p>
                                            <p>7.328</p>
                                        </li>
                                        <li class="flex">
                                            <p class="fw-6">Year buit</p>
                                            <p>2022</p>
                                        </li>
                                        <li class="flex">
                                            <p class="fw-6">Type</p>
                                            <p>Villa</p>
                                        </li>
                                        <li class="flex">
                                            <p class="fw-6">Status</p>
                                            <p>For sale</p>
                                        </li>
                                        <li class="flex">
                                            <p class="fw-6">Garage</p>
                                            <p>1</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="wg-property box-amenities spacing-3">
                                <div class="wg-title text-11 fw-6 text-color-heading">
                                    Amenities And Features
                                </div>
                                <div class="wrap-feature">
                                    <div class="box-feature">
                                        <ul>
                                            <li class="feature-item">
                                                Smoke alarm
                                            </li>
                                            <li class="feature-item">
                                                Carbon monoxide alarm
                                            </li>
                                            <li class="feature-item">
                                                First aid kit
                                            </li>
                                            <li class="feature-item">
                                                Self check-in with lockbox
                                            </li>
                                            <li class="feature-item">
                                                Security cameras
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="box-feature">
                                        <ul>
                                            <li class="feature-item">
                                                Hangers
                                            </li>
                                            <li class="feature-item">
                                                Bed linens
                                            </li>
                                            <li class="feature-item">
                                                Extra pillows & blankets
                                            </li>
                                            <li class="feature-item">
                                                Iron
                                            </li>
                                            <li class="feature-item">
                                                TV with standard cable
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="box-feature">
                                        <ul>
                                            <li class="feature-item">
                                                Refrigerator
                                            </li>
                                            <li class="feature-item">
                                                Microwave
                                            </li>
                                            <li class="feature-item">
                                                Dishwasher
                                            </li>
                                            <li class="feature-item">
                                                Coffee maker
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="wg-property single-property-map spacing-9">
                                <div class="wg-title text-11 fw-6 text-color-heading">Get Direction</div>
                                <iframe class="map"
                                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d135905.11693909427!2d-73.95165795400088!3d41.17584829642291!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1727094281524!5m2!1sen!2s"
                                    style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                                <div class="info-map">
                                    <ul class="box-left">
                                        <li>
                                            <span class="label fw-6">Address</span>
                                            <div class="text text-variant-1">150 sqft</div>
                                        </li>
                                        <li>
                                            <span class="label fw-6">City</span>
                                            <div class="text text-variant-1">#1234</div>
                                        </li>
                                        <li>
                                            <span class="label fw-6">State/county</span>
                                            <div class="text text-variant-1">$7,500</div>
                                        </li>
                                    </ul>
                                    <ul class="box-right">
                                        <li>
                                            <span class="label fw-6">Postal code</span>
                                            <div class="text text-variant-1">7.328</div>
                                        </li>
                                        <li>
                                            <span class="label fw-6">Area</span>
                                            <div class="text text-variant-1">7.328</div>
                                        </li>
                                        <li>
                                            <span class="label fw-6">Country</span>
                                            <div class="text text-variant-1">2024</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="wg-property single-property-floor spacing-4">
                                <div class="wg-title text-11 fw-6 text-color-heading">Floor Plans</div>
                                <ul class="box-floor" id="parent-floor">
                                    <li class="floor-item">
                                        <div class="floor-header" data-bs-target="#floor-one" role="button"
                                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="floor-one">
                                            <div class="inner-left">
                                                <i class="icon icon-CaretDown"></i>
                                                <span class="text-btn">First Floor</span>
                                            </div>
                                            <ul class="inner-right">
                                                <li class="flex items-center gap-8">
                                                    <i class="icon icon-beds-3"></i>
                                                    2 Bedroom
                                                </li>
                                                <li class="flex items-center gap-8">
                                                    <i class="icon icon-baths"></i>
                                                    2 Bathroom
                                                </li>
                                            </ul>
                                        </div>
                                        <div id="floor-one" class="collapse show" data-bs-parent="#parent-floor">
                                            <div class="faq-body">
                                                <div class="box-img">
                                                    <img src="{{ url('images/section/floor.jpg') }}" alt="img-floor">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="floor-item">
                                        <div class="floor-header collapsed" role="button" data-bs-target="#floor-two"
                                            data-bs-toggle="collapse" aria-expanded="false" aria-controls="floor-two">
                                            <div class="inner-left">
                                                <i class="icon icon-CaretDown"></i>
                                                <span class="text-btn">Second Floor</span>
                                            </div>
                                            <ul class="inner-right">
                                                <li class="flex items-center gap-8">
                                                    <i class="icon icon-beds-3"></i>
                                                    2 Bedroom
                                                </li>
                                                <li class="flex items-center gap-8">
                                                    <i class="icon icon-baths"></i>
                                                    2 Bathroom
                                                </li>
                                            </ul>
                                        </div>
                                        <div id="floor-two" class="collapse" data-bs-parent="#parent-floor">
                                            <div class="faq-body">
                                                <div class="box-img">
                                                    <img src="{{ url('images/section/floor.jpg') }}" alt="img-floor">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="wg-property box-attachments spacing-5">
                                <div class="wg-title text-11 fw-6 text-color-heading">File Attachments</div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="#" target="_blank" class="attachments-item">
                                            <div class="box-icon w-60">
                                                <img src="{{ url('images/items/download-1.png') }}" alt="file">
                                            </div>
                                            <span>Villa-Document.pdf</span>
                                            <i class="icon icon-DownloadSimple"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="#" target="_blank" class="attachments-item">
                                            <div class="box-icon w-60">
                                                <img src="{{ url('images/items/download-2.png') }}" alt="file">
                                            </div>
                                            <span>Villa-Document.pdf</span>
                                            <i class="icon icon-DownloadSimple"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="wg-property box-virtual-tour spacing-6">
                                <div class="wg-title text-11 fw-6 text-color-heading">360 Virtual Tour</div>
                                <div class="image-wrap">
                                    <img src="{{ url('images/section/property-detail-2.jpg') }}" alt="">
                                    <div class="box-icon">
                                        <div class="icons">
                                            <i class="icon-360"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wg-property box-loan spacing-4">
                                <div class="wg-title text-11 fw-6 text-color-heading">Loan Calculator</div>
                                <form class="form-pre-approved">
                                    <div class="cols ">
                                        <fieldset>
                                            <label class=" text-1 fw-6 mb-12" for="amount">Total Amount</label>
                                            <input type="number" id="amount" placeholder="1000">
                                        </fieldset>
                                        <div class="wrap-input">
                                            <fieldset class="payment">
                                                <label class="text-1 fw-6 mb-12" for="payment">Down Payment</label>
                                                <input type="number" id="payment" placeholder="2000">
                                            </fieldset>
                                            <fieldset class="percent">
                                                <input class="input-percent" type="text" value="20%">
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="cols">
                                        <fieldset class="interest-rate">
                                            <label class="text-1 fw-6 mb-12" for="interest-rate">Interest
                                                Rate</label>
                                            <input type="number" id="interest-rate" placeholder="0">
                                        </fieldset>
                                        <div class="select">
                                            <label class="text-1 fw-6 mb-12">Amortization Period (months)</label>
                                            <div class="nice-select" tabindex="0">
                                                <span class="current">Select amortization period</span>
                                                <ul class="list">
                                                    <li data-value class="option selected">Select amortization
                                                        period
                                                    </li>
                                                    <li data-value="1 month" class="option">1 month</li>
                                                    <li data-value="2 months" class="option">2 months</li>
                                                    <li data-value="3 months" class="option">3 months</li>
                                                    <li data-value="4 months" class="option">4 months</li>
                                                    <li data-value="5 months" class="option">5 months</li>
                                                    <li data-value="6 months" class="option">6 months</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cols">
                                        <fieldset>
                                            <label class=" text-1 fw-6 mb-12" for="tax">Property Tax</label>
                                            <input type="number" id="tax" placeholder="$3000">
                                        </fieldset>
                                        <fieldset>
                                            <label class=" text-1 fw-6 mb-12" for="insurance">Home Insurance</label>
                                            <input type="number" id="insurance" placeholder="$3000">
                                        </fieldset>
                                    </div>

                                    <div class="wrap-btn flex items-center justify-between ">
                                        <a href="#" class="tf-btn bg-color-primary  pd-22 fw-7">
                                            Calculate now <i class="icon-arrow-right-2 fw-4
                                            "></i>
                                        </a>
                                        <p class="text-1 mb-0 fw-5 text-color-heading">Your estimated monthly
                                            payment:
                                            <span>$599.25</span>
                                        </p>
                                    </div>
                                </form>
                            </div>
                            <div class="wg-property single-property-nearby spacing-7">
                                <div class="wg-title text-11 fw-6 text-color-heading">What’s Nearby?</div>
                                <p class="description text-color-default">Explore nearby amenities to precisely
                                    locate
                                    your property and identify surrounding conveniences, providing a comprehensive
                                    overview of the living environment and the property's convenience.</p>
                                <div class="row box-nearby">
                                    <div class="col-md-5">
                                        <ul class="box-left">
                                            <li class="item-nearby">
                                                <span class="fw-7 label text-4">School:</span>
                                                <span>0.7 km</span>
                                            </li>
                                            <li class="item-nearby">
                                                <span class="fw-7 label text-4">University:</span>
                                                <span>1.3 km</span>
                                            </li>
                                            <li class="item-nearby">
                                                <span class="fw-7 label text-4">Grocery center:</span>
                                                <span>0.6 km</span>
                                            </li>
                                            <li class="item-nearby">
                                                <span class="fw-7 label text-4">Market:</span>
                                                <span>1.1 km</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-5">
                                        <ul class="box-right">
                                            <li class="item-nearby">
                                                <span class="fw-7 label text-4">Hospital:</span>
                                                <span>0.4 km</span>
                                            </li>
                                            <li class="item-nearby">
                                                <span class="fw-7 label text-4">Metro station:</span>
                                                <span>1.8 km</span>
                                            </li>
                                            <li class="item-nearby">
                                                <span class="fw-7 label text-4">Gym, wellness:</span>
                                                <span>1.3 km</span>
                                            </li>
                                            <li class="item-nearby">
                                                <span class="fw-7 label text-4">River:</span>
                                                <span>2.1 km</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="wg-property mb-0 box-comment spacing-8">
                                <div class="wrap-comment">
                                    <h4 class="title">Guest Reviews</h4>
                                    <ul class="comment-list">
                                        <li>
                                            <div class="comment-item">
                                                <div class="image-wrap">
                                                    <img src="{{ url('images/avatar/avatar-1.jpg') }}" alt="">
                                                </div>
                                                <div class="content">
                                                    <div class="user">
                                                        <div class="author ">
                                                            <h6 class="name mb-5">Viola Lucas</h6>
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
                                                        <p>It's really easy to use and it is exactly what I am
                                                            looking
                                                            for.
                                                            A lot of good looking templates & it's highly
                                                            customizable.
                                                            Live
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
                                                            <h6 class="name mb-5">Viola Lucas</h6>
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
                                                        <p>It's really easy to use and it is exactly what I am
                                                            looking
                                                            for.
                                                            A lot of good looking templates & it's highly
                                                            customizable.
                                                            Live
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
                                                            <h6 class="name mb-5">Viola Lucas</h6>
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
                                                        <p>It's really easy to use and it is exactly what I am
                                                            looking
                                                            for.
                                                            A lot of good looking templates & it's highly
                                                            customizable.
                                                            Live
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
                                        <span>View all reivew <i class="icon-arrow-right-2 fw-4
                                            "></i></span>
                                    </a>
                                </div>
                                <div class="box-send ">
                                    <div class="heading-box">
                                        <h4 class="title fw-7">Add Review</h4>
                                        <p>Your email address will not be published</p>
                                    </div>
                                    <form class="form-add-review">
                                        <div class="cols">
                                            <fieldset class="name">
                                                <label class="text-1 fw-6 " for="name1">Name</label>
                                                <input type="text" class="tf-input style-2" placeholder="Your Name*"
                                                    tabindex="2" aria-required="true" id="name1" name="name" required>
                                            </fieldset>
                                            <fieldset class="email">
                                                <label class="text-1 fw-6" for="email1">Email</label>
                                                <input type="email" class="tf-input style-2" placeholder="Your Email*"
                                                    tabindex="2" aria-required="true" id="email1" name="email" required>
                                            </fieldset>
                                        </div>
                                        <div class="checkbox-item style-1">
                                            <label>
                                                <span class="text-1 fw-4">Save your name, email for the next time
                                                    review</span>
                                                <input type="checkbox">
                                                <span class="btn-checkbox"></span>
                                            </label>
                                        </div>
                                        <fieldset class="message">
                                            <label class="text-1 fw-6" for="message">Review</label>
                                            <textarea id="message" class="tf-input" name="message" rows="4"
                                                placeholder="Your review" tabindex="4" aria-required="true"
                                                required></textarea>
                                        </fieldset>
                                        <button class="tf-btn bg-color-primary pd-24 fw-7" type="submit">
                                            Post Comment <i class="icon-arrow-right-2 fw-4
                                            "></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-4 col-lg-5">
                            <div class=" tf-sidebar sticky-sidebar ">
                                <form class="form-contact-seller mb-30">
                                    <h4 class="heading-title mb-30">
                                        Contact Sellers
                                    </h4>
                                    <div class="seller-info">
                                        <div class="avartar">
                                            <img src="{{ url('images/avatar/seller.jpg') }}" alt="">
                                        </div>
                                        <div class="content">
                                            <h6 class="name">Shara Conner</h6>
                                            <ul class="contact">
                                                <li><i class="icon-phone-1"></i><span>0333-1929762</span></li>
                                                <li><i class="icon-mail"></i><a href="#">info@randhawamarketing.com</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <fieldset class="mb-12">
                                        <input type="text" class="form-control" placeholder="Full Name" name="name"
                                            id="name2" required>
                                    </fieldset>
                                    <fieldset class="mb-30">
                                        <textarea name="message" cols="30" rows="10" placeholder="How can an agent help"
                                            id="message2" required></textarea>
                                    </fieldset>

                                    <a href="#" class="tf-btn bg-color-primary w-full">
                                        Send message</a>
                                </form>
                                <div class=" sidebar-ads mb-30">
                                    <div class="image-wrap">
                                        <img class="lazyload" data-src="{{ url('images/blog/ads.jpg') }}" src="{{ url('images/blog/ads.jpg') }}"
                                            alt="">
                                    </div>
                                    <div class="logo relative z-5">
                                        <img src="{{ url('images/logo/logo-2%402x.png') }}" alt="">
                                    </div>
                                    <div class="box-ads relative z-5">
                                        <div class="content ">
                                            <h4 class="title"><a href="property-detail-v1">We can help you find
                                                    a
                                                    local real estate agent</a> </h4>
                                            <div class="text-addres ">
                                                <p>Connect with a trusted agent who knows the market inside out -
                                                    whether you’re buying or selling.</p>
                                            </div>
                                        </div>
                                        <a href="#" class="tf-btn fw-6 bg-color-primary fw-6 w-full">
                                            Connect with an agent
                                        </a>
                                    </div>
                                </div>
                                <form class="form-contact-agent">
                                    <h4 class="heading-title mb-30">
                                        More About This Property
                                    </h4>
                                    <fieldset>
                                        <input type="text" class="form-control" placeholder="Your name" name="name"
                                            id="name3" required>
                                    </fieldset>
                                    <fieldset>
                                        <input type="text" class="form-control" placeholder="Email" name="email"
                                            id="email3" required>
                                    </fieldset>
                                    <fieldset class="phone">
                                        <input type="text" class="form-control " placeholder="Phone" name="phone"
                                            id="phone" required>
                                    </fieldset>
                                    <fieldset>
                                        <textarea name="message" cols="30" rows="10" placeholder="Message" id="message3"
                                            required></textarea>
                                    </fieldset>
                                    <div class="wrap-btn">
                                        <a href="#" class="tf-btn bg-color-primary fw-6 w-full"><svg width="20"
                                                height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18.125 5.625V14.375C18.125 14.8723 17.9275 15.3492 17.5758 15.7008C17.2242 16.0525 16.7473 16.25 16.25 16.25H3.75C3.25272 16.25 2.77581 16.0525 2.42417 15.7008C2.07254 15.3492 1.875 14.8723 1.875 14.375V5.625M18.125 5.625C18.125 5.12772 17.9275 4.65081 17.5758 4.29917C17.2242 3.94754 16.7473 3.75 16.25 3.75H3.75C3.25272 3.75 2.77581 3.94754 2.42417 4.29917C2.07254 4.65081 1.875 5.12772 1.875 5.625M18.125 5.625V5.8275C18.125 6.14762 18.0431 6.46242 17.887 6.74191C17.7309 7.0214 17.5059 7.25628 17.2333 7.42417L10.9833 11.27C10.6877 11.4521 10.3472 11.5485 10 11.5485C9.65275 11.5485 9.31233 11.4521 9.01667 11.27L2.76667 7.425C2.4941 7.25711 2.26906 7.02224 2.11297 6.74275C1.95689 6.46325 1.87496 6.14845 1.875 5.82833V5.625"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Email agent</a>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section-property-detail -->

            <!-- section-opinion -->
            <section class="section-similar-properties tf-spacing-3 ">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-12">
                            <div class="heading-section mb-32">
                                <h2 class="title ">Similar Properties</h2>
                            </div>
                            <div class="swiper style-pagination tf-sw-mobile-1" data-screen="991" data-preview="1"
                                data-space="15">
                                <div class="swiper-wrapper tf-layout-mobile-xl  lg-col-3 wrap-agent wow fadeInUp"
                                    data-wow-delay=".2s">
                                    <div class="swiper-slide">
                                        <div class="box-house hover-img">
                                            <div class="image-wrap">
                                                <a href="property-detail-v1">
                                                    <img class="lazyload" data-src="{{ url('images/section/box-house-21.jpg') }}"
                                                        src="{{ url('images/section/box-house-21.jpg') }}" alt="">
                                                </a>
                                                <ul class="box-tag flex gap-8 ">
                                                    <li class="flat-tag text-4 bg-main fw-6 text-white">Featured</li>
                                                    <li class="flat-tag text-4 bg-3 fw-6 text-white">For Sale</li>
                                                </ul>
                                                <div class="list-btn flex gap-8 ">
                                                    <a href="#" class="btn-icon save hover-tooltip"><i
                                                            class="icon-save"></i>
                                                        <span class="tooltip">Add Favorite</span>
                                                    </a>
                                                    <a href="#" class="btn-icon find hover-tooltip"><i
                                                            class="icon-find-plus"></i>
                                                        <span class="tooltip">Quick View</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <h5 class="title">
                                                    <a href="property-detail-v1">Elegant studio flat</a>

                                                </h5>
                                                <p class="location text-1 flex items-center gap-8">
                                                    <i class="icon-location"></i> 102 Ingraham St, Brooklyn, NY 11237
                                                </p>
                                                <ul class="meta-list flex">
                                                    <li class="text-1 flex"><span>3</span>Beds</li>
                                                    <li class="text-1 flex"><span>3</span>Baths</li>
                                                    <li class="text-1 flex"><span>4,043</span>Sqft</li>
                                                </ul>
                                                <div class="bot flex justify-between items-center">
                                                    <h5 class="price">
                                                        $8.600
                                                    </h5>
                                                    <div class="wrap-btn flex">
                                                        <a href="#" class="compare flex gap-8 items-center text-1"><i
                                                                class="icon-compare"></i>Compare
                                                        </a>
                                                        <a href="property-detail-v1"
                                                            class="tf-btn style-border pd-4">Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="box-house hover-img">
                                            <div class="image-wrap">
                                                <a href="property-detail-v1">
                                                    <img class="lazyload" data-src="{{ url('images/section/box-house-18.jpg') }}"
                                                        src="{{ url('images/section/box-house-18.jpg') }}" alt="">
                                                </a>
                                                <ul class="box-tag flex gap-8 ">
                                                    <li class="flat-tag text-4 bg-main fw-6 text-white">Featured</li>
                                                    <li class="flat-tag text-4 bg-3 fw-6 text-white">For Sale</li>
                                                </ul>
                                                <div class="list-btn flex gap-8 ">
                                                    <a href="#" class="btn-icon save hover-tooltip"><i
                                                            class="icon-save"></i>
                                                        <span class="tooltip">Add Favorite</span>
                                                    </a>
                                                    <a href="#" class="btn-icon find hover-tooltip"><i
                                                            class="icon-find-plus"></i>
                                                        <span class="tooltip">Quick View</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <h5 class="title">
                                                    <a href="property-detail-v1">Elegant studio flat</a>

                                                </h5>
                                                <p class="location text-1 flex items-center gap-8">
                                                    <i class="icon-location"></i> 102 Ingraham St, Brooklyn, NY 11237
                                                </p>
                                                <ul class="meta-list flex">
                                                    <li class="text-1 flex"><span>3</span>Beds</li>
                                                    <li class="text-1 flex"><span>3</span>Baths</li>
                                                    <li class="text-1 flex"><span>4,043</span>Sqft</li>
                                                </ul>
                                                <div class="bot flex justify-between items-center">
                                                    <h5 class="price">
                                                        $8.600
                                                    </h5>
                                                    <div class="wrap-btn flex">
                                                        <a href="#" class="compare flex gap-8 items-center text-1"><i
                                                                class="icon-compare"></i>Compare
                                                        </a>
                                                        <a href="property-detail-v1"
                                                            class="tf-btn style-border pd-4">Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="box-house hover-img">
                                            <div class="image-wrap">
                                                <a href="property-detail-v1">
                                                    <img class="lazyload" data-src="{{ url('images/section/box-house-15.jpg') }}"
                                                        src="{{ url('images/section/box-house-15.jpg') }}" alt="">
                                                </a>
                                                <ul class="box-tag flex gap-8 ">
                                                    <li class="flat-tag text-4 bg-main fw-6 text-white">Featured</li>
                                                    <li class="flat-tag text-4 bg-3 fw-6 text-white">For Sale</li>
                                                </ul>
                                                <div class="list-btn flex gap-8 ">
                                                    <a href="#" class="btn-icon save hover-tooltip"><i
                                                            class="icon-save"></i>
                                                        <span class="tooltip">Add Favorite</span>
                                                    </a>
                                                    <a href="#" class="btn-icon find hover-tooltip"><i
                                                            class="icon-find-plus"></i>
                                                        <span class="tooltip">Quick View</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <h5 class="title">
                                                    <a href="property-detail-v1">Elegant studio flat</a>

                                                </h5>
                                                <p class="location text-1 flex items-center gap-8">
                                                    <i class="icon-location"></i> 102 Ingraham St, Brooklyn, NY 11237
                                                </p>
                                                <ul class="meta-list flex">
                                                    <li class="text-1 flex"><span>3</span>Beds</li>
                                                    <li class="text-1 flex"><span>3</span>Baths</li>
                                                    <li class="text-1 flex"><span>4,043</span>Sqft</li>
                                                </ul>
                                                <div class="bot flex justify-between items-center">
                                                    <h5 class="price">
                                                        $8.600
                                                    </h5>
                                                    <div class="wrap-btn flex">
                                                        <a href="#" class="compare flex gap-8 items-center text-1"><i
                                                                class="icon-compare"></i>Compare
                                                        </a>
                                                        <a href="property-detail-v1"
                                                            class="tf-btn style-border pd-4">Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sw-pagination sw-pagination-mb-1 text-center d-lg-none d-block mt-20"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /section-opinion -->

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
    </div><!-- /wrapper -->

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
                    <li class="menu-item menu-item-has-children-mobile current-menu-item">
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
                                <li class="menu-item menu-item-has-children-mobile-2 current-menu-item">
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
                                            <li class="menu-item current-item">
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
                    <li class="menu-item menu-item-has-children-mobile">
                        <a href="#dropdown-menu-five" class="item-menu-mobile collapsed" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="dropdown-menu-five">
                            Blogs
                        </a>
                        <div id="dropdown-menu-five" class="collapse" data-bs-parent="#menu-mobile-menu">
                            <ul class="sub-mobile ">
                                <li class="menu-item"><a href="blog-grid">Blog Grid</a></li>
                                <li class="menu-item"><a href="blog-list">Blog List</a></li>
                                <li class="menu-item"><a href="blog-details">Blog Details </a></li>
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
    <script type="text/javascript" src="{{ url('js/magnific-popup.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/jquery.nice-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/swiper.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/jquery.fancybox.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/main.js') }}"></script>
    <script defer src="../../../sibforms.com/forms/end-form/build/main.js"></script>
    <!-- /Javascript -->

</body>


<!-- Mirrored from themesflat.co/html/proty/property-detail-v3 by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Dec 2024 18:14:13 GMT -->
</html>