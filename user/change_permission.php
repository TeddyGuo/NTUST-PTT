<?php
    include('../util/constant.php');
    include('../util/connect.php');
    include('../util/general.php');

    if (!isset($_POST['submit']))
        exit('Illegal call to this page.');
    
    if ($_SESSION['default_permission'] < ADMINISTRATOR)
        exit('Not enough permission.');
    
    $user_id = $_POST['user_ID'];
    $user_id = addslashes($user_id);
    $permission = $_POST['permission'];
    $permission = intval($permission);
    if (!$permission)
        exit('Illegal call to this page.');	

    $query = "UPDATE user SET default_permission = '$permission' WHERE user_id = '$user_id'";
    mysql_query($query) or die(mysql_error());
    $last_page = $_SERVER["HTTP_REFERER"];
    header("location:$last_page");
?>