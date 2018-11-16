<?php
    include('../util/constant.php');
    include('../util/connect.php');
    include('../util/general.php');

    $reply_id = $_GET['reply_id'];
    $reply_id = addslashes($reply_id);
    $query = "SELECT * FROM post_reply WHERE reply_id = '$reply_id'";
    $result = $con->query($query) or die($query . '<br/>' . $con->error);
    $result = $result->fetch_array(MYSQLI_BOTH);
    $post_id = $result['post_id'];
    $author_id = $result['user_id'];
    $user_id = $_SESSION['user_id'];
    $board_id = getBoardId($post_id);
    $permission = getPermission($user_id, $board_id);
    
    if (($permission < MODERATOR) and ($user_id != $author_id))
        exit('Not enough permission.');
        
    $query = "DELETE FROM post_reply WHERE reply_id = '$reply_id'";
    $con->query($query) or die($query . '<br/>' . $con->error);
    $last_page = $_SERVER["HTTP_REFERER"];
    header("location:$last_page");
?>