<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<?php

$user_id= $_POST['user_id'];
$name= $_POST['name'];
$pw= $_POST['pw'];
$memo= $_POST['memo'];
$regdate=date("YmdHis", time()); //날짜, 시간
$repw= $_POST['repw'];

include("password.php");
include("connect.php");
$con = dbconn();
    
setcookie('lg','2','0','/');

$hash = password_hash($pw,PASSWORD_DEFAULT);

if(empty($name)) {
    Error("닉네임을 입력하여 주세요.");
} elseif(strlen($name)<6 or strlen($name)>15) {
    Error("이름은 2자에서 5자까지만 허용됩니다.");
}

if(empty($user_id)) {
    Error("아이디를 입력하여 주세요.");
} elseif(substr($user_id,"10")){
    Error("회원 아이디는 10자 까지만 허용됩니다."); 
} elseif(preg_match("/[^a-z 0-9]/",$user_id)) {
    Error("아이디는 영소문자와 숫자만 가능합니다.");
}

if(empty($pw)) {
    Error("패스워드를 입력하여 주세요.");
}

if($pw !== $repw) {
    Error("본 패스워드와 확인 패스워드가 일치하지 않습니다.");
}

//쿼리전송
$query= "INSERT INTO test(user_id, name, pw, memo, regdate) VALUES('{$user_id}', '{$name}', '{$hash}', '{$memo}', '{$regdate}')";

mysqli_query($con, $query);

mysqli_close($con); //끝내기
    
setcookie('lg','0','0','/');

echo "<script>alert(\"회원가입이 정상적으로 완료되었습니다.\"); history.back(1);
</script>";

?>
</body>

</html>
