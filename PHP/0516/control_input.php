<form method=post action=control_input_process.php>
<select name="did" > 
<?php
  //device table에 있는 디바이스명으로 드롭다운 메뉴를만든다
  $conn = mysqli_connect('localhost', 'root', '','bssm2_3');
  $query = "select * from device;";
  $result = mysqli_query($conn, $query);
  while($row = mysqli_fetch_assoc($result)){
    echo "<option value='".$row['did']."'>".$row['did']."</option>";
  }
?>
  </select><BR>
핀번호 : <input type=text name=pin><BR>
OFF<input type=radio name=cmd value=0 checked>
ON<input type=radio name=cmd value=1>
<input type=submit value=저장>
</form>