<?php
    session_start();

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";

    include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";

    $mode = $_GET["mode"];
    switch ($mode){
        case 'reser_delete': {
            $num = $_GET["num"];
            $sql = "delete from ticket_reservation where num = $num";

            mysqli_query($con, $sql);
            mysqli_close($con);     
            break;    
        }
    }
    header("location: admin_reser_form.php");
    exit();
?>

