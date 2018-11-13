<?php
    include('../util/constant.php');
    include('../util/connect.php');
    include('../util/general.php');
    
    $post_id = $_GET['post_id'];
    $post_id = addslashes($post_id);
    $query = "SELECT * FROM post WHERE post_id = '$post_id'";
    $result = mysql_query($query) or die(mysql_error());
    $result = mysql_fetch_array($result);
    $board_id = $result['board_id'];
    $author_id = $result['user_id'];
    $user_id = $_SESSION['user_id'];
    
    $permission = getPermission($user_id, $board_id);
    if (($permission < PERM_MODERATOR) and ($user_id != $author_id))
        exit('Not enough permission.');
    $query = "DELETE FROM post_reply WHERE post_id = '$post_id'";
    mysql_query($query) or die(mysql_error());
        
    $query = "DELETE FROM post WHERE post_id = '$post_id'";
    mysql_query($query) or die(mysql_error());
    $last_page = $_SERVER["HTTP_REFERER"];
    header("location:$last_page");
?>