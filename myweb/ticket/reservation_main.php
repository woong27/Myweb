<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/Web_project/myweb/css/ticket.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/js/ticket.js"></script>
    <title>Document</title>
</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/sub_header.php"?>
    </header>

    <section>
        <form action="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/ticket/reservation_server.php" method="post" name="reservation_main">
            <div class="reservation_title">
                <h1>Reservation</h1>
            </div>
            <div class="reservation_body">
                <div class="reservation_poster">
                    <?php
                        if (!$user_id) {
                            echo("<script>
                            alert('로그인 후 이용해주세요!');
                            history.go(-1);
                            </script>
                            ");
                            exit;
                        }
                        include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";
                        $num = $_GET["num"];
                        $page = $_GET["page"];

                        $sql = "select * from concert_insert where num=$num";
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($result);

                        $title = $row["title"];
                        $artist = $row["artist"];
                        $genre = $row["genre"];
                        $concerthall = $row["concerthall"];
                        $price = $row["price"];
                        $start_day = $row["start_day"];
                        $end_day = $row["end_day"];
                        $file_name = $row['file_name'];
                        $file_copied = $row['file_copied'];
                        $file_type = $row['file_type'];
                        //이미지 정보를 가져오기 위한 함수 width, height, type
                        if (!empty($file_name)) {
                            $image_info = getimagesize("../condata/" . $file_copied);
                            $image_width = $image_info[0];
                            $image_height = $image_info[1];
                            $image_type = $image_info[2];
                            $image_width = 200;
                            $image_height = 300;
                            if ($image_width > 200) $image_width = 200;
                        }
                    ?>
                    <div>
                        <?php 
                            if (strpos($file_type, "image") !== false) {
                                echo "<img src='../condata/$file_copied' width='$image_width'><br>";
                            } else if ($file_name) {
                                $real_name = $file_copied;
                                $file_path = "../condata/" . $real_name;
                                $file_size = filesize($file_path);
                            } 
                        ?>
                    </div>
                    <div>
                        <div>
                            <h4><?= $title ?></h4>
                            <small><?= $concerthall ?></small>
                        </div>
                    </div>
                </div>
                <div class="reservation_menu">
                    <?php
                        $sql    = "select * from members where id='$user_id'";
                        $result = mysqli_query($con, $sql);
                        $row    = mysqli_fetch_array($result);
                        
                        $user_nick = $row["nick"];
                        $phone = $row["phone"];
                        $email = $row["email"];
                    ?>
                    <ul class="reservation_main">
                        <li>ID</li>
                        <li>닉네임</li>
                        <li>전화번호</li>
                        <li>이메일</li>
                        <li>공연기간</li>
                        <li>예매날짜</li>
                        <li>결제 금액</li>
                        <li>결제 카드</li>
                    </ul>
                    <ul class="reservation_input">
                        <input type="hidden" name="title" value="<?= $title ?>">
                        <input type="hidden" name="artist" value="<?= $artist ?>">
                        <li><input type="text" name="user_id" value="<?= $user_id ?>" readonly></li>
                        <li><input type="text" name="user_nick" value="<?= $user_nick ?>" readonly></li>
                        <li><input type="text" name="phone" value="<?= $phone ?>" readonly></li>
                        <li><input type="text" name="email" value="<?= $email ?>" readonly></li>
                        <li><p><?= $start_day." ~ ".$end_day ?></p></li>
                        <li><input type="date" name="reser_day" max="<?= $end_day ?>" min="<?= $start_day ?>" value="<?= $start_day ?>"></li>
                        <li><input type="text" name="price" value="<?= $price?>" readonly></li>
                        <li>
                        <input type="text" name="card" list="twodatalist">
                            <datalist id="twodatalist">
                                <option value="신한"></option>
                                <option value="국민"></option>
                                <option value="농협"></option>
                                <option value="삼성"></option>
                                <option value="카카오"></option>
                            </datalist>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="reser_button">
                <input class="reser_btn" type="button" value="Submit" onclick="check_input()">
            </div>
        </form>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/footer.php"?>
    </footer>
</body>
</html>