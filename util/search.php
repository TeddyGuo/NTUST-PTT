<?php
    include('../util/connect.php');

    if(isset($_POST['submit']))
    { 
        if(isset($_GET['go']))
        { 
            $pattern = '/^[  a-zA-Z]+/';
            if(preg_match($pattern, $_POST['name']) )
            { 
                $name = $_POST['name']; 
                //-query  the database table 
                $query = "SELECT user_id, board_id, board_name FROM board WHERE board_name LIKE '%" . $name .  "%'"; 
                //-run  the query against the mysql query function 
                $result = $con->query($query);
                //-create  while loop and loop through result set 
                while($row = $result->fetch_array() )
                { 
                    $user_id = $row['user_id']; 
                    $board_id = $row['board_id']; 
                    $board_name = $row['board_name']; 
                    //-display the result of the array 
                    echo <<< EOT
                    <ul>
                        <li><a href="search.php?board_id=$board_id">$board_name</a></li>
                    </ul>
EOT;
                }
            } 
            else
            { 
                echo  "<p>Please enter a search query</p>"; 
            } 
        } 
    } 
?> 