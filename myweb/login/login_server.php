<?php 
session_start();
// 데이터베이스 연결 
include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";

// 전역변수 선언 !
$user_id = $pass = $user_info = "";

// $_POST 방식 진행!
if(isset($_POST['user_id']) && isset($_POST['pass'])){
    //4. 보안코딩 (validation 기능을 사용해도 된다 !)
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);

    $user_info = "id={$user_id}";
    if(empty($user_id)){
        header("location: login_form.php?error=아이디입력하세요&$user_info");
        exit();
    }else if(empty($pass)){
        header("location: login_form.php?error=패스워드입력하세요&$user_info");
        exit();
    }else {
        
        // password_verify()는 password_hash()로 암호화한 비밀번호가 사용자가 입력한 값과 같은지 확인하는
        // 함수입니다. 암호화된 문자열을 원래 문자열로 바꾸는 것이 아니고, 단지 같은지 다른지를 비교하여 TRUE 
        // 또는 FALSE를 반환합니다.

        $sql_same = "select * from members where id = '$user_id' ";
        // mysqli_query($con, $sql_same) : For succecssful select queries it will
        $record_set = mysqli_query($con, $sql_same);
        echo "<br><br><br>";
        //mysqli_num_rows($recod_set) 결과값에서 레코드 갯수를 구함.
        if(mysqli_num_rows($record_set) === 1){
            $row = mysqli_fetch_assoc($record_set);
            $hash_value = $row["pass"];

            //hash 값을 비교하기 위한 방법
            if(password_verify($pass, $hash_value)){
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["user_nick"] = $row["nick"];
                
                header("location: http://{$_SERVER['HTTP_HOST']}/Web_project/myweb/music_web.php");
                exit();
            }else {
                header("location: login_form.php?error=로그인 실패&$user_info");
                exit();
            }
        }else{
            header("location: login_form.php?error=아이디와 패스워드를 확인해주세요");
            exit();
        }

    }
}else {
    header("location: login_form.php?error=가입되지 않은 회원입니다.");
    exit();
}
?>