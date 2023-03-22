<?php
    $name = "정빈박";
    $age = 65;
    $gender = "여자";
    $height = "300.02";

    // MYSQL 연결
    $conn = mysqli_connect('localhost', 'root', '', 'example1');

    // 데이터를 insert하는 SQL 쿼리를 작성
    $query = "insert into teble1(name, age, gender, height) values('".$name."', ".$age.", '".$gender."', ".$height.");"; 

    // SQL 쿼리를 실행
    $result = mysqli_query($conn, $query);
    
    // 실행결과 확인
    if($result){
        echo "성공";
    }else{
        echo "실패";
    }
?>