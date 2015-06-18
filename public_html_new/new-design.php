<?php
//!!!!!!!!!!!!!!!!!!!!!//// mysql_fetch_assoc
include_once '../classes/MySQL.php';
include_once '../classes/login.php';
include_once '../classes/user_lib.php';
include_once '../blocks/left.php';
include_once '../blocks/user_header.php';
?>

<!--
function category($c_id);
function products($c_id = false);
function product($p_id);
function logIn();
function isLogged();
function getCartData();
function checkout();
-->




<html>
<head>
    <title>Главная страница</title>

    <link href="css/styles-2.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <script src="js/jquery.min.js"></script>
    <script src="js/cart-2.js"></script>
</head>
<body>

<div id="wrapper">
    <div class="cart-icon-top">
    </div>

    <div class="cart-icon-bottom">
    </div>

    <div id="checkout">
        CHECKOUT
    </div>

    <div id="info">
        <p class="i1">Add to cart interaction prototype by Virgil Pana</p>
        <p>    Follow me on <a href="https://dribbble.com/virgilpana" style="color:#ea4c89" target="_blank">Dribbble</a> | <a style="color:#2aa9e0" href="https://twitter.com/virgil_pana" target="_blank">Twitter</a></p>
    </div>

    <div id="header">
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">BRANDS</a></li>
            <li><a href="">DESIGNERS</a></li>
            <li><a href="">CONTACT</a></li>
        </ul>
    </div>

    <div id="sidebar">
        <h3>CART</h3>
        <div id="cart">
            <span class="empty">No items in cart.</span>
        </div>

        <h3>CATEGORIES</h3>
        <div class="checklist categories">
            <ul>
                <li><a href="">New Arivals</a></li>
                <li><a href="">Accesories</a></li>
                <li><a href="">Bags</a></li>
                <li><a href="">Dressed</a></li>
                <li><a href="">Jackets</a></li>
                <li><a href="">jewelry</a></li>
                <li><a href="">Shoes</a></li>
                <li><a href="">Shirts</a></li>
                <li><a href="">Sweaters</a></li>
                <li><a href="">T-shirts</a></li>
            </ul>
        </div>
    </div>

    <!--<div id="grid-selector">
        <div id="grid-menu">
            View:
            <ul>
                <li class="largeGrid">
                    <a href=""></a>
                </li>
                <li class="smallGrid">
                    <a class="active" href=""></a>
                </li>
            </ul>
        </div>

        Showing 1–9 of 48 results
    </div>-->

    <div id="grid">

        <div class="product">
            <div class="make3D">
                <div class="product-front">
                    <div class="shadow"></div>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1.jpg" alt="" />
                    <div class="image_overlay"></div>
                    <div class="add_to_cart">Add to cart</div>
                    <div class="view_gallery">View gallery</div>
                    <div class="stats">
                        <div class="stats-container">
                            <span class="product_price">$39</span>
                            <span class="product_name">FLUTED HEM DRESS</span>
                            <p>Summer dress</p>
                    </div>
                </div>

                <div class="product-back">
                    <div class="shadow"></div>
                    <div class="carousel">
                        <ul class="carousel-container">
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1.jpg" alt="" /></li>
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/2.jpg" alt="" /></li>
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/3.jpg" alt="" /></li>
                        </ul>
                        <div class="arrows-perspective">
                            <div class="carouselPrev">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                            <div class="carouselNext">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flip-back">
                        <div class="cy"></div>
                        <div class="cx"></div>
                    </div>
                </div>
            </div>
            </div>
        </div>


        <div class="product">
            <div class="info-large">
                <h4>PLEAT PRINTED DRESS</h4>
                <div class="sku">
                    PRODUCT SKU: <strong>89356</strong>
                </div>

                <div class="price-big">
                    <span>$43</span> $39
                </div>

                <h3>COLORS</h3>
                <div class="colors-large">
                    <ul>
                        <li><a href="" style="background:#222"><span></span></a></li>
                        <li><a href="" style="background:#6e8cd5"><span></span></a></li>
                        <li><a href="" style="background:#f56060"><span></span></a></li>
                        <li><a href="" style="background:#44c28d"><span></span></a></li>
                    </ul>
                </div>

                <h3>SIZE</h3>
                <div class="sizes-large">
                    <span>XS</span>
                    <span>S</span>
                    <span>M</span>
                    <span>L</span>
                    <span>XL</span>
                    <span>XXL</span>
                </div>

                <button class="add-cart-large">Add To Cart</button>

            </div>
            <div class="make3D">
                <div class="product-front">
                    <div class="shadow"></div>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/2.jpg" alt="" />
                    <div class="image_overlay"></div>
                    <div class="add_to_cart">Add to cart</div>
                    <div class="view_gallery">View gallery</div>
                    <div class="stats">
                        <div class="stats-container">
                            <span class="product_price">$39</span>
                            <span class="product_name">PLEAT PRINTED DRESS</span>
                            <p>Summer dress</p>

                            <div class="product-options">
                                <strong>SIZES</strong>
                                <span>XS, S, M, L, XL, XXL</span>
                                <strong>COLORS</strong>
                                <div class="colors">
                                    <div class="c-blue"><span></span></div>
                                    <div class="c-red"><span></span></div>
                                    <div class="c-white"><span></span></div>
                                    <div class="c-green"><span></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-back">
                    <div class="shadow"></div>
                    <div class="carousel">
                        <ul class="carousel-container">
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/2.jpg" alt="" /></li>
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/3.jpg" alt="" /></li>
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/4.jpg" alt="" /></li>
                        </ul>
                        <div class="arrows-perspective">
                            <div class="carouselPrev">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                            <div class="carouselNext">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flip-back">
                        <div class="cy"></div>
                        <div class="cx"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product">
            <div class="info-large">
                <h4>FLOWY SHIRT DRESS</h4>
                <div class="sku">
                    PRODUCT SKU: <strong>89356</strong>
                </div>

                <div class="price-big">
                    <span>$43</span> $39
                </div>

                <h3>COLORS</h3>
                <div class="colors-large">
                    <ul>
                        <li><a href="" style="background:#222"><span></span></a></li>
                        <li><a href="" style="background:#6e8cd5"><span></span></a></li>
                        <li><a href="" style="background:#f56060"><span></span></a></li>
                        <li><a href="" style="background:#44c28d"><span></span></a></li>
                    </ul>
                </div>

                <h3>SIZE</h3>
                <div class="sizes-large">
                    <span>XS</span>
                    <span>S</span>
                    <span>M</span>
                    <span>L</span>
                    <span>XL</span>
                    <span>XXL</span>
                </div>

                <button class="add-cart-large">Add To Cart</button>

            </div>
            <div class="make3D">
                <div class="product-front">
                    <div class="shadow"></div>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/3.jpg" alt="" />
                    <div class="image_overlay"></div>
                    <div class="add_to_cart">Add to cart</div>
                    <div class="view_gallery">View gallery</div>
                    <div class="stats">
                        <div class="stats-container">
                            <span class="product_price">$39</span>
                            <span class="product_name">FLOWY SHIRT DRESS</span>
                            <p>Summer dress</p>

                            <div class="product-options">
                                <strong>SIZES</strong>
                                <span>XS, S, M, L, XL, XXL</span>
                                <strong>COLORS</strong>
                                <div class="colors">
                                    <div class="c-blue"><span></span></div>
                                    <div class="c-red"><span></span></div>
                                    <div class="c-white"><span></span></div>
                                    <div class="c-green"><span></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-back">
                    <div class="shadow"></div>
                    <div class="carousel">
                        <ul class="carousel-container">
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/3.jpg" alt="" /></li>
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/4.jpg" alt="" /></li>
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1.jpg" alt="" /></li>
                        </ul>
                        <div class="arrows-perspective">
                            <div class="carouselPrev">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                            <div class="carouselNext">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flip-back">
                        <div class="cy"></div>
                        <div class="cx"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="product">
            <div class="info-large">
                <h4>DOUBLE LAYER DRESS</h4>
                <div class="sku">
                    PRODUCT SKU: <strong>89356</strong>
                </div>

                <div class="price-big">
                    <span>$43</span> $39
                </div>

                <h3>COLORS</h3>
                <div class="colors-large">
                    <ul>
                        <li><a href="" style="background:#222"><span></span></a></li>
                        <li><a href="" style="background:#6e8cd5"><span></span></a></li>
                        <li><a href="" style="background:#f56060"><span></span></a></li>
                        <li><a href="" style="background:#44c28d"><span></span></a></li>
                    </ul>
                </div>

                <h3>SIZE</h3>
                <div class="sizes-large">
                    <span>XS</span>
                    <span>S</span>
                    <span>M</span>
                    <span>L</span>
                    <span>XL</span>
                    <span>XXL</span>
                </div>

                <button class="add-cart-large">Add To Cart</button>

            </div>
            <div class="make3D">
                <div class="product-front">
                    <div class="shadow"></div>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/4.jpg" alt="" />
                    <div class="image_overlay"></div>
                    <div class="add_to_cart">Add to cart</div>
                    <div class="view_gallery">View gallery</div>
                    <div class="stats">
                        <div class="stats-container">
                            <span class="product_price">$39</span>
                            <span class="product_name">DOUBLE LAYER DRESS</span>
                            <p>Summer dress</p>

                            <div class="product-options">
                                <strong>SIZES</strong>
                                <span>XS, S, M, L, XL, XXL</span>
                                <strong>COLORS</strong>
                                <div class="colors">
                                    <div class="c-blue"><span></span></div>
                                    <div class="c-red"><span></span></div>
                                    <div class="c-white"><span></span></div>
                                    <div class="c-green"><span></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-back">
                    <div class="shadow"></div>
                    <div class="carousel">
                        <ul class="carousel-container">
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/4.jpg" alt="" /></li>
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/6.jpg" alt="" /></li>
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/7.jpg" alt="" /></li>
                        </ul>
                        <div class="arrows-perspective">
                            <div class="carouselPrev">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                            <div class="carouselNext">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flip-back">
                        <div class="cy"></div>
                        <div class="cx"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product">
            <div class="info-large">
                <h4>BEAD DETAIL DRESS</h4>
                <div class="sku">
                    PRODUCT SKU: <strong>89356</strong>
                </div>

                <div class="price-big">
                    <span>$43</span> $39
                </div>

                <h3>COLORS</h3>
                <div class="colors-large">
                    <ul>
                        <li><a href="" style="background:#222"><span></span></a></li>
                        <li><a href="" style="background:#6e8cd5"><span></span></a></li>
                        <li><a href="" style="background:#f56060"><span></span></a></li>
                        <li><a href="" style="background:#44c28d"><span></span></a></li>
                    </ul>
                </div>

                <h3>SIZE</h3>
                <div class="sizes-large">
                    <span>XS</span>
                    <span>S</span>
                    <span>M</span>
                    <span>L</span>
                    <span>XL</span>
                    <span>XXL</span>
                </div>

                <button class="add-cart-large">Add To Cart</button>

            </div>
            <div class="make3D">
                <div class="product-front">
                    <div class="shadow"></div>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/5.jpg" alt="" />
                    <div class="image_overlay"></div>
                    <div class="add_to_cart">Add to cart</div>
                    <div class="view_gallery">View gallery</div>
                    <div class="stats">
                        <div class="stats-container">
                            <span class="product_price">$39</span>
                            <span class="product_name">BEAD DETAIL DRESS</span>
                            <p>Summer dress</p>

                            <div class="product-options">
                                <strong>SIZES</strong>
                                <span>XS, S, M, L, XL, XXL</span>
                                <strong>COLORS</strong>
                                <div class="colors">
                                    <div class="c-blue"><span></span></div>
                                    <div class="c-red"><span></span></div>
                                    <div class="c-white"><span></span></div>
                                    <div class="c-green"><span></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-back">
                    <div class="shadow"></div>
                    <div class="carousel">
                        <ul class="carousel-container">
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/5.jpg" alt="" /></li>
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/7.jpg" alt="" /></li>
                        </ul>
                        <div class="arrows-perspective">
                            <div class="carouselPrev">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                            <div class="carouselNext">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flip-back">
                        <div class="cy"></div>
                        <div class="cx"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="product">
            <div class="info-large">
                <h4>PLEATED DETAIL DRESS</h4>
                <div class="sku">
                    PRODUCT SKU: <strong>89356</strong>
                </div>

                <div class="price-big">
                    <span>$43</span> $39
                </div>

                <h3>COLORS</h3>
                <div class="colors-large">
                    <ul>
                        <li><a href="" style="background:#222"><span></span></a></li>
                        <li><a href="" style="background:#6e8cd5"><span></span></a></li>
                        <li><a href="" style="background:#9b887b"><span></span></a></li>
                        <li><a href="" style="background:#44c28d"><span></span></a></li>
                    </ul>
                </div>

                <h3>SIZE</h3>
                <div class="sizes-large">
                    <span>XS</span>
                    <span>S</span>
                    <span>M</span>
                    <span>L</span>
                    <span>XL</span>
                    <span>XXL</span>
                </div>

                <button class="add-cart-large">Add To Cart</button>

            </div>
            <div class="make3D">
                <div class="product-front">
                    <div class="shadow"></div>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/6.jpg" alt="" />
                    <div class="image_overlay"></div>
                    <div class="add_to_cart">Add to cart</div>
                    <div class="view_gallery">View gallery</div>
                    <div class="stats">
                        <div class="stats-container">
                            <span class="product_price">$39</span>
                            <span class="product_name">PLEATED DETAIL DRESS</span>
                            <p>Summer dress</p>

                            <div class="product-options">
                                <strong>SIZES</strong>
                                <span>XS, S, M, L, XL, XXL</span>
                                <strong>COLORS</strong>
                                <div class="colors">
                                    <div class="c-blue"><span></span></div>
                                    <div class="c-red"><span></span></div>
                                    <div class="c-white"><span></span></div>
                                    <div class="c-green"><span></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-back">
                    <div class="shadow"></div>
                    <div class="carousel">
                        <ul class="carousel-container">
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/6.jpg" alt="" /></li>
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/7.jpg" alt="" /></li>
                        </ul>
                        <div class="arrows-perspective">
                            <div class="carouselPrev">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                            <div class="carouselNext">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flip-back">
                        <div class="cy"></div>
                        <div class="cx"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product">
            <div class="info-large">
                <h4>PRINTED DRESS</h4>
                <div class="sku">
                    PRODUCT SKU: <strong>89356</strong>
                </div>

                <div class="price-big">
                    <span>$43</span> $39
                </div>

                <h3>COLORS</h3>
                <div class="colors-large">
                    <ul>
                        <li><a href="" style="background:#222"><span></span></a></li>
                        <li><a href="" style="background:#6e8cd5"><span></span></a></li>
                        <li><a href="" style="background:#9b887b"><span></span></a></li>
                        <li><a href="" style="background:#44c28d"><span></span></a></li>
                    </ul>
                </div>

                <h3>SIZE</h3>
                <div class="sizes-large">
                    <span>XS</span>
                    <span>S</span>
                    <span>M</span>
                    <span>L</span>
                    <span>XL</span>
                    <span>XXL</span>
                </div>

                <button class="add-cart-large">Add To Cart</button>

            </div>
            <div class="make3D">
                <div class="product-front">
                    <div class="shadow"></div>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/7.jpg" alt="" />
                    <div class="image_overlay"></div>
                    <div class="add_to_cart">Add to cart</div>
                    <div class="view_gallery">View gallery</div>
                    <div class="stats">
                        <div class="stats-container">
                            <span class="product_price">$39</span>
                            <span class="product_name">PRINTED DRESS</span>
                            <p>Summer dress</p>

                            <div class="product-options">
                                <strong>SIZES</strong>
                                <span>XS, S, M, L, XL, XXL</span>
                                <strong>COLORS</strong>
                                <div class="colors">
                                    <div class="c-blue"><span></span></div>
                                    <div class="c-red"><span></span></div>
                                    <div class="c-white"><span></span></div>
                                    <div class="c-green"><span></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-back">
                    <div class="shadow"></div>
                    <div class="carousel">
                        <ul class="carousel-container">
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/7.jpg" alt="" /></li>
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/5.jpg" alt="" /></li>
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/4.jpg" alt="" /></li>
                        </ul>
                        <div class="arrows-perspective">
                            <div class="carouselPrev">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                            <div class="carouselNext">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flip-back">
                        <div class="cy"></div>
                        <div class="cx"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product">
            <div class="info-large">
                <h4>PRINTED DRESS</h4>
                <div class="sku">
                    PRODUCT SKU: <strong>89356</strong>
                </div>

                <div class="price-big">
                    <span>$43</span> $39
                </div>

                <h3>COLORS</h3>
                <div class="colors-large">
                    <ul>
                        <li><a href="" style="background:#222"><span></span></a></li>
                        <li><a href="" style="background:#6e8cd5"><span></span></a></li>
                        <li><a href="" style="background:#9b887b"><span></span></a></li>
                        <li><a href="" style="background:#44c28d"><span></span></a></li>
                    </ul>
                </div>

                <h3>SIZE</h3>
                <div class="sizes-large">
                    <span>XS</span>
                    <span>S</span>
                    <span>M</span>
                    <span>L</span>
                    <span>XL</span>
                    <span>XXL</span>
                </div>

                <button class="add-cart-large">Add To Cart</button>

            </div>
            <div class="make3D">
                <div class="product-front">
                    <div class="shadow"></div>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/8.jpg" alt="" />
                    <div class="image_overlay"></div>
                    <div class="add_to_cart">Add to cart</div>
                    <div class="view_gallery">View gallery</div>
                    <div class="stats">
                        <div class="stats-container">
                            <span class="product_price">$39</span>
                            <span class="product_name">PRINTED DRESS</span>
                            <p>Summer dress</p>

                            <div class="product-options">
                                <strong>SIZES</strong>
                                <span>XS, S, M, L, XL, XXL</span>
                                <strong>COLORS</strong>
                                <div class="colors">
                                    <div class="c-blue"><span></span></div>
                                    <div class="c-red"><span></span></div>
                                    <div class="c-white"><span></span></div>
                                    <div class="c-green"><span></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-back">
                    <div class="shadow"></div>
                    <div class="carousel">
                        <ul class="carousel-container">
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/8.jpg" alt="" /></li>
                            <li><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/7.jpg" alt="" /></li>
                        </ul>
                        <div class="arrows-perspective">
                            <div class="carouselPrev">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                            <div class="carouselNext">
                                <div class="y"></div>
                                <div class="x"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flip-back">
                        <div class="cy"></div>
                        <div class="cx"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


</body>
</html>
























































