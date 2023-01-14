<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>MusicTicket</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/board.css">
  <script>
  function check_input() {
    if (!document.board_form.subject.value) {
      alert("제목을 입력하세요!");
      document.board_form.subject.focus();
      return;
    }
    if (!document.board_form.content.value) {
      alert("내용을 입력하세요!");
      document.board_form.content.focus();
      return;
    }
    document.board_form.submit();
  }
  </script>
</head>

<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/sub_header.php"?>
  </header>
  <section>
    <div class="board_box">
      <div>
        <h3 id="board_title">커뮤니티</h3>
      </div>
      <!-- enctype="multipart/form-data" 이것을 하지 않으면 파일업로드 되지 않음 : 명심 -->
    <div>
      <form name="imageboard_form" method="post" action="imageboard_dml.php" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="insert">
        <div class="board_form">
          <div>
            <span class="col1">이름 : </span>
            <span class="col2"><?=$user_nick?></span>
          </div>
          <li>
            <span class="col1">제목 : </span>
            <span class="col2"><input name="subject" type="text"></span>
          </li>
          <li id="text_area">
            <span class="col1">내용 : </span>
            <span class="col2">
              <textarea name="content"></textarea>
            </span>
          </li>
          <li>
            <span class="col1"> 첨부 파일</span>
            <span class="col2"><input type="file" name="upfile"></span>
          </li>
        </div>
        <ul class="buttons">
          <li><button type="button" onclick="check_input()">저장</button></li>
          <li><button type="button" onclick="location.href='imageboard_list.php'">목록</button></li>
        </ul>
      </form>
    </div>
    </div> <!-- board_box -->
  </section>
</body>

</html>