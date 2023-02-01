<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MusicTicket</title>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/form.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/user_info.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/admin.css">
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

        <section class="reser_check">
            <div class="reser_title">
                <h1>예매내역</h1>
            </div>
            <div class="reser_box">
                <table class="reser_table">
                    <tr>
                        <th class="num1">번호</th>
                        <th class="num2">콘서트</th>
                        <th class="num3">아티스트</th>
                        <th class="num4">닉네임</th>
                        <th class="num5">전화번호</th>
                        <th class="num6">이메일</th>
                        <th class="num7">공연날짜</th>
                        <th class="num8">가격</th>
                        <th class="num8">결제방법</th>
                        <th class="num9">예매날짜</th>
                        <th class="num9">선택</th>
                    </tr>
                <?php
                    include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";
                    $sql = "select * from ticket_reservation where id='$user_id' order by num desc";
                    $result = mysqli_query($con, $sql);
                    $total_record = mysqli_num_rows($result);
                
                    $number = $total_record;

                    while ($row = mysqli_fetch_array($result))
                    {
                        $num = $row["num"];
                        $user_id = $row["id"];
                        $title = $row["title"];
                        $artist = $row["artist"];
                        $user_nick = $row["nick"];
                        $phone = $row["phone"];
                        $email = $row["email"];
                        $reser_day = $row["reser_day"];
                        $price = $row["price"];
                        $card = $row["card"];
                        $regist_day = $row["regist_day"];
                        $regist_day = substr($regist_day, 0, 10)
                ?>
                    <tr>
                        <td class="num1"><?=$num?></td>
                        <td class="num2"><?=$title?></td>
                        <td class="num3"><?=$artist?></td>
                        <td class="num4"><?=$user_nick?></td>
                        <td class="num5"><?=$phone?></td>
                        <td class="num6"><?=$email?></td>
                        <td class="num7"><?=$reser_day?></td>
                        <td class="num8"><?=$price?></td>
                        <td class="num9"><?=$card?></td>
                        <td class="num10"><?=$regist_day?></td>
                        <td class="col_button"><button type="submit" onclick="location.href='admin_con_delete.php?mode=reser_delete&num=<?=$num?>'">예매취소</button></td>
                    </tr>	
                <?php
                        $number--;
                    }
                    mysqli_close($con);
                ?>
                </table>
            </div> <!-- admin_box -->
        </section>
    </div>
</body>
</html>