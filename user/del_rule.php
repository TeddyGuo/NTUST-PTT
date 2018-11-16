<?php
    include('../util/constant.php');
    include('../util/connect.php');
    include('../util/general.php');

    if ($_SESSION['default_permission'] < MODERATOR)
        exit('Not enough permission.');

    $user_id = $_GET['user_id'];
    $user_id = addslashes($user_id);
    $board_id = $_GET['board_id'];
    $board_id = addslashes($board_id);
        
    $query = "DELETE FROM rule WHERE (user_id = '$user_id' and board_id = '$board_id')";
    $con->query($query) or die($query . '<br/>' . $con->error);
    $last_page = $_SERVER["HTTP_REFERER"];
    header("location:$last_page");
?>