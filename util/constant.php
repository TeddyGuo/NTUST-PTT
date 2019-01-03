<?php
    define("USER", 1);
    define("MODERATOR", 2);
    define("ADMIN", 3);

    $permission_text = array('null', 'User', 'Moderator');
    $permission_plus_admin = array('null', 'User', 'Moderator', 'Admin');

    $permission_option = '';
    $permission_plus_option = '';
    for ($i = 1; $i < count($permission_text); $i++)
    {
        $permission_option .= "<option value=$i>$permission_text[$i]</option>\n";
        $permission_plus_option .= "<option value=$i>$permission_text[$i]</option>\n";
    }
    $permission_plus_option .= "<option value=3>$permission_plus_admin[3]</option>\n";

    // test output
    // echo $permission_option;
?>