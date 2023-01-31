<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MusicTicket</title>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/sign_up.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/js/login.js"></script>
</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/sub_header.php"?>
    </header>

    <section class="login_section">
        <form action="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/login/login_server.php" method="post" name="login_form">
            <div class="login_title">
                <h1>LOGIN</h1>
            </div>

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
                <!-- id -->
                <div class="signup_id">
                    <div class="input_id">
                        <input class="login_id" type="text" name="user_id" placeholder="ID">
                    </div>
                </div>

                <div class="signup_sub">
                    <!-- pass1 -->
                    <div class="signup_pass">
                        <div>
                            <input type="password" name="pass" placeholder = "Password">
                        </div>
                    </div>
                </div><!-- signup_sub -->

                <div class="btn_body">
                    <div>
                        <input class="button" type="submit" value="LOGIN" onclick="check_input()">
                    </div>
                    <div>
                        <a href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/sign_up/sign_up_form.php" class="save">회원가입 하시겠어요?</a>
                    </div>
                </div><!-- btn_body -->

            </div> <!-- signup_body -->
        </form>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/footer.php"?>
    </footer>
</body>
</html>