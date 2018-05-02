<?php
session_start();
session_unset();
$_SESSION = array();
$_SESSION['define'] = false;
// set timzone
date_default_timezone_set('UTC');
// site bast dir and url
$BASE_HTTP = 'http://';
$_SESSION['BASE_DIR'] = dirname($_SERVER['PHP_SELF']);
$_SESSION['BASE_URL'] = $BASE_HTTP . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

//template part
include __DIR__ . '/includes/error_reporting.php';
enableErrorReporting();
?>

<!doctype html>
<html ng-app="storeApp" lang="en">
<head>
    <title>Ministore - one page eCommerce template</title>
    <meta charset="utf-8">
    <meta name="description"
          content="dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam.">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap-touch-carousel.css">
    <link rel="stylesheet" href="plugins/anima/anima.css">
    <link rel="stylesheet" href="plugins/owlcarousel/owl.carousel.css">
    <link rel="stylesheet" href="css/style.min.css">

    <link rel="stylesheet" href="css/blue.css" class="colors">
    <link rel="stylesheet" href="css/custom.css" class="colors">

    <link rel="shortcut icon" href="img/ico/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/ico/favicon.ico" type="image/x-icon">

    <script>
        //https://stackoverflow.com/questions/9046184/reload-the-site-when-reached-via-browsers-back-button
        //Reload the site when reached via browsers back button
        if (!!window.performance && window.performance.navigation.type == 2) {
            window.location.reload();
        }
    </script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="home" onunload="">
<div id="main-nav" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#home">
                <img id="navlogo" src="img/logo.png" alt="microstore" width="122" height="45">
            </a>

        </div>
        <div class="collapse navbar-collapse">
            <ul id="navigation" class="nav navbar-nav navbar-right text-center">
                <li><a href="#products">Products</a></li>
                <li><a href="#testimonial">Reviews</a></li>
                <li><a href="#orderform">Order</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>

    </div>
</div>

<div style="margin-top:60px;">
    <section id="hero" class="hero-slider light-typo full-height" data-height="600">
        <div id="hero-slider" class="owl-carousel owl-theme" data-navigation="true" data-dots="true"
             data-transition="fadeOut">

            <div class="item m-center" style="background-image: url(img/Main-slide-2.jpg);">
                <div class="center-box">
                    <span class="overlay-bg"></span>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 text-center anima fade-up">
                                <div class="hero-unit">
                                    <h2>Introducing Ministore</h2>
                                    <p>
                                        Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et
                                        dolore magna aliquyam.
                                    </p>
                                    <ul class="social-links text-center">
                                        <li><a href="#"
                                               target="_blank"><i class="icon-facebook" title="facebook"></i></a></li>
                                        <li><a href="#"
                                               target="_blank"><i class="icon-youtube" title="youtube"></i></a></li>
                                        <li><a href="#"
                                               target="_blank"><i class="icon-pinterest" title="pinterest"></i></a></li>
                                    </ul>
                                    <a class="btn btn-store smooth-scroll" href="#products">Browse the products</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="item m-center" style="background-image: url(img/Main-slide-1.jpg);">
            </div>


        </div>
    </section>
</div>


<section id="products" class=" padding-top-bottom" ng-controller="productsController">
    <div class="container">
        <header class="section-header text-center anima fade-up">
            <h2>Products</h2>
        </header>
    </div>
    <div class="container">
        <div id="projects-container" class="row">

            <article class="design product col-xs-12 col-sm-4 col-md-4  anima fade-up">
                <div class="img-box">
                    <div class="hover-mask2"></div>
                    <span class="product-icon icon-eye"></span>
                    <img class="img-responsive project-image" src="img/product-slider-big/couch1/1.jpg" alt="">
                </div>
                <div class="product-info col-md-12">
                    <p class="project-price">{{::items[0]['price']}}€</p>
                    <div>
                        <h4 class="project-title">{{::items[0]['name']}}</h4>
                    </div>
                </div>
                <div class="sr-only project-description"
                     data-images="img/product-slider-big/couch1/1.jpg,img/product-slider-big/couch1/2.jpg">
                    <p>
                        Produktinformation:
                    </p>

                    <?php include __DIR__ . '/includes/product_information.php'; ?>

                </div>
            </article>

            <article class="design product col-xs-12 col-sm-4 col-md-4  anima fade-up">
                <div class="img-box">
                    <div class="hover-mask2"></div>
                    <span class="product-icon icon-eye"></span>
                    <img class="img-responsive project-image" src="img/product-slider-big/couch2/1.jpg" alt="">
                </div>
                <div class="product-info col-md-12">
                    <p class="project-price">{{::items[1]['price']}}€</p>
                    <div>
                        <h4 class="project-title">{{::items[1]['name']}}</h4>
                    </div>
                </div>
                <div class="sr-only project-description"
                     data-images="img/product-slider-big/couch2/1.jpg,img/product-slider-big/couch2/2.jpg">
                    <p>
                        Produktinformation:
                    </p>

                    <?php include __DIR__ . '/includes/product_information.php'; ?>

                </div>
            </article>

            <article class="design product col-xs-12 col-sm-4 col-md-4  anima fade-up">
                <div class="img-box">
                    <div class="hover-mask2"></div>
                    <span class="product-icon icon-eye"></span>
                    <img class="img-responsive project-image" src="img/product-slider-big/couch3/1.jpg" alt="">
                </div>
                <div class="product-info col-md-12">
                    <p class="project-price">{{::items[2]['price']}}€</p>
                    <div>
                        <h4 class="project-title">{{::items[2]['name']}}</h4>
                    </div>
                </div>
                <div class="sr-only project-description"
                     data-images="img/product-slider-big/couch3/1.jpg,img/product-slider-big/couch3/2.jpg">
                    <p>
                        Produktinformation:
                    </p>

                    <?php include __DIR__ . '/includes/product_information.php'; ?>

                </div>
            </article>

        </div>
        <div id="projects-container" class="row">

            <article class="design product col-xs-12 col-sm-4 col-md-4  anima fade-up">
                <div class="img-box">
                    <div class="hover-mask2"></div>
                    <span class="product-icon icon-eye"></span>
                    <img class="img-responsive project-image" src="img/product-slider-big/couch4/1.jpg" alt="">
                </div>
                <div class="product-info col-md-12">
                    <p class="project-price">{{::items[3]['price']}}€</p>
                    <div>
                        <h4 class="project-title">{{::items[3]['name']}}</h4>
                    </div>
                </div>
                <div class="sr-only project-description"
                     data-images="img/product-slider-big/couch4/1.jpg,img/product-slider-big/couch4/1.jpg">
                    <p>
                        Produktinformation:
                    </p>

                    <?php include __DIR__ . '/includes/product_information.php'; ?>

                </div>
            </article>

            <article class="design product col-xs-12 col-sm-4 col-md-4  anima fade-up">
                <div class="img-box">
                    <div class="hover-mask2"></div>
                    <span class="product-icon icon-eye"></span>
                    <img class="img-responsive project-image" src="img/product-slider-big/couch5/1.jpg" alt="">
                </div>
                <div class="product-info col-md-12">
                    <p class="project-price">{{::items[4]['price']}}€</p>
                    <div>
                        <h4 class="project-title">{{::items[4]['name']}}</h4>
                    </div>
                </div>
                <div class="sr-only project-description"
                     data-images="img/product-slider-big/couch5/1.jpg,img/product-slider-big/couch5/1.jpg">
                    <p>
                        Produktinformation:
                    </p>

                    <?php include __DIR__ . '/includes/product_information.php'; ?>

                </div>
            </article>

            <article class="design product col-xs-12 col-sm-4 col-md-4  anima fade-up">
                <div class="img-box">
                    <div class="hover-mask2"></div>
                    <span class="product-icon icon-eye"></span>
                    <img class="img-responsive project-image" src="img/product-slider-big/couch6/1.jpg" alt="">
                </div>
                <div class="product-info col-md-12">
                    <p class="project-price">{{::items[5]['price']}}€</p>
                    <div>
                        <h4 class="project-title">{{::items[5]['name']}}</h4>
                    </div>
                </div>
                <div class="sr-only project-description"
                     data-images="img/product-slider-big/couch6/1.jpg,img/product-slider-big/couch6/1.jpg">
                    <p>
                        Produktinformation:
                    </p>

                    <?php include __DIR__ . '/includes/product_information.php'; ?>

                </div>
            </article>

        </div>

    </div>

    <div id="project-modal" class="modal " style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="close" href="#" data-dismiss="modal"><i class="icon-close"></i></a>
                    <div id="project-slider" class="owl-carousel owl-theme" data-navigation="true" data-dots="true">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div id="project-sidebar" class="col-md-4 ">
                                <h2 id="sdbr-title">Flat UI-Kit</h2>
                                <div>
                                    <div id="sdbr-price">200</div>
                                    <div id="sdbr-oldprice">500</div>
                                </div>
                            </div>
                            <div id="project-content" class="col-md-8 ">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sapien risus, blandit at
                                    fringilla ac, varius sed dolor. Donec augue lacus, vulputate sed consectetur
                                    facilisis, interdum pharetra ligula. Nulla suscipit erat nibh, ut porttitor nisl
                                    dapibus eu.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="cta" class="padding-top-bottom color-bg light-typo">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 col-sm-4 news anima fade-up">
                <i class="icon-trophy iconBig"></i>
                <h3>Quality Guaranteed</h3>
            </div>
            <div class="col-md-4 col-sm-4 news anima fade-up d1">
                <i class="icon-truck iconBig"></i>
                <h3>Fast Delivery</h3>
            </div>
            <div class="col-md-4 col-sm-4 anima fade-up d2">
                <i class="icon-lock iconBig"></i>
                <h3>Secure Payment</h3>
            </div>
        </div>
    </div>
</section>


<section id="about" class="padding-top-bottom gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-4 anima fadeInLeft">
                <header class="section-header cta-message">
                    <h2>About The Business</h2>
                </header>
            </div>
            <div class="col-md-8 cta-message anima fade-up">
                <p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming.</p>
                <p style="display:none;" id="showme">
                    id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                    <br> <br>
                    <strong>Strictly Adhering to ISO Standards</strong> <br>
                    Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis.
                </p>
                <a class="btn btn-store outline" id="show-btn" href="#">Read more</a>
            </div>
        </div>
    </div>
</section>

<section id="testimonial" class="padding-top-bottom image-bg light-typo">
    <div class="container">

        <div class="testimonial">
            <div id="carousel-example-generic" class="carousel slide bs-docs-carousel-example">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>

                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <h1>Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem
                            ipsum dolor sit amet.</h1>
                        <br>
                        <h3>Lorem Ipsum</h3>
                    </div>
                    <div class="item">
                        <h1>Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem
                            ipsum dolor sit amet.</h1>
                        <br>
                        <h3>Lorem Ipsum</h3>
                    </div>


                </div>
                <br><br><br>
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <i class=" icon-arrow-left"></i>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <i class=" icon-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="overlay-bg"></div>
    </div>
</section>


<section id="orderform" class="gray-bg padding-top-bottom" ng-controller="orderController">
    <div class="container">
        <header class="section-header text-center">
            <h2>Order Form</h2>
        </header>
        <form id="order-form" method="post" action="/pp/wall.php" novalidate>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <table class="table" id="order-form-table">
                        <thead>
                        <tr>
                            <th>Products</th>
                            <th>Cost per unit</th>
                            <th class="text-center">
                                <span class="hidden-xs">Quantatiy</span>
                                <span class="visible-xs">QNT</span>
                            </th>
                            <th class="text-right">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="vert-align">Clita</td>
                            <td class="vert-align">€<span class="unit-cost">200</span></td>
                            <td class="text-center">
                                <select class="form-control form-control-inline quantity" ng-model="clita"
                                        ng-change="updateTotal()" name="clita_qty"
                                        ng-options="opt as opt.label for opt in options"></select>

                            </td>
                            <td class="text-right vert-align">{{ clita.value * 200 | currency:"€" }}</td>
                        </tr>
                        <tr>
                            <td class="vert-align">Vero</td>
                            <td class="vert-align">€<span class="unit-cost">150</span></td>
                            <td class="text-center">
                                <select class="form-control form-control-inline quantity" ng-model="vero"
                                        ng-change="updateTotal()" name="vero_qty"
                                        ng-options="opt as opt.label for opt in options"></select>

                            </td>
                            <td class="text-right vert-align">{{ vero.value * 150 | currency:"€" }}</td>
                        </tr>
                        <tr>
                            <td class="vert-align">Mero</td>
                            <td class="vert-align">€<span class="unit-cost">250</span></td>
                            <td class="text-center">
                                <select class="form-control form-control-inline quantity" ng-model="mero"
                                        ng-change="updateTotal()" name="mero_qty"
                                        ng-options="opt as opt.label for opt in options"></select>

                            </td>
                            <td class="text-right vert-align">{{ mero.value * 250 | currency:"€" }}</td>
                        </tr>
                        <tr>
                            <td class="vert-align">Jebo</td>
                            <td class="vert-align">€<span class="unit-cost">500</span></td>
                            <td class="text-center">
                                <select class="form-control form-control-inline quantity" ng-model="jebo"
                                        ng-change="updateTotal()" name="jebo_qty"
                                        ng-options="opt as opt.label for opt in options"></select>

                            </td>
                            <td class="text-right vert-align">{{ jebo.value * 500 | currency:"€" }}</td>
                        </tr>
                        <tr>
                            <td class="vert-align">Nemo</td>
                            <td class="vert-align">€<span class="unit-cost">500</span></td>
                            <td class="text-center">
                                <select class="form-control form-control-inline quantity" ng-model="nemo"
                                        ng-change="updateTotal()" name="nemo_qty"
                                        ng-options="opt as opt.label for opt in options"></select>

                            </td>
                            <td class="text-right vert-align">{{ nemo.value * 500 | currency:"€" }}</td>
                        </tr>
                        <tr>
                            <td class="vert-align">Yoki</td>
                            <td class="vert-align">€<span class="unit-cost">600</span></td>
                            <td class="text-center">
                                <select class="form-control form-control-inline quantity" ng-model="yoki"
                                        ng-change="updateTotal()" name="yoki_qty"
                                        ng-options="opt as opt.label for opt in options"></select>

                            </td>
                            <td class="text-right vert-align">{{ yoki.value * 600 | currency:"€" }}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <div class="center-block col-md-6" style="float: none; position:inherit; background-color: transparent">
                    <table class="table">
                        <thead>
                        <tr>
                            <th colspan="3" class="text-center">Order Summary</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Shipping cost:</td>
                            <td></td>
                            <td class="text-right">€{{shipping = 3.99}}</td>
                        </tr>
                        <tr>
                            <td>Total:</td>
                            <td></td>
                            <td id="total" class="text-right">
                                € {{total | customNumber}}
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <p class="text-center"><strong>Delivery Address</strong></p>
                    <div class="form-group">
                        <label class="control-label">First Name</label>
                        <input name="first_name" placeholder="First Name" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Last Name</label>
                        <input name="last_name" placeholder="Last Name" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input name="email" placeholder="Email" class="form-control" type="email" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Address 1</label>
                        <input name="address1" placeholder="Address 1" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Address 2</label>
                        <input name="address2" placeholder="Address 2" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Post Code</label>
                        <input name="zip" placeholder="Post Code" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">City</label>
                        <input name="city" placeholder="City" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">State</label>
                        <input name="state" placeholder="State" class="form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Telephone</label>
                        <input name="phone" placeholder="Telephone" class="form-control" type="tel">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Land</label>
                        <select name="addressCountry" class="form-control" required>
                            <option selected="selected" value=""> -- Select a country --</option>
                            <option value="AF">Afghanistan</option>
                            <option value="AX">Åland Islands</option>
                            <option value="AL">Albania</option>
                            <option value="DZ">Algeria</option>
                            <option value="AS">American Samoa</option>
                            <option value="AD">Andorra</option>
                            <option value="AO">Angola</option>
                            <option value="AI">Anguilla</option>
                            <option value="AQ">Antarctica</option>
                            <option value="AG">Antigua and Barbuda</option>
                            <option value="AR">Argentina</option>
                            <option value="AM">Armenia</option>
                            <option value="AW">Aruba</option>
                            <option value="AU">Australia</option>
                            <option value="AT">Austria</option>
                            <option value="AZ">Azerbaijan</option>
                            <option value="BS">Bahamas</option>
                            <option value="BH">Bahrain</option>
                            <option value="BD">Bangladesh</option>
                            <option value="BB">Barbados</option>
                            <option value="BY">Belarus</option>
                            <option value="BE">Belgium</option>
                            <option value="BZ">Belize</option>
                            <option value="BJ">Benin</option>
                            <option value="BM">Bermuda</option>
                            <option value="BT">Bhutan</option>
                            <option value="BO">Bolivia, Plurinational State of</option>
                            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                            <option value="BA">Bosnia and Herzegovina</option>
                            <option value="BW">Botswana</option>
                            <option value="BV">Bouvet Island</option>
                            <option value="BR">Brazil</option>
                            <option value="IO">British Indian Ocean Territory</option>
                            <option value="BN">Brunei Darussalam</option>
                            <option value="BG">Bulgaria</option>
                            <option value="BF">Burkina Faso</option>
                            <option value="BI">Burundi</option>
                            <option value="KH">Cambodia</option>
                            <option value="CM">Cameroon</option>
                            <option value="CA">Canada</option>
                            <option value="CV">Cape Verde</option>
                            <option value="KY">Cayman Islands</option>
                            <option value="CF">Central African Republic</option>
                            <option value="TD">Chad</option>
                            <option value="CL">Chile</option>
                            <option value="CN">China</option>
                            <option value="CX">Christmas Island</option>
                            <option value="CC">Cocos (Keeling) Islands</option>
                            <option value="CO">Colombia</option>
                            <option value="KM">Comoros</option>
                            <option value="CG">Congo</option>
                            <option value="CD">Congo, the Democratic Republic of the</option>
                            <option value="CK">Cook Islands</option>
                            <option value="CR">Costa Rica</option>
                            <option value="CI">Côte d'Ivoire</option>
                            <option value="HR">Croatia</option>
                            <option value="CU">Cuba</option>
                            <option value="CW">Curaçao</option>
                            <option value="CY">Cyprus</option>
                            <option value="CZ">Czech Republic</option>
                            <option value="DK">Denmark</option>
                            <option value="DJ">Djibouti</option>
                            <option value="DM">Dominica</option>
                            <option value="DO">Dominican Republic</option>
                            <option value="EC">Ecuador</option>
                            <option value="EG">Egypt</option>
                            <option value="SV">El Salvador</option>
                            <option value="GQ">Equatorial Guinea</option>
                            <option value="ER">Eritrea</option>
                            <option value="EE">Estonia</option>
                            <option value="ET">Ethiopia</option>
                            <option value="FK">Falkland Islands (Malvinas)</option>
                            <option value="FO">Faroe Islands</option>
                            <option value="FJ">Fiji</option>
                            <option value="FI">Finland</option>
                            <option value="FR">France</option>
                            <option value="GF">French Guiana</option>
                            <option value="PF">French Polynesia</option>
                            <option value="TF">French Southern Territories</option>
                            <option value="GA">Gabon</option>
                            <option value="GM">Gambia</option>
                            <option value="GE">Georgia</option>
                            <option value="DE">Germany</option>
                            <option value="GH">Ghana</option>
                            <option value="GI">Gibraltar</option>
                            <option value="GR">Greece</option>
                            <option value="GL">Greenland</option>
                            <option value="GD">Grenada</option>
                            <option value="GP">Guadeloupe</option>
                            <option value="GU">Guam</option>
                            <option value="GT">Guatemala</option>
                            <option value="GG">Guernsey</option>
                            <option value="GN">Guinea</option>
                            <option value="GW">Guinea-Bissau</option>
                            <option value="GY">Guyana</option>
                            <option value="HT">Haiti</option>
                            <option value="HM">Heard Island and McDonald Islands</option>
                            <option value="VA">Holy See (Vatican City State)</option>
                            <option value="HN">Honduras</option>
                            <option value="HK">Hong Kong</option>
                            <option value="HU">Hungary</option>
                            <option value="IS">Iceland</option>
                            <option value="IN">India</option>
                            <option value="ID">Indonesia</option>
                            <option value="IR">Iran, Islamic Republic of</option>
                            <option value="IQ">Iraq</option>
                            <option value="IE">Ireland</option>
                            <option value="IM">Isle of Man</option>
                            <option value="IL">Israel</option>
                            <option value="IT">Italy</option>
                            <option value="JM">Jamaica</option>
                            <option value="JP">Japan</option>
                            <option value="JE">Jersey</option>
                            <option value="JO">Jordan</option>
                            <option value="KZ">Kazakhstan</option>
                            <option value="KE">Kenya</option>
                            <option value="KI">Kiribati</option>
                            <option value="KP">Korea, Democratic People's Republic of</option>
                            <option value="KR">Korea, Republic of</option>
                            <option value="KW">Kuwait</option>
                            <option value="KG">Kyrgyzstan</option>
                            <option value="LA">Lao People's Democratic Republic</option>
                            <option value="LV">Latvia</option>
                            <option value="LB">Lebanon</option>
                            <option value="LS">Lesotho</option>
                            <option value="LR">Liberia</option>
                            <option value="LY">Libya</option>
                            <option value="LI">Liechtenstein</option>
                            <option value="LT">Lithuania</option>
                            <option value="LU">Luxembourg</option>
                            <option value="MO">Macao</option>
                            <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                            <option value="MG">Madagascar</option>
                            <option value="MW">Malawi</option>
                            <option value="MY">Malaysia</option>
                            <option value="MV">Maldives</option>
                            <option value="ML">Mali</option>
                            <option value="MT">Malta</option>
                            <option value="MH">Marshall Islands</option>
                            <option value="MQ">Martinique</option>
                            <option value="MR">Mauritania</option>
                            <option value="MU">Mauritius</option>
                            <option value="YT">Mayotte</option>
                            <option value="MX">Mexico</option>
                            <option value="FM">Micronesia, Federated States of</option>
                            <option value="MD">Moldova, Republic of</option>
                            <option value="MC">Monaco</option>
                            <option value="MN">Mongolia</option>
                            <option value="ME">Montenegro</option>
                            <option value="MS">Montserrat</option>
                            <option value="MA">Morocco</option>
                            <option value="MZ">Mozambique</option>
                            <option value="MM">Myanmar</option>
                            <option value="NA">Namibia</option>
                            <option value="NR">Nauru</option>
                            <option value="NP">Nepal</option>
                            <option value="NL">Netherlands</option>
                            <option value="NC">New Caledonia</option>
                            <option value="NZ">New Zealand</option>
                            <option value="NI">Nicaragua</option>
                            <option value="NE">Niger</option>
                            <option value="NG">Nigeria</option>
                            <option value="NU">Niue</option>
                            <option value="NF">Norfolk Island</option>
                            <option value="MP">Northern Mariana Islands</option>
                            <option value="NO">Norway</option>
                            <option value="OM">Oman</option>
                            <option value="PK">Pakistan</option>
                            <option value="PW">Palau</option>
                            <option value="PS">Palestinian Territory, Occupied</option>
                            <option value="PA">Panama</option>
                            <option value="PG">Papua New Guinea</option>
                            <option value="PY">Paraguay</option>
                            <option value="PE">Peru</option>
                            <option value="PH">Philippines</option>
                            <option value="PN">Pitcairn</option>
                            <option value="PL">Poland</option>
                            <option value="PT">Portugal</option>
                            <option value="PR">Puerto Rico</option>
                            <option value="QA">Qatar</option>
                            <option value="RE">Réunion</option>
                            <option value="RO">Romania</option>
                            <option value="RU">Russian Federation</option>
                            <option value="RW">Rwanda</option>
                            <option value="BL">Saint Barthélemy</option>
                            <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                            <option value="KN">Saint Kitts and Nevis</option>
                            <option value="LC">Saint Lucia</option>
                            <option value="MF">Saint Martin (French part)</option>
                            <option value="PM">Saint Pierre and Miquelon</option>
                            <option value="VC">Saint Vincent and the Grenadines</option>
                            <option value="WS">Samoa</option>
                            <option value="SM">San Marino</option>
                            <option value="ST">Sao Tome and Principe</option>
                            <option value="SA">Saudi Arabia</option>
                            <option value="SN">Senegal</option>
                            <option value="RS">Serbia</option>
                            <option value="SC">Seychelles</option>
                            <option value="SL">Sierra Leone</option>
                            <option value="SG">Singapore</option>
                            <option value="SX">Sint Maarten (Dutch part)</option>
                            <option value="SK">Slovakia</option>
                            <option value="SI">Slovenia</option>
                            <option value="SB">Solomon Islands</option>
                            <option value="SO">Somalia</option>
                            <option value="ZA">South Africa</option>
                            <option value="GS">South Georgia and the South Sandwich Islands</option>
                            <option value="SS">South Sudan</option>
                            <option value="ES">Spain</option>
                            <option value="LK">Sri Lanka</option>
                            <option value="SD">Sudan</option>
                            <option value="SR">Suriname</option>
                            <option value="SJ">Svalbard and Jan Mayen</option>
                            <option value="SZ">Swaziland</option>
                            <option value="SE">Sweden</option>
                            <option value="CH">Switzerland</option>
                            <option value="SY">Syrian Arab Republic</option>
                            <option value="TW">Taiwan, Province of China</option>
                            <option value="TJ">Tajikistan</option>
                            <option value="TZ">Tanzania, United Republic of</option>
                            <option value="TH">Thailand</option>
                            <option value="TL">Timor-Leste</option>
                            <option value="TG">Togo</option>
                            <option value="TK">Tokelau</option>
                            <option value="TO">Tonga</option>
                            <option value="TT">Trinidad and Tobago</option>
                            <option value="TN">Tunisia</option>
                            <option value="TR">Turkey</option>
                            <option value="TM">Turkmenistan</option>
                            <option value="TC">Turks and Caicos Islands</option>
                            <option value="TV">Tuvalu</option>
                            <option value="UG">Uganda</option>
                            <option value="UA">Ukraine</option>
                            <option value="AE">United Arab Emirates</option>
                            <option value="GB">United Kingdom</option>
                            <option value="US">United States</option>
                            <option value="UM">United States Minor Outlying Islands</option>
                            <option value="UY">Uruguay</option>
                            <option value="UZ">Uzbekistan</option>
                            <option value="VU">Vanuatu</option>
                            <option value="VE">Venezuela, Bolivarian Republic of</option>
                            <option value="VN">Viet Nam</option>
                            <option value="VG">Virgin Islands, British</option>
                            <option value="VI">Virgin Islands, U.S.</option>
                            <option value="WF">Wallis and Futuna</option>
                            <option value="EH">Western Sahara</option>
                            <option value="YE">Yemen</option>
                            <option value="ZM">Zambia</option>
                            <option value="ZW">Zimbabwe</option>
                        </select>
                    </div>



                </div>


                <div class="center-block col-md-6" style="float: none; position: inherit; background-color: transparent;">
                    <h4>Pay with PayPal Plus:</h4>
                    <button type="submit" id="process-order-btn" class="btn btn-store outline">Process order</button>
                    <div id="isErrorrs" class="alert-danger col-md-12"><p>Please fill in the form</p></div>
                </div>
            </div>

            <input hidden="text" name="shipping" value="{{shipping = 3.99}}">

            <!--IMPORTANT input with products data, check custom.js-->
            <input type="text" class="hidden" name="items" id="pr-items" value="">
            <input type="hidden" name="subtotal" id="subtotal" value="{{subtotal | customNumber}}">
            <input type="hidden" name="shipping" id="shipping" value="{{shipping}}">
            <input type="hidden" name="total" id="total" value="{{total | customNumber}}">

        </form>
    </div>
</section>


<section id="contact" style="background-color: rgb(224, 224, 224);" class=" padding-top-bottom">
    <div class="container">
        <header class="section-header tcol-sm-12 col-md-12ext-center">
            <h1><strong>Contact</strong></h1>
            <p>Do you have a problem with our products?</p>
        </header>
        <form action="message_sent.php" method="post" id="contact-form">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 contact-info cta-message anima fade-right">
                    <address>
                        <strong>Lorem Ipsum</strong><br>
                        info@lorem.com
                    </address>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-8 anima fade-up d1">
                    <div class="form-group">
                        <label class="control-label" for="contact-name">Name</label>
                        <div class="controls">
                            <input id="contact-name" name="contactName" placeholder="Your Name"
                                   class="form-control input-lg requiredField" type="text" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="contact-mail">Your Email</label>
                        <div class=" controls">
                            <input id="contact-mail" name="email" placeholder="Your Email"
                                   class="form-control input-lg requiredField" type="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="contact-message">Your Message</label>
                        <div class="controls">
                            <textarea id="contact-message" name="comments" placeholder="Your Message"
                                      class="form-control input-lg requiredField" rows="5" required></textarea>
                        </div>
                    </div>
                    <p>
                        <button name="submit" type="submit" class="btn btn-store btn-block">Send message</button>
                    </p>
                    <input type="hidden" name="submitted" id="submitted3" value="true">
                </div>
            </div>
        </form>
    </div>
</section>

<footer id="main-footer" class="dark-bg light-typo">
    <div class="container">
        <p class="pull-left copyright">
            &copy; Lorem 2017<br>
        </p>

        <div class="pull-right paymentMethodImg copyright">
            <a class="btn btn-store outline" href="#" data-toggle="modal"
               data-target=".text-modal">Terms and Conditions</a>
        </div>
    </div>
</footer>

<div class="modal fade text-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="color-bg">
                <div class="container">
                    <div class="row ">
                        <div class="col-xs-12 col-sm-12 col-md-12 color-bg light-typo" id="9modal-bar">
                            <h2 class="pull-left">Terms and Conditions</h2>
                            <a class="close pull-right" href="#" data-dismiss="modal"><i class="icon-close"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">

                        <h3>Payment</h3>
                        <p>Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem
                            ipsum dolor sit amet.</p>
                        <h3>order confirmation</h3>
                        <p>Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem
                            ipsum dolor sit amet.</p>
                        <h3>Shipping</h3>
                        <p>
                            At vero eos et accusam et justo duo dolores et ea rebum.
                        </p>
                        <h3>Returns</h3>
                        <p>At vero eos et accusam et justo duo dolores et ea rebum.</p>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <h3>Data Protection Policy</h3>
                        <p>At vero eos et accusam et justo duo dolores et ea rebum.</p>
                        <h3>safety</h3>
                        <p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming.</p>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <a class="btn btn-store" href="#" data-dismiss="modal">Back to the shop</a><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="no-interaction-background" style="display: none;">
</div>


<script type="text/javascript" src="plugins/plugins.js"></script>

<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js"></script>
<script type="text/javascript" src="js/swipe.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.h5validate/0.9.0/jquery.h5validate.min.js"></script>
<script src="https://www.paypalobjects.com/webstatic/ppplus/ppplus.min.js" type="text/javascript"></script>

<!--<script src="https://www.paypalobjects.com/api/checkout.js"></script>-->
<!--<script src="https://www.paypalobjects.com/webstatic/ppplus/ppplus.min.js"
        type="text/javascript"></script>-->
<!--<script src="https://checkout.stripe.com/checkout.js"></script>-->
<script type="text/javascript" src="js/main.js"></script>
<script src="js/custom.js"></script>


</body>

</html>