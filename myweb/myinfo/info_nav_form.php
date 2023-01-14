<?php 
//세선값 체크
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
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/form.css">
    
    <script src="https://kit.fontawesome.com/dd24ff9acb.js" crossorigin="anonymous"></script>
    <title>information</title>
</head>
<body>
    <nav class="info_body">
        <div class="nav_body">
            <div class="nav_profile">
                <i class="fa-solid fa-user"></i>   
                <a href="#"><?= $logged = $user_nick?></a> 
            </div>
            
            <ul>
                <li><a href="#">화원정보 수정</a></li>
                <li><a href="#">예약 확인</a></li>
                <li><a href="#">내가 쓴 글</a></li>
<?php
if($user_id == "rjsdnd27"){
?>
                            <li><a href="#">관리자 모드</a></li>
<?php 
}
?>
            </ul>
        </div>
    </nav>
</body>
</html>