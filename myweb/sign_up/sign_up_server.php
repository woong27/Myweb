<?php 
// 데이터 베이스 연결
include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";

// 전역변수 선언
$user_id = $user_nick = $pass1 = $pass2 = $email = $phone = "";

$regist_day = date("Y-m-d (H:i)");
//3. $_POST 방식 진행!
if(isset($_POST['user_id']) && isset($_POST['user_nick']) && 
isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['email']) && isset($_POST['phone'])){
    //4. 보안코딩 (validation 기능을 사용해도 된다 !)
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $user_nick = mysqli_real_escape_string($con, $_POST['user_nick']);
    $pass1 = mysqli_real_escape_string($con, $_POST['pass1']);
    $pass2 = mysqli_real_escape_string($con, $_POST['pass2']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);

    $user_info = "user_id={$user_id}&user_nick={$user_nick}";
    if(empty($user_id)){
        header("location: sign_up_form.php?error=아이디를 입력하세요&$user_info");
        exit();
    }else if(empty($user_nick)){
        header("location: sign_up_form.php?error=닉네임을 입력하세요&$user_info");
        exit();
    }else if(empty($pass1)){
        header("location: sign_up_form.php?error=패스워드를 입력하세요&$user_info");
        exit();
    }else if(empty($pass2)){
        header("location: sign_up_form.php?error=패스워드를 입력하세요&$user_info");
        exit();
    }else if(empty($email)){
        header("location: sign_up_form.php?error=이메일을 입력하세요&$user_info");
        exit();
    }else if(empty($phone)){
        header("location: sign_up_form.php?error=전화번호를 입력하세요&$user_info");
        exit();
    }else if($pass1 !== $pass2){
        header("location: sign_up_form.php?error=패스워드가 일치하지 않아요&$user_info");
        exit();
    }else {
        // 암호화 방법(password_hash, md5) 
        // 양방향암호, 복호화기능(md5 복호화 사이트)
        // password_hash : 단방향 암호: 복호화 불가능, 255자 사이즈를 잡아놓을것
        // $pass1 = md5($pass1);
        $pass1 = password_hash($pass1, PASSWORD_DEFAULT);

        // 데이터베이스 저장, 조회, 수정, 삭제
        // user_id, user_nick 비교해서 하나라도 맞는것이 해당되는 레코드를 가져와라

        $sql = "select * from members where id = '$user_id' or nick = '$user_nick' ";
        // mysqli_query($con, $sql_same) : For succecssful select queries it will
        $record_set = mysqli_query($con, $sql);
        //mysqli_num_rows($recod_set) 결과값에서 레코드 갯수를 구함.
        if(mysqli_num_rows($record_set) > 0){
            header("location: sign_up_form.php?error=아이디와 닉네임이 존재합니다.&$user_info");
            exit();
        }else{
            $sql_insert = "insert into members(id, nick, pass, phone, email, level, regist_day) values('$user_id', '$user_nick', '$pass1', '$phone', '$email', 2, '$regist_day')";
            $result = mysqli_query($con, $sql_insert);

            if($result){
                header("location: ../login/login_form.php?success=성공적으로가입완료");
                exit();
            }else {
                header("location: sign_up_form.php?error=가입에 실패했습니다&$user_info");
                exit();
            }
        }
    }
}else {
    header("location: sign_up_form.php?error=가입 할 수 없습니다.");
    exit();
}
?>