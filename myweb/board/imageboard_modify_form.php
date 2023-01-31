<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>MusicTicket</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/board.css">
  <script>
  function check_input() {
    if (!document.imageboard_modify_form.subject.value) {
      alert("제목을 입력하세요!");
      document.imageboard_modify_form.subject.focus();
      return;
    }
    if (!document.imageboard_modify_form.content.value) {
      alert("내용을 입력하세요!");
      document.imageboard_modify_form.content.focus();
      return;
    }
    document.imageboard_modify_form.submit();
  }
  </script>
</head>

<body>
  <header>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/sub_header.php"?>
  </header>
  <section>
    <div class="board_box">
      <h3 class="modify_title">수정</h3>

      <?php
        // 경고 메시지 
        function alert_back($message){
          echo("
              <script>
              alert('$message');
              history.go(-1)
              </script>
          ");
        }
        if (!$user_id) {
          echo("<script>
              alert('로그인 후 이용해주세요!');
              history.go(-1);
              </script>
            ");
            exit;
        }
 
        include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php"; 
        if (isset($_POST["mode"]) && $_POST["mode"] === "modify") {
          $num = $_POST["num"];
          $page = $_POST["page"];

          $sql = "select * from image_board where num=$num";
          $result = mysqli_query($con, $sql);
          $row = mysqli_fetch_array($result);

          $writer = $row["id"];
          // 세션값이 없거나 또는 사용자가 해당글의 사용자가 아니고 관리자도 아닐때
          if (!isset($user_id) || ($user_id !== $writer && $user_level !== '1')) {
              alert_back('수정권한이 없습니다.');
              exit;
          }
          $nick = $row["nick"];
          $subject = $row["subject"];
          $content = $row["content"];
          $file_name = $row["file_name"];
          // var_dump($row);
          // exit; 
          if (empty($file_name)){
            $file_name = "없음";
          } 
        }
      ?>
      <!-- enctype="multipart/form-data" 이것을 하지 않으면 파일업로드 되지 않음 : 명심 -->
      <form class="modify_form" name="imageboard_modify_form" method="post" action="imageboard_DUI.php" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="modify">
        <input type="hidden" name="num" value=<?= $num ?>>
        <input type="hidden" name="page" value=<?= $page ?>>

        <ul class="modify_form">
          <li>
            <span class="num1">닉네임 : </span>
            <span class="num2"><?=$nick?></span>
          </li>
          <li class="modify_title2">
            <span class="num1">제목 : </span>
            <span class="num2"><input name="subject" type="text" value=<?= $subject ?>></span>
          </li>
          <li class="text_area">
            <div>
              <span class="num1">내용 : </span>
            </div>
            <span class="num2">
              <textarea name="content"><?= $content ?></textarea>
            </span>
          </li>
          <li>
            <span class="num1"> 첨부 파일</span>
            <span class="num2"><input type="file" name="upfile">
              <input type="checkbox" value="yes" name="file_delete">&nbsp;파일 삭제
              <br>현재 파일 : <?= $file_name ?>
            </span>
          </li>
        </ul>

        <div class="modify_btn">
          <button type="button" onclick="check_input()">수정</button>
          <button type="button" onclick="location.href='imageboard_list.php'">취소</button>
        </div>
      </form>
    </div> <!-- board_box -->
  </section>
</body>

</html>