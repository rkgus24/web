<?php
    // 데이터베이스에 있는 내용을 (테이블로) 출력한다
    // DB에 접속한다
    $conn = mysqli_connect('localhost', 'root', '','test2_3');
    // 데이터를 꺼내오는 select 쿼리를 작성한다
    $query = "select * from test limit 20;"; // ⭐출력개수 limit 20 : 최대 20개만 출력하겠다
    // 쿼리를 실행한다
    $result = mysqli_query($conn, $query);
    // 결과를 출력한다
    echo "<table border=1 width=500>";
    echo "<tr><th>번호</th><th>온도</th><th>습도</th></tr>"; // ⭐변할 수도 있음
    // DB에서 꺼내온 데이터가 1건이 아니기 때문에 1레코드씩 조회해서 출력한다
    while($row = mysqli_fetch_assoc($result)){
        // $row 여러개의 데이터 중 1개의 레코드
        // $row['num'] $row['temp'] $row['humi'] ⭐필드명
        echo "<tr><td>".$row['num']."</td><td>".$row['temp']."</td><td>".$row['humi']."</td></tr>";
    }
    echo "</table>";
?>
