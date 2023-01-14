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
  <section class="board_section">
      <!-- enctype="multipart/form-data" 이것을 하지 않으면 파일업로드 되지 않음 : 명심 -->
      <form name="imageboard_form" method="post" action="imageboard_dml.php" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="insert">
        <div class="board_body">
          <div class="nickname">
            <p>작성자 : <?=$user_nick?></p>
          </div>
          <div class="input_title">
            <p>제목</p>
            <input name="subject" type="text">
          </div>
          <div class="input_content">
            <p>내용</p>
            <textarea name="content"></textarea>
          </div>
          <div class="input_phoot">
            <input type="file" name="upfile">
          </div>
          <div class="buttons">
            <button type="button" onclick="check_input()">등록</button>
            <button type="button" onclick="location.href='imageboard_list.php'">취소</button>
          </div>
        </div>
      </form>
  </section>
</body>

</html>