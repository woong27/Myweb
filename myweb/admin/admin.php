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

        <section class="check_section2">
            <div class="admin_box">
                <div class="member_body">
                    <div class="member_title">
                        <h3>관리자 모드(회원)</h3>
                    </div>
                    <table class="member_table">
                        <tr>
                            <th class="col">번호</th>
                            <th class="col2">아이디</th>
                            <th class="col3">닉네임</th>
                            <th class="col4">전화번호</th>
                            <th class="col6">가입일</th>
                            <th class="col7">수정</th>
                            <th class="col8">삭제</th>
                        </tr>
                        <?php
                            //1. 데이터베이스 include
                            //2. select 진행함.
                            include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";
                            $sql = "select * from members order by num desc";
                            $result = mysqli_query($con, $sql);
                            $total_record = mysqli_num_rows($result);

                            $number = $total_record;

                            while($row = mysqli_fetch_array($result)){
                                $num = $row["num"];
                                $user_id = $row["id"];
                                $user_nick = $row["nick"];
                                $phone = $row["phone"];
                                $regist_day = $row["regist_day"];
                        ?>

                        <tr>
                            <form method="post" action="admin_member_DUI.php?mode=update">
                                <input type="hidden" name="num" value="<?=$num?>">
                                <td class="col1"><?=$number?></td>
                                <td class="col2"><?=$user_id?></td>
                                <td class="col3"><input type="text" name="user_nick" value="<?=$user_nick?>"></td>
                                <td class="col4"><?=$phone?></td>
                                <td class="col6"><?=$regist_day?></td>
                                <td class="col_button"><button type="submit">수정</button></td>
                                <td class="col_button"><button type="button" onclick="location.href='admin_member_DUI.php?mode=delete&num=<?=$num?>'">삭제</button></td>
                            </form>
                        </tr>
                        <?php 
                            $number--;
                        }
                        ?>
                    </table>
                </div>

                <div class="board_body">
                    <form method="post" action="admin_member_DUI.php?mode=board_delete">
                        <div class="member_title">
                            <h3>관리자 모드(게시판)</h3>
                            <button class="button_delete" type="submit">선택된 글 삭제</button>
                        </div>

                        <table class="board_table">
                            <tr class="title">
                                <th class="col">선택</th>
                                <th class="col2">번호</th>
                                <th class="col3">이름</th>
                                <th class="col4">제목</th>
                                <th class="col5">첨부파일명</th>
                                <th class="col6">작성일</th>
                            </tr>
                            <?php 
                                $sql = "select * from image_board order by num desc";
                                $result = mysqli_query($con, $sql);
                                $total_record = mysqli_num_rows($result);
                            
                                $number = $total_record;

                                while ($row = mysqli_fetch_array($result))
                                {
                                    $num = $row["num"];
                                    $user_nick = $row["nick"];
                                    $subject = $row["subject"];
                                    $file_name = $row["file_name"];
                                    $regist_day = $row["regist_day"];
                                    $regist_day = substr($regist_day, 0, 10)
                            ?>
                                <tr>
                                    <td class="col1"><input type="checkbox" name="item[]" value="<?=$num?>"></td>
                                    <td class="col2"><?=$number?></td>
                                    <td class="col3"><?=$user_nick?></td>
                                    <td class="col4"><?=$subject?></td>
                                    <td class="col5"><?=$file_name?></td>
                                    <td class="col6"><?=$regist_day?></td>
                                </tr>	
                            <?php
                                    $number--;
                                }
                            ?>
                        </table>
                        
                    </form> 
                </div>

                <div class="concert_body2">
                    <form method="post" action="admin_member_DUI.php?mode=concert_delete">
                        <div class="member_title">
                            <h3>관리자 모드(공연정보)</h3>
                            <button class="button_delete" type="submit">선택된 글 삭제</button>
                        </div>

                        <table class="concert_table">
                            <tr class="consert_title">
                                <th class="col">선택</th>
                                <th class="col2">번호</th>
                                <th class="col3">아티스트</th>
                                <th class="col3">제목</th>
                                <th class="col4">장르</th>
                                <th class="col5">가격</th>
                                <th class="col6">공연장</th>
                                <th class="col7">공연날짜</th>
                                <th class="col8">첨부파일명</th>
                            </tr>
                            <?php 
                                $sql = "select * from concert_insert order by num desc";
                                $result = mysqli_query($con, $sql);
                                $total_record = mysqli_num_rows($result);
                                $number = $total_record;

                                while ($row = mysqli_fetch_array($result))
                                {
                                    $num = $row["num"];
                                    $artist = $row["artist"];
                                    $title = $row["title"];
                                    $genre = $row["genre"];
                                    $price = $row["price"];
                                    $concerthall = $row["concerthall"];
                                    $start_day = $row["start_day"];
                                    $end_day = $row["end_day"];
                                    $file_name = $row["file_name"];
                            ?>
                            <tr>
                                <td class="col1"><input type="checkbox" name="item2[]" value="<?=$num?>"></td>
                                <td class="col2"><?=$number?></td>
                                <td class="col2"><?=$artist?></td>
                                <td class="col3"><?=$title?></td>
                                <td class="col4"><?=$genre?></td>
                                <td class="col5"><?=$price?></td>
                                <td class="col6"><?=$concerthall?></td>
                                <td class="col7"><?=$start_day?> ~ <?=$end_day?></td>
                                <td class="col8"><?=$file_name?></td>
                            </tr>	
                            <?php
                                    $number--;
                                }
                                mysqli_close($con);
                            ?>
                        </table>
                    </form>     
                </div>
            </div> <!-- admin_box -->
        </section>
    </div>
</body>
</html>