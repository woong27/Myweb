<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>MusicTicket</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/board.css">
</head>

<body>
  <header>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/sub_header.php"?>
  </header>
  <section>
    <div class="imsi_body">
      <div class="board_box">
        <div class="top_body">
          <div class="menu_title"><h3>COMMUNITY</h3></div>
          <div class="buttons">

            <?php
              if ($user_id) {
            ?>
                <button onclick="location.href='imageboard_form.php'">글쓰기</button>
            <?php
              } else {
            ?>
                <a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a>
            <?php
              }
            ?>

          </div>
        </div><!-- top_body -->
          <ul class="board_list">

            <?php
              include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";

              if (isset($_GET["page"])) {
                  $page = $_GET["page"];
              } else {
                  $page = 1;
              }

              $sql = "select count(*) from image_board order by num desc";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_array($result);
              $total_record = intval($row[0]); // 전체 글 수

              $scale = 6;
              $total_page = ceil($total_record / $scale);

              // 표시할 페이지($page)에 따라 $start 계산
              $start = ($page - 1) * $scale;

              $number = $total_record - $start;

              //현재페이지 레코드 결과값을 저장하기 위해서 배열선언
              $list = array();

              $sql = "select * from image_board order by num desc LIMIT $start, $scale";
              $result = mysqli_query($con, $sql);
              $i = 0;
              while ($row = mysqli_fetch_array($result)) {
                  //$list[0]["num"] ~ $list[0]["file_copied"]
                  $list[$i] = $row;
                  //번호순서
                  $list_num = $total_record - ($page - 1) * $scale;

                  $list[$i]['no'] = $list_num - $i;
                  $i++;
              }

              $image_width = 300;
              $image_height = 300;

              for ($i = 0; $i < count($list); $i++) {
                $file_image = (!empty($list[$i]['file_name'])) ? "<img src='./img/file.gif'>" : " ";
                $date = substr($list[$i]['regist_day'], 0, 10);
                //이미지파일명이 있으면 if문 진행
                if (!empty($list[$i]['file_name'])) {
                    //진짜 이미지 사이즈를 정보를 가져온다.
                    $image_info = getimagesize("../data/" . $list[$i]['file_copied']);
                    $image_width = $image_info[0];
                    $image_height = $image_info[1];
                    $image_type = $image_info[2];
                    if ($image_width > 300) {
                        $image_width = 300;
                    }

                    if ($image_height > 300) {
                        $image_height = 300;
                    }

                    $file_copied = $list[$i]['file_copied'];
                }
            ?>

            <li>
              <span>
                <a href="imageboard_view.php?num=<?=$list[$i]['num']?>&page=<?=$page?>">

                  <?php
                    //file_type image 문자열이 존재하면 if문 실행 없으면 else 실행
                    if (strpos($list[$i]['file_type'], "image") !== false) {
                        echo "<img src='../data/$file_copied' width='$image_width' height='$image_height'><br>";
                    } else {
                        echo "<img src='../img/user.jpg' width='$image_width' height='$image_height'><br>";
                    }

                  ?>

                  <?=$list[$i]['subject']?>
                </a><br>
                  <?=$list[$i]['id']?><br>
                  <?=$date?>
              </span>
            </li>

            <?php
              } //end of form
              mysqli_close($con);
            ?>

          </ul>

          <ul id="page_num">

            <?php
              $url = "imageboard_list.php?";
              include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/paging.php";
              echo get_paging(6, $page, $total_page, $url);
            ?>

          </ul> <!-- page -->
      </div><!-- board_box -->
    </div> <!-- imsi_body -->
  </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/footer.php"?>
  </footer>
</body>
</html>