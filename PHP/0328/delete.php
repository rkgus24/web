<?php
    echo $_GET['nun'];
    $conn = mysqli_connect('localhost', 'root', '','example1');
    $query = "delete from teble1 where nun=" . $_GET['nun'];
    $result = mysqli_query($conn, $query);  
    // 실행 결과 확인
    if($result){
        echo "성공";
    }else{
        echo "실패";
    }
?>
<meta http-equiv="refresh" content="0; url=input.php">
