<?php 
    include_once $_SERVER['DOCUMENT_ROOT']."/Web_project/myweb/db/create_statement.php";

    //세선값 체크
    session_start();
    $user_id = $user_nick = $level = "";
    if(isset($_SESSION["user_id"]) && isset($_SESSION["user_nick"]) && isset($_SESSION["user_level"])) {
        $user_id = $_SESSION["user_id"];
        $user_nick = $_SESSION["user_nick"];
        $user_level = $_SESSION["user_level"];
    }else {
        $user_id = $user_nick = $user_level = "";
    }
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MusicTicket</title>
    <script src="https://kit.fontawesome.com/dd24ff9acb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/slide.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/form.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/music_web.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js" defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js" defer></script>
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
                                if($user_level == "1"){
                            ?>
                                <li><a href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/admin/admin.php">관리자 모드</a></li>
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
                <img src="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/img/concert.png">
                <h1>MusicTicket</h1>
            </div>

            <nav class="header_nav">
                <ul>
                    <li class="header_menu">
                        <ul class="menu_main">
                            <li>
                                <a href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/ticket/reservation_form.php">이달의 콘서트</a>
                            </li>
                            <li>
                                <a href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/board/imageboard_list.php">커뮤니티</a>
                            </li>
                            <li>
                                <?php
                                    if($user_id){
                                        if($user_level == 1){
                                ?>
                                            <a href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/message/message_list.php?mode=rv">1 : 1 문의</a>
                                <?php
                                        }else {
                                ?>
                                            <a href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/message/message_list.php?mode=send">1 : 1 문의</a>
                                <?php      
                                        }
                                    }else {
                                ?>
                                        <a href="javascript:alert('로그인 후 이용해 주세요!')">1 : 1 문의</a>
                                <?php
                                    }
                                ?>
                                
                            </li>
                        </ul>
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
                    <p class="content">Jazz has three characteristics: swing feeling from off-beat rhythm, creativity and vitality in improvision, and sound and framing that make use of the performer's personality, and these are fundamentally different from European music and classical music.</p>
                </div>
            </div>
        </div>
        <!-- page TWO -->
        <div class="fullsection full2" pageNum="2">
            <div class="slide">
                <div class="slide_title">
                    <h1>MusicConcert of Month</h1>
                </div>
                <div class="slideshow">
                    <?php
                        include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";

                        if (isset($_GET["page"])) {
                            $page = $_GET["page"];
                        } else {
                            $page = 1;
                        }
        
                        $sql = "select count(*) from concert_insert order by num desc";
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($result);
                        $total_record = intval($row[0]);
        
                        $scale = 20;
                        $total_page = ceil($total_record / $scale);
        
                        // 표시할 페이지($page)에 따라 $start 계산
                        $start = ($page - 1) * $scale;
        
                        $number = $total_record - $start;
        
                        //현재페이지 레코드 결과값을 저장하기 위해서 배열선언
                        $list = array();
        
                        $sql = "select * from concert_insert order by num desc LIMIT $start, $scale";
                        $result = mysqli_query($con, $sql);
                        $i = 0;
                        while ($row = mysqli_fetch_array($result)) {
                            //$list[0]["num"] ~ $list[0]["file_copied"]
                            $list[$i] = $row;
                            //번호순서
                            $list_num = $total_record - ($page - 1) * $scale;
        
                            $list[$i]['no'] = $list_num - $i;
                            $i++;
                        }
                        $image_width = 200;
                        $image_height = 300;
        
                        for ($i = 0; $i < count($list); $i++) {
                            $file_image = (!empty($list[$i]['file_name'])) ? "<img src='./img/file.gif'>" : " ";
                            //이미지파일명이 있으면 if문 진행
                            if (!empty($list[$i]['file_name'])) {
                                //진짜 이미지 사이즈를 정보를 가져온다.
                                $image_info = getimagesize("./condata/" . $list[$i]['file_copied']);
                                $image_width = $image_info[0];
                                $image_height = $image_info[1];
                                $image_type = $image_info[2];
                                if ($image_width > 200) {
                                    $image_width = 200;
                                }
                        
                                if ($image_height > 300) {
                                    $image_height = 300;
                                }
                        
                                $file_copied = $list[$i]['file_copied'];
                            }
                    ?>
                    <a href="./ticket/reservation_view.php?num=<?=$list[$i]['num']?>&page=<?=$page?>"><?php
                        //file_type image 문자열이 존재하면 if문 실행 없으면 else 실행
                        if (strpos($list[$i]['file_type'], "image") !== false) {
                            echo "<img src='./condata/$file_copied' width='$image_width' height='$image_height'><br>";
                        } else {
                            echo "<img src='./img/user.jpg' width='$image_width' height='$image_height'><br>";
                        }
                    ?>
                        <h4><?=$list[$i]['title']?></h4>
                    </a>
                    <?php
                        }
                        mysqli_close($con);
                    ?>   
                </div>
                
                <div class="slideshow_nav">
                    <a href="#" class="prev"><i class="fa-solid fa-angle-left"></i></a>
                    <a href="#" class="next"><i class="fa-solid fa-angle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- page THREE -->
        <div class="fullsection full3" pageNum="3">
            <div class="full3_body">
                <div class="content_body">
                    <h1 class="full3_title">Members Only</h1>
                    <p class="full3_content">We offer the best service for concert reservations. This page is for members only. If you want to see more information, please sign up for more information.</p>
                </div>
            
                <div class="full3_menubody">
                    <?php
                        include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";

                        if (isset($_GET["page"])) {
                            $page = $_GET["page"];
                        } else {
                            $page = 1;
                        }

                        $sql = "select * from ticket_reservation where id='$user_id' order by num asc";
                        $result = mysqli_query($con, $sql);
                        $total_record = mysqli_num_rows($result);
                    
                        $number = $total_record;
                        while ($row = mysqli_fetch_array($result)) {
                            $num = $row["num"];
                            $user_id = $row["id"];
                            $title = $row["title"];
                            $artist = $row["artist"];
                            $reser_day = $row["reser_day"];
                            $regist_day = $row["regist_day"];
                            $regist_day = substr($regist_day, 0, 10);
                            $number--;
                        }
                        mysqli_close($con);
                        if(!$user_id || !$total_record){
                    ?>

                    <div class="full3_resermenu">
                        <h3 class="full_title">My Concert</h3>
                        <div class="resermenu_content">
                            <h5>로그인후 이용해주세요</h5>
                        </div>
                    </div>
                    <div class="full3_boardmenu">
                        <h3 class="full_title">내가 쓴 글</h3>
                        <div class="resermenu_content">
                            <h3 class="full_title">로그인후 이용해주세요</h3>
                        </div>
                    </div>

                    <?php
                        }else {     
                    ?>

                    <div class="full3_resermenu">
                        <h3 class="full_title">My Concert</h3>
                        <div class="resermenu_content">
                            <h5><?=$artist?></h5>
                            <h5><?=$title?></h5>
                            <h5>예매날짜 : <?=$reser_day?></h5>
                        </div>
                        <small>최근 예매 내역입니다.</small>
                    </div>
                    
                    <div class="full3_boardmenu">
                        <h3 class="full_title">내가 쓴 글</h3>
                        <div class="board_body">
                            <?php 
                                include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";

                                if (isset($_GET["page"])) {
                                    $page = $_GET["page"];
                                } else {
                                    $page = 1;
                                }

                                $sql = "select * from image_board where id='$user_id' order by num asc limit 4";
                                $result = mysqli_query($con, $sql);
                                $total_record = mysqli_num_rows($result);
                            
                                $number = $total_record;

                                $list = array();
                                $i = 0;
                                while ($row = mysqli_fetch_array($result)) {
                                    $list[$i] = $row;
                                    $num = $row["num"];
                                    $user_nick = $row["nick"];
                                    $subject = $row["subject"];
                                    $regist_day = $row["regist_day"];
                                    $regist_day = substr($regist_day, 0, 10)
                            ?>	
                            <div class="full3_board">
                                <span><?=$user_nick?></span>
                                <span>
                                    <a href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/board/imageboard_view.php?num=<?=$list[$i]['num']?>&page=<?=$page?>"><?=$subject?>
                                    </a>
                                </span> 
                                <span><?=$regist_day?></span>
                            </div>
                            <?php
                                $number--;
                            }
                            ?>
                        </div>
                    </div>  
                    <?php
                        }
                    ?>
                </div>
            </div>
            <footer>
                <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/footer.php"?>
            </footer>       
        </div>
    </section>
    <!-- ==section== -->
</body>
</html>