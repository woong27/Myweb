<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MusicTicket</title>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/form.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/user_info.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/sign_up.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/js/modify.js"></script>
    <script src="https://kit.fontawesome.com/dd24ff9acb.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/sub_header.php"?>
    </header>
    <div class="info_body">
        <nav class="main_nav">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/myinfo/info_nav_form.php"?>
        </nav>

<?php    
	include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";
    $sql    = "select * from members where id='$user_id'";
    $result = mysqli_query($con, $sql);
    $row    = mysqli_fetch_array($result);

    $user_nick = $row["nick"];
    $pass = $row["pass"];
    $phone = $row["phone"];
    $email = $row["email"];

    mysqli_close($con);
?>

        <section class="check_section">
            <form action="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/myinfo/info_modify_server.php" method="post" name="info_modify_form">
                <div class="signup_body">

                <!-- id -->
                <div class="signup_id">
                    <div>
                        <label>ID</label>
                    </div>
                    <div class="input_id">
                        <input class="input_id2" type="text" name="user_id" value="<?=$user_id?>" readonly>
                    </div>
                </div>

                <div class="signup_sub">

                    <div class="signup_nick">
                        <div>
                            <label>NICK</label>
                        </div>
                    </div>
                    <div>
                        <input class='input_nick' type='text' name='user_nick' value="<?=$user_nick?>">
                    </div>

                    <!-- pass1 -->
                    <div class="signup_pass">
                        <div>
                            <label>PASSWORD</label>
                        </div>
                        <div>
                            <input type="password" name="pass1" placeholder = "Password">
                        </div>
                    </div>
                    

                    <!-- pass2 -->
                    <div class="signup_passcheck">
                        <div>
                            <label>PSSWORD CHECK</label>
                        </div>
                        <div>
                            <input type="password" placeholder = "Password Check" name="pass2">
                        </div>
                    </div>

                    <!-- email -->
                    <div>
                        <div>
                            <label>E-mail</label>
                        </div>
                        <div>
                            <input type="text" name="email" value="<?=$email?>">
                        </div>
                    </div>

                    <!-- phone -->
                    <div>
                        <div>
                            <label>Phone</label>
                        </div>
                        <div>
                            <input type="text" name="phone" value="<?=$phone?>">
                        </div>
                    </div>
                </div><!-- signup_sub -->

                <div class="btn_body">
                    <div>
                        <input class="signup_btn" type="button" value="Update" onclick="check_input()">
                    </div>
                    <div>
                        <input class="signup_btn" type="button" value="Reset" onclick="reset_form()">
                    </div>
                </div><!-- btn_body -->

            </div> <!-- signup_body -->
        </form>
    </section>
</body>
</html>