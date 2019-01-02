<?php
    include('../util/constant.php');
    include('../util/connect.php');
    include('../util/general.php');
    
    if (!isset($_POST['submit']))
        exit('Illegal call to this page.');
        
    $post_id = $_POST['post_id'];
    $post_id = addslashes($post_id);
    $board_id = getBoardId($post_id);
    $user_id = $_SESSION['user_id'];
    $permission = getPermission($user_id, $board_id);
    if ($permission < USER)
        exit('Not enough permission.');
        
    $content = $_POST['content'];
    $content = addslashes($content);
    $content = mysql_real_escape_string($content);
    $img = $_POST['img'];
    $img = addslashes($img);
    $img = mysql_real_escape_string($img);
    $now = date('Y-m-d H:i:s', time());
    $query = "INSERT INTO post_reply(user_id, post_id, create_time, content, img) ";
    $query .= "VALUES ('$user_id', '$post_id', '$now', '$content', '$img')";
    $con->query($query) or die($query . '<br/>' . $con->error);
    $query = "UPDATE post SET last_update = '$now' WHERE post_id = '$post_id'";
    $con->query($query) or die($query . '<br/>' . $con->error);
    header("Location: post.php?post_id=$post_id");
?>