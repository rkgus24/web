<? php
    echo $_GET['nun'];
    $query = "delete into teble1(name, age, gender, height) values('".$name."', ".$age.", '".$gender."', ".$height.");"; 

    // SQL 쿼리를 실행
    $result = mysqli_query($conn, $query);
    
    // 실행결과 확인
    if($result){
        echo "성공";
    }else{
        echo "실패";
    }
?>
<meta http-equiv="refresh" content="0; url=input.php">
?>