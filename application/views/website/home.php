<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description"
        content="Emigo: A sleek, responsive, and user-friendly HTML template designed for online grocery stores.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Grocery, Store, stores">
    <title>Emigo</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url() ?>assets/website/images/fav.webp">
    <!-- plugins css -->
    <link rel="stylesheet preload" href="<?php echo site_url() ?>assets/website/css/plugins.css" as="style">
    <link rel="stylesheet preload" href="<?php echo site_url() ?>assets/website/css/style.css" as="style">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="shop-main-h">


    <!-- rts header area start -->
    <!-- rts header area start -->
    <div class="rts-header-one-area-one">
        <div class="header-top-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bwtween-area-header-top">
                            <div class="discount-area">
                                <p class="disc">FREE delivery & 40% Discount for next 3 orders! Place your 1st order in.
                                </p>
                            </div>
                            <div class="contact-number-area">
                                <p>Need help? Call Us:
                                    <a href="tel:+4733378901">+1234567890</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-mid-one-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-mid-wrapper-between">
                            <div class="nav-sm-left">
                                <ul class="nav-h_top">
                                    <li><a href="<?php echo base_url('website/user/register'); ?>">Register</a></li>
                                    <li><a href="<?php echo base_url('website/user/login'); ?>">Login</a></li>

                                </ul>
                                <p class="para">We deliver to your everyday from 7:00 to 22:00</p>
                            </div>
                            <div class="nav-sm-left">
                                <ul class="nav-h_top language">
                                    <li class="category-hover-header language-hover">
                                        <a href="#">
                                            <?php if(isset($language)){
                                                 if($language == 'ma'){
                                                    $lang = 'മലയാളം';
                                                }
                                                if($language == 'en'){
                                                    $lang = 'English';
                                                }
                                                if($language == 'hi'){
                                                    $lang = 'हिन्दी';
                                                }
                                                if($language == 'ar'){
                                                    $lang = 'وتُكتب';
                                                }
                                                echo $lang;
                                            } ?>
                                        </a>








                                        <ul class="category-sub-menu">
                                            <?php $selected_languages = explode(",", $store_selected_languages );
                                        foreach ($selected_languages as $languag){ ?>
                                            <li>
                                                <?php if($languag == 'ma'){
                                                $lang = 'മലയാളം';
                                            }
                                            if($languag == 'en'){
                                                $lang = 'English';
                                            }
                                            if($languag == 'hi'){
                                                $lang = 'हिन्दी';
                                            }
                                            if($languag == 'ar'){
                                                $lang = 'وتُكتب';
                                            }
                                            ?>
                                                <a href="<?php echo base_url('website/products/set_language/'.$languag); ?>"
                                                    class="menu-item">
                                                    <span><?php echo $lang; ?></span>
                                                </a>
                                            </li>
                                            <?php } ?>
                                        </ul>



                                    </li>
                                    <!-- <li class="category-hover-header language-hover">
                                        <a href="#">
                                            USD
                                        </a>
                                        <ul class="category-sub-menu">
                                            <li>
                                                <a href="#" class="menu-item">
                                                    <span>Rubol</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="menu-item">
                                                    <span>Rupi</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="menu-item">
                                                    <span>Euro</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li> -->

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-header-area-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="logo-search-category-wrapper">
                            <a href="#" class="logo-area">
                                <h1 style="color: #131212;">EMIGO</h1>
                            </a>
                            <div class="category-search-wrapper">
                                <div class="category-btn category-hover-header">
                                    <img class="parent" src="<?php echo site_url() ?>assets/website/images/bar-1.svg"
                                        alt="icons">
                                    <span>Categories</span>
                                    <ul class="category-sub-menu" id="category-active-four">
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/01.svg"
                                                    alt="icons">
                                                <span>Breakfast</span>
                                                <i fa-plus"></i>
                                            </a>
                                            <ul class="submenu mm-collapse">
                                                <li><a class="mobile-menu-link" href="#">Masala Dosa</a></li>
                                                <li><a class="mobile-menu-link" href="#">Ghee Roast</a></li>
                                                <li><a class="mobile-menu-link" href="#"> Dosa Set</a></li>
                                                <li><a class="mobile-menu-link" href="#"> Poori Bhaji</a></li>

                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/02.svg"
                                                    alt="icons">
                                                <span>Starter</span>
                                                <i fa-plus"></i>
                                            </a>
                                            <ul class="submenu mm-collapse">
                                                <li><a class="mobile-menu-link" href="#">Honey Glazed Chicken Prawn</a>
                                                </li>
                                                <li><a class="mobile-menu-link" href="#">Chicken Lollypop</a></li>
                                                <li><a class="mobile-menu-link" href="#"> Travncore Chi.fry</a></li>
                                                <li><a class="mobile-menu-link" href="#">Crispy Fried Veg</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/03.svg"
                                                    alt="icons">
                                                <span>Soup</span>
                                                <i fa-plus"></i>
                                            </a>
                                            <ul class="submenu mm-collapse">
                                                <li><a class="mobile-menu-link" href="#">Sweet Corn Veg.Chi</a></li>
                                                <li><a class="mobile-menu-link" href="#">Hot and Sour Veg.Chi</a></li>
                                                <li><a class="mobile-menu-link" href="#"> Kozhi Kurumulak</a></li>
                                                <li><a class="mobile-menu-link" href="#">Adu Kurumulak</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/04.svg"
                                                    alt="icons">
                                                <span>Lunch</span>
                                                <i fa-plus"></i>
                                            </a>
                                            <ul class="submenu mm-collapse">
                                                <li><a class="mobile-menu-link" href="#">Fish Curry Meals</a></li>
                                                <li><a class="mobile-menu-link" href="#">Pothichoru</a></li>
                                                <li><a class="mobile-menu-link" href="#">Chatty Chor</a></li>
                                                <li><a class="mobile-menu-link" href="#">Chicken Dum Biryani</a></li>



                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/05.svg"
                                                    alt="icons">
                                                <span>Special fish fry</span>
                                                <i fa-plus"></i>
                                            </a>
                                            <ul class="submenu mm-collapse">
                                                <li><a class="mobile-menu-link" href="#">Mathi Fry</a></li>
                                                <li><a class="mobile-menu-link" href="#">Ayla Porichathu</a></li>
                                                <li><a class="mobile-menu-link" href="#">Manthal Fry</a></li>
                                                <li><a class="mobile-menu-link" href="#">Kakka Irachi</a></li>



                                            </ul>
                                        </li>



                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/07.svg"
                                                    alt="icons">
                                                <span>SuNi's specials</span>
                                                <i fa-plus"></i>
                                            </a>
                                            <ul class="submenu mm-collapse">
                                                <li><a class="mobile-menu-link" href="#">Kizhi Poratta</a></li>
                                                <li><a class="mobile-menu-link" href="#">Kappa Biriyani</a></li>
                                                <li><a class="mobile-menu-link" href="#"> Duck Special</a></li>
                                                <li><a class="mobile-menu-link" href="#"> Kujan Kozhi Kondattam</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/07.svg"
                                                    alt="icons">
                                                <span>Chicken</span>
                                                <i fa-plus"></i>
                                            </a>
                                            <ul class="submenu mm-collapse">
                                                <li><a class="mobile-menu-link" href="#">Kerala Chicken Curry</a></li>
                                                <li><a class="mobile-menu-link" href="#">Chicken Korma</a></li>
                                                <li><a class="mobile-menu-link" href="#"> Chicken Roast</a></li>
                                                <li><a class="mobile-menu-link" href="#"> Kozhi Kanthari Curry</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/09.svg"
                                                    alt="icons">
                                                <span>Mutton</span>
                                                <i fa-plus"></i>
                                            </a>
                                            <ul class="submenu mm-collapse">
                                                <li><a class="mobile-menu-link" href="#">Mutton Coconut Fry</a></li>
                                                <li><a class="mobile-menu-link" href="#">Mutton Varattu</a></li>
                                                <li><a class="mobile-menu-link" href="#"> Mutton Pepper Fry</a></li>
                                                <li><a class="mobile-menu-link" href="#"> Mutton Kuruma</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/10.svg"
                                                    alt="icons">
                                                <span>Sea Food Special</span>
                                                <i fa-plus"></i>
                                            </a>
                                            <ul class="submenu mm-collapse">
                                                <li><a class="mobile-menu-link" href="#">King Fish Mango Curry</a></li>
                                                <li><a class="mobile-menu-link" href="#">Meen Chatti Manga Curry</a>
                                                </li>
                                                <li><a class="mobile-menu-link" href="#"> Meen Pollichathu</a></li>
                                                <li><a class="mobile-menu-link" href="#"> Koonthal Roast</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/10.svg"
                                                    alt="icons">
                                                <span>Beef</span>
                                                <i fa-plus"></i>
                                            </a>
                                            <ul class="submenu mm-collapse">
                                                <li><a class="mobile-menu-link" href="#">Beef Cocount Fry</a></li>
                                                <li><a class="mobile-menu-link" href="#">Beef Nadan Curry</a></li>
                                                <li><a class="mobile-menu-link" href="#"> Beef Roast</a></li>
                                                <li><a class="mobile-menu-link" href="#"> Beef Koorkka Varatiyathu</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <form action="#" class="search-header">
                                    <input type="text" placeholder="Search for products, categories or brands" required>
                                    <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                        <div class="btn-text">
                                            Search
                                        </div>
                                        <div class="arrow-icon">
                                            <i class="fa fa-search"></i>
                                        </div>
                                        <div class="arrow-icon">
                                            <i class="fa fa-search"></i>
                                        </div>
                                    </a>
                                </form>
                            </div>
                            <div class="actions-area">
                                <div class="search-btn" id="searchs">

                                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.75 14.7188L11.5625 10.5312C12.4688 9.4375 12.9688 8.03125 12.9688 6.5C12.9688 2.9375 10.0312 0 6.46875 0C2.875 0 0 2.9375 0 6.5C0 10.0938 2.90625 13 6.46875 13C7.96875 13 9.375 12.5 10.5 11.5938L14.6875 15.7812C14.8438 15.9375 15.0312 16 15.25 16C15.4375 16 15.625 15.9375 15.75 15.7812C16.0625 15.5 16.0625 15.0312 15.75 14.7188ZM1.5 6.5C1.5 3.75 3.71875 1.5 6.5 1.5C9.25 1.5 11.5 3.75 11.5 6.5C11.5 9.28125 9.25 11.5 6.5 11.5C3.71875 11.5 1.5 9.28125 1.5 6.5Z"
                                            fill="#1F1F25"></path>
                                    </svg>

                                </div>
                                <div class="menu-btn" id="menu-btn">

                                    <svg width="20" height="16" viewBox="0 0 20 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect y="14" width="20" height="2" fill="#1F1F25"></rect>
                                        <rect y="7" width="20" height="2" fill="#1F1F25"></rect>
                                        <rect width="20" height="2" fill="#1F1F25"></rect>
                                    </svg>

                                </div>
                            </div>
                            <div class="accont-wishlist-cart-area-header">
                                <a href="#" class="btn-border-only account">
                                    <i class="fa fa-user"></i>
                                    <span>Account</span>
                                </a>

                                <div class="btn-border-only cart category-hover-header">
                                    <i class="fa fa fa-cart-shopping"></i>
                                    <span class="text">My Cart</span>
                                    <span class="number">2</span>
                                    <div class="category-sub-menu card-number-show">
                                        <h5 class="shopping-cart-number">Shopping Cart (03)</h5>
                                        <div class="cart-item-1 border-top">
                                            <div class="img-name">
                                                <div class="thumbanil">
                                                    <img src="<?php echo site_url() ?>assets/website/images/cart-1.webp"
                                                        alt="">
                                                </div>
                                                <div class="details">
                                                    <a href="#">
                                                        <h5 class="title">Foster Farms Breast Nuggets Shaped Chicken
                                                        </h5>
                                                    </a>
                                                    <div class="number">
                                                        1 <i class="fa fa-x"></i>
                                                        <span>₹36.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="close-c1">
                                                <i class="fa fa-x"></i>
                                            </div>
                                        </div>
                                        <div class="cart-item-1">
                                            <div class="img-name">
                                                <div class="thumbanil">
                                                    <img src="<?php echo site_url() ?>assets/website/images/05.webp"
                                                        alt="">
                                                </div>
                                                <div class="details">
                                                    <a href="#">
                                                        <h5 class="title">Foster Farms Breast Nuggets Shaped Chicken
                                                        </h5>
                                                    </a>
                                                    <div class="number">
                                                        1 <i class="fa fa-x"></i>
                                                        <span>₹36.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="close-c1">
                                                <i class="fa fa-x"></i>
                                            </div>
                                        </div>
                                        <div class="cart-item-1">
                                            <div class="img-name">
                                                <div class="thumbanil">
                                                    <img src="<?php echo site_url() ?>assets/website/images/04.webp"
                                                        alt="">
                                                </div>
                                                <div class="details">
                                                    <a href="#">
                                                        <h5 class="title">Foster Farms Breast Nuggets Shaped Chicken
                                                        </h5>
                                                    </a>
                                                    <div class="number">
                                                        1 <i class="fa fa-x"></i>
                                                        <span>₹36.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="close-c1">
                                                <i class="fa fa-x"></i>
                                            </div>
                                        </div>
                                        <div class="sub-total-cart-balance">
                                            <div class="bottom-content-deals mt--10">
                                                <div class="top">
                                                    <span>Sub Total:</span>
                                                    <span class="number-c">₹108.00</span>
                                                </div>
                                                <div class="single-progress-area-incard">
                                                    <div class="progress">
                                                        <div class="progress-bar wow fadeInLeft" role="progressbar"
                                                            style="width: 80%" aria-valuenow="25" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <p>Spend More <span>₹125.00</span> to reach <span>Free Shipping</span>
                                                </p>
                                            </div>
                                            <div
                                                class="button-wrapper d-flex align-items-center justify-content-between">
                                                <a href="#" class="rts-btn btn-primary ">View Cart</a>
                                                <a href="#" class="rts-btn btn-primary border-only">CheckOut</a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="over_link"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rts-header-nav-area-one header--sticky">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="nav-and-btn-wrapper">
                            <div class="nav-area">
                                <nav>
                                    <ul class="parent-nav">
                                        <li class="parent has-dropdown">
                                            <a class="nav-link" href="<?php echo base_url(); ?>website/home">Home</a>

                                        </li>
                                        <li class="parent"><a href="<?php echo base_url(); ?>about">About</a></li>
                                        <li class="parent with-megamenu">
                                            <a href="#">Shop</a>

                                        </li>

                                        <!-- <li class="parent has-dropdown">
                                            <a class="nav-link" href="#">Pages</a>
                                            
                                        </li> -->
                                        <li class="parent"><a href="<?php echo site_url('website/cart/view'); ?>">View
                                                Cart</a></li>

                                        <li class="parent"><a href="<?php echo base_url(); ?>contact">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- button-area -->
                            <div class="right-btn-area">
                                <a href="#" class="btn-narrow"><?php echo lang('product_heading'); ?></a>
                                <button class="rts-btn btn-primary">
                                    Get 30% Discount Now
                                    <span>Sale</span>
                                </button>
                            </div>
                            <!-- button-area end -->
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="logo-search-category-wrapper after-md-device-header">
                            <a href="#" class="logo-area">
                                <h1 style="color: #131212;">EMIGO</h1>
                                <!-- <img src="<?php echo site_url() ?>assets/website/images/logo/logo-01.svg" alt="logo-main" class="logo"> -->
                            </a>
                            <!-- <div class="category-search-wrapper">
                                <div class="category-btn category-hover-header">
                                    <img class="parent" src="<?php echo site_url() ?>assets/website/images/icons/bar-1.svg" alt="icons">
                                    <span>Categories</span>
                                    <ul class="category-sub-menu">
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/icons/01.svg" alt="icons">
                                                <span>Breakfast & Dairy</span>
                                                <i  fa-plus"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/icons/02.svg" alt="icons">
                                                <span>Meats & Seafood</span>
                                                <i  fa-plus"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/icons/03.svg" alt="icons">
                                                <span>Breads & Bakery</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/icons/04.svg" alt="icons">
                                                <span>Chips & Snacks</span>
                                                <i  fa-plus"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/icons/05.svg" alt="icons">
                                                <span>Medical Healthcare</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/icons/06.svg" alt="icons">
                                                <span>Breads & Bakery</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/icons/07.svg" alt="icons">
                                                <span>Biscuits & Snacks</span>
                                                <i  fa-plus"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/icons/08.svg" alt="icons">
                                                <span>Frozen Foods</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/icons/09.svg" alt="icons">
                                                <span>Grocery & Staples</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="menu-item">
                                                <img src="<?php echo site_url() ?>assets/website/images/icons/10.svg" alt="icons">
                                                <span>Other Items</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <form action="#" class="search-header">
                                    <input type="text" placeholder="Search for products, categories or brands" required>
                                    <button class="rts-btn btn-primary radious-sm with-icon">
                                        <span class="btn-text">
                                        Search
                                    </span>
                                        <span class="arrow-icon">
                                        <i class="fa fa-magnifying-glass"></i>
                                    </span>
                                        <span class="arrow-icon">
                                        <i class="fa fa-magnifying-glass"></i>
                                    </span>
                                    </button>
                                </form>
                            </div> -->
                            <div class="main-wrapper-action-2 d-flex">
                                <div class="accont-wishlist-cart-area-header">
                                    <a href="#" class="btn-border-only account">
                                        <i class="fa fa-user"></i>
                                        Account
                                    </a>
                                    <a href="#" class="btn-border-only wishlist">
                                        <i class="fa fa-heart"></i>
                                        Wishlist
                                    </a>
                                    <div class="btn-border-only cart category-hover-header">
                                        <i class="fa-sharp fa fa-cart-shopping"></i>
                                        <span class="text">My Cart</span>
                                        <div class="category-sub-menu card-number-show">
                                            <h5 class="shopping-cart-number">Shopping Cart (03)</h5>
                                            <div class="cart-item-1 border-top">
                                                <div class="img-name">
                                                    <div class="thumbanil">
                                                        <img src="<?php echo site_url() ?>assets/website/images/shop/cart-1.png"
                                                            alt="">
                                                    </div>
                                                    <div class="details">
                                                        <a href="#">
                                                            <h5 class="title">Foster Farms Breast Nuggets Shaped Chicken
                                                            </h5>
                                                        </a>
                                                        <div class="number">
                                                            1 <i class="fa fa-x"></i>
                                                            <span>₹36.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="close-c1">
                                                    <i class="fa fa-x"></i>
                                                </div>
                                            </div>
                                            <div class="cart-item-1">
                                                <div class="img-name">
                                                    <div class="thumbanil">
                                                        <img src="<?php echo site_url() ?>assets/website/images/shop/05.png"
                                                            alt="">
                                                    </div>
                                                    <div class="details">
                                                        <a href="#">
                                                            <h5 class="title">Foster Farms Breast Nuggets Shaped Chicken
                                                            </h5>
                                                        </a>
                                                        <div class="number">
                                                            1 <i class="fa fa-x"></i>
                                                            <span>₹36.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="close-c1">
                                                    <i class="fa fa-x"></i>
                                                </div>
                                            </div>
                                            <div class="cart-item-1">
                                                <div class="img-name">
                                                    <div class="thumbanil">
                                                        <img src="<?php echo site_url() ?>assets/website/images/shop/04.png"
                                                            alt="">
                                                    </div>
                                                    <div class="details">
                                                        <a href="#">
                                                            <h5 class="title">Foster Farms Breast Nuggets Shaped Chicken
                                                            </h5>
                                                        </a>
                                                        <div class="number">
                                                            1 <i class="fa fa-x"></i>
                                                            <span>₹36.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="close-c1">
                                                    <i class="fa fa-x"></i>
                                                </div>
                                            </div>
                                            <div class="sub-total-cart-balance">
                                                <div class="bottom-content-deals mt--10">
                                                    <div class="top">
                                                        <span>Sub Total:</span>
                                                        <span class="number-c">₹108.00</span>
                                                    </div>
                                                    <div class="single-progress-area-incard">
                                                        <div class="progress">
                                                            <div class="progress-bar wow fadeInLeft" role="progressbar"
                                                                style="width: 80%" aria-valuenow="25" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <p>Spend More <span>₹125.00</span> to reach <span>Free
                                                            Shipping</span></p>
                                                </div>
                                                <div
                                                    class="button-wrapper d-flex align-items-center justify-content-between">
                                                    <a href="#" class="rts-btn btn-primary ">View Cart</a>
                                                    <a href="#" class="rts-btn btn-primary border-only">CheckOut</a>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#" class="over_link"></a>
                                    </div>
                                </div>
                                <div class="actions-area">
                                    <div class="search-btn" id="search">

                                        <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.75 14.7188L11.5625 10.5312C12.4688 9.4375 12.9688 8.03125 12.9688 6.5C12.9688 2.9375 10.0312 0 6.46875 0C2.875 0 0 2.9375 0 6.5C0 10.0938 2.90625 13 6.46875 13C7.96875 13 9.375 12.5 10.5 11.5938L14.6875 15.7812C14.8438 15.9375 15.0312 16 15.25 16C15.4375 16 15.625 15.9375 15.75 15.7812C16.0625 15.5 16.0625 15.0312 15.75 14.7188ZM1.5 6.5C1.5 3.75 3.71875 1.5 6.5 1.5C9.25 1.5 11.5 3.75 11.5 6.5C11.5 9.28125 9.25 11.5 6.5 11.5C3.71875 11.5 1.5 9.28125 1.5 6.5Z"
                                                fill="#1F1F25"></path>
                                        </svg>

                                    </div>
                                    <div class="menu-btn">

                                        <svg width="20" height="16" viewBox="0 0 20 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect y="14" width="20" height="2" fill="#1F1F25"></rect>
                                            <rect y="7" width="20" height="2" fill="#1F1F25"></rect>
                                            <rect width="20" height="2" fill="#1F1F25"></rect>
                                        </svg>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts header area end -->

    <!-- rts header area start -->
    <!-- header style two -->
    <div id="side-bar" class="side-bar header-two">
        <button class="close-icon-menu"><i class="far fa-times"></i></button>


        <form action="#" class="search-input-area-menu mt--30">
            <input type="text" placeholder="Search..." required>
            <button><i class="fa fa-magnifying-glass"></i></button>
        </form>

        <div class="mobile-menu-nav-area tab-nav-btn mt--20">

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">Menu</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Category</button>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                    tabindex="0">
                    <!-- mobile menu area start -->
                    <div class="mobile-menu-main">
                        <nav class="nav-main mainmenu-nav mt--30">
                            <ul class="mainmenu metismenu" id="mobile-menu-active">
                                <li>
                                    <a href="#" class="main">Home</a>

                                </li>
                                <li>
                                    <a href="#" class="main">About</a>
                                </li>

                                <li>
                                    <a href="#" class="main">Shop</a>

                                </li>
                                <li>
                                    <a href="#" class="main">Pages</a>

                                </li>
                                <li>
                                    <a href="#" class="main">Contact</a>
                                </li>
                            </ul>
                            </li>


                            </ul>
                        </nav>

                    </div>
                    <!-- mobile menu area end -->
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                    tabindex="0">
                    <div class="category-btn category-hover-header menu-category">
                        <ul class="category-sub-menu" id="category-active-menu">
                            <li>
                                <a href="#" class="menu-item">
                                    <img src="<?php echo site_url() ?>assets/website/images/01.svg" alt="icons">
                                    <span>Breakfast</span>
                                    <i fa-plus"></i>
                                </a>
                                <ul class="submenu mm-collapse">
                                    <li><a class="mobile-menu-link" href="#">Masala Dosa</a></li>
                                    <li><a class="mobile-menu-link" href="#">Ghee Roast</a></li>
                                    <li><a class="mobile-menu-link" href="#"> Dosa Set</a></li>
                                    <li><a class="mobile-menu-link" href="#"> Poori Bhaji</a></li>

                                </ul>
                            </li>
                            <li>
                                <a href="#" class="menu-item">
                                    <img src="<?php echo site_url() ?>assets/website/images/02.svg" alt="icons">
                                    <span>Starter</span>
                                    <i fa-plus"></i>
                                </a>
                                <ul class="submenu mm-collapse">
                                    <li><a class="mobile-menu-link" href="#">Honey Glazed Chicken Prawn</a></li>
                                    <li><a class="mobile-menu-link" href="#">Chicken Lollipop</a></li>
                                    <li><a class="mobile-menu-link" href="#"> Travncore Chi.fry</a></li>
                                    <li><a class="mobile-menu-link" href="#">Crispy Fried Veg</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="menu-item">
                                    <img src="<?php echo site_url() ?>assets/website/images/03.svg" alt="icons">
                                    <span>Soup</span>
                                    <i fa-plus"></i>
                                </a>
                                <ul class="submenu mm-collapse">
                                    <li><a class="mobile-menu-link" href="#">Sweet Corn Veg.Chi</a></li>
                                    <li><a class="mobile-menu-link" href="#">Hot and Sour Veg.Chi</a></li>
                                    <li><a class="mobile-menu-link" href="#"> Kozhi Kurumulak</a></li>
                                    <li><a class="mobile-menu-link" href="#">Adu Kurumulak</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="menu-item">
                                    <img src="<?php echo site_url() ?>assets/website/images/04.svg" alt="icons">
                                    <span>Lunch</span>
                                    <i fa-plus"></i>
                                </a>
                                <ul class="submenu mm-collapse">
                                    <li><a class="mobile-menu-link" href="#">Fish Curry Meals</a></li>
                                    <li><a class="mobile-menu-link" href="#">Pothichoru</a></li>
                                    <li><a class="mobile-menu-link" href="#">Chatty Chor</a></li>
                                    <li><a class="mobile-menu-link" href="#">Chicken Dum Biryani</a></li>



                                </ul>
                            </li>
                            <li>
                                <a href="#" class="menu-item">
                                    <img src="<?php echo site_url() ?>assets/website/images/05.svg" alt="icons">
                                    <span>Special Fish Fry</span>
                                    <i fa-plus"></i>
                                </a>
                                <ul class="submenu mm-collapse">
                                    <li><a class="mobile-menu-link" href="#">Mathi Fry</a></li>
                                    <li><a class="mobile-menu-link" href="#">Ayla Porichathu</a></li>
                                    <li><a class="mobile-menu-link" href="#">Manthal Fry</a></li>
                                    <li><a class="mobile-menu-link" href="#">Kakka Irachi</a></li>



                                </ul>
                            </li>



                            <li>
                                <a href="#" class="menu-item">
                                    <img src="<?php echo site_url() ?>assets/website/images/07.svg" alt="icons">
                                    <span>SuNi's Specials</span>
                                    <i fa-plus"></i>
                                </a>
                                <ul class="submenu mm-collapse">
                                    <li><a class="mobile-menu-link" href="#">Kizhi Poratta</a></li>
                                    <li><a class="mobile-menu-link" href="#">Kappa Biriyani</a></li>
                                    <li><a class="mobile-menu-link" href="#"> Duck Special</a></li>
                                    <li><a class="mobile-menu-link" href="#"> Kujan Kozhi Kondattam</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="menu-item">
                                    <img src="<?php echo site_url() ?>assets/website/images/07.svg" alt="icons">
                                    <span>Chicken</span>
                                    <i fa-plus"></i>
                                </a>
                                <ul class="submenu mm-collapse">
                                    <li><a class="mobile-menu-link" href="#">Kerala Chicken Curry</a></li>
                                    <li><a class="mobile-menu-link" href="#">Chicken Korma</a></li>
                                    <li><a class="mobile-menu-link" href="#"> Chicken Roast</a></li>
                                    <li><a class="mobile-menu-link" href="#"> Kozhi Kanthari Curry</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="menu-item">
                                    <img src="<?php echo site_url() ?>assets/website/images/09.svg" alt="icons">
                                    <span>Mutton</span>
                                    <i fa-plus"></i>
                                </a>
                                <ul class="submenu mm-collapse">
                                    <li><a class="mobile-menu-link" href="#">Mutton Coconut Fry</a></li>
                                    <li><a class="mobile-menu-link" href="#">Mutton Varattu</a></li>
                                    <li><a class="mobile-menu-link" href="#"> Mutton Pepper Fry</a></li>
                                    <li><a class="mobile-menu-link" href="#"> Mutton Kuruma</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="menu-item">
                                    <img src="<?php echo site_url() ?>assets/website/images/10.svg" alt="icons">
                                    <span>Sea Food Special</span>
                                    <i fa-plus"></i>
                                </a>
                                <ul class="submenu mm-collapse">
                                    <li><a class="mobile-menu-link" href="#">King Fish Mango Curry</a></li>
                                    <li><a class="mobile-menu-link" href="#">Meen Chatti Manga Curry</a></li>
                                    <li><a class="mobile-menu-link" href="#"> Meen Pollichathu</a></li>
                                    <li><a class="mobile-menu-link" href="#"> Koonthal Roast</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="menu-item">
                                    <img src="<?php echo site_url() ?>assets/website/images/10.svg" alt="icons">
                                    <span>Beef</span>
                                    <i fa-plus"></i>
                                </a>
                                <ul class="submenu mm-collapse">
                                    <li><a class="mobile-menu-link" href="#">Beef Cocount Fry</a></li>
                                    <li><a class="mobile-menu-link" href="#">Beef Nadan Curry</a></li>
                                    <li><a class="mobile-menu-link" href="#"> Beef Roast</a></li>
                                    <li><a class="mobile-menu-link" href="#"> Beef Koorkka Varatiyathu</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <!-- button area wrapper start -->
        <div class="button-area-main-wrapper-menuy-sidebar mt--50">
            <div class="contact-area">
                <div class="phone">
                    <i class="fa fa-headset"></i>
                    <a href="#">02345697871</a>
                </div>
                <div class="phone">
                    <i class="fa fa-envelope"></i>
                    <a href="#">02345697871</a>
                </div>
            </div>
            <div class="buton-area-bottom">
                <a href="#" class="rts-btn btn-primary">Sign In</a>
                <a href="#" class="rts-btn btn-primary">Sign Up</a>
            </div>
        </div>
        <!-- button area wrapper end -->

    </div>
    <!-- header style two End -->
    <!-- rts header area end -->
    <!-- rts header area end -->

    <div class="background-light-gray-color rts-section-gap bg_light-1 pt_sm--20" style="padding: 15px;">
        <!-- rts banner area start -->
        <div class="rts-banner-area-one mb--30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="category-area-main-wrapper-one">
                            <div class="swiper mySwiper-category-1 swiper-data" data-swiper='{
                                "spaceBetween":1,
                                "slidesPerView":1,
                                "loop": true,
                                "speed": 2000,
                                "autoplay":{
                                    "delay":"4000"
                                },
                                "navigation":{
                                    "nextEl":".swiper-button-next",
                                    "prevEl":".swiper-button-prev"
                                },
                                "breakpoints":{
                                "0":{
                                    "slidesPerView":1,
                                    "spaceBetween": 0},
                                "320":{
                                    "slidesPerView":1,
                                    "spaceBetween":0},
                                "480":{
                                    "slidesPerView":1,
                                    "spaceBetween":0},
                                "640":{
                                    "slidesPerView":1,
                                    "spaceBetween":0},
                                "840":{
                                    "slidesPerView":1,
                                    "spaceBetween":0},
                                "1140":{
                                    "slidesPerView":1,
                                    "spaceBetween":0}
                                }
                            }'>
                                <div class="swiper-wrapper">
                                    <!-- single swiper start -->
                                    <div class="swiper-slide">
                                        <div
                                            class="banner-bg-image bg_image bg_one-banner  ptb--120 ptb_md--80 ptb_sm--60">
                                            <div class="banner-one-inner-content">
                                                <span class="pre">Get up to 30% off on your first ₹150 purchase</span>
                                                <h1 class="title">
                                                    <?php echo lang('banner_title'); ?>
                                                </h1>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Shop Now
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-arrow-right"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-arrow-right"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single swiper start -->
                                    <!-- single swiper start -->
                                    <div class="swiper-slide">
                                        <div
                                            class="banner-bg-image bg_image bg_one-banner two  ptb--120 ptb_md--80 ptb_sm--60">
                                            <div class="banner-one-inner-content">
                                                <span class="pre">Get up to 30% off on your first ₹150 purchase</span>
                                                <h1 class="title">
                                                    <?php echo lang('banner_title'); ?>
                                                </h1>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Shop Now
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-arrow-right"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-arrow-right"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single swiper start -->
                                </div>

                                <button class="swiper-button-next"><i class="fa fa-arrow-right"></i></button>
                                <button class="swiper-button-prev"><i class="fa fa-arrow-left"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- rts banner area end -->
        <!-- rts category area satart -->
        <div class="rts-caregory-area-one ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="category-area-main-wrapper-one">
                            <div class="swiper mySwiper-category-1 swiper-data" data-swiper='{
                                "spaceBetween":12,
                                "slidesPerView":10,
                                "loop": true,
                                "speed": 1000,
                                "breakpoints":{
                                "0":{
                                    "slidesPerView":2,
                                    "spaceBetween": 12},
                                "320":{
                                    "slidesPerView":2,
                                    "spaceBetween":12},
                                "480":{
                                    "slidesPerView":3,
                                    "spaceBetween":12},
                                "640":{
                                    "slidesPerView":4,
                                    "spaceBetween":12},
                                "840":{
                                    "slidesPerView":4,
                                    "spaceBetween":12},
                                "1140":{
                                    "slidesPerView":10,
                                    "spaceBetween":12}
                                }
                            }'>
                                <div class="swiper-wrapper">
                                    <!-- single swiper start -->
                                    <div class="swiper-slide">
                                        <a href="#" class="single-category-one">
                                            <img src="<?php echo site_url() ?>assets/website/images/masaladosa.png"
                                                alt="category">
                                            <p>Masala Dosa</p>
                                        </a>
                                    </div>
                                    <!-- single swiper start -->
                                    <!-- single swiper start -->
                                    <div class="swiper-slide">
                                        <a href="#" class="single-category-one">
                                            <img src="<?php echo site_url() ?>assets/website/images/idli.png"
                                                alt="category">
                                            <p>Idly</p>
                                        </a>
                                    </div>
                                    <!-- single swiper start -->
                                    <!-- single swiper start -->
                                    <div class="swiper-slide">
                                        <a href="#" class="single-category-one">
                                            <img src="<?php echo site_url() ?>assets/website/images/vadaset.png"
                                                alt="category">
                                            <p>Vada Set</p>
                                        </a>
                                    </div>
                                    <!-- single swiper start -->
                                    <!-- single swiper start -->
                                    <div class="swiper-slide">
                                        <a href="#" class="single-category-one">
                                            <img src="<?php echo site_url() ?>assets/website/images/chickenlollipop.png"
                                                alt="category">
                                            <p>Chicken Lollipop</p>
                                        </a>
                                    </div>
                                    <!-- single swiper start -->
                                    <!-- single swiper start -->
                                    <div class="swiper-slide">
                                        <a href="#" class="single-category-one">
                                            <img src="<?php echo site_url() ?>assets/website/images/gobi65.png"
                                                alt="category">
                                            <p>Gobi 65</p>
                                        </a>
                                    </div>
                                    <!-- single swiper start -->
                                    <!-- single swiper start -->
                                    <div class="swiper-slide">
                                        <a href="#" class="single-category-one">
                                            <img src="<?php echo site_url() ?>assets/website/images/pthichoru.png"
                                                alt="category">
                                            <p>Pothichoru</p>
                                        </a>
                                    </div>
                                    <!-- single swiper start -->
                                    <!-- single swiper start -->
                                    <div class="swiper-slide">
                                        <a href="#" class="single-category-one">
                                            <img src="<?php echo site_url() ?>assets/website/images/chicken-biryani.png"
                                                alt="category">
                                            <p>Chicken Biryani</p>
                                        </a>
                                    </div>
                                    <!-- single swiper start -->
                                    <!-- single swiper start -->
                                    <div class="swiper-slide">
                                        <a href="#" class="single-category-one">
                                            <img src="<?php echo site_url() ?>assets/website/images/beef-biryani.png"
                                                alt="category">
                                            <p>Beef Biryani</p>
                                        </a>
                                    </div>
                                    <!-- single swiper start -->
                                    <!-- single swiper start -->
                                    <div class="swiper-slide">
                                        <a href="#" class="single-category-one">
                                            <img src="<?php echo site_url() ?>assets/website/images/chicken-curry.png"
                                                alt="category">
                                            <p>Chicken Curry</p>
                                        </a>
                                    </div>
                                    <!-- single swiper start -->
                                    <!-- single swiper start -->
                                    <div class="swiper-slide">
                                        <a href="#" class="single-category-one">
                                            <img src="<?php echo site_url() ?>assets/website/images/prawnsroast.png"
                                                alt="category">
                                            <p>Prawns Roast</p>
                                        </a>
                                    </div>
                                    <!-- single swiper start -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- rts category area end -->
    </div>

    <!-- rts featrure area start -->
    <div class="rts-feature-area rts-section-gap">
        <div class="container">
            <div class="row g-4">
                <div class="col-xl-20 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="single-feature-area">
                        <div class="icon">
                            <svg width="43" height="43" viewBox="0 0 43 43" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M36.7029 6.29715C32.642 2.23634 27.2429 0 21.5 0C15.7571 0 10.358 2.23634 6.29715 6.29715C2.23642 10.358 0 15.7571 0 21.5C0 27.2429 2.23642 32.642 6.29715 36.7029C10.358 40.7637 15.7571 43 21.5 43C27.2429 43 32.642 40.7637 36.7029 36.7029C40.7636 32.642 43 27.2429 43 21.5C43 15.7571 40.7636 10.358 36.7029 6.29715ZM21.5 40.4805C11.0341 40.4805 2.51953 31.9659 2.51953 21.5C2.51953 11.0341 11.0341 2.51953 21.5 2.51953C31.9659 2.51953 40.4805 11.0341 40.4805 21.5C40.4805 31.9659 31.9659 40.4805 21.5 40.4805Z"
                                    fill="#629D23" />
                                <path
                                    d="M22.8494 20.2402H20.1506C18.6131 20.2402 17.3623 18.9895 17.3623 17.452C17.3623 15.9145 18.6132 14.6638 20.1506 14.6638H25.548C26.2438 14.6638 26.8078 14.0997 26.8078 13.404C26.8078 12.7083 26.2438 12.1442 25.548 12.1442H22.7598V9.35594C22.7598 8.66022 22.1957 8.09618 21.5 8.09618C20.8043 8.09618 20.2402 8.66022 20.2402 9.35594V12.1442H20.1507C17.2239 12.1442 14.8429 14.5253 14.8429 17.452C14.8429 20.3787 17.224 22.7598 20.1507 22.7598H22.8495C24.3869 22.7598 25.6377 24.0106 25.6377 25.548C25.6377 27.0855 24.3869 28.3363 22.8495 28.3363H17.452C16.7563 28.3363 16.1923 28.9004 16.1923 29.5961C16.1923 30.2918 16.7563 30.8559 17.452 30.8559H20.2402V33.6442C20.2402 34.34 20.8043 34.904 21.5 34.904C22.1957 34.904 22.7598 34.34 22.7598 33.6442V30.8559H22.8494C25.7761 30.8559 28.1571 28.4747 28.1571 25.548C28.1571 22.6214 25.7761 20.2402 22.8494 20.2402Z"
                                    fill="#629D23" />
                            </svg>
                        </div>
                        <div class="content">
                            <h4 class="title">Wide Assortment</h4>
                            <span>Orders ₹50 or more</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-20 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="single-feature-area">
                        <div class="icon">
                            <svg width="37" height="44" viewBox="0 0 37 44" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M35.0347 19.5029C32.0518 11.3353 26.6248 5.76684 26.3952 5.53386L24.2276 3.33326V11.6016C24.2276 12.3124 23.658 12.8906 22.9578 12.8906C22.2577 12.8906 21.688 12.3124 21.688 11.6016C21.688 5.20446 16.5614 0 10.26 0H8.99021V1.28906C8.99021 7.30933 5.09884 11.646 2.14143 17.2212C-0.841884 22.8449 -0.69916 29.7349 2.51381 35.2021C5.7234 40.6636 11.5291 44 17.7786 44H18.3686C24.1822 44 29.6369 41.1045 32.9597 36.2545C36.2819 31.4054 37.056 25.0371 35.0347 19.5029ZM30.8748 34.7824C28.0265 38.9398 23.3513 41.4219 18.3686 41.4219H17.7786C12.4416 41.4219 7.42813 38.5325 4.69471 33.8813C1.93691 29.1886 1.81535 23.2733 4.37726 18.4436C7.17519 13.1691 10.9752 8.81934 11.4744 2.662C15.803 3.26502 19.1483 7.04412 19.1483 11.6015C19.1483 13.7338 20.8572 15.4687 22.9577 15.4687C25.0581 15.4687 26.767 13.7338 26.767 11.6015V9.91607C28.54 12.2131 31.0138 15.9094 32.6534 20.399C34.3856 25.1416 33.704 30.653 30.8748 34.7824Z"
                                    fill="#629D23" />
                                <path
                                    d="M16.6089 22C16.6089 19.8676 14.9 18.1328 12.7996 18.1328C10.6991 18.1328 8.99021 19.8676 8.99021 22C8.99021 24.1324 10.6991 25.8672 12.7996 25.8672C14.9 25.8672 16.6089 24.1324 16.6089 22ZM11.5298 22C11.5298 21.2892 12.0994 20.7109 12.7996 20.7109C13.4997 20.7109 14.0693 21.2892 14.0693 22C14.0693 22.7108 13.4997 23.2891 12.7996 23.2891C12.0994 23.2891 11.5298 22.7108 11.5298 22Z"
                                    fill="#629D23" />
                                <path
                                    d="M22.9578 28.4453C20.8573 28.4453 19.1485 30.1801 19.1485 32.3125C19.1485 34.4449 20.8573 36.1797 22.9578 36.1797C25.0583 36.1797 26.7672 34.4449 26.7672 32.3125C26.7672 30.1801 25.0583 28.4453 22.9578 28.4453ZM22.9578 33.6016C22.2577 33.6016 21.688 33.0233 21.688 32.3125C21.688 31.6017 22.2577 31.0234 22.9578 31.0234C23.658 31.0234 24.2276 31.6017 24.2276 32.3125C24.2276 33.0233 23.658 33.6016 22.9578 33.6016Z"
                                    fill="#629D23" />
                                <path
                                    d="M10.5466 34.0632L23.2407 18.599L25.1911 20.249L12.4969 35.7132L10.5466 34.0632Z"
                                    fill="#629D23" />
                            </svg>

                        </div>
                        <div class="content">
                            <h4 class="title">Easy Return Policy</h4>
                            <span>Orders ₹50 or more</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-20 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="single-feature-area">
                        <div class="icon">
                            <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M32.2963 41.508C31.8507 41.508 31.4844 41.847 31.4412 42.2812H24.9741L23.9539 36.1376L25.0879 35.0037C25.249 34.8425 25.3396 34.6239 25.3396 34.396C25.3396 34.1681 25.249 33.9496 25.0879 33.7883L24.0845 32.7849H25.799C27.6807 32.7849 29.4317 33.7189 30.4826 35.2833C30.7473 35.6773 31.2813 35.782 31.6752 35.5174C32.0691 35.2527 32.174 34.7188 31.9093 34.3248C30.5492 32.3004 28.29 31.0861 25.8569 31.067C26.6893 30.1451 27.1971 28.9246 27.1971 27.5876V26.3271C27.1971 23.4613 24.8657 21.1298 21.9998 21.1298C19.134 21.1298 16.8025 23.4613 16.8025 26.3271V27.5876C16.8025 28.925 17.3105 30.1456 18.1432 31.0676C14.1133 31.0988 10.8441 34.3856 10.8441 38.4228V43.1406C10.8441 43.6152 11.2288 44 11.7035 44H32.2962C32.7708 44 33.1555 43.6152 33.1555 43.1406V42.3674C33.1557 41.8928 32.771 41.508 32.2963 41.508ZM22.0099 35.6511L20.7548 34.396L22.0099 33.141L23.265 34.396L22.0099 35.6511ZM21.5651 37.6007C21.7014 37.6834 21.8554 37.7258 22.0098 37.7258C22.1641 37.7258 22.3182 37.6835 22.4545 37.6007L23.2318 42.2812H20.7878L21.5651 37.6007ZM18.5214 26.3271C18.5214 24.4091 20.0819 22.8485 22 22.8485C23.9181 22.8485 25.4786 24.409 25.4786 26.3271V27.5876C25.4786 29.5056 23.9181 31.0662 22 31.0662C20.0819 31.0662 18.5214 29.5057 18.5214 27.5876V26.3271ZM12.563 38.4228C12.563 35.314 15.0922 32.7849 18.2009 32.7849H19.9351L18.9317 33.7883C18.7705 33.9496 18.68 34.1681 18.68 34.396C18.68 34.6239 18.7705 34.8425 18.9317 35.0037L20.0657 36.1376L19.0455 42.2812H12.5629L12.563 38.4228Z"
                                    fill="#629D23" />
                                <path
                                    d="M10.9901 5.49504C10.9901 2.46504 8.525 0 5.4951 0C2.4652 0 0 2.46513 0 5.49504C0 8.52495 2.46512 10.9901 5.49501 10.9901C8.52491 10.9901 10.9901 8.52503 10.9901 5.49504ZM1.71875 5.49504C1.71875 3.41285 3.41275 1.71876 5.49501 1.71876C7.57728 1.71876 9.27128 3.41285 9.27128 5.49504C9.27128 7.57723 7.57728 9.27132 5.49501 9.27132C3.41275 9.27132 1.71875 7.57731 1.71875 5.49504Z"
                                    fill="#629D23" />
                                <path
                                    d="M17.3644 10.9902H26.6357C27.1103 10.9902 27.4951 10.6053 27.4951 10.1308V0.859378C27.4951 0.38483 27.1103 0 26.6357 0H17.3644C16.8897 0 16.505 0.38483 16.505 0.859378V10.1308C16.505 10.6053 16.8897 10.9902 17.3644 10.9902ZM18.2237 1.71876H25.7763V9.2714H18.2237V1.71876Z"
                                    fill="#629D23" />
                                <path
                                    d="M43.8848 9.35966L38.9261 0.771034C38.7727 0.505143 38.489 0.341345 38.1819 0.341345C37.8749 0.341345 37.5912 0.505143 37.4377 0.771034L32.479 9.35966C32.3255 9.62555 32.3255 9.95315 32.479 10.219C32.6325 10.4849 32.9162 10.6487 33.2233 10.6487H43.1406C43.4477 10.6487 43.7313 10.4849 43.8848 10.219C44.0384 9.95315 44.0384 9.62555 43.8848 9.35966ZM34.7117 8.92997L38.1818 2.91948L41.652 8.92997H34.7117Z"
                                    fill="#629D23" />
                                <path
                                    d="M22 19.4427C22.4746 19.4427 22.8594 19.0579 22.8594 18.5834V16.1313L22.8942 16.1799C23.062 16.4144 23.3258 16.5393 23.5938 16.5393C23.7669 16.5393 23.9417 16.4871 24.0933 16.3786C24.4792 16.1024 24.5681 15.5657 24.2919 15.1797L22.6989 12.9537C22.5375 12.7282 22.2773 12.5944 22.0001 12.5944C21.7228 12.5944 21.4626 12.7282 21.3012 12.9537L19.7082 15.1797C19.432 15.5657 19.521 16.1024 19.9069 16.3786C20.2928 16.6548 20.8296 16.566 21.1059 16.1799L21.1406 16.1313V18.5834C21.1406 19.058 21.5254 19.4427 22 19.4427Z"
                                    fill="#629D23" />
                                <path
                                    d="M14.9245 26.4029C14.9245 25.9283 14.5398 25.5435 14.0651 25.5435H6.35937V16.1313L6.39418 16.1799C6.56201 16.4144 6.82584 16.5393 7.09379 16.5393C7.26687 16.5393 7.44167 16.4871 7.59326 16.3786C7.97921 16.1024 8.06815 15.5657 7.79195 15.1797L6.19893 12.9537C6.03754 12.7282 5.77732 12.5944 5.50008 12.5944C5.22285 12.5944 4.96263 12.7282 4.80124 12.9537L3.20822 15.1797C2.93201 15.5657 3.02096 16.1024 3.4069 16.3786C3.79276 16.6548 4.32962 16.566 4.6059 16.1799L4.64062 16.1313V26.4029C4.64062 26.8774 5.02536 27.2622 5.5 27.2622H14.0651C14.5397 27.2622 14.9245 26.8775 14.9245 26.4029Z"
                                    fill="#629D23" />
                                <path
                                    d="M39.1988 12.9536C39.0374 12.7281 38.7772 12.5943 38.5 12.5943C38.2227 12.5943 37.9625 12.7281 37.8011 12.9536L36.2081 15.1796C35.9319 15.5656 36.0209 16.1023 36.4068 16.3785C36.7928 16.6548 37.3296 16.5659 37.6058 16.1799L37.6406 16.1313V25.5435H29.9349C29.4602 25.5435 29.0755 25.9283 29.0755 26.4029C29.0755 26.8774 29.4602 27.2622 29.9349 27.2622H38.5C38.9746 27.2622 39.3594 26.8774 39.3594 26.4029V16.1313L39.3942 16.1799C39.562 16.4144 39.8258 16.5393 40.0938 16.5393C40.2669 16.5393 40.4417 16.4871 40.5932 16.3786C40.9792 16.1024 41.0681 15.5657 40.7919 15.1797L39.1988 12.9536Z"
                                    fill="#629D23" />
                                <path
                                    d="M32.2962 39.3597C32.7708 39.3597 33.1555 38.9749 33.1555 38.5003C33.1555 38.0257 32.7708 37.6409 32.2962 37.6409C31.8215 37.6409 31.4368 38.0257 31.4368 38.5003C31.4368 38.9749 31.8215 39.3597 32.2962 39.3597Z"
                                    fill="#629D23" />
                            </svg>

                        </div>
                        <div class="content">
                            <h4 class="title">Best Prices & Offers</h4>
                            <span>Orders ₹50 or more</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-20 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="single-feature-area">
                        <div class="icon">
                            <svg width="43" height="43" viewBox="0 0 43 43" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M36.7029 6.29715C32.642 2.23634 27.2429 0 21.5 0C15.7571 0 10.358 2.23634 6.29715 6.29715C2.23642 10.358 0 15.7571 0 21.5C0 27.2429 2.23642 32.642 6.29715 36.7029C10.358 40.7637 15.7571 43 21.5 43C27.2429 43 32.642 40.7637 36.7029 36.7029C40.7636 32.642 43 27.2429 43 21.5C43 15.7571 40.7636 10.358 36.7029 6.29715ZM21.5 40.4805C11.0341 40.4805 2.51953 31.9659 2.51953 21.5C2.51953 11.0341 11.0341 2.51953 21.5 2.51953C31.9659 2.51953 40.4805 11.0341 40.4805 21.5C40.4805 31.9659 31.9659 40.4805 21.5 40.4805Z"
                                    fill="#629D23" />
                                <path
                                    d="M22.8494 20.2402H20.1506C18.6131 20.2402 17.3623 18.9895 17.3623 17.452C17.3623 15.9145 18.6132 14.6638 20.1506 14.6638H25.548C26.2438 14.6638 26.8078 14.0997 26.8078 13.404C26.8078 12.7083 26.2438 12.1442 25.548 12.1442H22.7598V9.35594C22.7598 8.66022 22.1957 8.09618 21.5 8.09618C20.8043 8.09618 20.2402 8.66022 20.2402 9.35594V12.1442H20.1507C17.2239 12.1442 14.8429 14.5253 14.8429 17.452C14.8429 20.3787 17.224 22.7598 20.1507 22.7598H22.8495C24.3869 22.7598 25.6377 24.0106 25.6377 25.548C25.6377 27.0855 24.3869 28.3363 22.8495 28.3363H17.452C16.7563 28.3363 16.1923 28.9004 16.1923 29.5961C16.1923 30.2918 16.7563 30.8559 17.452 30.8559H20.2402V33.6442C20.2402 34.34 20.8043 34.904 21.5 34.904C22.1957 34.904 22.7598 34.34 22.7598 33.6442V30.8559H22.8494C25.7761 30.8559 28.1571 28.4747 28.1571 25.548C28.1571 22.6214 25.7761 20.2402 22.8494 20.2402Z"
                                    fill="#629D23" />
                            </svg>
                        </div>
                        <div class="content">
                            <h4 class="title">Support 24/7</h4>
                            <span>Orders ₹50 or more</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-20 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="single-feature-area">
                        <div class="icon">
                            <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.26667 8.26667C11.935 4.59834 16.8122 2.57812 22 2.57812C25.9672 2.57812 29.8028 3.78495 33.0284 6.01279L30.5382 6.2682L30.8013 8.83283L37.5044 8.14533L36.8169 1.4422L34.2522 1.70526L34.4751 3.8787C30.8247 1.36271 26.4866 0 22 0C16.1236 0 10.5989 2.28843 6.44368 6.44368C2.28843 10.5989 0 16.1236 0 22C0 26.3993 1.29456 30.6457 3.7437 34.28L5.88165 32.8393C5.852 32.7952 5.82321 32.7508 5.79391 32.7065C3.68998 29.5289 2.57812 25.8307 2.57812 22C2.57812 16.8123 4.59834 11.935 8.26667 8.26667Z"
                                    fill="#629D23" />
                                <path
                                    d="M40.2564 9.71996L38.1184 11.1607C38.148 11.2047 38.1768 11.2493 38.2061 11.2935C40.3099 14.4711 41.4219 18.1693 41.4219 22C41.4219 27.1878 39.4017 32.065 35.7333 35.7333C32.0651 39.4017 27.1879 41.4219 22 41.4219C18.0328 41.4219 14.1972 40.2151 10.9716 37.9872L13.4618 37.7318L13.1987 35.1672L6.49559 35.8547L7.18309 42.5578L9.7478 42.2947L9.52488 40.1213C13.1754 42.6373 17.5135 44 22 44C27.8764 44 33.4011 41.7116 37.5564 37.5563C41.7117 33.4011 44 27.8764 44 22C44 17.6007 42.7055 13.3543 40.2564 9.71996Z"
                                    fill="#629D23" />
                                <path
                                    d="M10.7407 24.7057L12.4096 23.1632C13.6739 22 13.9142 21.2161 13.9142 20.3564C13.9142 18.7127 12.5108 17.6633 10.4753 17.6633C8.73048 17.6633 7.4788 18.3966 6.80874 19.5093L8.66731 20.546C9.02129 19.9771 9.60291 19.6863 10.2477 19.6863C11.0063 19.6863 11.3856 20.0276 11.3856 20.5966C11.3856 20.9633 11.2845 21.3679 10.5764 22.0254L7.26387 25.123V26.6907H14.1544V24.7057L10.7407 24.7057Z"
                                    fill="#629D23" />
                                <path
                                    d="M22.1076 24.9965H23.4224V23.0115H22.1076V21.507H19.7433V23.0115H17.948L21.5512 17.8404H18.9594L14.9894 23.3655V24.9965H19.6674V26.6906H22.1076V24.9965Z"
                                    fill="#629D23" />
                                <path d="M25.6986 27.955L29.8708 16.045H27.7341L23.5618 27.955H25.6986Z"
                                    fill="#629D23" />
                                <path
                                    d="M31.995 21.1908V19.8254H34.3213L31.3375 26.6906H34.0685L37.1913 19.4081V17.8404H29.8582V21.1908H31.995Z"
                                    fill="#629D23" />
                            </svg>


                        </div>
                        <div class="content">
                            <h4 class="title">Best Prices & Offers</h4>
                            <span>Orders ₹50 or more</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts featrure area end -->

    <!-- rts grocery feature area start -->

    <!-- rts grocery feature area end -->

    <!-- rts grocery feature area start -->

    <!-- rts grocery feature area end -->



    <!-- for testing -->
    <div class="weekly-best-selling-area rts-section-gap bg_light-1 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-area-between">
                        <h2 class="title-left">
                            Categories
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content" id="myTabContent">
                        <!-- first tabs area start-->
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row g-4">
                                <?php if (!empty($products)): ?>
                                <?php foreach ($products as $product): ?>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>uploads/product/<?php echo $product['image']; ?>"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    <?php echo $product['product_name_' . $language]; ?>
                                                </h4>
                                            </a>

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹<?php echo $product['price']; ?></span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <form action="<?php echo site_url('website/cart/add'); ?>"
                                                    method="post">
                                                    <input type="hidden" name="product_id"
                                                        value="<?php echo $product['product_id']; ?>">
                                                    <button class="rts-btn btn-primary radious-sm with-icon"
                                                        type="submit">
                                                        <div class="btn-text">
                                                            Add
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa fa-cart-shopping"></i>
                                                        </div>
                                                        <div class="arrow-icon">
                                                            <i class="fa fa-cart-shopping"></i>
                                                        </div>
                                                    </button>
                                                </form>
                                                <!-- <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                <div class="btn-text">
                                                    Add
                                                </div>
                                                <div class="arrow-icon">
                                                    <i class="fa fa-cart-shopping"></i>
                                                </div>
                                                <div class="arrow-icon">
                                                    <i class="fa fa-cart-shopping"></i>
                                                </div>
                                            </a> -->
                                            </div>
                                        </div>
                                    </div>

                                    <!-- single blog area end -->
                                </div>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <p>No products found.</p>
                                <?php endif; ?>




                            </div>
                        </div>
                        <!-- first tabs area start-->

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row g-4">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/pothichoru.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Pothichoru
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/chattichoru.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Chattichoru
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/chicken-biryaniproduct.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Chicken Dum Biryani
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/fishbiryani.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Fish Biryani
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row g-4">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/mathifry.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Mathi Fry
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/ayalafry.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Ayla Porichathu
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/manthal.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Manthal Fry
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/kakka.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Kakka Irachi
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="vitamine" role="tabpanel" aria-labelledby="vitamine-tab">
                            <div class="row g-4">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/kerala-chicken.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Kerala Chicken Curry
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/chicken roast.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Chicken Roast
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/chicken-varattu.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Chicken Varattu
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/chicken-kanthari.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Chicken Kanthari
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- for testing -->


    <!-- categories filter -->
    <div class="weekly-best-selling-area rts-section-gap bg_light-1 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-area-between">
                        <h2 class="title-left">
                            Categories
                        </h2>
                        <ul class="nav nav-tabs best-selling-grocery" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">Breakfast</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">Lunch</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                    type="button" role="tab" aria-controls="contact" aria-selected="false">Special Fish
                                    Fry</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="vitamine-tab" data-bs-toggle="tab"
                                    data-bs-target="#vitamine" type="button" role="tab" aria-controls="vitamine"
                                    aria-selected="false">Chicken</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content" id="myTabContent">
                        <!-- first tabs area start-->
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row g-4">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/masaladosaproduct.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Masala Dosa
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                            <span class="text">Read Details</span>
                                            <div class="plus-icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                            <div class="plus-icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/idliproduct.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Idli
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                            <span class="text">Read Details</span>
                                            <div class="plus-icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                            <div class="plus-icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/pooribhaji.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Poori Bhaji
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                            <span class="text">Read Details</span>
                                            <div class="plus-icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                            <div class="plus-icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/vadsetproduct.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Vada Set
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                            <span class="text">Read Details</span>
                                            <div class="plus-icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                            <div class="plus-icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>

                            </div>
                        </div>
                        <!-- first tabs area start-->

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row g-4">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/pothichoru.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Pothichoru
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/chattichoru.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Chattichoru
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/chicken-biryaniproduct.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Chicken Dum Biryani
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/fishbiryani.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Fish Biryani
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row g-4">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/mathifry.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Mathi Fry
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/ayalafry.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Ayla Porichathu
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/manthal.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Manthal Fry
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/kakka.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Kakka Irachi
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="vitamine" role="tabpanel" aria-labelledby="vitamine-tab">
                            <div class="row g-4">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/kerala-chicken.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Kerala Chicken Curry
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/chicken roast.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Chicken Roast
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/chicken-varattu.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Chicken Varattu
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <!-- single blog area start -->
                                    <div class="single-blog-area-start single-shopping-card-one">
                                        <a href="#" class="thumbnail">
                                            <img src="<?php echo site_url() ?>assets/website/images/chicken-kanthari.png"
                                                alt="blog-area">
                                        </a>
                                        <div class="blog-body" style="border: none;">

                                            <a href="#">
                                                <h4 class="title">
                                                    Chicken Kanthari
                                                </h4>
                                            </a>
                                            <!-- <a href="#" class="shop-now-goshop-btn">
                                                <span class="text">Read Details</span>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                                <div class="plus-icon">
                                                    <i class="fa fa-plus"></i>
                                                </div>
                                            </a> -->

                                            <div class="cart-counter-action">
                                                <div class="price-area">
                                                    <span class="current">₹36.00</span>

                                                </div>
                                                <div class="quantity-edit">
                                                    <input type="text" class="input" value="1">
                                                    <div class="button-wrapper-action">
                                                        <button class="button"><i
                                                                class="fa fa-chevron-down"></i></button>
                                                        <button class="button plus">+<i
                                                                class="fa fa-chevron-up"></i></button>
                                                    </div>
                                                </div>
                                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                                    <div class="btn-text">
                                                        Add
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                    <div class="arrow-icon">
                                                        <i class="fa fa-cart-shopping"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single blog area end -->
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- categories filter -->

    <!-- rts category feature area start -->

    <!-- rts category feature area end -->

    <!-- rts top tranding product area -->
    <!-- <div class="top-tranding-product rts-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-area-between">
                        <h2 class="title-left mb--10">
                            Top Trending Products
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="cover-card-main-over">
                        <div class="row g-4">
                            <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                                <div class="single-shopping-card-one tranding-product">
                                    <a href="#" class="thumbnail-preview">
                                        <div class="badge">
                                            <span>25% <br> 
                                                Off
                                            </span>
                                            <i class="fa-solid fa-bookmark"></i>
                                        </div>
                                        <img src="<?php echo site_url() ?>assets/website/images/grocery07 .webp" alt="grocery">
                                    </a>
                                    <div class="body-content">

                                        <a href="#">
                                            <h4 class="title">Pastine Mellin Filid</h4>
                                        </a>
                                        <span class="availability">500g Pack</span>
                                        <div class="price-area">
                                            <span class="current">₹36.00</span>
                                            <div class="previous">₹36.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                                <div class="single-shopping-card-one tranding-product">
                                    <a href="#" class="thumbnail-preview">
                                        <div class="badge">
                                            <span>25% <br> 
                                                Off
                                            </span>
                                            <i class="fa-solid fa-bookmark"></i>
                                        </div>
                                        <img src="<?php echo site_url() ?>assets/website/images/grocery08 .webp" alt="grocery">
                                    </a>
                                    <div class="body-content">

                                        <a href="#">
                                            <h4 class="title">Di Grano Tenero</h4>
                                        </a>
                                        <span class="availability">500g Pack</span>
                                        <div class="price-area">
                                            <span class="current">₹36.00</span>
                                            <div class="previous">₹36.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                                <div class="single-shopping-card-one tranding-product">
                                    <a href="#" class="thumbnail-preview">
                                        <div class="badge">
                                            <span>25% <br> 
                                                Off
                                            </span>
                                            <i class="fa-solid fa-bookmark"></i>
                                        </div>
                                        <img src="<?php echo site_url() ?>assets/website/images/grocery09 .webp" alt="grocery">
                                    </a>
                                    <div class="body-content">

                                        <a href="#">
                                            <h4 class="title">Mellin Grano Tenero</h4>
                                        </a>
                                        <span class="availability">500g Pack</span>
                                        <div class="price-area">
                                            <span class="current">₹36.00</span>
                                            <div class="previous">₹36.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                                <div class="single-shopping-card-one tranding-product">
                                    <a href="#" class="thumbnail-preview">
                                        <div class="badge">
                                            <span>25% <br> 
                                                Off
                                            </span>
                                            <i class="fa-solid fa-bookmark"></i>
                                        </div>
                                        <img src="<?php echo site_url() ?>assets/website/images/grocery10.webp" alt="grocery">
                                    </a>
                                    <div class="body-content">

                                        <a href="#">
                                            <h4 class="title">Grano Tenero</h4>
                                        </a>
                                        <span class="availability">500g Pack</span>
                                        <div class="price-area">
                                            <span class="current">₹36.00</span>
                                            <div class="previous">₹36.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                                <div class="single-shopping-card-one tranding-product">
                                    <a href="#" class="thumbnail-preview">
                                        <div class="badge">
                                            <span>25% <br> 
                                                Off
                                            </span>
                                            <i class="fa-solid fa-bookmark"></i>
                                        </div>
                                        <img src="<?php echo site_url() ?>assets/website/images/grocery11.webp" alt="grocery">
                                    </a>
                                    <div class="body-content">

                                        <a href="#">
                                            <h4 class="title">Jack Froot</h4>
                                        </a>
                                        <span class="availability">500g Pack</span>
                                        <div class="price-area">
                                            <span class="current">₹36.00</span>
                                            <div class="previous">₹36.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                                <div class="single-shopping-card-one tranding-product">
                                    <a href="#" class="thumbnail-preview">
                                        <div class="badge">
                                            <span>25% <br> 
                                                Off
                                            </span>
                                            <i class="fa-solid fa-bookmark"></i>
                                        </div>
                                        <img src="<?php echo site_url() ?>assets/website/images/grocery12.webp" alt="grocery">
                                    </a>
                                    <div class="body-content">

                                        <a href="#">
                                            <h4 class="title">Fresh Mango</h4>
                                        </a>
                                        <span class="availability">500g Pack</span>
                                        <div class="price-area">
                                            <span class="current">₹36.00</span>
                                            <div class="previous">₹36.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                                <div class="single-shopping-card-one tranding-product">
                                    <a href="#" class="thumbnail-preview">
                                        <div class="badge">
                                            <span>25% <br> 
                                                Off
                                            </span>
                                            <i class="fa-solid fa-bookmark"></i>
                                        </div>
                                        <img src="<?php echo site_url() ?>assets/website/images/grocery13.webp" alt="grocery">
                                    </a>
                                    <div class="body-content">

                                        <a href="#">
                                            <h4 class="title">Fresh Juice</h4>
                                        </a>
                                        <span class="availability">500g Pack</span>
                                        <div class="price-area">
                                            <span class="current">₹36.00</span>
                                            <div class="previous">₹36.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                                <div class="single-shopping-card-one tranding-product">
                                    <a href="#" class="thumbnail-preview">
                                        <div class="badge">
                                            <span>25% <br> 
                                                Off
                                            </span>
                                            <i class="fa-solid fa-bookmark"></i>
                                        </div>
                                        <img src="<?php echo site_url() ?>assets/website/images/grocery14.webp" alt="grocery">
                                    </a>
                                    <div class="body-content">

                                        <a href="#">
                                            <h4 class="title">Pastine Mellin</h4>
                                        </a>
                                        <span class="availability">500g Pack</span>
                                        <div class="price-area">
                                            <span class="current">₹36.00</span>
                                            <div class="previous">₹36.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- rts top tranding product area end -->

    <!-- rts top tranding product area -->
    <div class="blog-area-start rts-section-gapBottom" style="padding: 30px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-area-between">
                        <h2 class="title-left mb--0">
                            Latest Blog Post Insights
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="cover-card-main-over">
                        <div class="row g-4">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <!-- single blog area start -->
                                <div class="single-blog-area-start">
                                    <a href="#" class="thumbnail">
                                        <img src="<?php echo site_url() ?>assets/website/images/blog01.webp"
                                            alt="blog-area">
                                    </a>
                                    <div class="blog-body">
                                        <div class="top-area">
                                            <div class="single-meta">
                                                <i class="fa fa-clock"></i>
                                                <span>15 Sep, 2023</span>
                                            </div>
                                            <div class="single-meta">
                                                <i class="fa fa-folder"></i>
                                                <span>Modern Fashion</span>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <h4 class="title">
                                                Shion Fixation: Fueling Your Passion
                                                for All Things Stylish
                                            </h4>
                                        </a>
                                        <a href="#" class="shop-now-goshop-btn">
                                            <span class="text">Read Details</span>
                                            <div class="plus-icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                            <div class="plus-icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- single blog area end -->
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <!-- single blog area start -->
                                <div class="single-blog-area-start">
                                    <a href="#" class="thumbnail">
                                        <img src="<?php echo site_url() ?>assets/website/images/blog02.webp"
                                            alt="blog-area">
                                    </a>
                                    <div class="blog-body">
                                        <div class="top-area">
                                            <div class="single-meta">
                                                <i class="fa fa-clock"></i>
                                                <span>15 Sep, 2023</span>
                                            </div>
                                            <div class="single-meta">
                                                <i class="fa fa-folder"></i>
                                                <span>Modern Fashion</span>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <h4 class="title">
                                                Ashion Fixation: Fueling Your Passion
                                                for All Things Stylish
                                            </h4>
                                        </a>
                                        <a href="#" class="shop-now-goshop-btn">
                                            <span class="text">Read Details</span>
                                            <div class="plus-icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                            <div class="plus-icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- single blog area end -->
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <!-- single blog area start -->
                                <div class="single-blog-area-start">
                                    <a href="#" class="thumbnail">
                                        <img src="<?php echo site_url() ?>assets/website/images/blog03 (1).webp"
                                            alt="blog-area">
                                    </a>
                                    <div class="blog-body">
                                        <div class="top-area">
                                            <div class="single-meta">
                                                <i class="fa fa-clock"></i>
                                                <span>15 Sep, 2023</span>
                                            </div>
                                            <div class="single-meta">
                                                <i class="fa fa-folder"></i>
                                                <span>Modern Fashion</span>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <h4 class="title">
                                                Fixation: Fueling Your Passion
                                                for All Things Stylish
                                            </h4>
                                        </a>
                                        <a href="#" class="shop-now-goshop-btn">
                                            <span class="text">Read Details</span>
                                            <div class="plus-icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                            <div class="plus-icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- single blog area end -->
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <!-- single blog area start -->
                                <div class="single-blog-area-start">
                                    <a href="#" class="thumbnail">
                                        <img src="<?php echo site_url() ?>assets/website/images/blog04 (1).webp"
                                            alt="blog-area">
                                    </a>
                                    <div class="blog-body">
                                        <div class="top-area">
                                            <div class="single-meta">
                                                <i class="fa fa-clock"></i>
                                                <span>15 Sep, 2023</span>
                                            </div>
                                            <div class="single-meta">
                                                <i class="fa fa-folder"></i>
                                                <span>Modern Fashion</span>
                                            </div>
                                        </div>
                                        <a href="#">
                                            <h4 class="title">
                                                Fashion Fixation: Fueling Your Passion
                                                for All Things Stylish
                                            </h4>
                                        </a>
                                        <a href="#" class="shop-now-goshop-btn">
                                            <span class="text">Read Details</span>
                                            <div class="plus-icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                            <div class="plus-icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- single blog area end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts top tranding product area end -->

    <!-- rts footer one area start -->
    <div class="rts-footer-area pt--80 bg_light-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-main-content-wrapper pb--70 pb_sm--30">
                        <!-- single footer area wrapper -->
                        <div class="single-footer-wized">
                            <h3 class="footer-title">About Company</h3>
                            <div class="call-area">
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="info">
                                    <span>Have Question? Call Us 24/7</span>
                                    <a href="#" class="number">+258 3692 2569</a>
                                </div>
                            </div>
                            <div class="opening-hour">
                                <div class="single">
                                    <p>Monday - Friday: <span>8:00am - 6:00pm</span></p>
                                </div>
                                <div class="single">
                                    <p>Saturday: <span>8:00am - 6:00pm</span></p>
                                </div>
                                <div class="single">
                                    <p>Sunday: <span>Service Close</span></p>
                                </div>
                            </div>
                        </div>
                        <!-- single footer area wrapper -->
                        <!-- single footer area wrapper -->
                        <div class="single-footer-wized">
                            <h3 class="footer-title">Our Stores</h3>
                            <div class="footer-nav">
                                <ul>
                                    <li><a href="#">Delivery Information</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Support Center</a></li>
                                    <li><a href="#">Careers</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- single footer area wrapper -->
                        <!-- single footer area wrapper -->
                        <div class="single-footer-wized">
                            <h3 class="footer-title">Shop Categories</h3>
                            <div class="footer-nav">
                                <ul>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Information</a></li>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Careers</a></li>
                                    <li><a href="#">Nest Stories</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- single footer area wrapper -->
                        <!-- single footer area wrapper -->
                        <div class="single-footer-wized">
                            <h3 class="footer-title">Useful Links</h3>
                            <div class="footer-nav">
                                <ul>
                                    <li><a href="#">Cancellation & Returns</a></li>
                                    <li><a href="#">Report Infringement</a></li>
                                    <li><a href="#">Payments</a></li>
                                    <li><a href="#">Shipping</a></li>
                                    <li><a href="#">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- single footer area wrapper -->
                        <!-- single footer area wrapper -->

                        <!-- single footer area wrapper -->
                    </div>
                    <div class="social-and-payment-area-wrapper">
                        <div class="social-one-wrapper">
                            <span>Follow Us:</span>
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <div class="payment-access">
                            <span>Payment Accepts:</span>
                            <img src="<?php echo site_url() ?>assets/website/images/payment.webp" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts footer one area end -->

    <!-- rts copyright-area start -->
    <div class="rts-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-between-1">
                        <p class="disc">
                            Copyright 2024 <a href="#">EMIGO</a>. All rights reserved.
                        </p>
                        <a href="#" class="playstore-app-area">
                            <span>Download App</span>
                            <img src="<?php echo site_url() ?>assets/website/images/googleplay.webp" alt="">
                            <img src="<?php echo site_url() ?>assets/website/images/appstore.webp" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts copyright-area end -->

    <!-- modal -->
    <!-- <div id="myModal-1" class="modal fade" role="dialog">
        <div class="modal-dialog bg_image">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal"><i class="fa fa-x"></i></button>
                </div>
                <div class="modal-body text-center">
                    <div class="inner-content">
                        <div class="content">
                            <span class="pre-title">Get up to 30% off on your first ₹150 purchase</span>
                            <h1 class="title">Feed Your Family at the  <br>
                                Best Price</h1>
                            <p class="disc">
                                We have prepared special discounts for you on grocery products. Don't <br> miss these opportunities...
                            </p>
                            <div class="rts-btn-banner-area">
                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                    <div class="btn-text">
                                        Shop Now
                                    </div>
                                    <div class="arrow-icon">
                                        <i class="fa fa-arrow-right"></i>
                                    </div>
                                    <div class="arrow-icon">
                                        <i class="fa fa-arrow-right"></i>
                                    </div>
                                </a>
                                <div class="price-area">
                                    <span>
                                        from
                                    </span>
                                    <h3 class="title animated fadeIn">₹80.99</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->





    <!-- successfully add in wishlist -->
    <!-- <div class="successfully-addedin-wishlist">
        <div class="d-flex" style="align-items: center; gap: 15px;">
            <i class="fa fa-check"></i>
            <p>Your item has already added in wishlist successfully</p>
        </div>
    </div> -->
    <!-- successfully add in wishlist end -->



    <!-- Modal -->
    <!-- <div class="modal modal-compare-area-start fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Products Compare</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="compare-main-wrapper-body">
                        <div class="single-compare-elements name">Preview</div>
                        <div class="single-compare-elements">
                            <div class="thumbnail-preview">
                                <img src="<?php echo site_url() ?>assets/website/images/grocery/01.jpg" alt="grocery">
                            </div>
                        </div>
                        <div class="single-compare-elements">
                            <div class="thumbnail-preview">
                                <img src="<?php echo site_url() ?>assets/website/images/grocery/02.jpg" alt="grocery">
                            </div>
                        </div>
                        <div class="single-compare-elements">
                            <div class="thumbnail-preview">
                                <img src="<?php echo site_url() ?>assets/website/images/grocery/03.jpg" alt="grocery">
                            </div>
                        </div>
                    </div>
                    <div class="compare-main-wrapper-body productname spacifiq">
                        <div class="single-compare-elements name">Name</div>
                        <div class="single-compare-elements">
                            <p>J.Crew Mercantile Women's Short</p>
                        </div>
                        <div class="single-compare-elements">
                            <p>Amazon Essentials Women's Tanks</p>
                        </div>
                        <div class="single-compare-elements">
                            <p>Amazon Brand - Daily Ritual Wom</p>
                        </div>
                    </div>
                    <div class="compare-main-wrapper-body productname">
                        <div class="single-compare-elements name">Price</div>
                        <div class="single-compare-elements price">
                            <p>₹25.00</p>
                        </div>
                        <div class="single-compare-elements price">
                            <p>₹39.25</p>
                        </div>
                        <div class="single-compare-elements price">
                            <p>₹12.00</p>
                        </div>
                    </div>
                    <div class="compare-main-wrapper-body productname">
                        <div class="single-compare-elements name">Description</div>
                        <div class="single-compare-elements discription">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard</p>
                        </div>
                        <div class="single-compare-elements discription">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard</p>
                        </div>
                        <div class="single-compare-elements discription">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard</p>
                        </div>
                    </div>
                    <div class="compare-main-wrapper-body productname">
                        <div class="single-compare-elements name">Rating</div>
                        <div class="single-compare-elements">
                            <div class="rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span>(25)</span>
                            </div>
                        </div>
                        <div class="single-compare-elements">
                            <div class="rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span>(19)</span>
                            </div>
                        </div>
                        <div class="single-compare-elements">
                            <div class="rating">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span>(120)</span>
                            </div>
                        </div>
                    </div>
                    <div class="compare-main-wrapper-body productname">
                        <div class="single-compare-elements name">Weight</div>
                        <div class="single-compare-elements">
                            <div class="rating">
                                <p>320 gram</p>
                            </div>
                        </div>
                        <div class="single-compare-elements">
                            <p>370 gram</p>
                        </div>
                        <div class="single-compare-elements">
                            <p>380 gram</p>
                        </div>
                    </div>
                    <div class="compare-main-wrapper-body productname">
                        <div class="single-compare-elements name">Stock status</div>
                        <div class="single-compare-elements">
                            <div class="instocks">
                                <span>In Stock</span>
                            </div>
                        </div>
                        <div class="single-compare-elements">
                            <div class="outstocks">
                                <span class="out-stock">Out Of Stock</span>
                            </div>
                        </div>
                        <div class="single-compare-elements">
                            <div class="instocks">
                                <span>In Stock</span>
                            </div>
                        </div>
                    </div>
                    <div class="compare-main-wrapper-body productname">
                        <div class="single-compare-elements name">Buy Now</div>
                        <div class="single-compare-elements">
                            <div class="cart-counter-action">
                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                    <div class="btn-text">
                                        Add To Cart
                                    </div>
                                    <div class="arrow-icon">
                                        <i class="fa fa-cart-shopping"></i>
                                    </div>
                                    <div class="arrow-icon">
                                        <i class="fa fa-cart-shopping"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="single-compare-elements">
                            <div class="cart-counter-action">
                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                    <div class="btn-text">
                                        Add To Cart
                                    </div>
                                    <div class="arrow-icon">
                                        <i class="fa fa-cart-shopping"></i>
                                    </div>
                                    <div class="arrow-icon">
                                        <i class="fa fa-cart-shopping"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="single-compare-elements">
                            <div class="cart-counter-action">
                                <a href="#" class="rts-btn btn-primary radious-sm with-icon">
                                    <div class="btn-text">
                                        Add To Cart
                                    </div>
                                    <div class="arrow-icon">
                                        <i class="fa fa-cart-shopping"></i>
                                    </div>
                                    <div class="arrow-icon">
                                        <i class="fa fa-cart-shopping"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->



    <!--================= Preloader Section Start Here =================-->
    <!-- <div id="weiboo-load">
    <div class="preloader-new">
        <svg class="cart_preloader" role="img" aria-label="Shopping cart_preloader line animation"
            viewBox="0 0 128 128" width="128px" height="128px" xmlns="http://www.w3.org/2000/svg">
            <g fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="8">
                <g class="cart__track" stroke="hsla(0,10%,10%,0.1)">
                    <polyline points="4,4 21,4 26,22 124,22 112,64 35,64 39,80 106,80" />
                    <circle cx="43" cy="111" r="13" />
                    <circle cx="102" cy="111" r="13" />
                </g>
                <g class="cart__lines" stroke="currentColor">
                    <polyline class="cart__top" points="4,4 21,4 26,22 124,22 112,64 35,64 39,80 106,80"
                        stroke-dasharray="338 338" stroke-dashoffset="-338" />
                    <g class="cart__wheel1" transform="rotate(-90,43,111)">
                        <circle class="cart__wheel-stroke" cx="43" cy="111" r="13" stroke-dasharray="81.68 81.68"
                            stroke-dashoffset="81.68" />
                    </g>
                    <g class="cart__wheel2" transform="rotate(90,102,111)">
                        <circle class="cart__wheel-stroke" cx="102" cy="111" r="13" stroke-dasharray="81.68 81.68"
                            stroke-dashoffset="81.68" />
                    </g>
                </g>
            </g>
        </svg>
    </div>
</div> -->
    <!--================= Preloader End Here =================-->





    <div class="search-input-area">
        <div class="container">
            <div class="search-input-inner">
                <div class="input-div">
                    <input id="searchInput1" class="search-input" type="text" placeholder="Search by keyword or #">
                    <button><i class="far fa-search"></i></button>
                </div>
            </div>
        </div>
        <div id="close" class="search-close-icon"><i class="far fa-times"></i></div>
    </div>
    <div id="anywhere-home" class="anywere"></div>
    <!-- progress area start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
            </path>
        </svg>
    </div>
    <!-- progress area end -->


    <!-- plugins js -->
    <script defer src="<?php echo site_url() ?>assets/website/js/plugins.js"></script>

    <!-- custom js -->
    <script defer src="<?php echo site_url() ?>assets/website/js/main.js"></script>
    <!-- header style two End -->


</body>

</html>