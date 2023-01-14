<?php
    // 데이터베이스 include
    include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";
    // 전역변수 선언 한줄
    $message = $user_id = "";
    
    // $_POST isset() 진행한다.
    // 보안코딩
    if(isset($_POST['message']) && isset($_POST['user_id'])){
            $message = mysqli_real_escape_string($con, $_POST['message']);
            $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    }

    $user_id = $_GET["user_id"];

    if(!$user_id) {
        $message= "<li>아이디를 입력해 주세요!</li>";
    }else{
        $sql = "select * from members where id='$user_id'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) == 1)
        {
            $message = "<li>".$user_id." 아이디는 중복됩니다.</li>";
            $message .= "<li>다른 아이디를 사용해 주세요!</li>";
        }
        else
        {
            $message = "<li>".$user_id." 아이디는 사용 가능합니다.</li>";
        }
        mysqli_close($con);
    }
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<style>
h3 {
   padding-left: 5px;
   border-left: solid 5px #edbf07;
}
#close {
   margin:100px 0 0 170px;
}

#close input {
    background: red;
    padding: 5px 20px;
}
</style>
</head>
<body>
<h3>아이디 중복체크</h3>
<p><?php echo $message;?></p>
<div id="close">
   <!-- javascript:self.close() = 자기창을 닫게한다 -->
   <input type="button" value="닫기" onclick="javascript:self.close()"></input>
</div>
</body>
</html>

