<?php
    define("USER", 1);
    define("MODERATOR", 2);
    define("ADMIN", 3);

    $permission_text = array('null', 'user', 'moderator', 'admin');

    $permission_option = '';
    for ($i = 1; $i < count($permission_text); $i++)
    {
        $permission_option .= "<option value=$i>$permission_text[$i]</option>\n";
    }

    // test output
    // echo $permission_option;
?>