<?php
data_defalut_timezone_set('Asia/Seoul');
$gas = $_GET['gas'];
$cds = $_GET['cds'];
$date = date("Y-m-d H:i:s",time());

//MYSQL연결한다
$conn = mysqli_connect('localhost', 'root', '','bssm2_3');
// 데이터를 insert하는 sql 쿼리 작성
$query = "insert into gas(gas, cds, date) values(".$gas.", ".$cds.", '".$date."');";
// sql 쿼리 실행
$result = mysqli_query($conn, $query);
// 실행결과 확인
if($result) {
echo "성공";
} 
else {
echo "실패";
}
?>
