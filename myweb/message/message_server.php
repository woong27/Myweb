<?php 
include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";


$send_id = $rv_id = $subject = $content = "";

if(isset($_POST['send_id']) && isset($_POST['rv_id']) && isset($_POST['subject']) && isset($_POST['content'])){
    $send_id = mysqli_real_escape_string($con, $_POST['send_id']);
    $rv_id = mysqli_real_escape_string($con, $_POST['rv_id']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $content = mysqli_real_escape_string($con, $_POST['content']);

    // html tag 구조는 entity code 변환시켜줌 (trim, stripslashes 기능을 뺴버리는것이 맞다)
    // ENT_QUOTES : '' (홀따옴표) 와 ""(겹따옴표) 둘다 변환
    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);

    $regist_day = date("Y-m-d (H:i)");

    if(!$send_id){
        echo ("<script>
        alert('로그인 후 이용해주세요! ');
        history.go(-1);
        </script>");
        exit;
    }

    $sql = "select * from members where id='$rv_id'";

    $result = mysqli_query($con, $sql);

    $num_record = mysqli_num_rows($result);

    if($num_record == 1){
        $sql = "insert into message (send_id, rv_id, subject, content, regist_day) values('$send_id','$rv_id','$subject','$content', '$regist_day')";
        mysqli_query($con, $sql); //$sql 에 저장된 명령 실행
    }else {
        echo ("<script>
        alert('수신 아이디가 잘못 되었습니다!');
        history.go(-1);
        </script>");
        exit();
    }

    mysqli_close($con);

    if($user_level !== '1'){
        echo "
            <script>
                location.href = 'message_list.php?mode=send';
            </script>
	    ";
    }else {
        echo "
            <script>
                location.href = 'message_list.php?mode=rv';
            </script>
	    ";
    }

    var_dump($user_level);
    exit();

    
}

?>