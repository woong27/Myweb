<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MusicTicket</title>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/message.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/js/message.js" defer></script>
</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/sub_header.php"?>
    </header>
        <?php
        //세션아이디
        if (!isset($user_id) || empty($user_id)) {
            echo ("<script>
                alert('로그인 후 이용해주세요!');
                history.go(-1);
                </script>");
                exit;
        }
        ?>
    <section>
        <div>
            <div class="message_title">
                <h1>1 : 1 문의</h1>
            </div>
            <div class="message_body">
                <form name="message_form" method="post" action="message_server.php">
                    <div class="message_section">
                        <div class="list_menu">
                            <?php
                                if($user_level === '1'){
                            ?>

                            <a href="#">고객의소리</a>

                            <?php
                                }else{
                            ?>

                            <a href="#">나의 질문</a>

                            <?php 
                                }
                            ?>

                        </div>
                        <div class="menu_body">
                            <div class="message_menu">
                                <p class="menu nick">작성자</p>
                                <p class="menu reception">받는이</p>
                                <p class="menu title">제목(필수)</p>
                                <p class="menu content">내용(필수)</p>
                            </div>
                            <div class="message_content">
                                <p class="main nick">
                                    <input class="input_id" name="send_id" type="text" value="<?= $user_id?>" readonly>
                                </p>
                                <p class="main reception">
                                    <input class="input_id" name="rv_id" type="text" value="<?= $user_id='rjsdnd27'?>" readonly></p>
                                <p class="main title"><input name="subject" type="text"></p>
                                <p class="main content"><textarea name="content"></textarea></p> 
                            </div>
                        </div>
                    </div>
                
                    <div class="board_button">
                        <button type="button" onclick="location.href='message_list.php?mode=send'">취소</button>
                        <button type="button" onclick="check_input()">작성</button>
                    </div>
                </form>
            </div>           
        </div>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/footer.php"?>
    </footer>
</body>
</html>