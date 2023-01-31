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
        <div>
            <div class="list_title">
            
                <?php
                    if(isset($_GET["page"]) || !empty($_GET["page"])){
                        $page = $_GET["page"];
                    }else {
                        $page = 1;
                    }

                    $mode = $_GET["mode"];

                    if ($mode=="send"){
                        if($user_level === '1'){
                            echo "<h3>답변 완료</h3>";
                        }else {
                            echo "<h3>나의 질문</h3>";
                        }
                    }else {
                        if($user_level === '1'){
                            echo "<h3>고객의 소리</h3>";
                        }else {
                            echo "<h3>관리자 답변</h3>";
                        }
                    }

                    if($user_level !== '1'){
                ?>
                    <div class="button_menu">
                        <button class="message_button" onclick="location.href='message_form.php'">쪽지 보내기</button>
                        <button class="message_button" onclick="location.href='message_list.php?mode=rv'">관리자 답변</button>
                    </div>
                <?php
                    }else {
                ?>  
                    <button class="message_button" onclick="location.href='message_list.php?mode=send'">고객 답변</button>
                <?php
                    }
                ?>
                
            </div>

            <table>
                <tr>
                    <th>번호</th>
                    <th>제목</th>
                    <th>
                        <?php 
                        if ($mode=="send"){
                            echo "받은이";
                        }else {
                            echo "보낸이";
                        }
                        ?>
                    </th>
                    <th>등록일</th>
                </tr>
                <?php
                    include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";

                    if ($mode == "send"){
                        $sql = "select count(*) from message where send_id='$user_id' order by num desc";
                    }else {
                        $sql = "select count(*) from message where rv_id='$user_id' order by num desc";
                    }
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);
                    $total_record = intval($row[0]); // 전체 글 수
                    // 페이지 구하기
                    $scale = 5;
                    
                    // ceil() 함수는 소수점 자리의 숫자를 무조건 올리는 함수이다.
                    // 전체 레코드 수에서 $scale 을 나눈다
                    $total_page = ceil($total_record / $scale); // << 전체 페이지

                    $start = ($page - 1) * $scale;

                    // mysqli_fetch_array 함수는 mysqli_query 를 통해 얻은 리절트 셋(result set)에서 레코드를 1개씩 리턴해주는 함수입니다.
                    $row = mysqli_fetch_array($result);

                    $number = $total_record - $start;

                    

                    if($mode=="send"){
                        //보여줄 레코드 limit $start,$scale
                        $sql = "select * from message where send_id='$user_id' order by num desc limit $start, $scale";
                    }else {
                        $sql = "select * from message where rv_id='$user_id' order by num desc limit $start, $scale";
                    }

                    $result = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_array($result)) {
                        $num = $row["num"];
                        $subject = $row["subject"];
                        $regist_day = $row["regist_day"];
                        
                        if($mode == "send") {
                            $msg_id = $row["rv_id"];
                        } else {
                            $msg_id = $row["send_id"];
                        }

                        $result2 = mysqli_query($con, "select nick from members where id = '$msg_id'");
                        $record = mysqli_fetch_array($result2);
                        $msg_nick = $record["nick"];
                ?>
                <tr>
                    <td><?=$number?></td>
                    <td class="table_item"><a href="message_view.php?mode=<?=$mode?>&num=<?=$num?>"><?=$subject?></a></td>
                    <td>
                        <?php
                            if($user_level == '1'){
                        ?>
                        <?=$msg_nick?>(<?=$msg_id?>)
                        <?php      
                            }else {
                        ?>
                            <?=$msg_nick?>(관리자)
                        <?php
                            }
                        ?>
                        
                    </td>
                    <td><?=$regist_day?></td>
                </tr>
                <?php
                        $number--;
                    }
                    mysqli_close($con);
                ?>
            </table>
            <div class="message_page">
                <?php
                    $url = "message_list.php?mode=$mode&";
                    include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/paging.php";
                    echo get_paging(5, $page, $total_page, $url);
                ?>
            </div>
        </div>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/footer.php"?>
    </footer>
</body>
</html>