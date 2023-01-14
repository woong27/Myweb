<?php
    session_start();
    
    include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";
    $user_id = $user_nick = $pass1 = $pass2 = $phone = $email = "";

    if(isset($_POST['user_id']) && isset($_POST['user_nick']) && isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['phone']) && isset($_POST['email'])){
        $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
        $user_nick = mysqli_real_escape_string($con, $_POST['user_nick']);
        $pass1 = mysqli_real_escape_string($con, $_POST['pass1']);
        $pass2 = mysqli_real_escape_string($con, $_POST['pass2']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
    
        $user_info = "nick={$user_nick}";
        if(empty($user_nick)){
            header("location: info_modify_form.php?error=아이디 입력하세요&$user_info");
            exit();
        }else if(empty($pass1)){
            header("location: info_modify_form.php?error=패스워드 입력하세요&$user_info");
            exit();
        }else if(empty($pass2)){
            header("location: info_modify_form.php?error=패스워드 입력하세요&$user_info");
            exit();
        }else if(empty($phone)){
            header("location: info_modify_form.php?error=전화번호를 입력하세요&$user_info");
            exit();
        }else if(empty($email)){
            header("location: info_modify_form.php?error=이메일 입력하세요&$user_info");
            exit();
        }else {
            $pass = password_hash($pass1, PASSWORD_DEFAULT);
            
            
            $sql = "update members set nick='$user_nick', pass='$pass', phone='$phone' , email='$email' where id='$user_id' ";
            $result = mysqli_query($con, $sql);
            mysqli_close($con); 
            if(!$result){
                header("location info_modify_form.php?error=수정 실패&$user_info");
                exit();
            }else{
                header("location: info_check.php");
                exit();
            }
            header("location info_check.php");
            exit();
        }     
    }     

    
?>

   
