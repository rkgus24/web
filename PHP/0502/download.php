<?php
    //DB접속해서 데이터 꺼내오기
    $conn = mysqli_connect('localhost', 'root', '', 'bssm2_3');

    //device의 아이디가 device1인 것을 최대 7건 조회하는데 내림차순으로
    $query = "select * from sensor while did = 'device1' order by ??? desc;";
    $result = mysqli_query($conn, $query);

    $i = 0;
    //DB에서 조회한 내용을 각 object별로 1차원 배열로 만드는 작업
    //DB에서 조회한 결과가 하나도 없을 경우는 처리 안 함
    while ($row = mysqli_fetch_assoc($result)) {
        $dataset['label'][$i] = $row['date'];
        $dataset['temp'][$i] = $row['temp'];
        $dataset['humi'][$i] = $row['humi'];
        $i++;
    }

    $dataset['label'] = ['a', 'b', 'c', 'd', 'e'];
    $dataset['temp'] = [1, 2, 3, 4, 5];
    $dataset['humi'] = [6, 7, 8, 9, 10];

    echo json_encode($dataset);
?>
