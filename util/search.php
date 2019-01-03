<?php
    include('../util/connect.php');

    if(isset($_POST['submit']))
    { 
        if(isset($_GET['go']))
        { 
            $pattern = strval(' /^[  a-zA-Z]+/ ');
            if(preg_match($pattern, $_POST['name']) )
            { 
                $name = $_POST['name']; 
                //-query  the database table 
                $query = "SELECT * FROM board WHERE board_name LIKE '%$name%'"; 
                //-run  the query against the mysql query function 
                $result = $con->query($query);
                if ($result === True)
                { 
                    //-create  while loop and loop through result set 
                    while($row = $result->fetch_array() )
                    {
                        $board_id = $row['board_id'];
                        $board_name = $row['board_name']; 
                        //-display the result of the array 
                        echo <<< EOT
                        <script>
                            window.onload = function()
                            {
                                window.open("/ptt/board.php?board_id=$board_id", "_blank"); // will open new tab on window.onload
                            }
                        </script>
EOT;
                    }
                }
                $query = "SELECT * FROM post WHERE post_name LIKE '%$name%'"; 
                $result = $con->query($query);
                if ($result === True)
                {
                    while($row = $result->fetch_array() )
                    {
                        $post_id = $row['post_id'];
                        $post_name = $row['post_name']; 
                        //-display the result of the array 
                        echo <<< EOT
                        <script>
                            window.onload = function()
                            {
                                window.open("/ptt/post.php?post_id=$post_id", "_blank"); // will open new tab on window.onload
                            }
                        </script>
EOT;
                    }
                }
            } 
            
            $last_page = $_SERVER['HTTP_REFERER'];
            header('Location: '. $last_page);
        } 
    } 
?> 