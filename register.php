<?php
    include("util/constant.php");

    $option = '';
    for ($i = 1; $i < count($permission_text); $i++)
    {
        if ($i == 2) $option .= "<option value=$i selected='selected'>$permission_text[$i]</option>";
        else $option .= "<option value=$i>$permission_text[$i]</option>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8 />
        <title>NTUST-ptt - register</title>
        <link href="/bootstrap-4.1.3-dist/css/bootstrap.min.css" />
		<link href="/css/style.css" rel="stylesheet" />
        <script src="/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        
    </body>
</html>