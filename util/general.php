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
            echo("Moderator");
        else
            echo("User");
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
    function checkhtml($html) {
        //if(!checkperm('allowhtml')) {
     
            preg_match_all("/\<([^\<]+)\>/is", $html, $ms);
     
            $searchs[] = '<';
            $replaces[] = '&lt;';
            $searchs[] = '>';
            $replaces[] = '&gt;';
     
            if($ms[1]) {
                $allowtags = 'img|a|font|div|table|tbody|caption|tr|td|th|br|p|b|strong|i|u|em|span|ol|ul|li|blockquote|object|param|embed';
                $ms[1] = array_unique($ms[1]);
                foreach ($ms[1] as $value) {
                    $searchs[] = "&lt;".$value."&gt;";
     
                    $value = str_replace('&', '_uch_tmp_str_', $value);
                    $value = dhtmlspecialchars($value);
                    $value = str_replace('_uch_tmp_str_', '&', $value);
     
                    $value = str_replace(array('\\','/*'), array('.','/.'), $value);
                    $skipkeys = array('onabort','onactivate','onafterprint','onafterupdate','onbeforeactivate','onbeforecopy','onbeforecut','onbeforedeactivate',
                            'onbeforeeditfocus','onbeforepaste','onbeforeprint','onbeforeunload','onbeforeupdate','onblur','onbounce','oncellchange','onchange',
                            'onclick','oncontextmenu','oncontrolselect','oncopy','oncut','ondataavailable','ondatasetchanged','ondatasetcomplete','ondblclick',
                            'ondeactivate','ondrag','ondragend','ondragenter','ondragleave','ondragover','ondragstart','ondrop','onerror','onerrorupdate',
                            'onfilterchange','onfinish','onfocus','onfocusin','onfocusout','onhelp','onkeydown','onkeypress','onkeyup','onlayoutcomplete',
                            'onload','onlosecapture','onmousedown','onmouseenter','onmouseleave','onmousemove','onmouseout','onmouseover','onmouseup','onmousewheel',
                            'onmove','onmoveend','onmovestart','onpaste','onpropertychange','onreadystatechange','onreset','onresize','onresizeend','onresizestart',
                            'onrowenter','onrowexit','onrowsdelete','onrowsinserted','onscroll','onselect','onselectionchange','onselectstart','onstart','onstop',
                            'onsubmit','onunload','javascript','script','eval','behaviour','expression','style','class');
                    $skipstr = implode('|', $skipkeys);
                    $value = preg_replace(array("/($skipstr)/i"), '.', $value);
                    if(!preg_match("/^[\/|\s]?($allowtags)(\s+|$)/is", $value)) {
                        $value = '';
                    }
                    $replaces[] = empty($value)?'':"<".str_replace('&quot;', '"', $value).">";
                }
            }
            $html = str_replace($searchs, $replaces, $html);
        //}
     
        return $html;
    }    
?>