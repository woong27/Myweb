<?php
	//1. $_GET isset()
	//2. empty() 에러코딩 체크 경고창을 보여주고 되돌려준다. 
    //board_download.php  프라이머리키 num, 2023_01_10_10_08_10flower.png, flower, png
    $real_name = $_GET["real_name"];
    $file_name = $_GET["file_name"];
    $file_type = $_GET["file_type"];
    $file_path = "../data/".$real_name;

    //브라우저가 인터넷 익스플로러인지 체크함. $_SERVER['HTTP_USER_AGENT'] 속에 
    //MSIE 나 Internet Explorer 포함되었는지 확인함. 
    //strpos: $_SERVER['HTTP_USER_AGENT']속에 Trident/7.0 나 rv:11.0 포함되었는지 점검
    //인터넷 익스플로러는 이러한 문자열이 포함되어 있음. 
    $ie = preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || 
        (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0') !== false && 
            strpos($_SERVER['HTTP_USER_AGENT'], 'rv:11.0') !== false);

    //IE인경우 한글파일명이 깨지는 경우를 방지하기 위한 코드 
    //iconv('utf-8', 'euc-kr', $file_name): $file_name 의 utf-8문자셋을 euc-kr 문자셋으로 변경함 
    if( $ie ){
         $file_name = iconv('utf-8', 'euc-kr', $file_name);
    }
    //file_exists($file_path) 해당되는 파일이 존재하는지를 유무 
    if( file_exists($file_path) )
    { 
		$fp = fopen($file_path,"rb"); 
        //다운로드할 파일의정보를 Header() 함수로 클라이언트 브라우저에게 알려줌. 
		Header("Content-type: application/x-msdownload"); 
        Header("Content-Length: ".filesize($file_path));     
        Header("Content-Disposition: attachment; filename=".$file_name);   
        Header("Content-Transfer-Encoding: binary"); 
		Header("Content-Description: File Transfer"); 
        Header("Expires: 0");       
    } 
	//fpassthru($fp) 함수는  현재 파일 포인터가 지시하는 위치부터 끝까지 파일을
    //읽어 출력버퍼에 저장한다. 이렇게 함으로써 사용자의 컴퓨터로 파일이 전송된다. 
    //성공: 전송된 문자의 개수 변환, 실패하면:  false
    
    //fclose($fp) : 파일 포인터가 지시하는 파일을 닫는다.  성공: true, 실패: false
    if(!fpassthru($fp)){
	    fclose($fp); 
    }else{
	    fclose($fp); 
    } 
?>