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

        <section class="check_writing">
            <div class="admin_box">
                <div class="board_body">
                    <div class="member_title">
                        <h3>내가 쓴 글</h3>
                    </div>
                    <table class="board_table">
                        <tr class="title">
                            <th class="col2">번호</th>
                            <th class="col3">이름</th>
                            <th class="col4">제목</th>
                            <th class="col5">첨부파일명</th>
                            <th class="col6">작성일</th>
                        </tr>
                        <?php 
                            include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";

                            if (isset($_GET["page"])) {
                                $page = $_GET["page"];
                            } else {
                                $page = 1;
                            }

                            $sql = "select * from image_board where id='$user_id' order by num desc";
                            $result = mysqli_query($con, $sql);
                            $total_record = mysqli_num_rows($result);
                        
                            $number = $total_record;

                            $list = array();
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                $list[$i] = $row;
                                $num = $row["num"];
                                $user_nick = $row["nick"];
                                $subject = $row["subject"];
                                $file_name = $row["file_name"];
                                $regist_day = $row["regist_day"];
                                $regist_day = substr($regist_day, 0, 10)
                        ?>
                            <tr>
                                <td class="col2"><?=$number?></td>
                                <td class="col3"><?=$user_nick?></td>
                                <td class="col4">
                                    <a href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/board/imageboard_view.php?num=<?=$list[$i]['num']?>&page=<?=$page?>"><?=$subject?>
                                </a>
                                    
                                </td>
                                <td class="col5"><?=$file_name?></td>
                                <td class="col6"><?=$regist_day?></td>
                            </tr>	
                        <?php
                                $number--;
                            }
                        ?>
                    </table> 
                </div>
            </div> <!-- admin_box -->
        </section>
    </div>
</body>
</html>