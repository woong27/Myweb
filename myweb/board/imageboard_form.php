<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>MusicTicket</title>
  <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/board.css">
  <script>
  function check_input() {
    if (!document.imageboard_form.subject.value) {
      alert("제목을 입력하세요!");
      document.imageboard_form.subject.focus();
      return;
    }
    if (!document.imageboard_form.content.value) {
      alert("내용을 입력하세요!");
      document.imageboard_form.content.focus();
      return;
    }
    document.imageboard_form.submit();
  }
  </script>
</head>

<body>
  <header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/sub_header.php"?>
  </header>
  <section class="board_section">
      <!-- enctype="multipart/form-data" 이것을 하지 않으면 파일업로드 되지 않음 : 명심 -->
      <form name="imageboard_form" method="post" action="imageboard_DUI.php" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="insert">
        <p class="board_title">COMMUNITY</p>
        <div class="board_body">
          <div class="board_menu">
            <p class="menu nick">작성자</p>
            <p class="menu title">제목(필수)</p>
            <p class="menu content">내용(필수)</p>
            <p class="menu file">첨부파일</p>
          </div>
          <div class="board_content">
            <p class="main nick"><?=$user_nick?></p>
            <p class="main title"><input name="subject" type="text"></p>
            <p class="main content"><textarea name="content"></textarea></p>
            <p class="main file"><input type="file" name="upfile"></p>
          </div>
        </div>
        <div class="board_button">
          <button type="button" onclick="location.href='imageboard_list.php'">취소</button>
          <button type="button" onclick="check_input()">작성</button>
        </div>
      </form>
  </section>
  <footer>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/footer.php"?>
  </footer>
</body>

</html>