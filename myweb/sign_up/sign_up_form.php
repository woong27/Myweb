<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MusicTicket</title>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/sign_up.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/js/members.js"></script>
</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/sub_header.php"?>
    </header>

    <section>
        <form action="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/sign_up/sign_up_server.php" method="post" name="sign_up_form">
            <div class="signup_title">
                <h1>SIGN UP</h1>
            </div>

            <div class="signup_body">
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
                    <div>
                        <label>ID</label>
                    </div>
                    <div class="input_id">
                        <input class="input_id2" type="text" name="user_id" placeholder="ID">
                    </div>
                </div>

                <div class="signup_sub">
                    <div class="signup_nick">
                        <div>
                            <label>NICK</label>
                        </div>
    <?php
if (isset($_GET['user_nick'])) {
    $user_nick = $_GET['user_nick'];
    echo "<div><input class='input_nick' type='text' placeholder = 'Nickname' name='user_nick' value={$user_nick}>
                </div>";
} else {
    echo "<div><input class='input_nick' type='text' placeholder = 'Nickname' name='user_nick'>
                </div>";
}
    ?>
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
                            <input type="text" placeholder = "Email" name="email">
                        </div>
                    </div>

                    <!-- phone -->
                    <div>
                        <div>
                            <label>Phone</label>
                        </div>
                        <div>
                            <input type="text" placeholder = "Phone" name="phone">
                        </div>
                    </div>
                </div><!-- signup_sub -->

                <div class="btn_body">
                    <div>
                        <input class="signup_btn" type="button" value="Submit" onclick="check_input()">
                    </div>
                    <div>
                        <input class="signup_btn" type="button" value="Reset" onclick="reset_form()">
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