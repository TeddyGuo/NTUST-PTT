<?php
    include(".././util/./constant.php");
    include(".././util/./connect.php");
    include(".././util/./general.php");

    if (!($_SESSION['default_permission']) >= ADMINISTRATOR)
    {
        exit("Not enough permission.");
    }

    $board_id = $_GET['board_id'];
    $board_id = addcslashes($board_id);

    $query = "SELECT post_id FROM post WHERE board_id = '$board_id'";
    $result = mysql_query($query) or die(mysql_error());

    while ($row = mysql_fetch_array($result))
    {
        $post_id = $row['post_id'];
        $query = "DELETE FROM post_reply WHERE post_id = '$post_id'";
        mysql_query($query) or die(mysql_error());
    }

    $query = "DELETE FROM post WHERE board_id = '$board_id'";
    mysql_query($query) or die(mysql_error());

    $query = "DELETE FROM board WHERE board_id = '$board_id'";
    mysql_query($query) or die(mysql_error());

    $last_page = $_SERVER["HTTP_REFERER"];
    header("Location: $last_page");
?>