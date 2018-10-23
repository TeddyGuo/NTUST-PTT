<?php
    session_start();

    if (!isset($_SESSION['user_id']))
    {
        exit("Illegal call to this page.");
    }

    function showUser()
    {
        $username = $_SESSION['username'];
        echo("Identity: ".$username);
    }
    function showUserManagement()
    {
        if ($permission >= MODERATOR)
        {
            echo("<a href='user/manage.php'>User Management<a>");
        }
    }
    function getPermission($user_id, $board_id)
    {
        $query = "SELECT permission FROM rule WHERE (user_id = '$user_id' AND board_id = '$board_id')";
        $result = mysql_query($query) or die(mysql_error());
        $permission = mysql_fetch_array($result)['permission'];
        if (!$permission)
        {
            $permission = $_SESSION['default_permission'];
        }
        return $permission;
    }
    function getBoardId($post_id)
    {
        $query = "SELECT permission FROM rule WHERE post_id = '$post_id'";
        $result = mysql_query($query) or die(mysql_error());
        return mysql_fetch_array($result)['board_id'];
    }
    function getBoardName($board_id)
    {
        $query = "SELECT board_name FROM board WHERE board_id = '$board_id'";
        $result = mysql_query($query) or die(mysql_error());
        return mysql_fetch_array($result)['board_name'];
    }
    function getUserName($user_id)
    {
        $query = "SELECT username FROM user WHERE user_id = '$user_id'";
        $result = mysql_query($query) or die(mysql_error());
        return mysql_fetch_array($result)['username'];
    }
?>