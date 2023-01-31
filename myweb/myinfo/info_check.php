<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MusicTicket</title>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/form.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/user_info.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/js/login.js"></script>
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

        <section class="check_section">
            <form action="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/myinfo/info_check_server.php" method="post" name="info_check">
                <div class="login_body">
    <!-- 에러메세지 -->
    <?php
    if (isset($_GET['error'])) {
        echo "<p class='error'>{$_GET['error']}</p>";
    }

    if (isset($_GET['success'])) {
        echo "<p class='success'>{$_GET['success']}</p>";
    }
    ?>
                    <div class="signup_sub">
                        <!-- pass1 -->
                        <div class="signup_pass">
                            <div>
                                <input type="hidden" name="user_id" value="<?=$user_id?>">
                                <input type="password" name="pass" placeholder = "Password">
                            </div>
                        </div>
                    </div><!-- signup_sub -->

                    <div class="btn_body">
                        <div>
                            <input class="button" type="submit" value="CHECK" onclick="check_pass()">
                        </div>
                    </div><!-- btn_body -->

                </div> <!-- signup_body -->
            </form>
        </section>
    </div>
</body>
</html>