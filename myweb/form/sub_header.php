<?php 
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
    <title>Document</title>
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
<?php
}
?>
    </header>
</body>

</html>