<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MusicTicket</title>
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/form.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/user_info.css">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/css/admin.css">
    <script src="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/js/login.js"></script>
    <script src="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/js/admin.js"></script>
    <script src="https://kit.fontawesome.com/dd24ff9acb.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/sub_header.php"?>
    </header>
    <div class="info_body">
        <nav class="main_nav">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/myinfo/info_nav_form.php"?>
        </nav>

        <section class="concert_section">
            <!-- form = action 으로 어디에 있는 서버(컨트롤러)와 연결할건지 설정
                        method 로 어떤방식으로 데이터를 보낼건지 설정
                        name 은 이 폼의 이름 
                        enctype 은 파일을 업로드하기위한 필수 코드이다 꼭 넣어줄것 -->
            <form action="http://<?= $_SERVER['HTTP_HOST']?>/Web_project/myweb/admin/admin_con_server.php" method="post" name="admin_con_form" enctype="multipart/form-data">
                <input type="hidden" name="mode" value="insert">
                <div class="concert_title">
                        <h1>관리자 공연등록</h1>
                </div>
                <div class="concert_body">
                    <div class="concert_menu">
                        <ul>
                            <li>제목</li>
                            <li>아티스트</li>
                            <li>장르</li>
                            <li>장소</li>
                            <li>진행날짜</li>
                            <li>가격</li>
                            <li>소개</li>
                            <li class="image">이미지 첨부</li>
                        </ul>
                    </div>
                    <div class="input_menu">
                        <ul>
                            <li><input type="text" name="title" placeholder="Title"></li>
                            <li><input type="text" name="artist" placeholder="Artist"></li>
                            <li>
                                <select name="genre">
                                    <option value="JAZZ">JAZZ</option>
                                    <option value="POP">POP</option>
                                    <option value="HIPHOP">HIPHOP</option>
                                    <option value="ROCK">ROCK</option>
                                    <option value="R & B">R & B</option>
                                </select>
                            </li>
                            <li>
                                <select name="concerthall">
                                    <option value="예술의전당 음악당 콘서트홀">예술의전당 음악당 콘서트홀</option>
                                    <option value="성남아트센터 콘서트홀">성남아트센터 콘서트홀</option>
                                    <option value="갈갈이홀">갈갈이홀</option>
                                    <option value="브로드웨이아트홀 2관">브로드웨이아트홀 2관</option>
                                    <option value="서울역오픈콘서트홀">서울역오픈콘서트홀</option>
                                    <option value="예술의전당">예술의전당</option>
                                    <option value="롯데콘서트홀">롯데콘서트홀</option>
                                    <option value="예향콘서트홀">예향콘서트홀</option>
                                    <option value="씨드콘서트홀 수원점">씨드콘서트홀</option>
                                </select>
                            </li>
                            <div class="day_body">
                                <li><input type="date" name="start_day" max="2100-12-31" min="2023-01-01" value="2023-01-01"></li>
                                <li><input type="date" name="end_day" max="2100-12-31" min="2023-01-01" value="2023-01-01"></li>
                            </div>
                            <li><input type="text" name="price" placeholder="Price"></li>
                            <li><textarea name="content"></textarea></li>
                            <li><input type="file" name="upfile"></li>
                        </ul>
                    </div>
                </div>
                <div class="con_button">
                    <input class="concert_btn" type="button" value="Submit" onclick="check_input()">
                    <input class="concert_btn" type="button" value="Reset" onclick="reset_form()">
                </div>
            </form>
        </section>    
</body>
</html>