<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="http://<?=$_SERVER['HTTP_HOST']?>/Web_project/myweb/css/ticket.css">
</head>
<body>
    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/sub_header.php"?>
    </header>
    <section>
        <div>
            <div class="ticket_body">
            <?php
                if (!$user_id) {
                    echo("<script>
                    alert('로그인 후 이용해주세요!');
                    history.go(-1);
                    </script>
                    ");
                    exit;
                }
                include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/db/db.php";
                $num = $_GET["num"];
                $page = $_GET["page"];
                $sql = "select * from concert_insert where num=$num";
                
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);

                $title = $row["title"];
                $artist = $row["artist"];
                $genre = $row["genre"];
                $content = $row["content"];
                $concerthall = $row["concerthall"];
                $price = $row["price"];
                $start_day = $row["start_day"];
                $end_day = $row["end_day"];
                $file_name = $row['file_name'];
                $file_copied = $row['file_copied'];
                $file_type = $row['file_type'];
                //이미지 정보를 가져오기 위한 함수 width, height, type
                if (!empty($file_name)) {
                    $image_info = getimagesize("../condata/" . $file_copied);
                    $image_width = $image_info[0];
                    $image_height = $image_info[1];
                    $image_type = $image_info[2];
                    $image_width = 200;
                    $image_height = 300;
                    if ($image_width > 200) $image_width = 200;
                }
            ?>
                <div class="view_img">
                    <?php 
                        if (strpos($file_type, "image") !== false) {
                            echo "<img src='../condata/$file_copied' width='$image_width'><br>";
                        } else if ($file_name) {
                            $real_name = $file_copied;
                            $file_path = "../condata/" . $real_name;
                            $file_size = filesize($file_path);
                        } 
                    ?>      
                </div>
                <div class="ticket_content">
                    <div class="ticket_top">
                        <h1><?= $title ?></h1>
                        <p><?= $content ?></p>
                    </div>
                    <table>
                    <tr>
                        <th class="item_one">공연기간 </th>
                        <td><?= $start_day. " ~ " .$end_day?></td>
                        <th class="item_two">아티스트 </th>
                        <td><?= $artist ?></td>
                    </tr>
                    <tr>
                        <th class="item_one">공연장 </th>
                        <td><?= $concerthall ?></td>
                        <th class="item_two">장르 </th>
                        <td><?= $genre ?></td>
                    </tr>
                    </table>
                </div>
            </div>

            <div class="ticket_button">
                <div>
                    <h1><span>전석 </span><?= $price ?>원</h1>
                </div>
                <div>
                    <button type="button" onclick="location.href='reservation_main.php?num=<?=$num?>&page=<?=$page?>'">예매하기</button>
                </div>
            </div>

            <div>
                <div class="ticket_end">
                    <ul class="end_menu">
                        <li>주최 / 기획</li>
                        <li>공연 관련 문의</li>
                        <li>예매 관련 문의</li>
                        <li>유효기간(이용조건)</li>
                        <li>취소 / 환불조건</li>
                    </ul>
                    <ul class="end_content">
                        <li>미래IT캠퍼스</li>
                        <li>010-1234-5678</li>
                        <li>1588-0000</li>
                        <li>예매한 공연 회차에 한해 이용가능</li>
                        <li>- 취소마감시간 이후 또는 관람일 당일 예매하신 건에 대해서는 취소/변경/환불이 불가합니다.</li>
                        <li>- 예매수수료는 예매 당일 밤 12시 이전까지 취소 시 환불 가능합니다.</li>
                        <li>- 배송이 시작된 경우 취소마감시간 이전까지 멜론티켓 고객센터로 티켓을 반환해주셔야 환불이 가능하며, 도착한 일자 기준으로 취소수수료가 부과됩니다.</li>
                        <li>- 예매취소 시점과 결제 시 사용하신 신용카드사의 환불 처리기준에 따라 취소금액의 환급방법과 환급일은 다소 차이가 있을 수 있습니다.</li>
                        <li>- 티켓 부분 취소 시 신용카드 할부 결제는 티켓 예매 시점으로 적용됩니다. (무이자할부 행사기간이 지날 경우 혜택 받지 못하실 수 있으니 유의하시기 바랍니다. )</li>
                        <li>- 취소일자에 따라 아래와 같이 취소수수료가 부과됩니다.</li>
                        <li>- 취소마감시간 이후 또는 관람일 당일 예매하신 건에 대해서는 취소/변경/환불이 불가합니다.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/Web_project/myweb/form/footer.php"?>
    </footer>
</body>
</html>