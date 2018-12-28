<?php
    session_start();

    /* test for this part*/
    if (!isset($_SESSION['user_id']))
    {
        exit("Illegal call to this page.");
    }

    function showDefaultPermission()
    {
        $permission = $_SESSION['default_permission'];
        echo("Authority: ");
        if ($permission == 3) 
            echo("Admin");
        else if ($permission == 2)
            echo("MODERATOR");
        else
            echo("USER");
    }
    function showUser()
    {
        $username = $_SESSION['username'];
        echo("Identity: " . $username);
    }
    function showUserManagement($permission)
    {
        if ($permission >= MODERATOR)
        {
            echo("<a href='/user/manage.php'>User Management<a>");
        }
    }
    function getPermission($user_id, $board_id)
    {
        global $con; // very important, it will cause a fatal error without this line.

        $query = "SELECT permission FROM rule WHERE (user_id = '$user_id' AND board_id = '$board_id')";
        $result = $con->query($query) or die($query . '<br/>' . $con->error);
        $permission = $result->fetch_array(MYSQLI_BOTH)['permission'];
        if (!$permission)
        {
            $permission = $_SESSION['default_permission'];
        }
        return $permission;
    }
    function getBoardId($post_id)
    {
        global $con; // very important, it will cause a fatal error without this line.

        $query = "SELECT board_id FROM post WHERE post_id = '$post_id'";
        $result = $con->query($query) or die($query . '<br/>' . $con->error);
        return $result->fetch_array(MYSQLI_BOTH)['board_id'];
    }
    function getBoardName($board_id)
    {
        global $con; // very important, it will cause a fatal error without this line.

        $query = "SELECT board_name FROM board WHERE board_id = '$board_id'";
        $result = $con->query($query) or die($query . '<br/>' . $con->error);
        return $result->fetch_array(MYSQLI_BOTH)['board_name'];
    }
    function getUserName($user_id)
    {
        global $con; // very important, it will cause a fatal error without this line.

        $query = "SELECT username FROM user WHERE user_id = '$user_id'";
        $result = $con->query($query) or die($query . '<br/>' . $con->error);
        return $result->fetch_array(MYSQLI_BOTH)['username'];
    }
    // go back to last page
    function goBack()
    {
        echo <<< EOT
        <button onclick="history.back();">Back</button>
EOT;
    }
    function showImg($img)
    {
        echo "<img src='$img' alt='$img' />";
    }
?>