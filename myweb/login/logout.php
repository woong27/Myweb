<?php
  session_start();
  if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])){
    echo("
       <script>
          alert('비정상적인 접근입니다.');
          location.href = 'http://{$_SERVER['HTTP_HOST']}/Web_project/myweb/music_web.php';
      </script>
       ");
    exit;
  }
  unset($_SESSION["user_id"]);
  unset($_SESSION["user_nick"]);
  
  header("location: http://{$_SERVER['HTTP_HOST']}/Web_project/myweb/music_web.php");
  exit();
?>
