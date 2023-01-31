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

  <section class="view_body">
    <div id="board_box">
      <div id="board_list2">
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

          $sql = "select * from image_board where num=$num";
          $result = mysqli_query($con, $sql);
          $row = mysqli_fetch_array($result);

          $id = $row["id"];
          $user_nick = $row["nick"];
          $regist_day = $row["regist_day"];
          $subject = $row["subject"];
          $content = $row["content"];
          $file_name = $row["file_name"];
          $file_type = $row["file_type"];
          $file_copied = $row["file_copied"];
          $hit = $row["hit"];
          $content = str_replace(" ", "&nbsp;", $content);
          $content = str_replace("\n", "<br>", $content);
          
          //$hit 1추가 설정
          if ($user_id !== $id) {
              $new_hit = $hit + 1;
              $sql = "update image_board set hit=$new_hit where num=$num";
              mysqli_query($con, $sql);
          }

          $file_name = $row['file_name'];
          $file_copied = $row['file_copied'];
          $file_type = $row['file_type'];
          //이미지 정보를 가져오기 위한 함수 width, height, type
          if (!empty($file_name)) {
              $image_info = getimagesize("../data/" . $file_copied);
              $image_width = $image_info[0];
              $image_height = $image_info[1];
              $image_type = $image_info[2];
              $image_width = 300;
              $image_height = 300;
              if ($image_width > 300) $image_width = 300;
          }
        ?>
        <h3><span class="col1"><?= $subject ?></span></h3>
        <ul id="view_content">
          <li><span class="col2"><?= $user_nick ?> | <?= $regist_day ?></span></li>
          <div id="write_button">
            <ul class="button_menu">
              <li>
                <button class="btn_menu" onclick="location.href='imageboard_list.php?page=<?= $page ?>'">취소</button>

                <form action="imageboard_modify_form.php" method="post">
                  <button class="btn_menu">수정</button>
                  <input type="hidden" name="num" value=<?= $num ?>>
                  <input type="hidden" name="page" value=<?= $page ?>>
                  <input type="hidden" name="mode" value="modify">
                </form>

                <form action="imageboard_DUI.php" method="post">
                  <button class="btn_menu">삭제</button>
                  <input type="hidden" name="num" value=<?= $num ?>>
                  <input type="hidden" name="page" value=<?= $page ?>>
                  <input type="hidden" name="mode" value="delete">
                </form>
              </li>
            </ul>
          </div>
            <li>
              <?php
                if (strpos($file_type, "image") !== false) {
                  echo "<img src='../data/$file_copied' width='$image_width'><br>";
                } else if ($file_name) {
                  $real_name = $file_copied;
                  $file_path = "../data/" . $real_name;
                  $file_size = filesize($file_path);  //파일사이즈를 구해주는 함수

                  echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
                  <a href='imageboard_download.php?real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
                }
              ?>
              <?= $content ?>
            </li>
        </ul>
        <!--덧글내용시작  -->
        <div id="ripple">
          <div id="ripple1">댓글</div>
            <div id="ripple2">
              <?php
                $sql = "select * from `image_board_ripple` where parent='$num' ";
                $ripple_result = mysqli_query($con, $sql);
                while ($ripple_row = mysqli_fetch_array($ripple_result)) {
                  $ripple_num = $ripple_row['num'];
                  $ripple_id = $ripple_row['id'];
                  $ripple_nick = $ripple_row['nick'];
                  $ripple_date = $ripple_row['regist_day'];
                  $ripple_content = $ripple_row['content'];
                  $ripple_content = str_replace("\n", "<br>", $ripple_content);
                  $ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
              ?>
              <div id="ripple_title">
                <ul>
                  <li><?= $ripple_id . "&nbsp;&nbsp;" . $ripple_date ?></li>
                  <li id="mdi_del">
                    <?php
                      // 관리자모드 이거나, 부모글을 쓴 유저라면 삭제기능 부여
                      if ($_SESSION['user_id'] == "admin" || $_SESSION['user_id'] == $ripple_id) {
                        echo '
                          <form style="display:inline" action="imageboard_DUI.php" method="post">
                            <input type="hidden" name="page" value="'.$page.'">
                            <input type="hidden" name="hit" value="' . $hit . '">
                            <input type="hidden" name="mode" value="delete_ripple">
                            <input type="hidden" name="num" value="' . $ripple_num . '">
                            <input type="hidden" name="parent" value="' . $num . '">
                            <span>' . $ripple_content . '</span>
                            <input type="submit" value="삭제">
                          </form>';
                      }else {
                        echo '
                          <form style="display:inline" action=".php" method="post">
                            <input type="hidden" name="page" value="'.$page.'">
                            <input type="hidden" name="hit" value="' . $hit . '">
                            <input type="hidden" name="mode" value="delete_ripple">
                            <input type="hidden" name="num" value="' . $ripple_num . '">
                            <input type="hidden" name="parent" value="' . $num . '">
                            <span>' . $ripple_content . '</span>
                            <input type="submit" value="삭제">
                          </form>';
                      }
                    ?>
                  </li>
                </ul>
              </div>
              <?php
                }//end of while
                mysqli_close($con);
              ?>
              <form name="ripple_form" action="imageboard_DUI.php" method="post">
                <input type="hidden" name="mode" value="insert_ripple">
                <input type="hidden" name="parent" value="<?= $num ?>">
                <input type="hidden" name="hit" value="<?= $hit ?>">
                <input type="hidden" name="page" value="<?= $page ?>">
                <div id="ripple_insert">
                  <div id="ripple_textarea">
                    <textarea name="ripple_content" rows="3" cols="80"></textarea>
                  </div>
                  <div id="ripple_button">
                    <button>입력</button>
                  </div>
                </div><!--end of ripple_insert -->
              </form>
            </div><!--end of ripple2  -->
          </div><!--end of ripple1  -->
        </div><!--end of ripple  -->
      </div>
    </div><!-- board_box -->
  </section>

  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/footer.php"?>
  </footer>
</body>
</html>