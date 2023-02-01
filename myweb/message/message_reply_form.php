<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>MusicTicket</title>
<link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/message.css">

<script>
  function check_input() {
      if (!document.message_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.message_form.subject.focus();
          return;
      }
      if (!document.message_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.message_form.content.focus();
          return;
      }
      document.message_form.submit();
   }
</script>
</head>
<body> 
	<header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/sub_header.php"?>
    </header>
	<section>
		<div class="message_box">
			<h3 class="write_title">
					문의 답변
			</h3>
			<?php
				include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";
				$num = "";
				if(isset($_GET['num'])){
					$num = mysqli_real_escape_string($con, $_GET['num']);

					$sql = "select * from message where num=$num";
					$result = mysqli_query($con, $sql);

					$row = mysqli_fetch_array($result);
					$send_id = $row["send_id"];
					$rv_id = $row["rv_id"];
					$subject = $row["subject"];
					$content = $row["content"];

					$subject = "RE: ".$subject; 

					$content = "> ".$content; 
					$content = str_replace("\n", "\n>", $content);
					$content = "\n\n\n-----------------------------------------------\n".$content;

					$result2 = mysqli_query($con, "select nick from members where id='$send_id'");
					$record = mysqli_fetch_array($result2);
					$send_name    = $record["nick"];
				}
			?>		
			<form name="message_form" method="post" action="message_server.php">
				<input type="hidden" name="rv_id" value="<?=$send_id?>">
				<input type="hidden" name="send_id" value="<?=$user_id?>">
				<div class="write_msg">
					<ul class="write_menu">
						<li>보내는 사람 : </li>
						<li>수신 아이디 : </li>
						<li>제목 : </li>
						<li>글 내용 : </li>
					</ul>
					<ul class="write_contnet">
						<li class="no1"><?=$user_id?></li>
						<li class="no2"><?=$send_name?>(<?=$send_id?>)</li>
						<li class="no3"><input name="subject" type="text" value="<?=$subject?>"></li>
						<li class="no4"><textarea name="content"><?=$content?></textarea></li>
					</ul>
				</div>
				<div class="write_button">
					<button type="button" onclick="check_input()">보내기</button>
				</div>
			</form>
		</div> <!-- message_box -->
	</section>
	<footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/footer.php"?>
    </footer>
</body>
</html>
