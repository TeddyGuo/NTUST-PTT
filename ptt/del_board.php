<?php
    include(".././util/./constant.php");
    include(".././util/./connect.php");
    include(".././util/./general.php");

    if ($_SESSION['default_permission'] < MODERATOR)
    {
        exit("Not enough permission.");
    }

    $cur_user_id = $_SESSION['user_id'];
    $cur_user_id = addslashes($cur_user_id);
    $board_id = $_GET['board_id'];
    $board_id = addslashes($board_id);
    $user_id = $_GET['user_id'];
    $user_id = addslashes($user_id);

    // check rule part
    $query = "SELECT user_id FROM rule WHERE board_id = '$board_id' AND permission >= 2";
    $result1 = $con->query($query); // return True or False

    if ($_SESSION['default_permission'] != ADMIN && ($user_id == 0 || ($cur_user_id != $user_id && $result == False) ) )
    {
        echo <<< EOT
        <script>
            alert("You don't have permission.");
        <script>
EOT;
    }
    else
    {
        $query = "SELECT post_id FROM post WHERE board_id = '$board_id'";
        $result = $con->query($query) or die($query . '<br/>' . $con->error);
        
        while ($row = $result->fetch_array(MYSQLI_BOTH))
        {
            $post_id = $row['post_id'];
            $query = "DELETE FROM post_reply WHERE post_id = '$post_id'";
            $con->query($query) or die($query . '<br/>' . $con->error);
        }

        $query = "DELETE FROM post WHERE board_id = '$board_id'";
        $con->query($query) or die($query . '<br/>' . $con->error);

        $query = "DELETE FROM board WHERE board_id = '$board_id'";
        $con->query($query) or die($query . '<br/>' . $con->error);
    }

    $last_page = $_SERVER["HTTP_REFERER"];
    header("Location: $last_page");
?>