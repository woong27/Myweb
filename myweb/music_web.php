<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/Web_project/myweb/db/create_statement.php";

    //세선값 체크
    session_start();
    $user_id = $user_nick = "";
    if(isset($_SESSION["user_id"]) && isset($_SESSION["user_nick"])) {
        $user_id = $_SESSION["user_id"];
        $user_nick = $_SESSION["user_nick"];
    }else {
        $user_id = $user_nick = "";
    }
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MusicTicket</title>
    <script src="https://kit.fontawesome.com/dd24ff9acb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/music_web.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/slide.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js" defer></script>
    <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js" defer></script>
    <script src="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/js/music_web.js" defer></script>
    <script src="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/js/slide.js" defer></script>
    <script src="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/js/menu.js" defer></script>

</head>

<body onload="call_js()">
    <!-- header -->
    <header class="header_main">
<?php
if(!$user_id){
?>
        <div class="header_login">
            <a href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/login/login_form.php" class="login">Login</a>
            <i class="line"></i>
            <a href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/sign_up/sign_up_form.php" class="signup">Sign Up</a>
        </div>
<?php
} else {
?>
        <div class="header_login">
            <ul>
                <li>
                    <ul>
                        <li><a href="#" class="mybutton"><?= $logged = $user_nick?></a></li>
                    </ul>
                    <div class="login_menu">
                        <ul>
                            <li><a href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/login/logout.php">로그아웃</a></li>
                            <li><a href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/myinfo/info_check.php">내정보</a></li>
<?php
}
?>
<?php
if($user_id == "rjsdnd27"){
?>
                            <li><a href="#">관리자 모드</a></li>
<?php 
}
?>
                        </ul>
                    </div>
                </li>
            </ul>
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
                            <li><a href="#">새소식</a></li>
                            <li><a href="#">자유게시판</a></li>
                            <li><a href="#">고객지원</a></li>
                        </ul>
                        <div class="menu_sub">
                            <ul>
                                <li><a href="#">티켓오픈소식</a></li>
                                <li><a href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/board/imageboard_form.php">커뮤니티</a></li>
                                <li><a href="#">공지사항</a></li>
                            </ul>
                            <ul>
                                <li><a href="#">이달의 콘서트</a></li>
                                <li><a href="#">출석체크</a></li>
                                <li><a href="#">이용안내</a></li>
                            </ul>
                            <ul>
                                <li><a href="#">TOP100</a></li>
                                <li><a href="#">음악추천</a></li>
                                <li><a href="#">FAQ</a></li>
                            </ul>
                            <ul>
                                <li><a href="#">이벤트</a></li>
                                <li><a href="#">아티스트추천</a></li>
                                <li><a href="#">1 : 1 문의</a></li>
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
                    <a href="#"><img src="./img/poster1.jpg" alt="slide1"><h1>asdasdasd</h1></img></a>
                    <a href="#"><img src="./img/poster2.jpg" alt="slide2"><h1>asdasdasd</h1></img></a>
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