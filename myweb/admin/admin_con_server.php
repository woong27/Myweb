<?php
//db불러오기
include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";

session_start();

$title = $artist = $genre = $content = $concerthall = $start_day = $end_day = $price = "";

if(isset($_POST['title']) && isset($_POST['artist']) && isset($_POST['genre']) && isset($_POST['concerthall']) && isset($_POST['start_day']) && isset($_POST['end_day']) && isset($_POST['price']) && isset($_POST['content'])){

    $title = mysqli_real_escape_string($con, $_POST['title']);
    $artist = mysqli_real_escape_string($con, $_POST['artist']);
    $genre = mysqli_real_escape_string($con, $_POST['genre']);
    $content = mysqli_real_escape_string($con, $_POST['content']);
    $concerthall = mysqli_real_escape_string($con, $_POST['concerthall']);
    $start_day = mysqli_real_escape_string($con, $_POST['start_day']);
    $end_day = mysqli_real_escape_string($con, $_POST['end_day']);
    $price = mysqli_real_escape_string($con, $_POST['price']);

    $content = htmlspecialchars($content, ENT_QUOTES);
    if(isset($_POST["mode"]) && $_POST["mode"] === "insert"){
    
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

        if(mysqli_num_rows($result) === 0){
            header("location: admin_con_form.php?error=&등록된 공연입니다.");
            exit();
        }else {
            //$upload_dir 등록한 포스터를 저장하기 위한 폴더 경로설정
            $upload_dir = "../condata/";
            $upfile_name = $_FILES["upfile"]["name"];
            $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
            $upfile_type = $_FILES["upfile"]["type"];
            $upfile_size = $_FILES["upfile"]["size"];
            $upfile_error = $_FILES["upfile"]["error"];

            if ($upfile_name && !$upfile_error) { 
                $file = explode(".", $upfile_name); 
                $file_name = $file[0]; 
                $file_ext = $file[1]; 
        
                $new_file_name = date("Y_m_d_H_i_s");
                $new_file_name = $new_file_name . "_" . $file_name;
                $copied_file_name = $new_file_name . "." . $file_ext;
                $uploaded_file = $upload_dir . $copied_file_name;
                
                // 내가 설정한 파일 용량을 넘으면 에러가 뜨기때문에 if문 조건으로 스크립트 alert 방어함
                if ($upfile_size > 3000000) {
                    echo("
                    <script>
                    alert('업로드 파일 크기가 지정된 용량(3MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
                    history.go(-1)
                    </script>
                    ");
                    exit;
                }

                // 이것도 방어 대신 안에 들어간 move_uploaded_file함수는 PHP 함수이다
                if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
                    echo("
                    <script>
                    alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                    history.go(-1)
                    </script>
                    ");
                    exit;
                }
            } else {
                $upfile_name = "";
                $upfile_type = "";
                $copied_file_name = "";
            }

            // 여기서 쿼리문 실행 모든 컬럼 타입은 char 이다 
            $sql = "insert into concert_insert
            (num, title, artist, genre, content, concerthall, price, start_day, end_day, file_name, file_type, file_copied) values
            (null, '$title', '$artist', '$genre', '$content', '$concerthall', '$price', '$start_day', '$end_day', '$upfile_name', '$upfile_type', '$copied_file_name')";

            mysqli_query($con, $sql);

            mysqli_close($con);

        }
    }
    // 폼에서 submit 눌렀을때 위 코드가 모두 실행하고 마지막 등록이 완료됬을때 보여주는 화면을 경로설정 
    header("location: admin_con_form.php");
}
?>