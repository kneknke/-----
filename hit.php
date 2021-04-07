<?php
include("connect.php");
$con = dbconn();

$result = mysqli_query($con, "SELECT * FROM board");

$row = mysqli_fetch_assoc($result);

$hit = $row['hit'] + 1;

//쿼리전송
$query= "INSERT INTO board(hit) VALUES('{$hit}')";

mysqli_query($con, $query);

mysqli_close($con); //끝내기


?>