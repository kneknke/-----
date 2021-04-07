<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
    <?php
    function dbconn(){
        $host_name="localhost";
        $db_user_id="root";
        $db_pw="kimdongho99";
        $db_name="userinfo";
        $con =  new mysqli ("$host_name","$db_user_id","$db_pw","$db_name");
        if($con -> connect_error){
            die("연결에 실패 하였습니다1.". $con -> connect_error);
        }
        return $con;
    }
    
    function dbconn2(){
        $host_name="localhost";
        $db_user_id="root";
        $db_pw="kimdongho99";
        $db_name="userinfo";
        $con2 =  new mysqli ("$host_name","$db_user_id","$db_pw","$db_name");
        if($con2 -> connect_error){
            die("연결에 실패 하였습니다2.". $con2 -> connect_error);
        }
        return $con2;
    }

    function Error($msg){
        echo "
            <script>
                window.alert('$msg');
                history.back(1);
            </script>
        ";
        exit;
    }

?>
</body>

</html>
