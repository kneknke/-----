<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
    <?php
    session_start();
    
    setcookie('menu','1','0','/');
    
    include("connect.php");
    $con = dbconn();
    
    $story=$_POST['story'];
    $title=$_POST['title'];
    $user_id = $_SESSION['user_id'];
    
    if(empty($title)) {
        Error("제목을 입력하여 주세요.");
        check_no_write();
    }
    if(empty($story)) {
        Error("내용을 입력하여 주세요.");
    }
    
    //쿼리전송
    $query= "INSERT INTO board(user_id, title, story) VALUES('{$user_id}', '{$title}', '{$story}')";

    mysqli_query($con, $query);

    mysqli_close($con); //끝내기
    
    echo "<script>alert(\"글이 정상적으로 등록되었습니다.\"); history.back(1);</script>";

?>
</body>

</html>
