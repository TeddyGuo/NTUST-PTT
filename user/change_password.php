<?php
    include('../util/constant.php');
    include('../util/connect.php');
    include('../util/general.php');

    if (!isset($_POST['submit']))
        exit('Illegal call to this page.');
    $user_id = $_SESSION['user_id'];
    $old_password = MD5($_POST['old_password']);
    $new_password = MD5($_POST['new_password']);
    $query = "SELECT * FROM user WHERE (user_id = '$user_id' AND password = '$old_password')";
    $result = mysql_query($query) or die(mysql_error());
    if ($result = mysql_fetch_array($result))
    {
        $query = "UPDATE user SET password = '$new_password' WHERE user_id = '$user_id'";
        mysql_query($query) or die(mysql_error());
        $_SESSION['password'] = $new_password;
        echo <<< EOT
        <script>
            alert("Done.");
            window.history.go(-1);
        </script>		
EOT;
    }
    else
    {
        echo <<< EOT
        <script>
            alert("Wrong password.");
            window.history.go(-1);
        </script>
EOT;
    }
?>
