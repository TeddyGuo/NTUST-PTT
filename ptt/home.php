<?php
    include("../header.php");

    function showBoards($permission)
    {
	    global $con; // very important, it will cause a fatal error without this line.

        $query = "SELECT * FROM board ORDER BY board_id";
        $result = $con->query($query) or die($query . '<br/>' . $con->error);
        // $result = $con->real_escape_string($result);

        while ($row = $result->fetch_array(MYSQLI_BOTH))
        {
            $board_id = $row['board_id'];
            $board_name = $row['board_name'];
            $board_name = $con->real_escape_string($board_name);
            $board_name = htmlspecialchars($board_name);
            $board_link = "<li><a href='board.php?board_id=$board_id'>$board_name</a>";
            if ($permission >= MODERATOR)
                $control = "<button style=\"float:right\" class=\"btn btn-outline-light btn-sm\" onClick=\"confirmDelete($board_id, '$board_name')\">Delete</button></li>";
            else
                $control = "</li>";
            echo <<< EOT
            <p>
            <h4>
                $i. $board_link
                $control
            </h4>
            </p>	
EOT;
        }
        
        if ($permission >= MODERATOR)
        {
            echo <<< EOT
            <br>
            <h2>Create a new board</h2>
            <form method="post" action="add_board.php" onSubmit="return inputCheck()">
                <label for="board_name">Board name :</label>
                <input class="form-control col-lg-5" id="board_name", name="board_name" type="text" />
                <br>
                <input class="btn btn-outline-light btn-sm" type="submit" name="submit" value="Create" />
            </form>
            <script>
            function confirmDelete(board_id, board_name)
            {
                if (confirm("Do you really want to delete board '" + board_name + "'?"))
                    window.location.href = "del_board.php?board_id=" + board_id;
            }
            
            function inputCheck()
            {
                board_name = document.getElementById("board_name");
                if (!board_name.value)
                {
                    alert("Board name should not be empty.");
                    board_name.focus();
                    return false;
                }
                return true;
            }
            </script>
EOT;
        }
    }

    // Show Top 10
    function showTop($permission)
    {
        global $con; // very important, it will cause a fatal error without this line.

        $query = "SELECT post_id FROM top_cache ORDER BY reply_count DESC";
        $result = $con->query($query) or die($query . '<br/>' . $con->error);
        
        while ($row = $result->fetch_array(MYSQLI_BOTH))
        {
            $post_id = $row['post_id'];
            $query = "SELECT * FROM post WHERE post_id = '$post_id'";
            $result2 = $con->query($query) or die($query . '<br/>' . $con->error);
            $post_name = $result2->fetch_array(MYSQLI_BOTH)['post_name'];
            $post_name = $con->real_escape_string($post_name);
            // $post_name = checkhtml($post_name);
            $post_link = "<li><a href='post.php?post_id=$post_id'>$post_name</a></li>";
            echo <<< EOT
            <p><h5>
                $post_link
            </h5><p>
EOT;
        }
    }

?>

<!-- <!DOCTYPE html>
<html>
	<head>
        <title>NTUST-ptt - home</title>
        <link href="/bootstrap-4.1.3-dist/css/bootstrap.min.css" />
        <link href="/css/style.css" rel="stylesheet" type="text/css" />
        <script src="/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
	</head> -->
<!-- 	<body>
		<header class="masthead">
			<div class="container">
                    <div class="row">
        				<div class="col-lg-5">
                            <h4>NTUST-ptt</h4>
                        </div>
                        <div class="col-lg-7"style="text-align:right;">
                            <form>
                                <label>Style:</label>
                                <select name="cssStyle" id="cssStyle" onChange="this.form.submit()">
                                    <option <?php if($_SESSION['style_state'] == '/css/style.css'){echo("selected");}?> value="/css/style.css">Black</option>
                                    <option <?php if($_SESSION['style_state'] == '/css/style1.css'){echo("selected");}?> value="/css/style1.css">Blue</option>
                                    <option <?php if($_SESSION['style_state'] == '/css/style2.css'){echo("selected");}?> value="/css/style2.css">Purple</option>
                                </select>
                            </form>
                        </div>
        				<nav class="col-lg-12 masthead-nav">
        					<a class="btn btn-outline-light btn-sm" href="/ptt/home.php">Home</a>
                            <a class="btn btn-outline-light btn-sm" href="../user/user_style.php">Style</a>
        					<?php showUserManagement($_SESSION['default_permission']); ?>
        					<a class="btn btn-outline-light btn-sm" href="../user/user_info.php"><?php showUser(); ?></a>
        					<a class="btn btn-outline-light btn-sm" href="../logout.php">Log out</a>
        				</nav>
                    </div>
			</div>
		</header> -->
		
		<div class="container markdown-body">
			<h1 class="page-title">Board</h1>
			<?php showBoards($_SESSION['default_permission']); ?>
            <br>
			<h2>Top 10 Posts</h2>
			<?php showTop($_SESSION['default_permission']); ?>
		</div>
        <footer class="footer imgbox">
			<a href="https://www.pornhub.com" target="_blank"><img class="center-fit" src="/images/Home.jpeg" alt="Home" /></a>
        </footer>
	</body>
</html>