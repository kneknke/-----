<?php
include ("connect.php");
include ("index.php");
$con = dbconn();

if(empty($_GET['no']) === false ) {
    $sql = 'SELECT * FROM topic WHERE id='.$_GET['no'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo '<article><h2>'.$row['title'].'</h2></article>';
    echo $row['story'];
}

?>
