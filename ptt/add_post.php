<?php
    include('../util/constant.php');
    include('../util/connect.php');
    include('../util/general.php');

    if (!isset($_POST['submit']))
        exit('Illegal call to this page.');
        
    $board_id = $_POST['board_id'];
    $board_id = addslashes($board_id);
    $board_id = substr($board_id, 0, -1);
    $user_id = $_SESSION['user_id'];
    $permission = getPermission($user_id, $board_id);

    if ($permission < USER)
        exit('Not enough permission.');

    $post_name = $_POST['title'];
    $post_name = addslashes($post_name);
    $post_name = $con->real_escape_string($post_name);
    $post_name = htmlspecialchars($post_name);

    $content = $_POST['content'];
    $content = addslashes($content);
    $content = $con->real_escape_string($content);
    $content = htmlspecialchars($content);
    
    $img = $_POST['img'];
    $img = addslashes($img);
    $now = date('Y-m-d H:i:s', time());
    $query = "INSERT INTO post(user_id, board_id, post_name, create_time, last_update, content, img) ";
    $query .= "VALUES ('$user_id', '$board_id', '$post_name', '$now', '$now', '$content', '$img')";

    $con->query($query) or die($query . '<br/>' . $con->error);

    $result = $con->query('SELECT last_insert_id()');
    $post_id = $result->fetch_array(MYSQLI_BOTH)['last_insert_id()'];
    header("Location: post.php?post_id=$post_id");
?>
