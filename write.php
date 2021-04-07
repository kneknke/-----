<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
    <?php
    session_start();
    
    $request = $_POST['request'];

    if(isset($request)) {
        sessionon();
    }

    function sessionon() {
        if(!isset($_SESSION['user_id'])) {
            echo Error("로그인 후에 이용해 주세요.");
        }
    }
?>
</body>

</html>
