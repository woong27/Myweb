<?php
    session_start();
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
    $user_nick = isset($_SESSION['user_nick']) ? $_SESSION['user_nick'] : "";
    $user_level = isset($_SESSION['user_level']) ? $_SESSION['user_level'] : "";
 
    if ( $user_level !== '1' ) {
        echo("
            <script>
            alert('관리자가 아닙니다! 회원정보 수정은 관리자만 가능합니다!');
            history.go(-1)
            </script>
        ");
        exit;
    }

    include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";

    $mode = $_GET["mode"];
    switch ($mode){
        case 'update': {
            $num = mysqli_real_escape_string($con, $_POST['num']);
            $user_nick = mysqli_real_escape_string($con, $_POST['user_nick']);
            $sql = "update members set nick='$user_nick' where num=$num";

            mysqli_query($con, $sql);
            mysqli_close($con);

            echo "
                <script>
                    location.href = 'admin.php';
                </script>
            ";
        }
        case 'delete': {
            $num   = $_GET["num"];
            $sql = "delete from members where num = $num";

            mysqli_query($con, $sql);
            mysqli_close($con);
        }
        case 'board_delete': {
            $num_item = 0;
        
            if (isset($_POST["item"])){
                $num_item = count($_POST["item"]); 
            }else{
                echo("
                    <script>
                    alert('삭제할 게시글을 선택해주세요!');
                    history.go(-1)
                    </script>
                ");
            }

            for($i=0; $i<$num_item ; $i++){
                $num = $_POST["item"][$i];

                $sql = "select * from image_board where num = $num";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);

                $copied_name = $row["file_copied"];

                if ($copied_name) {
                    $file_path = "../data/".$copied_name;
                    unlink($file_path);
                }

                $sql = "delete from image_board where num = $num";
                mysqli_query($con, $sql);
            }
            mysqli_close($con);
        }

        case 'concert_delete': {
            $num_item2 = 0;
        
            if (isset($_POST["item2"])){
                $num_item2 = count($_POST["item2"]); 
            }else{
                echo("
                    <script>
                    alert('삭제할 게시글을 선택해주세요!');
                    history.go(-1)
                    </script>
                ");
            }

            for($i=0; $i<$num_item2 ; $i++){
                $num = $_POST["item2"][$i];

                $sql = "select * from concert_insert where num = $num";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);

                $copied_name = $row["file_copied"];

                if ($copied_name) {
                    $file_path = "../data/".$copied_name;
                    unlink($file_path);
                }

                $sql = "delete from concert_insert where num = $num";
                mysqli_query($con, $sql);
            }
            mysqli_close($con);
        }
        case 'reser_delete': {
            $num   = $_GET["num"];
            $sql = "delete from ticket_reservation where num = $num";

            mysqli_query($con, $sql);
            mysqli_close($con);
            header("location: admin_reser_form.php");
            exit();
        }
    }
    header("location: admin.php");
    exit();
?>

