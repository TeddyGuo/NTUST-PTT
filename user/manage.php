<?php
    include('../util/constant.php');
    include('../util/connect.php');
    include('../util/general.php');

    if ($_SESSION['default_permission'] < MODERATOR)
        exit('Not enough permission.');

    function showRules($permission)
    {
        global $permission_text;

        if ($permission >= MODERATOR)
        {
            $query = "SELECT * FROM rule ORDER BY user_id, board_id";
            $result = mysql_query($query) or die(mysql_error());
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
            while ($row = mysql_fetch_array($result))
            {
                $user_id = $row['user_id'];
                $username = getUserName($user_id);
                $board_id = $row['board_id'];
                $board_name = getBoardName($board_id);
                $permission = $permission_text[$row['permission']];
                echo <<< EOT
                <tr>
                    <td>$user_id</td>
                    <td>$username</td>
                    <td>$board_id</td>
                    <td>$board_name</td>
                    <td>$permission</td>
                    <td><button class="btn" onClick="windows.location.href='del_rule.php?user_id=$user_id&board_id=$board_id'">Delete</button></td>
                </tr>
EOT;
            }
            echo("</table>");
        }
    }

    function showRuleInput($permission)
    {
        if ($permission >= MODERATOR)
        {
            global $permission_option;

            $query = "SELECT * FROM user ORDER BY user_id";
            $result = mysql_query($query) or die(mysql_error());
            $user_option = '';
            while ($row = mysql_fetch_array($result))
            {
                $user_id = $row['user_id'];
                $username = getUserName($user_id);
                $user_option .= "<option value='$user_id'>$username</option>";
            }

            $query = "SELECT * FROM board ORDER BY board_id";
            $result = mysql_query($query) or die(mysql_error());
            $board_option = '';
            while ($row = mysql_fetch_array($result))
            {
                $board_id = $row['board_id'];
                $board_name = getBoardName($board_id);
                $board_option .= "<option value='$board_id'>$board_name</option>";
            }

            echo <<< EOT
            <h2>New Rule</h2>
            <form method="post" action="add_rule.php" onSubmit="return InputCheck()">
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
                    $permission_option
                </select>&nbsp; &nbsp;
                <input class="btn" type="submit" name="submit" value="Add" />
            </form>
EOT;
        }
    }

    function showUsers($permission)
    {
        global $permission_text;

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
            </table>
EOT;
            $query = "SELECT * FROM user ORDER BY user_id";
            $result = mysql_query($query) or die(mysql_error());
            $i = 0;
            while ($row = mysql_fetch_array($result))
            {
                $user_id = $row["user_id"];
                $username = getUserName("user_id");
                $registration_time = $row["registration_time"];
                $permission = $row["permission"];
            }
        }
    }
?>