<?php
    include('../util/constant.php');
    include('../util/connect.php');
    include('../util/general.php');

    if (!isset($_POST['submit']))
        exit('Illegal call to this page.');
    if (!($_SESSION['default_permission'] >= MODERATOR))
        exit('Not enough permission.');
        
    $user_id = $_SESSION['user_id'];
    $board_name = $_POST['board_name'];
    $board_name = addslashes($board_name);
    $board_name = $con->real_escape_string($board_name);
    $query = "INSERT INTO board(board_name, user_id) VALUES ('$board_name', '$user_id')";
    $con->query($query) or die($query . '<br/>' . $con->error);
    $last_page = $_SERVER["HTTP_REFERER"];
    header("Location: $last_page");
?>