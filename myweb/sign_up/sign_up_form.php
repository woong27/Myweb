<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MusicTicket</title>
    <link rel="stylesheet" href="../css/sign_up.css">
</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/sub_header.php"?>
    </header>

    <section>
        <form action="./sign_up_server.php" method="post" name="sign_up_form">
            <h1>SIGN UP</h1>
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
            <label>ID</label>
            <div class="input_id">
                <input type="text" name="id" placeholder="ID">
                <input class="check" type="button" value="Check" placeholder="ID" onclick="check_id()">
            </div>

            <label>NICK</label></label>
<?php
if (isset($_GET['nick'])) {
    $mb_nick = $_GET['nick'];
    echo "<div><input type='text' placeholder = 'Nickname' name='mb_nick' value={$mb_nick}>
                </div>";
} else {
    echo "<div><input type='text' placeholder = 'Nickname' name='mb_nick'>
                </div>";
}
?>

            <!-- pass1 -->
            <label>PASSWORD</label>
            <div>
                <input type="password" name="pass1" placeholder = "Password">
            </div>

            <!-- pass2 -->
            <label>PSSWORD CHECK</label>
            <div>
                <input type="password" placeholder = "Password Check" name="pass2">
            </div>

            <!-- email -->
            <label>E-mail</label>
            <div>
                <input type="text" placeholder = "Email" name="email">
            </div>

            <!-- phone -->
            <label>Phone</label>
            <div>
                <input type="text" placeholder = "Phone" name="phone">
            </div>
        </form>
    </section>
</body>
</html>