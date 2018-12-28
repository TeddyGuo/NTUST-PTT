<?php
    include("../util/constant.php");
    include("../util/connect.php");
    include("../util/general.php");

    if (!isset($_GET['board_id']))
        exit('Illegal call to this page.');
    
    $board_id = $_GET['board_id'];
    $board_id = addslashes($board_id);
    $user_id = $_SESSION['user_id'];
    $permission = getPermission($user_id, $board_id);

    $query = "SELECT board_name FROM board WHERE board_id = $board_id";
    $result = $con->query($query) or die($query . '<br/>' . $con->error);
    if ($result = $result->fetch_array(MYSQLI_BOTH))
        $board_name = $result['board_name'];
    else
        exit("No board found for BID=$board_id.");
    
    function showPosts($board_id, $user_id, $permission)
    {
        global $con; // very important, it will cause a fatal error without this line.

        $query = "SELECT * FROM post WHERE board_id = '$board_id' ORDER BY last_update DESC";
        $result = $con->query($query) or die($query . '<br/>' . $con->error);
        
        while ($row = $result->fetch_array(MYSQLI_BOTH))
        {
            $post_id = $row['post_id'];
            $post_name = $row['post_name'];
            $author_id = $row['user_id'];
            $post_link = "<a href='post.php?post_id=$post_id'>$post_name</a>";

            if (($permission >= MODERATOR) or ($user_id == $author_id))
                $control = "<button style=\"float:right\" class=\"btn btn-sm btn-danger\" onClick=\"confirmDelete($post_id, '$post_name')\">Delete</button>";
            echo <<< EOT
            <p>
            <h5>
                $post_link
                $control
            </h5>
            </p>
EOT;
        }
    }
    function showPostInput($board_id, $permission)
    {	
        if ($permission >= USER)
            echo <<< EOT
            <h2>New post</h2>
            <form method="post" action="add_post.php" onSubmit="return inputCheck()">
                <input type="hidden" name="board_id" value=$board_id/>
                <p>
                    <label for="title">Title :</label>
                    <input class="form-control input-block" type="text" id="title" name="title" />
                </p>
                <p>
                    <label for="content">Content :</label>
                    <textarea class="form-control input-block" id="content" name="content" rows=6></textarea>
                </p>
                <p>
                    <label for="image">Image :</label>
                    <input class="form-control input-block" type="text" id="image" name="image" />
                </p>
                <input class="btn btn-primary" type="submit" name="submit" value="Post!">
            </form>
EOT;
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>NTUST-ptt - board</title>
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
					<?php showUserManagement($_SESSION['default_permission']); ?>
					<a href="../user/user_info.php"><?php showUser(); ?></a>
					<a href="../logout.php">Log out</a>
				</nav>
			</div>
		</header>
		
		<div class="container markdown-body">
			<h1 class="page-title"><?php echo($board_name); ?></h1>
			<?php showPosts($board_id, $user_id, $permission); ?>
			<?php showPostInput($board_id, $permission); ?>
			<footer class="footer">
			    <?php goBack();?>
			</footer>
		</div>
	</body>
</html>

<script>
    function confirmDelete(post_id, post_name)
    {
        if (confirm("Do you really want to delete post '" + post_name + "'?"))
            window.location.href = "del_post.php?post_id=" + post_id;
    }
    function inputCheck()
    {
        title = document.getElementById("title");
        content = document.getElementById("content");
        if (!title.value)
        {
            alert("Post title should not be empty.");
            title.focus();
            return false;
        }
        if (!content.value)
        {
            alert("Content should not be empty.");
            content.focus();
            return false;
        }
        return true;
    }
</script>