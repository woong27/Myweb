<?php 
    //세선값 체크
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
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/form.css">
    
    <script src="https://kit.fontawesome.com/dd24ff9acb.js" crossorigin="anonymous"></script>
    <title>MusicTicket</title>
</head>
<body>
    <nav class="info_body">
        <div class="nav_body">
            <div class="nav_profile">
                <i class="fa-solid fa-user"></i>   
                <a href="#"><?= $logged = $user_nick?></a> 
            </div>
            
            <ul>
                <li><a href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/myinfo/info_check.php">화원정보 및 수정</a></li>
                <li><a href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/admin/admin_reser_form.php">예약 확인</a></li>
                <li><a href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/myinfo/info_mywriting.php">내가 쓴 글</a></li>

                <?php
                    if($user_level == "1"){
                ?>

                <li><a name="admin" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/admin/admin.php">관리자 모드</a></li>
                <li><a name="admin" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/admin/admin_con_form.php">공연 등록</a></li>

                <?php 
                    }
                ?>
                
            </ul>
        </div>
    </nav>
</body>
</html>