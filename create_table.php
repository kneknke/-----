<?php

include("connect.php");
$con = dbconn();

$sql = "CREATE TABLE board
    (no int not null auto_increment,
    PRIMARY KEY(no),
    user_id char(15),
    title text,
    story text,
    hit int
    )";

mysqli_query($sql, $con);
if(!$sql)die("테이블 생성 실패.".mysqli_error());
elseif($sql) echo "테이블 정상 생성 완료.";
?>