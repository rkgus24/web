<?php
   $nun = $_POST['mynun'];
   $name = $_POST['myname'];
   $age = $_POST['myage'];
   $gender = $_POST['mygender'];
   $height = $_POST['myheight'];

   //MYSQL연결한다
     $conn = mysqli_connect('localhost', 'root', '','example1');
    //데이터를 update하는 SQL쿼리를 작성
    $query = "update teble1 set name='".$name."', age=".$age.", gender='".$gender."', height=".$height." where nun=".$nun.";";
    //SQL쿼리를 실행
    $result = mysqli_query($conn, $query);
    //실행결과 확인
    if($result){
     echo "성공";
    }else{
     echo "실패";
    }
?>
<meta http-equiv="refresh" content="0; url=input.php">