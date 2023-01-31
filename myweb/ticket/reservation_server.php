<?php 
// 데이터 베이스 연결
include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";

// 전역변수 선언
$title = $artist = $user_id = $user_nick = $phone = $email = $reser_day = $price = $card = "";

$regist_day = date("Y-m-d (H:i)");
// $_POST 방식 진행!
if(isset($_POST['title']) && isset($_POST['artist']) && 
isset($_POST['user_id']) && isset($_POST['user_nick']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['reser_day']) && isset($_POST['price']) && isset($_POST['card'])){
    //4. 보안코딩 (validation 기능을 사용해도 된다 !)
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $artist = mysqli_real_escape_string($con, $_POST['artist']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $user_nick = mysqli_real_escape_string($con, $_POST['user_nick']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $reser_day = mysqli_real_escape_string($con, $_POST['reser_day']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $card = mysqli_real_escape_string($con, $_POST['card']);
    
    $sql_insert = "insert into ticket_reservation(id, nick, phone, email, title, artist, reser_day, price, card, regist_day) values('$user_id', '$user_nick', '$phone', '$email', '$title', '$artist', '$reser_day', '$price', '$card', '$regist_day')";
    mysqli_query($con, $sql_insert);

    mysqli_close($con);

    if($result){
        header("location: reservation_form.php?success=성공적으로 예매완료");
        exit();
    }else {
        header("location: reservation_main.php?error=예매 실패했습니다");
        exit();
    }
}else {
    header("location: reservation_main.php?error=가입 할 수 없습니다.");
    exit();
}
?>