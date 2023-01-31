<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";

	$num = $mode = "";

	if(isset($_GET['num']) && isset($_GET['mode'])){
		$num = mysqli_real_escape_string($con, $_GET['num']);
		$mode = mysqli_real_escape_string($con, $_GET['mode']);

		$sql = "delete from message where num=$num";

		mysqli_query($con, $sql);

		mysqli_close($con); // DB 연결 끊기

		if($mode == "send"){
			$url = "message_list.php?mode=send";
		}else{
			$url = "message_list.php?mode=rv";
		}
		
		echo "
		<script>
			location.href = '$url';
		</script>
		";
	}
?>