<?php
    include('../util/constant.php');
    include('../util/connect.php');
    include('../util/general.php');

    if (!isset($_POST['submit']))
        exit('Illegal call to this page.');
        
    $board_id = $_POST['board_id'];
    $board_id = addslashes($board_id);
    $user_id = $_SESSION['user_id'];
    $permission = getPermission($user_id, $board_id);

    if ($permission < USER)
        exit('Not enough permission.');

    $post_name = $_POST['title'];
    $post_name = addslashes($post_name);
    $content = $_POST['content'];
    $content = addslashes($content);
    $now = date('Y-m-d H:i:s', time());
    $query = "INSERT INTO post(user_id, board_id, post_name, create_time, content) ";
    $query .= "VALUES ('$user_id', '$board_id', '$post_name', '$now', '$content')";
    mysql_query($query) or die(mysql_error());
    $result = mysql_query('SELECT last_insert_id()');
    $post_id = mysql_fetch_array($result)['last_insert_id()'];
    header("location:post.php?post_id=$post_id");
?>
