<?php
  //MYSQL연결한다
   $conn = mysqli_connect('localhost', 'root', '','bssm2_3');
   //데이터를 읽어오는 쿼리를 작성한다
   $query = "select * from device;";
   //쿼리를 실행한다
   $result = mysqli_query($conn, $query);
   //결과를 출력한다
 
   echo "<table border=1 width=500>"; 
      echo "<tr>";
    echo "<th>디바이스명</th>";
    echo "<th>센서종류</th>";
    echo "<th>설치위치</th>";
    echo "<th>설치날짜</th>";
    echo "</tr>";
   while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>".$row['did']."</td>";
    echo "<td>".$row['loc']."</td>";
    echo "<td>".$row['type']."</td>";
    echo "<td>".$row['date']."</td>";
    echo "</tr>";
  }

  echo "</table>";
   
?>

<form method=post action=device_process.php>
  다바이스명:<input type=text name=mydid><BR>
  설치장소:<input type=text name=myloc><BR>
  센서종류:<input type=text name=mytype><BR>
  <input type=submit value=확인>
</form>