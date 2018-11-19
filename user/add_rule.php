<?php
    include('../util/constant.php');
    include('../util/connect.php');
    include('../util/general.php');

    if (!isset($_POST['submit']))
        exit('Illegal call to this page.');
    if ($_SESSION['default_permission'] < MODERATOR)
        exit('Not enough permission.');

    $user_id = $_POST['user_id'];
    $user_id = addslashes($user_id);
    $board_id = $_POST['board_id'];
    $board_id = addslashes($board_id);
    $permission = $_POST['permission'];
    $permission = addslashes($permission);
    $query = "INSERT INTO rule VALUES('$user_id', '$board_id', '$permission') ";
    $con->query($query) or die($query . '<br/>' . $con->error);
    $last_page = $_SERVER["HTTP_REFERER"];
    header("Location: $last_page");
?>