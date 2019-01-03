<?php
    include('../util/constant.php');
    include('../util/connect.php');
    include('../util/general.php');

    if (!isset($_POST['submit']))
        exit('Illegal call to this page.');
    
    $new_style = $_POST['cssStyle'];
    $user_id = $_SESSION['user_id'];
    if (!$new_style)
        exit('Illegal call to this page.');	

    $query = "UPDATE user SET style_state = '$new_style' WHERE user_id = '$user_id'";
    $con->query($query) or die($query . '<br/>' . $con->error);
    $_SESSION['style_state'] = $new_style;
    $last_page = $_SERVER["HTTP_REFERER"];
    header("Location: $last_page");
?>