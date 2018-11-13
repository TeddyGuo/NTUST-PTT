<?php
    include('../util/constant.php');
    include('../util/connect.php');
    include('../util/general.php');

    if (!isset($_POST['submit']))
        exit('Illegal call to this page.');
    if (!($_SESSION['default_permission'] >= ADMINISTRATOR))
        exit('Not enough permission.');
        
    $board_name = $_POST['board_name'];
    $board_name = addslashes($board_name);
    $query = "INSERT INTO board(board_name) VALUES ('$board_name')";
    mysql_query($query) or die(mysql_error());
    $last_page = $_SERVER["HTTP_REFERER"];
    header("location:$last_page");
?>