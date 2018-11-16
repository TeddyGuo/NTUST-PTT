<?php
    include('../util/constant.php');
    include('../util/connect.php');
    include('../util/general.php');
    
    $post_id = $_GET['post_id'];
    $post_id = addslashes($post_id);
    $query = "SELECT * FROM post WHERE post_id = '$post_id'";
    $result = $con->query($query) or die($query . '<br/>' . $con->error);
    $result = $result->fetch_array(MYSQLI_BOTH);
    $board_id = $result['board_id'];
    $author_id = $result['user_id'];
    $user_id = $_SESSION['user_id'];
    
    $permission = getPermission($user_id, $board_id);
    if (($permission < MODERATOR) and ($user_id != $author_id))
        exit('Not enough permission.');
    $query = "DELETE FROM post_reply WHERE post_id = '$post_id'";
    $con->query($query) or die($query . '<br/>' . $con->error);
        
    $query = "DELETE FROM post WHERE post_id = '$post_id'";
    $con->query($query) or die($query . '<br/>' . $con->error);
    $last_page = $_SERVER["HTTP_REFERER"];
    header("location:$last_page");
?>