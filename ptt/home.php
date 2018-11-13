<?php
    include('../util/constant.php');
    include('../util/connect.php');
    include('../util/general.php');

    function showBoards($permission)
    {
        $query = 'SELECT * FROM board ORDER BY board_id';
        $result = mysql_query($query) or die(mysql_error());
        $i = 0;
        while ($row = mysql_fetch_array($result))
        {
            $i++;
            $board_id = $row['board_id'];
            $board_name = $row['board_name'];
            $board_link = "<a href='board.php?board_id=$board_id'>$board_name</a>";
            if ($permission >= ADMINISTRATOR)
                $control = "<button style=\"float:right\" class=\"btn btn-sm btn-danger\" onClick=\"confirmDelete($board_id, '$board_name')\">Delete</button>";
            echo <<< EOT
            <p>
            <h4>
                $i. $board_link
                $control
            </h4>
            </p>	
EOT;
        }
        
        if ($permission >= ADMINISTRATOR)
            echo <<< EOT
            <h2>Create a new board</h2>
            <form method="post" action="add_board.php" onSubmit="return inputCheck()">
                <label for="board_name">Board name :</label>
                <input class="form-control" id="board_name", name="board_name" type="text" />
                <input class="btn" type="submit" name="submit" value="Create" />
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

    // Show Top 10
    function showTop($permission)
    {
        $query = "SELECT post_id FROM top_cache ORDER BY reply_count DESC";
        $result = mysql_query($query) or die(mysql_error());
        while ($row = mysql_fetch_array($result))
        {
            $post_id = $row['post_id'];
            $query = "SELECT * FROM post WHERE post_id = '$post_id'";
            $result2 = mysql_query($query) or die(mysql_error());
            $post_name = mysql_fetch_array($result2)['post_name'];
            $post_link = "<a href='post.php?post_id=$post_id'>$post_name</a>";
            echo <<< EOT
            <p><h5>
                $post_link
            </h5><p>
EOT;
        }
    }

?>

<!DOCTYPE html>
<html>
	<head>
		<title>NTUST-ptt - home</title>
		<link href="/bootstrap-4.1.3-dist/css/bootstrap.min.css" />
		<link href="/css/style.css" rel="stylesheet" />
        <script src="/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
	</head>
	<body>
		<header class="masthead">
			<div class="container">
				<div class="masthead-logo">
					NTUST-ptt
				</div>
				<nav class="masthead-nav">
					<a href="/ptt/home.php">Home</a>
					<?php showUserManangement($_SESSION['default_permission']); ?>
					<a href="../user/user_info.php"><?php showUser(); ?></a>
					<a href="../logout.php">Log out</a>
				</nav>
			</div>
		</header>
		
		<div class="container markdown-body">
			<h1 class="page-title">Board</h1>
			<?php showBoards($_SESSION['default_permission']); ?>
			<h2>Top 10 Posts</h2>
			<?php showTop($_SESSION['default_permission']); ?>
			<footer class="footer">
				We are family!
			</footer>
		</div>
	</body>
</html>