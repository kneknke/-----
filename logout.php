<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
<?php
    session_start();
    session_destroy();
?>
<script>
    window.alert('로그아웃 하였습니다.');
    history.back(1);
</script>
</body>
</html>