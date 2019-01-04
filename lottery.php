<?php
    // 取得列表
    $list = array("Fuck out away!", "Go like a guest!");
    $qty = 1; // fixed number
 
    // 抽籤
    srand((double)microtime() * 1000000);
    $num = rand(1, 2)
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-tw">
    <head>
        <title>抽籤</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <form action="<?php echo $request_uri ?>" method="post">
            <p>
                <input type="submit" value="抽籤" />
            </p>
        </form>
        <hr />
        <p>抽籤結果</p>
        <?php
            if (isset($_POST['submit']) )
            {
                echo <<< EOT
                <ul>
                    $list[$num]
                </ul>
EOT;
                if ($list[$num] == "Fuck out away!")
                {
                    header("Refresh:5; url=https://tw.yahoo.com/");
                }
                else
                {
                    header("Refresh:5; url=index.php");
                }
            }
            else
                echo("<ul></ul>");
        ?>
    </body>
</html>