<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
    <?php 
ob_start;
session_start();

include("connect.php");
$con = dbconn();
    
setcookie('lg','1','0','/');

$user_id = $_POST['user_id'];
$pw = $_POST['pw'];

// 정보 데이터 가져오기
$query = "SELECT * FROM user_inf where user_id = '$user_id'";
$result= mysqli_query($con, $query);
$member= mysqli_fetch_array($result);

if(empty($user_id)){
    Error("아이디를 입력하여 주세요.");
}elseif(!$member['user_id']) {
    Error("존재하지 않는 회원 아이디 입니다.");
} 

if(empty($pw)) {
    Error("비밀번호를 입력해주세요.");
}elseif(!password_verify($pw,$member['pw'])) {
    Error("비밀번호가 일치하지 않습니다.");
} 

$_SESSION['user_id'] = $user_id;
$_SESSION['name'] = $member['name'];
    
setcookie('lg','0','0','/');


?>
    <script>
        window.alert('로그인에 성공하였습니다.');
        history.back(1);

    </script>
</body>

</html>
