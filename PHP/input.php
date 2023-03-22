<?php
        // MYSQL을 연결한다.
        $conn = mysqli_connect('localhost', 'root', '', 'example1');

        // 데이터를 읽어오는 쿼리를 작성한다.
        $query = "select *from teble1;";
        
        // 쿼리를 실행한다.
        $result = mysqli_query($conn, $query);
        
        // 결과를 출력한다.
        echo "<table border=1 width=500>";
            echo "<tr>";
                echo "<th>번호</th>";
                echo "<th>이름</th>";
                echo "<th>나이</th>";
                echo "<th>성별</th>";
                echo "<th>키</th>";
                echo "<th>삭제</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
        echo "<tr>";
            echo "<td>" . $row['nun'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['age'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['height'] . "</td>";
            echo "<td><a href=delete.php?nun=".$row['nun'].">[삭제]</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>

    <form method=post action=test2.php>
        이름: <input type=text name=myname><br>
        나이: <input type=text name=myage><br>
        성별: <input type=text name=mygender><br>
        키: <input type=text name=myheight><br>
        <input type=submit value=확인>
    </form>


        <tr>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
        </tr>
    </table>