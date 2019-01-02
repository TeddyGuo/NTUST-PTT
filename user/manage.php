<?php
    include('../util/constant.php');
    include('../util/connect.php');
    include('../util/general.php');

    if ($_SESSION['default_permission'] < MODERATOR)
        exit('Not enough permission.');

    function showRules($permission)
    {
        global $con; // very important, it will cause a fatal error without this line.
        global $permission_text;
        // plus admin
        $strong_permission_text = $permission_text;
        array_push($strong_permission_text, "Admin");

        if ($permission >= MODERATOR)
        {
            $query = "SELECT * FROM rule ORDER BY user_id, board_id";
            $result = $con->query($query) or die($query . '<br/>' . $con->error);
            echo <<< EOT
            <h1>Rule Manage</h1>
            <table>
                <tr>
                    <td>User ID</td>
                    <td>User name</td>
                    <td>Board ID</td>
                    <td>Board name</td>
                    <td>Permission</td>
                    <td></td>
                </tr>
EOT;
            while ($row = $result->fetch_array(MYSQLI_BOTH))
            {
                $user_id = $row['user_id'];
                $username = getUserName($user_id);
                $board_id = $row['board_id'];
                $board_name = getBoardName($board_id);
                $permission = $strong_permission_text[$row['permission']];
                echo <<< EOT
                <tr>
                    <td>$user_id</td>
                    <td>$username</td>
                    <td>$board_id</td>
                    <td>$board_name</td>
                    <td>$permission</td>
                    <td><button class="btn" onclick="windows.location.href='del_rule.php?user_id=$user_id&board_id=$board_id'">Delete</button></td>
                </tr>
EOT;
            }
            echo("</table>");
        }
    }

    function showRuleInput($permission)
    {
        global $con; // very important, it will cause a fatal error without this line.

        if ($permission >= MODERATOR)
        {
            global $permission_option;
            $strong_permission_option = $permission_option;
            $strong_permission_option .= "<option value=3>Admin</option>\n";

            $query = "SELECT * FROM user ORDER BY user_id";
            $result = $con->query($query) or die($query . '<br/>' . $con->error);
            $user_option = '';
            while ($row = $result->fetch_array(MYSQLI_BOTH))
            {
                $user_id = $row['user_id'];
                $username = getUserName($user_id);
                $user_option .= "<option value='$user_id'>$username</option>";
            }

            $query = "SELECT * FROM board ORDER BY board_id";
            $result = $con->query($query) or die($query . '<br/>' . $con->error);
            $board_option = '';
            while ($row = $result->fetch_array(MYSQLI_BOTH))
            {
                $board_id = $row['board_id'];
                $board_name = getBoardName($board_id);
                $board_option .= "<option value='$board_id'>$board_name</option>";
            }

            echo <<< EOT
            <h2>New Rule</h2>
            <form method="post" action="add_rule.php" onSubmit="return inputCheck()">
                <label for="username">Username: </label>
                <select class="form-control" id="username" name="user_id">
                    $user_option
                </select>&nbsp; &nbsp;
                <label for="board_name">Board Name: </label>
                <select class="form-control" id="board_name" name="board_id">
                    $board_option
                </select>&nbsp; &nbsp;
                <label for="permission">Permission: </label>
                <select class="form-control" id="permission" name="permission">
                    $strong_permission_option
                </select>&nbsp; &nbsp;
                <input class="btn" type="submit" name="submit" value="Add" />
            </form>
EOT;
        }
    }

    function showUsers($permission)
    {
        global $con; // very important, it will cause a fatal error without this line.
        global $permission_text;
        $strong_permission_text = $permission_text;
        array_push($strong_permission_text, "Admin");

        if ($permission >= MODERATOR)
        {
            echo <<< EOT
            <h1>User manage</h1>
            <table>
                <tr>
                    <td>User ID</td>
                    <td>User name</td>
                    <td>Registration time</td>
                    <td>Default permission</td>

                    <td><button class="btn" onClick="window.location.href=window.location.href">Restore</button></td>
                </tr>
EOT;
            $query = "SELECT * FROM user ORDER BY user_id";
            $result = $con->query($query) or die($query . '<br/>' . $con->error);
            $i = 0;
            while ($row = $result->fetch_array(MYSQLI_BOTH))
            {
                $user_id = $row["user_id"];
                $username = getUserName($user_id);
                $registration_time = $row["registration_time"];
                $permission = $row["permission"];

                $i++;
                $option = '';
                for ($j = 1; $j < count($strong_permission_text); $j++)
                {
                    if ($j == $permission)
                        $option .= "<option value=$j selected='selected'>$strong_permission_text[$j]</option>";
                    else
                        $option .= "<option value=$j>$strong_permission_text[$j]</option>";
                }

                echo <<< EOT
                <tr>
                    <form method="post" action="./change_permission.php">
                        <input type="hidden" name="user_id" value=$user_id />
                        <td>$user_id</td>
                        <td>$username</td>
                        <td>$registration_time</td>
                        <td>
                            <select class="form-control" id="permission_$i" name="permission" autoComplete="off" onChange="document.getElementById('submit_$i').disabled=false">
                                $option
                            <select>
                        </td>
                        <td><button class="btn" id="submit_$i" name="submit" disabled=true>Commit</button></td>
                    </form>
                </tr>
EOT;
            }
            echo("</table>");
        }
    }
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>NTUST-ptt - user manage</title>
    <link href="/bootstrap-4.1.3-dist/css/bootstrap.min.css" />
    <link href="/css/style.css" rel="stylesheet" />
    <script src="/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
</head>
<body>
    <header class="masthead">
        <div class="container">
            <div class="row">
                <div class="masthead-logo col-4">
                    NTUST-ptt
                </div>
                <div class="masthead-nav col-8">
                    <a href="/ptt/home.php">Home</a><!--WTF this part-->
                    <?php showUserManagement($_SESSION['default_permission']); ?>
                    <a href="/user/user_info.php"><?php showUser(); ?></a>
                    <?php showDefaultPermission();?>
                    <a href="/logout.php">Log out</a>
                </div>
            </div>
        </div>
    </header>

    <div class="container markdown-body">
        <?php showRules($_SESSION['default_permission']); ?>
        <?php showRuleInput($_SESSION['default_permission']); ?>
        <?php showUsers($_SESSION['default_permission']); ?>			
        <footer class="footer">
            We are the best!
        </footer>
    </div>
</body>
</html>