<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/Web_project/myweb/db/create_statement.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MusicTicket</title>
    <script src="https://kit.fontawesome.com/dd24ff9acb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/music_web.css">
    <link rel="stylesheet" href="./css/slide.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js" defer></script>
    <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js" defer></script>
    <script src="./js/music_web.js" defer></script>
    <script src="./js/slide.js" defer></script>
</head>

<body onload="call_js()">
    <!-- header -->
    <header class="header_main">

        <div class="header_login">
            <a href="#" class="login">Login</a>
            <i class="line"></i>
            <a href="../myweb/sign_up/sign_up_form.php" class="signup">Sign Up</a>
        </div>

        <div class="header_sub">
            <div class="header_title">
                <img src="./img/concert.png">
                <h1>MusicTicket</h1>
            </div>

            <nav class="header_nav">
                <ul>
                    <li class="header_menu">
                        <ul class="menu_main">
                            <li><a href="#">main1</a></li>
                            <li><a href="#">main2</a></li>
                            <li><a href="#">main3</a></li>
                            <li><a href="#">고객센터</a></li>
                            <li><a href="#">고객센터</a></li>
                        </ul>
                        <div class="menu_sub">
                            <ul>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                            </ul>
                            <ul>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                            </ul>
                            <ul>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                            </ul>
                            <ul>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                            </ul>
                            <ul>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                                <li><a href="#">menu</a></li>
                                <!-- <li><a href="#">menu</a></li> -->
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- ==header== -->

    <!-- section -->
    <!-- page ONE -->
    <section id="fullpage">
        <div class='quick'>
            <ul></ul>
        </div>
        <div class="fullsection full1" pageNum="1">
            <div class="section_body">
                <div class="section_title">
                    <p id="subhead">J A Z Z M U S I C</p>
                    <h2>JAZZ</h2>
                    <p class="content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat nobis vero
                        distinctio ab
                        architecto
                        iusto et consequuntur at optio facere perspiciatis odio laborum vitae quidem sed praesentium, ad
                        sunt ut?</p>
                </div>
            </div>
        </div>
        <!-- page TWO -->
        <div class="fullsection full2" pageNum="2">
            <div class="slide">
                <h1>이달의 콘서트</h1>
                <div class="slideshow">
                    <a href="#"><img src="./img/poster1.jpg" alt="slide1"></img></a>
                    <a href="#"><img src="./img/poster2.jpg" alt="slide2"></img></a>
                    <a href="#"><img src="./img/poster3.jpg" alt="slide3"></img></a>
                    <a href="#"><img src="./img/poster4.jpg" alt="slide4"></img></a>
                    <a href="#"><img src="./img/poster5.jpg" alt="slide5"></img></a>
                    <a href="#"><img src="./img/poster6.jpg" alt="slide6"></img></a>
                    <a href="#"><img src="./img/poster7.jpg" alt="slide7"></img></a>
                    <a href="#"><img src="./img/poster8.jpg" alt="slide8"></img></a>
                    <a href="#"><img src="./img/poster9.jpg" alt="slide9"></img></a>
                    <a href="#"><img src="./img/poster10.jpg" alt="slide10"></img></a>
                    <a href="#"><img src="./img/poster11.jpg" alt="slide11"></img></a>
                    <a href="#"><img src="./img/poster12.jpg" alt="slide12"></img></a>
                </div>
        
                <div class="slideshow_nav">
                    <a href="#" class="prev"><i class="fa-solid fa-angle-left"></i></a>
                    <a href="#" class="next"><i class="fa-solid fa-angle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- page THREE -->
        <div class="fullsection full3" pageNum="3">

        </div>
    </section>
    <!-- ==section== -->
</body>
</html>