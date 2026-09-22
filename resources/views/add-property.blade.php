<!DOCTYPE html>
<!--[if IE 8]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->


<!-- Mirrored from themesflat.co/html/proty/add-property by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Dec 2024 18:14:44 GMT -->
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8" />
    <!--[if IE ]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/><![endif]-->
    <title>Add Property - Randhawa Marketing</title>

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
    <link rel="stylesheet" type="text/css" href="{{ url('css/jqueryui.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/styles.css') }}" />

    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="{{ url('icons/icomoon/style.css') }}" />

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ url('icons/favicon.svg') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ url('icons/favicon.svg') }}" />
</head>

<body class="bg-dashboard">
    <!-- .wrapper -->
    <div id="wrapper" class="bg-4 ">

        <!-- .preload -->
        <div id="loading">
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
        </div><!-- /.preload -->

        <!-- .header -->
        @include('layout.header')
        <!-- /.header -->


        <div class="page-layout">

            <!-- sidebar dashboard -->
            <div class="wrap-sidebar">
                <div class="sidebar-menu-dashboard">
                    <div class="menu-box">
                        <ul class="box-menu-dashboard">
                            <li class="nav-menu-item ">
                                <a class="nav-menu-link" href="dashboard">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.5 2.5H3.33333C2.8731 2.5 2.5 2.8731 2.5 3.33333V9.16667C2.5 9.6269 2.8731 10 3.33333 10H7.5C7.96024 10 8.33333 9.6269 8.33333 9.16667V3.33333C8.33333 2.8731 7.96024 2.5 7.5 2.5Z"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M16.668 2.5H12.5013C12.0411 2.5 11.668 2.8731 11.668 3.33333V5.83333C11.668 6.29357 12.0411 6.66667 12.5013 6.66667H16.668C17.1282 6.66667 17.5013 6.29357 17.5013 5.83333V3.33333C17.5013 2.8731 17.1282 2.5 16.668 2.5Z"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M16.668 10H12.5013C12.0411 10 11.668 10.3731 11.668 10.8333V16.6667C11.668 17.1269 12.0411 17.5 12.5013 17.5H16.668C17.1282 17.5 17.5013 17.1269 17.5013 16.6667V10.8333C17.5013 10.3731 17.1282 10 16.668 10Z"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M7.5 13.3334H3.33333C2.8731 13.3334 2.5 13.7065 2.5 14.1667V16.6667C2.5 17.1269 2.8731 17.5 3.33333 17.5H7.5C7.96024 17.5 8.33333 17.1269 8.33333 16.6667V14.1667C8.33333 13.7065 7.96024 13.3334 7.5 13.3334Z"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Dashboards
                                </a>
                            </li>
                            <li class="nav-menu-item">
                                <a class="nav-menu-link" href="my-profile">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.082 18.3333H14.9987C15.4407 18.3333 15.8646 18.1577 16.1772 17.8451C16.4898 17.5326 16.6654 17.1087 16.6654 16.6666V5.83329L12.4987 1.66663H4.9987C4.55667 1.66663 4.13275 1.84222 3.82019 2.15478C3.50763 2.46734 3.33203 2.89127 3.33203 3.33329V6.66663"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M11.668 1.66663V4.99996C11.668 5.44199 11.8436 5.86591 12.1561 6.17847C12.4687 6.49103 12.8926 6.66663 13.3346 6.66663H16.668"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M2.49828 10.9167C2.24146 11.0649 2.02884 11.279 1.88235 11.5368C1.73587 11.7946 1.66082 12.0868 1.66494 12.3833V15.0833C1.65529 15.3802 1.72514 15.6742 1.86726 15.935C2.00937 16.1958 2.2186 16.4139 2.47328 16.5667L4.99828 18.0833C5.25385 18.2356 5.5455 18.3166 5.84297 18.3181C6.14044 18.3195 6.43288 18.2414 6.68994 18.0917L9.16494 16.5833C9.42176 16.4351 9.63438 16.221 9.78087 15.9632C9.92735 15.7054 10.0024 15.4132 9.99828 15.1167V12.4167C10.0079 12.1198 9.93808 11.8258 9.79596 11.565C9.65385 11.3042 9.44462 11.0861 9.18994 10.9333L6.66494 9.41666C6.40937 9.26442 6.11771 9.18337 5.82025 9.1819C5.52278 9.18044 5.23033 9.25862 4.97328 9.40832L2.49828 10.9167Z"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M5.83203 14.1666V18.3333" stroke="#A8ABAE" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.7513 11.8334L5.83464 14.1667L1.91797 11.8334" stroke="#A8ABAE"
                                            stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Profile
                                </a>
                            </li>
                            <li class="nav-menu-item">
                                <a class="nav-menu-link" href="my-package">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2.5 7.5H17.5V15.8333C17.5 16.2754 17.3244 16.6993 17.0118 17.0118C16.6993 17.3244 16.2754 17.5 15.8333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V7.5Z"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M2.5 7.50004L4.54167 3.41671C4.6808 3.14059 4.89401 2.90861 5.15744 2.74673C5.42087 2.58484 5.72414 2.49943 6.03333 2.50004H13.9667C14.2773 2.49788 14.5823 2.58256 14.8473 2.74453C15.1124 2.9065 15.3269 3.13931 15.4667 3.41671L17.5 7.50004"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M10 2.5V7.5" stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    My package
                                </a>
                            </li>
                            <li class="nav-menu-item">
                                <a class="nav-menu-link" href="my-favorites">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.33203 18.3333H14.9987C15.4407 18.3333 15.8646 18.1577 16.1772 17.8451C16.4898 17.5326 16.6654 17.1087 16.6654 16.6666V5.83329L12.4987 1.66663H4.9987C4.55667 1.66663 4.13275 1.84222 3.82019 2.15478C3.50763 2.46734 3.33203 2.89127 3.33203 3.33329V4.99996"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M11.668 1.66663V4.99996C11.668 5.44199 11.8436 5.86591 12.1561 6.17847C12.4687 6.49103 12.8926 6.66663 13.3346 6.66663H16.668"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M8.574 8.91662C8.28934 8.63239 7.92648 8.43938 7.53169 8.3622C7.1369 8.28503 6.72807 8.32718 6.35733 8.48329C6.11566 8.58329 5.89066 8.73329 5.70733 8.92496L5.41566 9.20829L5.124 8.92496C4.84097 8.641 4.48002 8.44744 4.08689 8.36882C3.69376 8.29019 3.28613 8.33003 2.91566 8.48329C2.66566 8.58329 2.449 8.73329 2.25733 8.92496C1.46566 9.70829 1.424 11.0333 2.424 12.0416L5.41566 15L8.41566 12.0416C9.41566 11.0333 9.36566 9.70829 8.574 8.92496V8.91662Z"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    My favorites (1)
                                </a>
                            </li>
                            <li class="nav-menu-item">
                                <a class="nav-menu-link" href="my-save-search">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.91797 16.6666H3.33464C2.89261 16.6666 2.46868 16.491 2.15612 16.1785C1.84356 15.8659 1.66797 15.442 1.66797 15V4.16662C1.66797 3.7246 1.84356 3.30067 2.15612 2.98811C2.46868 2.67555 2.89261 2.49996 3.33464 2.49996H6.58464C6.86337 2.49723 7.13835 2.56445 7.38438 2.69547C7.63042 2.8265 7.83967 3.01715 7.99297 3.24996L8.66797 4.24996C8.81973 4.4804 9.02632 4.66956 9.26922 4.80046C9.51212 4.93136 9.78371 4.99991 10.0596 4.99996H16.668C17.11 4.99996 17.5339 5.17555 17.8465 5.48811C18.159 5.80067 18.3346 6.2246 18.3346 6.66662V10.0833"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M17.5013 17.5L15.918 15.9166" stroke="#A8ABAE" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M14.168 16.6666C15.5487 16.6666 16.668 15.5473 16.668 14.1666C16.668 12.7859 15.5487 11.6666 14.168 11.6666C12.7873 11.6666 11.668 12.7859 11.668 14.1666C11.668 15.5473 12.7873 16.6666 14.168 16.6666Z"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    My save searches
                                </a>
                            </li>
                            <li class="nav-menu-item">
                                <a class="nav-menu-link" href="review">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.5 12.5C17.5 12.942 17.3244 13.366 17.0118 13.6785C16.6993 13.9911 16.2754 14.1667 15.8333 14.1667H5.83333L2.5 17.5V4.16667C2.5 3.72464 2.67559 3.30072 2.98816 2.98816C3.30072 2.67559 3.72464 2.5 4.16667 2.5H15.8333C16.2754 2.5 16.6993 2.67559 17.0118 2.98816C17.3244 3.30072 17.5 3.72464 17.5 4.16667V12.5Z"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M6.66797 9.99996C7.11 9.99996 7.53392 9.82436 7.84648 9.5118C8.15904 9.19924 8.33464 8.77532 8.33464 8.33329V6.66663H6.66797"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M11.668 9.99996C12.11 9.99996 12.5339 9.82436 12.8465 9.5118C13.159 9.19924 13.3346 8.77532 13.3346 8.33329V6.66663H11.668"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Reviews
                                </a>
                            </li>
                            <li class="nav-menu-item">
                                <a class="nav-menu-link" href="my-property">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15 15C16.3807 15 17.5 13.8807 17.5 12.5C17.5 11.1193 16.3807 10 15 10C13.6193 10 12.5 11.1193 12.5 12.5C12.5 13.8807 13.6193 15 15 15Z"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M7.5013 9.16667C9.34225 9.16667 10.8346 7.67428 10.8346 5.83333C10.8346 3.99238 9.34225 2.5 7.5013 2.5C5.66035 2.5 4.16797 3.99238 4.16797 5.83333C4.16797 7.67428 5.66035 9.16667 7.5013 9.16667Z"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M8.33464 12.5H5.0013C4.11725 12.5 3.2694 12.8512 2.64428 13.4763C2.01916 14.1014 1.66797 14.9493 1.66797 15.8333V17.5"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M18.082 13.6666L17.332 13.4166" stroke="#A8ABAE" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M12.668 11.5834L11.918 11.3334" stroke="#A8ABAE" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M13.832 15.5834L14.082 14.8334" stroke="#A8ABAE" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15.918 10.1666L16.168 9.41663" stroke="#A8ABAE" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M16.3333 15.5833L16 14.75" stroke="#A8ABAE" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M14.0013 10.25L13.668 9.41663" stroke="#A8ABAE" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M11.918 13.8333L12.7513 13.5" stroke="#A8ABAE" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M17.25 11.5L18.0833 11.1666" stroke="#A8ABAE" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    My properties
                                </a>
                            </li>
                            <li class="nav-menu-item active">
                                <a class="nav-menu-link" href="add-property">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.9987 4.16663L12.987 2.15496C12.6745 1.84238 12.2507 1.66672 11.8087 1.66663H4.9987C4.55667 1.66663 4.13275 1.84222 3.82019 2.15478C3.50763 2.46734 3.33203 2.89127 3.33203 3.33329V16.6666C3.33203 17.1087 3.50763 17.5326 3.82019 17.8451C4.13275 18.1577 4.55667 18.3333 4.9987 18.3333H14.9987C15.4407 18.3333 15.8646 18.1577 16.1772 17.8451C16.4898 17.5326 16.6654 17.1087 16.6654 16.6666"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M17.8168 10.5217C18.1487 10.1897 18.3352 9.73947 18.3352 9.27C18.3352 8.80054 18.1487 8.3503 17.8168 8.01834C17.4848 7.68637 17.0346 7.49988 16.5651 7.49988C16.0956 7.49988 15.6454 7.68637 15.3134 8.01834L11.9718 11.3617C11.7736 11.5597 11.6286 11.8044 11.5501 12.0733L10.8526 14.465C10.8317 14.5367 10.8304 14.6127 10.849 14.6851C10.8675 14.7574 10.9052 14.8235 10.958 14.8763C11.0108 14.9291 11.0768 14.9668 11.1492 14.9853C11.2216 15.0038 11.2976 15.0026 11.3693 14.9817L13.7609 14.2842C14.0298 14.2057 14.2746 14.0606 14.4726 13.8625L17.8168 10.5217Z"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M6.66797 15H7.5013" stroke="#A8ABAE" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Add property
                                </a>
                            </li>
                            <li class="nav-menu-item">
                                <a class="nav-menu-link" href="index">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.5 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V4.16667C2.5 3.72464 2.67559 3.30072 2.98816 2.98816C3.30072 2.67559 3.72464 2.5 4.16667 2.5H7.5"
                                            stroke="#A8ABAE" stroke-width="1.4" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M13.332 14.1667L17.4987 10L13.332 5.83337" stroke="#A8ABAE"
                                            stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M17.5 10H7.5" stroke="#A8ABAE" stroke-width="1.4"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- /.end sidebar dashboard -->

            <!-- .main-content -->
            <div class="main-content w-100">
                <div class="main-content-inner">
                    <div class="button-show-hide show-mb">
                        <span class="body-1">Show Dashboard</span>
                    </div>
                    <div class="widget-box-2 mb-20">
                        <h3 class="title">Upload Media</h3>
                        <div class="box-uploadfile text-center">
                            <div class="uploadfile">
                                <a href="#" class=" tf-btn bg-color-primary pd-10 btn-upload mx-auto">
                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13.625 14.375V17.1875C13.625 17.705 13.205 18.125 12.6875 18.125H4.5625C4.31386 18.125 4.0754 18.0262 3.89959 17.8504C3.72377 17.6746 3.625 17.4361 3.625 17.1875V6.5625C3.625 6.045 4.045 5.625 4.5625 5.625H6.125C6.54381 5.62472 6.96192 5.65928 7.375 5.72834M13.625 14.375H16.4375C16.955 14.375 17.375 13.955 17.375 13.4375V9.375C17.375 5.65834 14.6725 2.57417 11.125 1.97834C10.7119 1.90928 10.2938 1.87472 9.875 1.875H8.3125C7.795 1.875 7.375 2.295 7.375 2.8125V5.72834M13.625 14.375H8.3125C8.06386 14.375 7.8254 14.2762 7.64959 14.1004C7.47377 13.9246 7.375 13.6861 7.375 13.4375V5.72834M17.375 11.25V9.6875C17.375 8.94158 17.0787 8.22621 16.5512 7.69876C16.0238 7.17132 15.3084 6.875 14.5625 6.875H13.3125C13.0639 6.875 12.8254 6.77623 12.6496 6.60041C12.4738 6.4246 12.375 6.18614 12.375 5.9375V4.6875C12.375 4.31816 12.3023 3.95243 12.1609 3.6112C12.0196 3.26998 11.8124 2.95993 11.5512 2.69876C11.2901 2.4376 10.98 2.23043 10.6388 2.08909C10.2976 1.94775 9.93184 1.875 9.5625 1.875H8.625"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Select photos
                                    <input type="file" class="ip-file">
                                </a>
                                <p class="file-name fw-5">or drag photos here <br>
                                    <span>(Up to 10 photos)</span>
                                </p>
                            </div>
                        </div>
                        <div class="box-img-upload">
                            <div class="item-upload file-delete">
                                <img src="{{ url('images/home/house-db-1.jpg') }}" alt="img">
                                <span class="icon icon-trashcan1 remove-file"></span>
                            </div>
                            <div class="item-upload file-delete">
                                <img src="{{ url('images/home/house-db-2.jpg') }}" alt="img">
                                <span class="icon icon-trashcan1"></span>

                            </div>
                            <div class="item-upload file-delete">
                                <img src="{{ url('images/home/house-db-3.jpg') }}" alt="img">
                                <span class="icon icon-trashcan1 remove-file"></span>

                            </div>
                            <div class="item-upload file-delete">
                                <img src="{{ url('images/home/house-db-4.jpg') }}" alt="img">
                                <span class="icon icon-trashcan1 remove-file"></span>

                            </div>
                            <div class="item-upload file-delete">
                                <img src="{{ url('images/home/house-db-5.jpg') }}" alt="img">
                                <span class="icon icon-trashcan1 remove-file"></span>

                            </div>
                        </div>
                    </div>
                    <div class="widget-box-2 mb-20">
                        <h5 class="title">Information</h5>
                        <form class="box-info-property">
                            <fieldset class="box box-fieldset">
                                <label for="title">
                                    Title:<span>*</span>
                                </label>
                                <input type="text" class="form-control" placeholder="Choose">
                            </fieldset>
                            <fieldset class="box box-fieldset">
                                <label for="desc">Description:</label>
                                <textarea class="textarea" placeholder="Your Decscription"></textarea>
                            </fieldset>
                            <div class="box grid-layout-3 gap-30">
                                <fieldset class="box-fieldset">
                                    <label for="address">
                                        Full Address:<span>*</span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Enter property full address">
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label for="zip">
                                        Zip Code:<span>*</span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Enter property zip code">
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label for="country">
                                        Country:<span>*</span>
                                    </label>
                                    <div class="nice-select" tabindex="0"><span class="current">United States</span>
                                        <ul class="list">
                                            <li data-value="1" class="option selected">United States</li>
                                            <li data-value="2" class="option">United Kingdom</li>
                                            <li data-value="3" class="option">Russia</li>
                                        </ul>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="box grid-layout-2 gap-30">
                                <fieldset class="box-fieldset">
                                    <label for="state">
                                        Province/State:<span>*</span>
                                    </label>
                                    <div class="nice-select" tabindex="0"><span class="current">None</span>
                                        <ul class="list">
                                            <li data-value="1" class="option selected">None</li>
                                            <li data-value="2" class="option">Texas</li>
                                            <li data-value="3" class="option">New York</li>
                                        </ul>
                                    </div>
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label for="neighborhood">
                                        Neighborhood:<span>*</span>
                                    </label>
                                    <div class="nice-select" tabindex="0"><span class="current">None</span>
                                        <ul class="list">
                                            <li data-value="1" class="option selected">None</li>
                                            <li data-value="2" class="option">Little Italy</li>
                                            <li data-value="3" class="option"> Bedford Park</li>
                                        </ul>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="box box-fieldset">
                                <label for="location">Location:<span>*</span></label>
                                <div class="box-ip">
                                    <input type="text" class="form-control" value="None">
                                    <a href="#" class="btn-location"><i class="icon icon-location"></i></a>
                                </div>
                                <iframe class="map"
                                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d135905.11693909427!2d-73.95165795400088!3d41.17584829642291!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1727094281524!5m2!1sen!2s"
                                    width="100%" height="456" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>

                            </div>

                        </form>
                    </div>
                    <div class="widget-box-2 mb-20">
                        <h3 class="title">Price</h3>
                        <div class="box-price-property">
                            <form class="box grid-2 gap-30">
                                <fieldset class="box-fieldset mb-30">
                                    <label for="price">Price:<span>*</span></label>
                                    <input type="text" class="form-control" placeholder="Example value: 12345.67">
                                </fieldset>
                                <fieldset class="box-fieldset mb-30">
                                    <label for="neighborhood">
                                        Unit Price:<span>*</span>
                                    </label>
                                    <div class="nice-select" tabindex="0"><span class="current">None</span>
                                        <ul class="list">
                                            <li data-value="1" class="option selected">None</li>
                                            <li data-value="2" class="option">1000</li>
                                            <li data-value="3" class="option">2000</li>
                                        </ul>
                                    </div>
                                </fieldset>
                                <div class="grid-layout-2 gap-30">
                                    <fieldset class="box-fieldset">
                                        <label for="price">
                                            Before Price Label:<span>*</span>
                                        </label>
                                        <input type="text" class="form-control">
                                    </fieldset>
                                    <fieldset class="box-fieldset">
                                        <label for="price">
                                            After Price Label:<span>*</span>
                                        </label>
                                        <input type="text" class="form-control">
                                    </fieldset>

                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="widget-box-2 mb-20">
                        <h3 class="title">Addtional Infomation</h3>
                        <form>
                            <div class="box grid-layout-3 gap-30">
                                <fieldset class="box-fieldset">
                                    <label for="type">
                                        Property Type:<span>*</span>
                                    </label>
                                    <div class="nice-select" tabindex="0"><span class="current">Choose</span>
                                        <ul class="list">
                                            <li data-value="1" class="option">Apartment</li>
                                            <li data-value="2" class="option">Villa</li>
                                            <li data-value="3" class="option">Studio</li>
                                            <li data-value="4" class="option">Studio</li>
                                            <li data-value="5" class="option">Office</li>
                                            <li data-value="6" class="option">Townhouse</li>
                                        </ul>
                                    </div>
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label for="status">
                                        Property Status:<span>*</span>
                                    </label>
                                    <div class="nice-select" tabindex="0"><span class="current">Choose</span>
                                        <ul class="list">
                                            <li data-value="1" class="option">For Rent</li>
                                            <li data-value="2" class="option">For Sale</li>
                                        </ul>
                                    </div>
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label for="label">
                                        Property Label:<span>*</span>
                                    </label>
                                    <div class="nice-select" tabindex="0"><span class="current">Choose</span>
                                        <ul class="list">
                                            <li data-value="1" class="option">New Listing</li>
                                            <li data-value="2" class="option">Open House</li>
                                        </ul>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="box grid-layout-3 gap-30">
                                <fieldset class="box-fieldset">
                                    <label for="size">
                                        Size (SqFt):<span>*</span>
                                    </label>
                                    <input type="text" class="form-control">
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label for="land">
                                        Land Area (SqFt):<span>*</span>
                                    </label>
                                    <input type="text" class="form-control">
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label for="id">
                                        Property ID:<span>*</span>
                                    </label>
                                    <input type="text" class="form-control">
                                </fieldset>
                            </div>
                            <div class="box grid-layout-3 gap-30">
                                <fieldset class="box-fieldset">
                                    <label for="rom">
                                        Rooms:<span>*</span>
                                    </label>
                                    <input type="text" class="form-control">
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label for="bedrooms">
                                        Bedrooms:<span>*</span>
                                    </label>
                                    <input type="text" class="form-control">
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label for="bathrooms">
                                        Bathrooms:<span>*</span>
                                    </label>
                                    <input type="text" class="form-control">
                                </fieldset>
                            </div>
                            <div class="box grid-layout-3 gap-30">
                                <fieldset class="box-fieldset">
                                    <label for="garages">
                                        Garages:<span>*</span>
                                    </label>
                                    <input type="text" class="form-control">
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label for="garages-size">
                                        Garages Size (SqFt):<span>*</span>
                                    </label>
                                    <input type="text" class="form-control">
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label for="year">
                                        Year Built:<span>*</span>
                                    </label>
                                    <input type="text" class="form-control">
                                </fieldset>
                            </div>
                        </form>
                    </div>
                    <div class="widget-box-2 mb-20">
                        <h5 class="title">Amenities<span>*</span></h5>
                        <div class="box-amenities-property">
                            <div class="box-amenities">
                                <div class="title-amenities fw-6 text-color-heading text-1">Home safety:</div>
                                <div class="list-amenities">
                                    <fieldset class="checkbox-item  style-1  ">
                                        <label>
                                            <span class="text-4">Smoke alarm</span>
                                            <input type="checkbox">
                                            <span class="btn-checkbox"></span>
                                        </label>
                                    </fieldset>
                                    <fieldset class="checkbox-item style-1  ">
                                        <label>
                                            <span class="text-4">Self check-in with lockbox</span>
                                            <input type="checkbox">
                                            <span class="btn-checkbox"></span>
                                        </label>
                                    </fieldset>
                                    <fieldset class="checkbox-item style-1  ">
                                        <label>
                                            <span class="text-4">Carbon monoxide alarm</span>
                                            <input type="checkbox">
                                            <span class="btn-checkbox"></span>
                                        </label>
                                    </fieldset>
                                    <fieldset class="checkbox-item style-1  ">
                                        <label>
                                            <span class="text-4">Security cameras</span>
                                            <input type="checkbox">
                                            <span class="btn-checkbox"></span>
                                        </label>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="box-amenities">
                                <div class="title-amenities fw-6 text-color-heading text-1">Bedroom</div>
                                <div class="list-amenities">
                                    <fieldset class="checkbox-item style-1  ">
                                        <label>
                                            <span class="text-4">Hangers</span>
                                            <input type="checkbox">
                                            <span class="btn-checkbox"></span>
                                        </label>
                                    </fieldset>
                                    <fieldset class="checkbox-item style-1  ">
                                        <label>
                                            <span class="text-4">Extra pillows & blankets</span>
                                            <input type="checkbox">
                                            <span class="btn-checkbox"></span>
                                        </label>
                                    </fieldset>
                                    <fieldset class="checkbox-item style-1  ">
                                        <label>
                                            <span class="text-4">
                                                Bed linens</span>
                                            <input type="checkbox">
                                            <span class="btn-checkbox"></span>
                                        </label>
                                    </fieldset>
                                    <fieldset class="checkbox-item style-1  ">
                                        <label>
                                            <span class="text-4">TV with standard cable</span>
                                            <input type="checkbox">
                                            <span class="btn-checkbox"></span>
                                        </label>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="box-amenities">
                                <div class="title-amenities fw-6 text-color-heading text-1">Kitchen:</div>
                                <div class="list-amenities">
                                    <fieldset class="checkbox-item style-1  ">
                                        <label>
                                            <span class="text-4">Refrigerator</span>
                                            <input type="checkbox">
                                            <span class="btn-checkbox"></span>
                                        </label>
                                    </fieldset>
                                    <fieldset class="checkbox-item style-1  ">
                                        <label>
                                            <span class="text-4">Dishwasher</span>
                                            <input type="checkbox">
                                            <span class="btn-checkbox"></span>
                                        </label>
                                    </fieldset>
                                    <fieldset class="checkbox-item style-1  ">
                                        <label>
                                            <span class="text-4">
                                                Microwave</span>
                                            <input type="checkbox">
                                            <span class="btn-checkbox"></span>
                                        </label>
                                    </fieldset>
                                    <fieldset class="checkbox-item style-1  ">
                                        <label>
                                            <span class="text-4">
                                                Coffee maker</span>
                                            <input type="checkbox">
                                            <span class="btn-checkbox"></span>
                                        </label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-box-2 mb-20">
                        <h3 class="title">Virtual Tour 360</h3>
                        <div class="box-radio-check">
                            <div class="text-btn mb-16">Virtual Tour Type:</div>
                            <form>
                                <fieldset class="radio-item   ">
                                    <label>
                                        <span class="text-1">Embedded code</span>
                                        <input type="radio" name="radio" id="radio1">
                                        <span class="btn-radio"></span>
                                    </label>
                                </fieldset>
                                <fieldset class="radio-item  style-1  ">
                                    <label>
                                        <span class="text-1">Upload image</span>
                                        <input type="radio" name="radio" id="radio2">
                                        <span class="btn-radio"></span>
                                    </label>
                                </fieldset>
                                <fieldset class="box-fieldset">
                                    <label for="embedded">Embedded Code Virtual 360</label>
                                    <textarea class="textarea"></textarea>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <div class="widget-box-2 mb-20">
                        <h3 class="title">Videos</h3>
                        <form>
                            <fieldset class="box-fieldset">
                                <label for="video" class="text-btn">Video URL:</label>
                                <input type="text" class="form-control" placeholder="Youtube, vimeo url">
                            </fieldset>
                        </form>
                    </div>
                    <div class="widget-box-2 mb-20">
                        <h3 class="title">Floors</h3>
                        <div class="box-radio-check mb-16">
                            <div class="text-1 mb-12">Enable Floor Plan:</div>
                            <fieldset class="radio-item mb-8">
                                <label>
                                    <span class="text-1">Enable
                                    </span>
                                    <input type="radio" name="radio" id=" floor-plan-1">
                                    <span class="btn-radio"></span>
                                </label>
                            </fieldset>
                            <fieldset class="radio-item  style-1  ">
                                <label>
                                    <span class="text-1">Disable</span>
                                    <input type="radio" name="radio" id="  floor-plan-2 ">
                                    <span class="btn-radio"></span>
                                </label>
                            </fieldset>
                        </div>
                        <div class="box-floor-property file-delete">
                            <div class="top d-flex justify-content-between align-items-center">
                                <h6>Floor 1:</h6>
                                <a href="#" class="remove-file"><span class="icon icon-close"></span></a>
                            </div>
                            <form>
                                <fieldset class="box box-fieldset">
                                    <label for="name">Floor Name:</label>
                                    <input type="text" class="form-control ">
                                </fieldset>
                                <div class="grid-layout-2 box gap-30">
                                    <fieldset class="box-fieldset">
                                        <label for="floor-price">Floor Price (Only Digits):</label>
                                        <input type="text" class="form-control ">
                                    </fieldset>
                                    <fieldset class="box-fieldset">
                                        <label for="price-postfix">Price Postfix:</label>
                                        <input type="text" class="form-control ">
                                    </fieldset>
                                </div>
                                <div class="grid-layout-2 box gap-30">
                                    <fieldset class="box-fieldset">
                                        <label for="floor-size">Floor Size (Only Digits):</label>
                                        <input type="text" class="form-control ">
                                    </fieldset>
                                    <fieldset class="box-fieldset">
                                        <label for="size-postfix">Size Postfix:</label>
                                        <input type="text" class="form-control ">
                                    </fieldset>
                                </div>
                                <div class="grid-layout-2 box gap-30">
                                    <fieldset class="box-fieldset">
                                        <label for="bedrooms">Bedrooms:</label>
                                        <input type="text" class="form-control ">
                                    </fieldset>
                                    <fieldset class="box-fieldset">
                                        <label for="bathrooms">Bathrooms:</label>
                                        <input type="text" class="form-control ">
                                    </fieldset>
                                </div>
                                <div class="grid-layout-2 box gap-30">
                                    <fieldset class="box-fieldset">
                                        <label for="bedrooms">Floor Image:</label>
                                        <div class="box-floor-img uploadfile">
                                            <a href="#" class="btn-upload tf-btn bg-color-primary pd-10">
                                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2.375 13.125L6.67417 8.82583C6.84828 8.65172 7.05498 8.51361 7.28246 8.41938C7.50995 8.32515 7.75377 8.27665 8 8.27665C8.24623 8.27665 8.49005 8.32515 8.71754 8.41938C8.94502 8.51361 9.15172 8.65172 9.32583 8.82583L13.625 13.125M12.375 11.875L13.5492 10.7008C13.7233 10.5267 13.93 10.3886 14.1575 10.2944C14.385 10.2001 14.6288 10.1516 14.875 10.1516C15.1212 10.1516 15.365 10.2001 15.5925 10.2944C15.82 10.3886 16.0267 10.5267 16.2008 10.7008L18.625 13.125M3.625 16.25H17.375C17.7065 16.25 18.0245 16.1183 18.2589 15.8839C18.4933 15.6495 18.625 15.3315 18.625 15V5C18.625 4.66848 18.4933 4.35054 18.2589 4.11612C18.0245 3.8817 17.7065 3.75 17.375 3.75H3.625C3.29348 3.75 2.97554 3.8817 2.74112 4.11612C2.5067 4.35054 2.375 4.66848 2.375 5V15C2.375 15.3315 2.5067 15.6495 2.74112 15.8839C2.97554 16.1183 3.29348 16.25 3.625 16.25ZM12.375 6.875H12.3817V6.88167H12.375V6.875ZM12.6875 6.875C12.6875 6.95788 12.6546 7.03737 12.596 7.09597C12.5374 7.15458 12.4579 7.1875 12.375 7.1875C12.2921 7.1875 12.2126 7.15458 12.154 7.09597C12.0954 7.03737 12.0625 6.95788 12.0625 6.875C12.0625 6.79212 12.0954 6.71263 12.154 6.65403C12.2126 6.59542 12.2921 6.5625 12.375 6.5625C12.4579 6.5625 12.5374 6.59542 12.596 6.65403C12.6546 6.71263 12.6875 6.79212 12.6875 6.875Z"
                                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                Choose File
                                                <input type="file" class="ip-file">
                                            </a>
                                            <p class="file-name">Or drop file here to upload</p>
                                        </div>
                                    </fieldset>
                                    <fieldset class="box-fieldset">
                                        <label for="bathrooms">Description:</label>
                                        <textarea class="textarea"></textarea>
                                    </fieldset>
                                </div>
                            </form>
                        </div>
                        <div class="text-center">
                            <a href="#" class="btn-add-floor"><span class="icon icon-plus"></span></a>
                        </div>
                    </div>
                    <div class="widget-box-2 mb-20">
                        <h3 class="title">Agent Infomation</h3>
                        <div class="box-radio-check">
                            <div class="text-1 mb-16">Choose type agent information?</div>
                            <fieldset class="radio-item mb-8">
                                <label>
                                    <span class="text-1">Your current user information
                                    </span>
                                    <input type="radio" name="radio" id=" floor-plan-1">
                                    <span class="btn-radio"></span>
                                </label>
                            </fieldset>
                            <fieldset class="radio-item  style-1  ">
                                <label>
                                    <span class="text-1">Other contact
                                    </span>
                                    <input type="radio" name="radio" id="  floor-plan-2 ">
                                    <span class="btn-radio"></span>
                                </label>
                            </fieldset>
                        </div>
                    </div>
                    <div class="box-btn">
                        <a href="#" class="tf-btn bg-color-primary pd-13">Add Property</a>
                        <a href="#" class="tf-btn style-border pd-10">Save & Preview</a>
                    </div>
                    <!-- .footer-dashboard -->
                    <div class="footer-dashboard">
                        <p>Copyright © 2024 Popty</p>
                        <ul class="list">
                            <li><a href="#">Privacy</a></li>
                            <li><a href="#">Terms</a></li>
                            <li><a href="#">Support</a></li>
                        </ul>

                    </div><!-- /.footer-dashboard -->
                </div>
                <div class="overlay-dashboard"></div>

            </div><!-- /.main-content -->


        </div>

    </div>
    
    @include('layout.footer')
    <!-- /wrapper -->

    <!-- mobile-nav -->
    <div class="offcanvas offcanvas-start mobile-nav-wrap " tabindex="-1" id="menu-mobile"
        aria-labelledby="menu-mobile">
        <div class="offcanvas-header top-nav-mobile">
            <div class="offcanvas-title">
                <a href="index"><img src="{{ url('images/logo/logo@2x.png') }}" alt="" width="136px" height="42px"></a>
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
                                <li class="menu-item"><a href="index">Home Page 01</a></li>
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
                                <li class="menu-item "><a href="faq">Faq's</a></li>
                                <li class="menu-item current-item"><a href="dashboard">Dashboard</a></li>
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
    <script type="text/javascript" src="{{ url('js/jqueryui.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/jquery.nice-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/main.js') }}"></script>
    <!-- /Javascript -->

</body>


<!-- Mirrored from themesflat.co/html/proty/add-property by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Dec 2024 18:14:44 GMT -->
</html>