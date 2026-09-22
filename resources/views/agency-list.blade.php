<!DOCTYPE html>
<!--[if IE 8]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->


<!-- Mirrored from themesflat.co/html/proty/agency-list by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Dec 2024 18:14:26 GMT -->
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8" />
    <!--[if IE ]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->
    <title>Agency List - Randhawa Marketing</title>

    <meta name="description"
        content="Propty is a website specializing in buying and renting properties, connecting buyers and tenants with trusted property owners. With an easy-to-use interface and detailed information, Propty offers a fast and convenient property search experience.">

    <meta name="keywords"
        content=" RealEstate, RealEstate, Buy, Rent, Homes, Apartment, Listings, Sale, Rental, Housing">

    <meta name="author" content="themesflat.com" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Theme Style -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/sib-styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/styles.css') }}" />  --}}
    <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/swiper-bundle.min.css') }}" />
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
        {{-- <div id="loading">
            <div id="loading-center">
                <div class="loader-container">
                    <div class="wrap-loader">
                        <div class="loader">
                        </div>
                        <div class="icon">
                            <img src="{{ url('images/logo/loading.png') }}" width="52px" height="52px">
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- /.preload -->

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
        <div class="main-content tf-spacing-6">

            <section class="section-agency-layout">
                <div class="tf-container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-7">
                            <div class="box-title ">
                                <h2>Agencies</h2>
                                <div class="right">

                                    <ul class="nav-tab-filter group-layout" role="tablist">
                                        <li class="nav-tab-item" role="presentation">
                                            <a href="#gridLayout" class=" btn-layout grid nav-link-item "
                                                data-bs-toggle="tab">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M5.04883 6.40508C5.04883 5.6222 5.67272 5 6.41981 5C7.16686 5 7.7908 5.62221 7.7908 6.40508C7.7908 7.18801 7.16722 7.8101 6.41981 7.8101C5.67241 7.8101 5.04883 7.18801 5.04883 6.40508Z"
                                                        stroke="#8E8E93" />
                                                    <path
                                                        d="M11.1045 6.40508C11.1045 5.62221 11.7284 5 12.4755 5C13.2229 5 13.8466 5.6222 13.8466 6.40508C13.8466 7.18789 13.2227 7.8101 12.4755 7.8101C11.7284 7.8101 11.1045 7.18794 11.1045 6.40508Z"
                                                        stroke="#8E8E93" />
                                                    <path
                                                        d="M19.9998 6.40514C19.9998 7.18797 19.3757 7.81016 18.6288 7.81016C17.8818 7.81016 17.2578 7.18794 17.2578 6.40508C17.2578 5.62211 17.8813 5 18.6288 5C19.3763 5 19.9998 5.62215 19.9998 6.40514Z"
                                                        stroke="#8E8E93" />
                                                    <path
                                                        d="M7.74249 12.5097C7.74249 13.2926 7.11849 13.9147 6.37133 13.9147C5.62411 13.9147 5 13.2926 5 12.5097C5 11.7267 5.62419 11.1044 6.37133 11.1044C7.11842 11.1044 7.74249 11.7266 7.74249 12.5097Z"
                                                        stroke="#8E8E93" />
                                                    <path
                                                        d="M13.7976 12.5097C13.7976 13.2927 13.1736 13.9147 12.4266 13.9147C11.6795 13.9147 11.0557 13.2927 11.0557 12.5097C11.0557 11.7265 11.6793 11.1044 12.4266 11.1044C13.1741 11.1044 13.7976 11.7265 13.7976 12.5097Z"
                                                        stroke="#8E8E93" />
                                                    <path
                                                        d="M19.9516 12.5097C19.9516 13.2927 19.328 13.9147 18.5807 13.9147C17.8329 13.9147 17.209 13.2925 17.209 12.5097C17.209 11.7268 17.8332 11.1044 18.5807 11.1044C19.3279 11.1044 19.9516 11.7265 19.9516 12.5097Z"
                                                        stroke="#8E8E93" />
                                                    <path
                                                        d="M5.04297 18.5947C5.04297 17.8118 5.66709 17.1896 6.4143 17.1896C7.16137 17.1896 7.78523 17.8116 7.78523 18.5947C7.78523 19.3778 7.16139 19.9997 6.4143 19.9997C5.66714 19.9997 5.04297 19.3773 5.04297 18.5947Z"
                                                        stroke="#8E8E93" />
                                                    <path
                                                        d="M11.0986 18.5947C11.0986 17.8118 11.7227 17.1896 12.47 17.1896C13.2169 17.1896 13.8409 17.8117 13.8409 18.5947C13.8409 19.3778 13.2169 19.9997 12.47 19.9997C11.7225 19.9997 11.0986 19.3774 11.0986 18.5947Z"
                                                        stroke="#8E8E93" />
                                                    <path
                                                        d="M17.252 18.5947C17.252 17.8117 17.876 17.1896 18.6229 17.1896C19.3699 17.1896 19.9939 17.8117 19.9939 18.5947C19.9939 19.3778 19.3702 19.9997 18.6229 19.9997C17.876 19.9997 17.252 19.3774 17.252 18.5947Z"
                                                        stroke="#8E8E93" />
                                                </svg>

                                            </a>
                                        </li>
                                        <li class="nav-tab-item" role="presentation">
                                            <a href="#listLayout" class="nav-link-item btn-layout list active"
                                                data-bs-toggle="tab">
                                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M19.7016 18.3317H9.00246C8.5615 18.3317 8.2041 17.9743 8.2041 17.5333C8.2041 17.0923 8.5615 16.7349 9.00246 16.7349H19.7013C20.1423 16.7349 20.4997 17.0923 20.4997 17.5333C20.4997 17.9743 20.1426 18.3317 19.7016 18.3317Z"
                                                        fill="#8E8E93" />
                                                    <path
                                                        d="M19.7016 13.3203H9.00246C8.5615 13.3203 8.2041 12.9629 8.2041 12.5219C8.2041 12.081 8.5615 11.7236 9.00246 11.7236H19.7013C20.1423 11.7236 20.4997 12.081 20.4997 12.5219C20.5 12.9629 20.1426 13.3203 19.7016 13.3203Z"
                                                        fill="#8E8E93" />
                                                    <path
                                                        d="M19.7016 8.30919H9.00246C8.5615 8.30919 8.2041 7.95179 8.2041 7.51083C8.2041 7.06986 8.5615 6.71246 9.00246 6.71246H19.7013C20.1423 6.71246 20.4997 7.06986 20.4997 7.51083C20.4997 7.95179 20.1426 8.30919 19.7016 8.30919Z"
                                                        fill="#8E8E93" />
                                                    <path
                                                        d="M5.5722 8.64465C6.16436 8.64465 6.6444 8.16461 6.6444 7.57245C6.6444 6.98029 6.16436 6.50024 5.5722 6.50024C4.98004 6.50024 4.5 6.98029 4.5 7.57245C4.5 8.16461 4.98004 8.64465 5.5722 8.64465Z"
                                                        fill="#8E8E93" />
                                                    <path
                                                        d="M5.5722 13.5942C6.16436 13.5942 6.6444 13.1141 6.6444 12.522C6.6444 11.9298 6.16436 11.4498 5.5722 11.4498C4.98004 11.4498 4.5 11.9298 4.5 12.522C4.5 13.1141 4.98004 13.5942 5.5722 13.5942Z"
                                                        fill="#8E8E93" />
                                                    <path
                                                        d="M5.5722 18.5438C6.16436 18.5438 6.6444 18.0637 6.6444 17.4716C6.6444 16.8794 6.16436 16.3994 5.5722 16.3994C4.98004 16.3994 4.5 16.8794 4.5 17.4716C4.5 18.0637 4.98004 18.5438 5.5722 18.5438Z"
                                                        fill="#8E8E93" />
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="nice-select select-filter list-sort" tabindex="0"><span
                                            class="current">Sort by (Default)</span>
                                        <ul class="list">
                                            <li data-value="default" class="option selected">Sort by (Default)</li>
                                            <li data-value="new" class="option">Newest</li>
                                            <li data-value="old" class="option">Oldest</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="flat-animate-tab">
                                <div class="tab-content">
                                    <div class="tab-pane " id="gridLayout" role="tabpanel">
                                        <div class="grid-layout-2">
                                            <div class="agencies-item style-2">
                                                <div class="bg-image">
                                                    <img src="{{ url('images/section/agencies-1.jpg') }}" alt="">
                                                </div>
                                                <div class="content-inner">
                                                    <div class="logo-wrap">
                                                        <img src="{{ url('images/brands/brand-7.jpg') }}" alt="">
                                                    </div>
                                                    <div class="content">
                                                        <div class="info">
                                                            <h6 class="name">
                                                                <a href="agency-details">Lorem House</a>

                                                            </h6>
                                                            <p class="location text-1 flex items-center gap-8">
                                                                102 Ingraham St, Brooklyn, NY 11237
                                                            </p>
                                                        </div>
                                                        <ul class="list-info">
                                                            <li><span>Listing:</span><span>7.328</span></li>
                                                            <li><span>Hotline:</span><span>+7-445-556-8337</span></li>
                                                            <li><span>Phone:</span><span>+7-445-556-8337</span></li>
                                                            <li><span>Email:</span><span>loremhouse@gmail.com</span>
                                                            </li>

                                                        </ul>
                                                        <div class="contact">
                                                            <ul class="list-link">
                                                                <li><a href="#"><i class="icon-phone-4"></i></a></li>
                                                                <li><a href="#"><i class="icon-letter-1"></i></a></li>
                                                                <li><a href="#"><i class="icon-connect"></i></a></li>
                                                            </ul>
                                                            <a href="agency-details"
                                                                class="tf-btn style-border pd-4">
                                                                Details
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="agencies-item style-2">
                                                <div class="bg-image">
                                                    <img src="{{ url('images/section/agencies-2.jpg') }}" alt="">
                                                </div>
                                                <div class="content-inner">
                                                    <div class="logo-wrap">
                                                        <img src="{{ url('images/brands/brand-1.jpg') }}" alt="">
                                                    </div>
                                                    <div class="content">
                                                        <div class="info">
                                                            <h6 class="name">
                                                                <a href="agency-details">Lorem House</a>

                                                            </h6>
                                                            <p class="location text-1 flex items-center gap-8">
                                                                102 Ingraham St, Brooklyn, NY 11237
                                                            </p>
                                                        </div>
                                                        <ul class="list-info">
                                                            <li><span>Listing:</span><span>7.328</span></li>
                                                            <li><span>Hotline:</span><span>+7-445-556-8337</span></li>
                                                            <li><span>Phone:</span><span>+7-445-556-8337</span></li>
                                                            <li><span>Email:</span><span>loremhouse@gmail.com</span>
                                                            </li>

                                                        </ul>
                                                        <div class="contact">
                                                            <ul class="list-link">
                                                                <li><a href="#"><i class="icon-phone-4"></i></a></li>
                                                                <li><a href="#"><i class="icon-letter-1"></i></a></li>
                                                                <li><a href="#"><i class="icon-connect"></i></a></li>
                                                            </ul>
                                                            <a href="agency-details"
                                                                class="tf-btn style-border pd-4">
                                                                Details
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="agencies-item style-2">
                                                <div class="bg-image">
                                                    <img src="{{ url('images/section/agencies-3.jpg') }}" alt="">
                                                </div>
                                                <div class="content-inner">
                                                    <div class="logo-wrap">
                                                        <img src="{{ url('images/brands/brand-4.jpg') }}" alt="">
                                                    </div>
                                                    <div class="content">
                                                        <div class="info">
                                                            <h6 class="name">
                                                                <a href="agency-details">Lorem House</a>

                                                            </h6>
                                                            <p class="location text-1 flex items-center gap-8">
                                                                102 Ingraham St, Brooklyn, NY 11237
                                                            </p>
                                                        </div>
                                                        <ul class="list-info">
                                                            <li><span>Listing:</span><span>7.328</span></li>
                                                            <li><span>Hotline:</span><span>+7-445-556-8337</span></li>
                                                            <li><span>Phone:</span><span>+7-445-556-8337</span></li>
                                                            <li><span>Email:</span><span>loremhouse@gmail.com</span>
                                                            </li>

                                                        </ul>
                                                        <div class="contact">
                                                            <ul class="list-link">
                                                                <li><a href="#"><i class="icon-phone-4"></i></a></li>
                                                                <li><a href="#"><i class="icon-letter-1"></i></a></li>
                                                                <li><a href="#"><i class="icon-connect"></i></a></li>
                                                            </ul>
                                                            <a href="agency-details"
                                                                class="tf-btn style-border pd-4">
                                                                Details
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="agencies-item style-2">
                                                <div class="bg-image">
                                                    <img src="{{ url('images/section/agencies-4.jpg') }}" alt="">
                                                </div>
                                                <div class="content-inner">
                                                    <div class="logo-wrap">
                                                        <img src="{{ url('images/brands/brand-2.jpg') }}" alt="">
                                                    </div>
                                                    <div class="content">
                                                        <div class="info">
                                                            <h6 class="name">
                                                                <a href="agency-details">Lorem House</a>

                                                            </h6>
                                                            <p class="location text-1 flex items-center gap-8">
                                                                102 Ingraham St, Brooklyn, NY 11237
                                                            </p>
                                                        </div>
                                                        <ul class="list-info">
                                                            <li><span>Listing:</span><span>7.328</span></li>
                                                            <li><span>Hotline:</span><span>+7-445-556-8337</span></li>
                                                            <li><span>Phone:</span><span>+7-445-556-8337</span></li>
                                                            <li><span>Email:</span><span>loremhouse@gmail.com</span>
                                                            </li>

                                                        </ul>
                                                        <div class="contact">
                                                            <ul class="list-link">
                                                                <li><a href="#"><i class="icon-phone-4"></i></a></li>
                                                                <li><a href="#"><i class="icon-letter-1"></i></a></li>
                                                                <li><a href="#"><i class="icon-connect"></i></a></li>
                                                            </ul>
                                                            <a href="agency-details"
                                                                class="tf-btn style-border pd-4">
                                                                Details
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="agencies-item style-2">
                                                <div class="bg-image">
                                                    <img src="{{ url('images/section/agencies-5.jpg') }}" alt="">
                                                </div>
                                                <div class="content-inner">
                                                    <div class="logo-wrap">
                                                        <img src="{{ url('images/brands/brand-8.jpg') }}" alt="">
                                                    </div>
                                                    <div class="content">
                                                        <div class="info">
                                                            <h6 class="name">
                                                                <a href="agency-details">Lorem House</a>

                                                            </h6>
                                                            <p class="location text-1 flex items-center gap-8">
                                                                102 Ingraham St, Brooklyn, NY 11237
                                                            </p>
                                                        </div>
                                                        <ul class="list-info">
                                                            <li><span>Listing:</span><span>7.328</span></li>
                                                            <li><span>Hotline:</span><span>+7-445-556-8337</span></li>
                                                            <li><span>Phone:</span><span>+7-445-556-8337</span></li>
                                                            <li><span>Email:</span><span>loremhouse@gmail.com</span>
                                                            </li>

                                                        </ul>
                                                        <div class="contact">
                                                            <ul class="list-link">
                                                                <li><a href="#"><i class="icon-phone-4"></i></a></li>
                                                                <li><a href="#"><i class="icon-letter-1"></i></a></li>
                                                                <li><a href="#"><i class="icon-connect"></i></a></li>
                                                            </ul>
                                                            <a href="agency-details"
                                                                class="tf-btn style-border pd-4">
                                                                Details
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="agencies-item style-2">
                                                <div class="bg-image">
                                                    <img src="{{ url('images/section/agencies-6.jpg') }}" alt="">
                                                </div>
                                                <div class="content-inner">
                                                    <div class="logo-wrap">
                                                        <img src="{{ url('images/brands/brand-6.jpg') }}" alt="">
                                                    </div>
                                                    <div class="content">
                                                        <div class="info">
                                                            <h6 class="name">
                                                                <a href="agency-details">Lorem House</a>

                                                            </h6>
                                                            <p class="location text-1 flex items-center gap-8">
                                                                102 Ingraham St, Brooklyn, NY 11237
                                                            </p>
                                                        </div>
                                                        <ul class="list-info">
                                                            <li><span>Listing:</span><span>7.328</span></li>
                                                            <li><span>Hotline:</span><span>+7-445-556-8337</span></li>
                                                            <li><span>Phone:</span><span>+7-445-556-8337</span></li>
                                                            <li><span>Email:</span><span>loremhouse@gmail.com</span>
                                                            </li>

                                                        </ul>
                                                        <div class="contact">
                                                            <ul class="list-link">
                                                                <li><a href="#"><i class="icon-phone-4"></i></a></li>
                                                                <li><a href="#"><i class="icon-letter-1"></i></a></li>
                                                                <li><a href="#"><i class="icon-connect"></i></a></li>
                                                            </ul>
                                                            <a href="agency-details"
                                                                class="tf-btn style-border pd-4">
                                                                Details
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="agencies-item style-2">
                                                <div class="bg-image">
                                                    <img src="{{ url('images/section/agencies-7.jpg') }}" alt="">
                                                </div>
                                                <div class="content-inner">
                                                    <div class="logo-wrap">
                                                        <img src="{{ url('images/brands/brand-9.jpg') }}" alt="">
                                                    </div>
                                                    <div class="content">
                                                        <div class="info">
                                                            <h6 class="name">
                                                                <a href="agency-details">Lorem House</a>

                                                            </h6>
                                                            <p class="location text-1 flex items-center gap-8">
                                                                102 Ingraham St, Brooklyn, NY 11237
                                                            </p>
                                                        </div>
                                                        <ul class="list-info">
                                                            <li><span>Listing:</span><span>7.328</span></li>
                                                            <li><span>Hotline:</span><span>+7-445-556-8337</span></li>
                                                            <li><span>Phone:</span><span>+7-445-556-8337</span></li>
                                                            <li><span>Email:</span><span>loremhouse@gmail.com</span>
                                                            </li>

                                                        </ul>
                                                        <div class="contact">
                                                            <ul class="list-link">
                                                                <li><a href="#"><i class="icon-phone-4"></i></a></li>
                                                                <li><a href="#"><i class="icon-letter-1"></i></a></li>
                                                                <li><a href="#"><i class="icon-connect"></i></a></li>
                                                            </ul>
                                                            <a href="agency-details"
                                                                class="tf-btn style-border pd-4">
                                                                Details
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="agencies-item style-2">
                                                <div class="bg-image">
                                                    <img src="{{ url('images/section/agencies-8.jpg') }}" alt="">
                                                </div>
                                                <div class="content-inner">
                                                    <div class="logo-wrap">
                                                        <img src="{{ url('images/brands/brand-5.jpg') }}" alt="">
                                                    </div>
                                                    <div class="content">
                                                        <div class="info">
                                                            <h6 class="name">
                                                                <a href="agency-details">Lorem House</a>

                                                            </h6>
                                                            <p class="location text-1 flex items-center gap-8">
                                                                102 Ingraham St, Brooklyn, NY 11237
                                                            </p>
                                                        </div>
                                                        <ul class="list-info">
                                                            <li><span>Listing:</span><span>7.328</span></li>
                                                            <li><span>Hotline:</span><span>+7-445-556-8337</span></li>
                                                            <li><span>Phone:</span><span>+7-445-556-8337</span></li>
                                                            <li><span>Email:</span><span>loremhouse@gmail.com</span>
                                                            </li>

                                                        </ul>
                                                        <div class="contact">
                                                            <ul class="list-link">
                                                                <li><a href="#"><i class="icon-phone-4"></i></a></li>
                                                                <li><a href="#"><i class="icon-letter-1"></i></a></li>
                                                                <li><a href="#"><i class="icon-connect"></i></a></li>
                                                            </ul>
                                                            <a href="agency-details"
                                                                class="tf-btn style-border pd-4">
                                                                Details
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane active show" id="listLayout" role="tabpanel">
                                        <div class="wrap-list">
                                            <div class="agencies-item">
                                                <div class="logo-wrap">
                                                    <img src="{{ url('images/brands/brand-1.jpg') }}" alt="">
                                                </div>
                                                <div class="content">
                                                    <div class="info">
                                                        <h6 class="name">
                                                            <a href="agency-details">Lorem House</a>

                                                        </h6>
                                                        <p class="location text-1 flex items-center gap-8">
                                                            <i class="icon-location"></i> 2118 Thornridge Cir. Syracuse,
                                                            Connecticut
                                                            35624
                                                        </p>
                                                    </div>
                                                    <p class="description text-1">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                                        ligula neque,
                                                        ornare
                                                        quis
                                                        urna nec, congue hendrerit turpis. Quisque nec diam varius,
                                                        iaculis enim
                                                        aliquam...
                                                    </p>
                                                    <div class="contact">
                                                        <ul class="list-link">
                                                            <li><a href="#"><i class="icon-phone-4"></i></a></li>
                                                            <li><a href="#"><i class="icon-letter-1"></i></a></li>
                                                            <li><a href="#"><i class="icon-connect"></i></a></li>
                                                        </ul>
                                                        <a href="agency-details" class="tf-btn style-border pd-4">
                                                            Details
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="agencies-item">
                                                <div class="logo-wrap">
                                                    <img src="{{ url('images/brands/brand-2.jpg') }}" alt="">
                                                </div>
                                                <div class="content">
                                                    <div class="info">
                                                        <h6 class="name">
                                                            <a href="agency-details">Lorem House</a>

                                                        </h6>
                                                        <p class="location text-1 flex items-center gap-8">
                                                            <i class="icon-location"></i> 2118 Thornridge Cir. Syracuse,
                                                            Connecticut
                                                            35624
                                                        </p>
                                                    </div>
                                                    <p class="description text-1">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                                        ligula neque,
                                                        ornare
                                                        quis
                                                        urna nec, congue hendrerit turpis. Quisque nec diam varius,
                                                        iaculis enim
                                                        aliquam...
                                                    </p>
                                                    <div class="contact">
                                                        <ul class="list-link">
                                                            <li><a href="#"><i class="icon-phone-4"></i></a></li>
                                                            <li><a href="#"><i class="icon-letter-1"></i></a></li>
                                                            <li><a href="#"><i class="icon-connect"></i></a></li>
                                                        </ul>
                                                        <a href="agency-details" class="tf-btn style-border pd-4">
                                                            Details
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="agencies-item">
                                                <div class="logo-wrap">
                                                    <img src="{{ url('images/brands/brand-3.jpg') }}" alt="">
                                                </div>
                                                <div class="content">
                                                    <div class="info">
                                                        <h6 class="name">
                                                            <a href="agency-details">Lorem House</a>

                                                        </h6>
                                                        <p class="location text-1 flex items-center gap-8">
                                                            <i class="icon-location"></i> 2118 Thornridge Cir. Syracuse,
                                                            Connecticut
                                                            35624
                                                        </p>
                                                    </div>
                                                    <p class="description text-1">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                                        ligula neque,
                                                        ornare
                                                        quis
                                                        urna nec, congue hendrerit turpis. Quisque nec diam varius,
                                                        iaculis enim
                                                        aliquam...
                                                    </p>
                                                    <div class="contact">
                                                        <ul class="list-link">
                                                            <li><a href="#"><i class="icon-phone-4"></i></a></li>
                                                            <li><a href="#"><i class="icon-letter-1"></i></a></li>
                                                            <li><a href="#"><i class="icon-connect"></i></a></li>
                                                        </ul>
                                                        <a href="agency-details" class="tf-btn style-border pd-4">
                                                            Details
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="agencies-item">
                                                <div class="logo-wrap">
                                                    <img src="{{ url('images/brands/brand-4.jpg') }}" alt="">
                                                </div>
                                                <div class="content">
                                                    <div class="info">
                                                        <h6 class="name">
                                                            <a href="agency-details">Lorem House</a>

                                                        </h6>
                                                        <p class="location text-1 flex items-center gap-8">
                                                            <i class="icon-location"></i> 2118 Thornridge Cir. Syracuse,
                                                            Connecticut
                                                            35624
                                                        </p>
                                                    </div>
                                                    <p class="description text-1">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                                        ligula neque,
                                                        ornare
                                                        quis
                                                        urna nec, congue hendrerit turpis. Quisque nec diam varius,
                                                        iaculis enim
                                                        aliquam...
                                                    </p>
                                                    <div class="contact">
                                                        <ul class="list-link">
                                                            <li><a href="#"><i class="icon-phone-4"></i></a></li>
                                                            <li><a href="#"><i class="icon-letter-1"></i></a></li>
                                                            <li><a href="#"><i class="icon-connect"></i></a></li>
                                                        </ul>
                                                        <a href="agency-details" class="tf-btn style-border pd-4">
                                                            Details
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="agencies-item">
                                                <div class="logo-wrap">
                                                    <img src="{{ url('images/brands/brand-5.jpg') }}" alt="">
                                                </div>
                                                <div class="content">
                                                    <div class="info">
                                                        <h6 class="name">
                                                            <a href="agency-details">Lorem House</a>

                                                        </h6>
                                                        <p class="location text-1 flex items-center gap-8">
                                                            <i class="icon-location"></i> 2118 Thornridge Cir. Syracuse,
                                                            Connecticut
                                                            35624
                                                        </p>
                                                    </div>
                                                    <p class="description text-1">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                                        ligula neque,
                                                        ornare
                                                        quis
                                                        urna nec, congue hendrerit turpis. Quisque nec diam varius,
                                                        iaculis enim
                                                        aliquam...
                                                    </p>
                                                    <div class="contact">
                                                        <ul class="list-link">
                                                            <li><a href="#"><i class="icon-phone-4"></i></a></li>
                                                            <li><a href="#"><i class="icon-letter-1"></i></a></li>
                                                            <li><a href="#"><i class="icon-connect"></i></a></li>
                                                        </ul>
                                                        <a href="agency-details" class="tf-btn style-border pd-4">
                                                            Details
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="agencies-item">
                                                <div class="logo-wrap">
                                                    <img src="{{ url('images/brands/brand-6.jpg') }}" alt="">
                                                </div>
                                                <div class="content">
                                                    <div class="info">
                                                        <h6 class="name">
                                                            <a href="agency-details">Lorem House</a>

                                                        </h6>
                                                        <p class="location text-1 flex items-center gap-8">
                                                            <i class="icon-location"></i> 2118 Thornridge Cir. Syracuse,
                                                            Connecticut
                                                            35624
                                                        </p>
                                                    </div>
                                                    <p class="description text-1">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                                                        ligula neque,
                                                        ornare
                                                        quis
                                                        urna nec, congue hendrerit turpis. Quisque nec diam varius,
                                                        iaculis enim
                                                        aliquam...
                                                    </p>
                                                    <div class="contact">
                                                        <ul class="list-link">
                                                            <li><a href="#"><i class="icon-phone-4"></i></a></li>
                                                            <li><a href="#"><i class="icon-letter-1"></i></a></li>
                                                            <li><a href="#"><i class="icon-connect"></i></a></li>
                                                        </ul>
                                                        <a href="agency-details" class="tf-btn style-border pd-4">
                                                            Details
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ul class="wg-pagination ">
                                <li class="arrow">
                                    <a href="#"><i class="icon-arrow-left"></i></a>
                                </li>
                                <li>
                                    <a href="#">1</a>
                                </li>
                                <li class="active">
                                    <a href="#">2</a>
                                </li>
                                <li>
                                    <a href="#">...</a>
                                </li>
                                <li>
                                    <a href="#">20</a>
                                </li>
                                <li class="arrow">
                                    <a href="#"><i class="icon-arrow-right"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-4 col-lg-5">
                            <div class=" tf-sidebar">
                                <form class="form-contact-agent style-2 mb-30">
                                    <h4 class="heading-title mb-30">
                                        Contact Me
                                    </h4>
                                    <fieldset>
                                        <input type="text" class="form-control" placeholder="Your name" name="name"
                                            id="name" required>
                                    </fieldset>
                                    <fieldset>
                                        <input type="text" class="form-control" placeholder="Email" name="email"
                                            id="email" required>
                                    </fieldset>
                                    <fieldset class="phone">
                                        <input type="text" class="form-control " placeholder="Phone" name="phone"
                                            id="phone" required>
                                    </fieldset>
                                    <fieldset>
                                        <textarea name="message" cols="30" rows="10" placeholder="Message"
                                            name="message" id="message" required></textarea>
                                    </fieldset>
                                    <div class="wrap-btn">
                                        <a href="#" class="tf-btn bg-color-primary w-full"><svg width="20" height="20"
                                                viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18.125 5.625V14.375C18.125 14.8723 17.9275 15.3492 17.5758 15.7008C17.2242 16.0525 16.7473 16.25 16.25 16.25H3.75C3.25272 16.25 2.77581 16.0525 2.42417 15.7008C2.07254 15.3492 1.875 14.8723 1.875 14.375V5.625M18.125 5.625C18.125 5.12772 17.9275 4.65081 17.5758 4.29917C17.2242 3.94754 16.7473 3.75 16.25 3.75H3.75C3.25272 3.75 2.77581 3.94754 2.42417 4.29917C2.07254 4.65081 1.875 5.12772 1.875 5.625M18.125 5.625V5.8275C18.125 6.14762 18.0431 6.46242 17.887 6.74191C17.7309 7.0214 17.5059 7.25628 17.2333 7.42417L10.9833 11.27C10.6877 11.4521 10.3472 11.5485 10 11.5485C9.65275 11.5485 9.31233 11.4521 9.01667 11.27L2.76667 7.425C2.4941 7.25711 2.26906 7.02224 2.11297 6.74275C1.95689 6.46325 1.87496 6.14845 1.875 5.82833V5.625"
                                                    stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Send message</a>
                                        <a href="#" class="tf-btn style-border pd-9 "><svg width="21" height="20"
                                                viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.375 8.125V4.375M12.375 8.125H16.125M12.375 8.125L17.375 3.125M14.875 18.125C7.97167 18.125 2.375 12.5283 2.375 5.625V3.75C2.375 3.25272 2.57254 2.77581 2.92417 2.42417C3.27581 2.07254 3.75272 1.875 4.25 1.875H5.39333C5.82333 1.875 6.19833 2.1675 6.3025 2.585L7.22417 6.27083C7.31583 6.6375 7.17917 7.0225 6.87667 7.24833L5.79917 8.05667C5.64494 8.16831 5.53083 8.32672 5.47379 8.50837C5.41674 8.69002 5.4198 8.88523 5.4825 9.065C5.98406 10.4293 6.77618 11.6682 7.80398 12.696C8.83179 13.7238 10.0707 14.5159 11.435 15.0175C11.8025 15.1525 12.2083 15.0142 12.4433 14.7008L13.2517 13.6233C13.3623 13.4756 13.5141 13.3639 13.688 13.3021C13.8619 13.2402 14.0501 13.2311 14.2292 13.2758L17.915 14.1975C18.3317 14.3017 18.625 14.6767 18.625 15.1067V16.25C18.625 16.7473 18.4275 17.2242 18.0758 17.5758C17.7242 17.9275 17.2473 18.125 16.75 18.125H14.875Z"
                                                    stroke="#F1913D" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            Call
                                        </a>
                                    </div>
                                </form>
                                <div class="sidebar-item sidebar-featured style-2 mb-28  pb-36">
                                    <h4 class="sidebar-title mb-28">Featured Listings</h4>
                                    <ul>
                                        <li class="box-listings style-2 hover-img">
                                            <div class="image-wrap">
                                                <img class="lazyload" data-src="{{ url('images/section/box-listing-1.jpg') }}"
                                                    src="{{ url('images/section/box-listing-1.jpg') }}" alt="">
                                            </div>
                                            <div class="content">
                                                <div class="text-1 title fw-5 lh-20">
                                                    <a href="property-detail-v1">Casa Lomas de Machalí Machas</a>
                                                </div>
                                                <ul class="meta-list flex">
                                                    <li class="text-1 flex"><span>3</span>Bed</li>
                                                    <li class="text-1 flex"><span>3</span>Bath</li>
                                                    <li class="text-1 flex"><span>4,043</span>Sqft</li>
                                                </ul>
                                                <div class="price text-1 lh-20 fw-6">PKR 7,250,000</div>
                                            </div>
                                        </li>
                                        <li class="box-listings style-2 hover-img">
                                            <div class=" image-wrap">
                                                <img class="lazyload" data-src="{{ url('images/section/box-listing-2.jpg') }}"
                                                    src="{{ url('images/section/box-listing-2.jpg') }}" alt="">
                                            </div>
                                            <div class="content">
                                                <div class="text-1 title fw-5 lh-20">
                                                    <a href="property-detail-v1">Casa Lomas de Machalí Machas</a>
                                                </div>
                                                <ul class="meta-list flex">
                                                    <li class="text-1 flex"><span>3</span>Bed</li>
                                                    <li class="text-1 flex"><span>3</span>Bath</li>
                                                    <li class="text-1 flex"><span>4,043</span>Sqft</li>
                                                </ul>
                                                <div class="price text-1 lh-20 fw-6">PKR 7,250,000</div>

                                            </div>
                                        </li>
                                        <li class="box-listings style-2 hover-img">
                                            <div class=" image-wrap">
                                                <img class="lazyload" data-src="{{ url('images/section/box-listing-3.jpg') }}"
                                                    src="{{ url('images/section/box-listing-3.jpg') }}" alt="">
                                            </div>
                                            <div class="content">
                                                <div class="text-1 title fw-5 lh-20">
                                                    <a href="property-detail-v1">Casa Lomas de Machalí Machas</a>
                                                </div>
                                                <ul class="meta-list flex">
                                                    <li class="text-1 flex"><span>3</span>Bed</li>
                                                    <li class="text-1 flex"><span>3</span>Bath</li>
                                                    <li class="text-1 flex"><span>4,043</span>Sqft</li>
                                                </ul>
                                                <div class="price text-1 lh-20 fw-6">PKR 7,250,000</div>

                                            </div>
                                        </li>
                                        <li class="box-listings style-2 hover-img">
                                            <div class=" image-wrap">
                                                <img class="lazyload" data-src="{{ url('images/section/box-listing-4.jpg') }}"
                                                    src="{{ url('images/section/box-listing-4.jpg') }}" alt="">
                                            </div>
                                            <div class="content">
                                                <div class="text-1 title fw-5 lh-20">
                                                    <a href="property-detail-v1">Casa Lomas de Machalí Machas</a>
                                                </div>
                                                <ul class="meta-list flex">
                                                    <li class="text-1 flex"><span>3</span>Bed</li>
                                                    <li class="text-1 flex"><span>3</span>Bath</li>
                                                    <li class="text-1 flex"><span>4,043</span>Sqft</li>
                                                </ul>
                                                <div class="price text-1 lh-20 fw-6">PKR 7,250,000</div>
                                            </div>
                                        </li>
                                        <li class="box-listings style-2 hover-img">
                                            <div class=" image-wrap">
                                                <img class="lazyload" data-src="{{ url('images/section/box-listing-5.jpg') }}"
                                                    src="{{ url('images/section/box-listing-5.jpg') }}" alt="">
                                            </div>
                                            <div class="content">
                                                <div class="text-1 title fw-5 lh-20">
                                                    <a href="property-detail-v1">Casa Lomas de Machalí Machas</a>
                                                </div>
                                                <ul class="meta-list flex">
                                                    <li class="text-1 flex"><span>3</span>Bed</li>
                                                    <li class="text-1 flex"><span>3</span>Bath</li>
                                                    <li class="text-1 flex"><span>4,043</span>Sqft</li>
                                                </ul>
                                                <div class="price text-1 lh-20 fw-6">PKR 7,250,000</div>

                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class=" sidebar-ads">
                                    <div class="image-wrap">
                                        <img class="lazyload" data-src="{{ url('images/blog/ads.jpg') }}" src="{{ url('images/blog/ads.jpg') }}"
                                            alt="">
                                    </div>
                                    <div class="logo relative z-5">
                                        <img src="{{ url('images/logo/logo-2%402x.png') }}" alt="" width="136px" height="42px">
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


        </div>
        <!-- /main-content -->

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
                            <p>Copyright © 2024 <span class="fw-7">PROTY - REAL ESTATE</span> . Designed & Developed by
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
        </footer> <!-- /Footer -->
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
                                <label for="pass">Password</label>
                                <div class="ip-field">
                                    <svg class="icon" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.375 7.875V5.0625C12.375 4.16739 12.0194 3.30895 11.3865 2.67601C10.7535 2.04308 9.89511 1.6875 9 1.6875C8.10489 1.6875 7.24645 2.04308 6.61351 2.67601C5.98058 3.30895 5.625 4.16739 5.625 5.0625V7.875M5.0625 16.3125H12.9375C13.3851 16.3125 13.8143 16.1347 14.1307 15.8182C14.4472 15.5018 14.625 15.0726 14.625 14.625V9.5625C14.625 9.11495 14.4472 8.68573 14.1307 8.36926C13.8143 8.05279 13.3851 7.875 12.9375 7.875H5.0625C4.61495 7.875 4.18573 8.05279 3.86926 8.36926C3.55279 8.68573 3.375 9.11495 3.375 9.5625V14.625C3.375 15.0726 3.55279 15.5018 3.86926 15.8182C4.18573 16.1347 4.61495 16.3125 5.0625 16.3125Z"
                                            stroke="#A3ABB0" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <input type="password" class="form-control" id="pass" placeholder="Your password">
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
                <a href="index"><img src="{{ url('images/logo/logo%402x.png') }}" alt="" width="136px" height="42px"></a>
            </div>
            <div data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="icon-close"></i>
            </div>
        </div>
        <div class="offcanvas-body inner-mobile-nav">
            <div class="mb-body">
                <ul id="menu-mobile-menu">
                    <li class="menu-item menu-item-has-children-mobile">
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
                    <li class="menu-item menu-item-has-children-mobile current-menu-item">
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
                                <li class="menu-item menu-item-has-children-mobile-2 current-menu-item">
                                    <a href="#sub-agency" class="item-menu-mobile  collapsed" data-bs-toggle="collapse"
                                        aria-expanded="true" aria-controls="sub-agency">Agencies</a>
                                    <div id="sub-agency" class="collapse" data-bs-parent="#dropdown-menu-four">
                                        <ul class="sub-mobile">
                                            <li class="menu-item ">
                                                <a href="agency-grid" class="item-menu-mobile ">Agencies Grid</a>
                                            </li>
                                            <li class="menu-item current-item">
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
    <script type="text/javascript" src="{{ url('js/jquery.nice-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/main.js') }}"></script>
    <script defer src="../../../sibforms.com/forms/end-form/build/main.js"></script>
    <!-- /Javascript -->

</body>


<!-- Mirrored from themesflat.co/html/proty/agency-list by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Dec 2024 18:14:26 GMT -->
</html>