<?php 
    //세선값 체크
    session_start();
    $user_id = $user_nick = $user_level = "";
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
    <title>Document</title>
    <script src="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/js/sub_menu.js" defer></script>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/form.css">
</head>

<body>
    <header>
        <div class="header_title">
            <img src="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/img/concert.png">
            <a href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/music_web.php">
                <h1>MusicTicket</h1>
            </a>
        </div>

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
    </header>
</body>

</html>