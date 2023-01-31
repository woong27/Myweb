<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MusicTicket</title>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/message.css">
</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/sub_header.php"?>
    </header>
    <section>
        <div class="message_view">
            <div class="title_body">
                <h3 class="title">
                    <?php 
                        $mode = $_GET["mode"];
                        $num = $_GET["num"];

                        include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";
                        $sql = "select * from message where num=$num";
                        $result = mysqli_query($con, $sql);

                        $row = mysqli_fetch_array($result);
                        $send_id = $row["send_id"];
                        $rv_id = $row["rv_id"];
                        $regist_day = $row["regist_day"];
                        $subject = $row["subject"];
                        $content = $row["content"];

                        $content = str_replace(" ", "&nbsp;", $content);
                        $content = str_replace("\n", "<br>", $content);

                        if($mode=="send"){
                            $result2 = mysqli_query($con, "select nick from members where id='$rv_id'");
                        }else {
                            $result2 = mysqli_query($con, "select nick from members where id='$send_id'");
                        }

                        $record = mysqli_fetch_array($result2);
                        $msg_name = $record["nick"];

                        if($mode == "send"){
                            echo "문의 내용";
                        }else{
                            echo "수신 내용";
                        }
                    ?>
                </h3>
            </div>
            <div class="message_viewbutton">
                <button onclick="location.href='./message_list.php?mode=<?=$mode?>'">취소</button>

                <?php 
                    if($user_level == '1'){
                ?>
                    <button onclick="location.href='./message_reply_form.php?num=<?=$num?>'">답변 쪽지</button>
                <?php       
                    }
                ?>  
                <button onclick="location.href='./message_delete.php?num=<?=$num?>&mode=<?=$mode?>'">삭제</button>
            </div>
        </div>
        <div class="view_content">
            <ul>
                <li class="num1">제목 : <?= $subject?></li>
                <li class="num2"><?= $msg_name?> | <?= $regist_day?></li>
                <li class="num3"><?= $content?></li>
            </ul>
        </div>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/footer.php"?>
    </footer>
</body>
</html>