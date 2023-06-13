<?php
    //  esp32에서 온습도센서 값을 받아서 DB에 저장하는 페이지
    $temp = $_GET['temp']; // ⭐$temp : php 변수, $_GET['temp']에서의 temp : esp32가 업로드 하는 온도값의 key값
    $humi = $_GET['humi']; // ⭐$humi : php 변수, $_GET['humi']에서의 humi : esp32가 업로드 하는 습도값의 key값
    // 데이터베이스 접속
                                                 // ⭐DB이름
    $conn = mysqli_connect('localhost', 'root', '','test2_3');
                // ⭐ test: table 이름
                // ⭐ temp : 온도 필드명
                // ⭐ humi : 습도 필드명
    $query = "insert into test(temp, humi) values(".$temp.", ".$humi.");";
    // 작성된 쿼리를 실행한다
    $result = mysqli_query($conn, $query);
    if($result) {
        echo "성공";
    } else {
        echo "실패";
    }
?>
