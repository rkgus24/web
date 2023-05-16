<?php
    // 사용자가 데이터베이스테 저장해놓은 값을 불러와서 아래에 대입한다
    // DB에 나의 esp32가 현재 전송하는 디바이스명과 일치하는 데이터를 조회한다
    // checked 필드 값이 1이면 이미 전송된 값이므로 0인 값을 조회한다
    // 가장 최근 데이터(=내림차순으로 정렬해라) 1건을 조회한다

    $did = $_GET['did']; // esp32의 디바이스명
    $query = "select * from control where did='".$did."' and checked=0 order by num desc limit 1;";

    // pin번호가 -1이면 제어할 값이 없는 상태
    $data['pin'] = 16; // esp32의 핀번호
    $data['cmd'] = 0; // 1이면 HIGH, 0이면 LOW
    //{"pin":16, "cmd":0}
    echo json_encode($data) . "\r\n";
?>
