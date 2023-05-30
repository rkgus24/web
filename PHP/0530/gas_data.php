<?php
   //DB에 접속한다
   $conn = mysqli_connect('localhost', 'root', '','bssm2_3');
   //gas테이블에 가장 최근 1건을 읽어온다
     $query = "select * from gas order by num desc limit 1;";
     $result = mysqli_query($conn, $query);
     $count = mysqli_num_rows($result);

   //결과가 row에 들어있다
   
   //테이블에 출력한다
   if($count == 1) {
   $row = mysqli_fetch_assoc($result);
   // $row['num'] $row['gas'] $row['cds'] $row['date']
   }

   // DB의 결과물을 JSON으로 인코딩하여 response 하겠다
   echo json_encode($row);
?>
