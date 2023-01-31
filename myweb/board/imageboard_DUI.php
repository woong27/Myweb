<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php"; 
    
    //경고 메시지 
    function alert_back($message){
        echo("
            <script>
            alert('$message');
            history.go(-1)
            </script>
        ");
    }
    
	function input_set($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

	session_start();
    $user_id = $user_level = $user_nick = "";

    if (isset($_SESSION["user_id"]) && isset($_SESSION["user_level"]) && isset($_SESSION["user_nick"])) {
        $user_id = $_SESSION["user_id"];
        $user_level = $_SESSION["user_level"];
        $user_nick = $_SESSION["user_nick"];
    }

	if (!$user_id ){
			echo("
        <script>
        alert('이미지게시판 글쓰기는 로그인 후 이용해 주세요!');
        history.go(-1)
        </script>
			");
      exit;
	}
  
    if (isset($_POST["mode"]) && $_POST["mode"] === "delete") {
        $num = $_POST["num"];
        $page = $_POST["page"];
        $sql = "select * from image_board where num = $num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $writer = $row["id"];

        if (!isset($user_id) || ($user_id !== $writer && $user_level !== '1')) {
            alert_back('삭제권한이 없습니다.');
            exit;
        }
        $copied_name = $row["file_copied"];

        if ($copied_name) {
            $file_path = "../data/" . $copied_name;
            unlink($file_path);
        }

        $sql = "delete from image_board where num = $num";
        mysqli_query($con, $sql);
        mysqli_close($con);
        echo "
        <script>
            location.href = 'imageboard_list.php?page=$page';
        </script>
        ";
    } else if (isset($_POST["mode"]) && $_POST["mode"] === "insert") {
        $subject = $_POST["subject"];
        $content = $_POST["content"];
        $subject = htmlspecialchars($subject, ENT_QUOTES);
        $content = htmlspecialchars($content, ENT_QUOTES);
        $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
        $upload_dir = "../data/";

        $upfile_name = $_FILES["upfile"]["name"];
        $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
        $upfile_type = $_FILES["upfile"]["type"];
        $upfile_size = $_FILES["upfile"]["size"];  // 안되면 php init 에서 최대 크기 수정!
        $upfile_error = $_FILES["upfile"]["error"];

        if ($upfile_name && !$upfile_error) { // 업로드가 잘되었는지 판단
        $file = explode(".", $upfile_name); 
        $file_name = $file[0]; //(memo)
        $file_ext = $file[1]; //(sql)

        $new_file_name = date("Y_m_d_H_i_s");
        $new_file_name = $new_file_name . "_" . $file_name;
        $copied_file_name = $new_file_name . "." . $file_ext;
        $uploaded_file = $upload_dir . $copied_file_name;

            if ($upfile_size > 3000000) {
                echo("
                <script>
                alert('업로드 파일 크기가 지정된 용량(3MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
                history.go(-1)
                </script>
                ");
                exit;
            }

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

        $sql = "insert into image_board (id, nick, subject, content, regist_day, hit,  file_name, file_type, file_copied) ";
        $sql .= "values('$user_id', '$user_nick', '$subject', '$content', '$regist_day', 0, ";
        $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
        mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

        mysqli_close($con);                // DB 연결 끊기

        echo "
        <script>
            location.href = 'imageboard_list.php';
        </script>
        ";
    }else if (isset($_POST["mode"]) && $_POST["mode"] === "modify"){
        
        $num = $_POST["num"];
        $page = $_POST["page"];

        $subject = $_POST["subject"];
        $content = $_POST["content"];
        $file_delete = (isset($_POST["file_delete"])) ? $_POST["file_delete"] : 'no';

        $sql = "select * from image_board where num = $num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        $copied_name = $row["file_copied"];
        $upfile_name = $row["file_name"];
        $upfile_type = $row["file_type"];
        $copied_file_name = $row["file_copied"];

        //체크박스가 되어있으면 기존의 파일삭제
        if($file_delete === "yes"){
            if ($copied_name) {
                $file_path = "../data/" . $copied_name;
                unlink($file_path);
            }

            $upfile_name = "";
            $upfile_type = "";
            $copied_file_name = "";
            $copied_name = "";
        }else{
            //새로운파일이 존재하면 기존파일삭제후 저장
            if (isset($_FILES["upfile"])) {
                //기존파일삭제
                // if ($copied_name) {
                //     $file_path = "../data/" . $copied_name;
                //     unlink($file_path);
                // } 
                // 새로운 정보를 가져옴
                $upload_dir = "../data/";
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

                    if ($upfile_size > 3000000) {
                        echo("
                        <script>
                        alert('업로드 파일 크기가 지정된 용량(3MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
                        history.go(-1)
                        </script>
                        ");
                        exit;
                    }
                    if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
                        echo("
                        <script>
                        alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                        history.go(-1)
                        </script>
                    ");
                        exit;
                    }
                    
                }else{
                    $upfile_name = $row["file_name"];
                    $upfile_type = $row["file_type"];
                    $copied_file_name = $row["file_copied"];
                }
            }
        }
        $sql = "update image_board set subject='$subject', content='$content',  file_name='$upfile_name', file_type='$upfile_type', file_copied= '$copied_file_name' where num=$num";

        // var_dump($sql);
        // exit();

        mysqli_query($con, $sql);
        mysqli_close($con);

        echo "
        <script>
            location.href = 'imageboard_list.php?page=$page';
        </script>
        ";
    }else if (isset($_POST["mode"]) && $_POST["mode"] == "insert_ripple") {
        if (empty($_POST["ripple_content"])) {
            echo "<script>alert('내용입력요망!');history.go(-1);</script>";
            exit;
        }
        //"덧글을 다는사람은 로그인을 해야한다." 말한것.
        $q_userid = mysqli_real_escape_string($con, $user_id);
        $sql = "select * from members where id = '$q_userid'";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            die('Error: ' . mysqli_error($con));
        }
        $rowcount = mysqli_num_rows($result);
    
        if (!$rowcount) {
            echo "<script>alert('없는 아이디!!');history.go(-1);</script>";
            exit;
        } else {
            $content = input_set($_POST["ripple_content"]);
            $page = input_set($_POST["page"]);
            $parent = input_set($_POST["parent"]);
            $hit = input_set($_POST["hit"]);
            $q_usernick = isset($_SESSION['user_nick']) ? mysqli_real_escape_string($con, $_SESSION['user_nick']) : null;
            $q_content = mysqli_real_escape_string($con, $content);
            $q_parent = mysqli_real_escape_string($con, $parent);
            $regist_day = date("Y-m-d (H:i)");

            $sql = "INSERT INTO `image_board_ripple` VALUES (null,'$q_parent','$q_userid', '$q_usernick','$q_content','$regist_day')";
            $result = mysqli_query($con, $sql);
            if (!$result) {
                die('Error: ' . mysqli_error($con));
            }
            mysqli_close($con);
            echo "
            <script>
            location.href='./imageboard_view.php?num=$parent&page=$page&hit=$hit';
            </script>
            ";
        }//end of if rowcount
    } else if (isset($_POST["mode"]) && $_POST["mode"] == "delete_ripple") {
        $page = input_set($_POST["page"]);
        $hit = input_set($_POST["hit"]);
        $num = input_set($_POST["num"]);
        $parent = input_set($_POST["parent"]);
        $q_num = mysqli_real_escape_string($con, $num);

        $sql = "DELETE FROM `image_board_ripple` WHERE num=$q_num";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            die('Error: ' . mysqli_error($con));
        }
        mysqli_close($con);
        echo "
        <script>
        location.href='./imageboard_view.php?num=$parent&page=$page&hit=$hit';</script>";
    }
?>