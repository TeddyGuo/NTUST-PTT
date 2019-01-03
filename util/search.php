<?php
    include('../util/connect.php');
    include('../util/general.php');
    include('../util/constant.php');

    if(isset($_POST['submit']))
    { 
        if(!isset($_GET['go']) )
        {
            $last_page = '/ptt/home.php';
            header("Location: " . $last_page);
        }
    } 

    function showSearch($name)
    {
        $pattern = strval(' /^[  a-zA-Z]+/ ');
        if(preg_match($pattern, $_POST['name']) )
        { 
            //-query  the database table 
            $query = "SELECT * FROM board WHERE board_name LIKE '%$name%'"; 
            //-run  the query against the mysql query function 
            $result = $con->query($query);
            
            //-create  while loop and loop through result set 
            while($row = $result->fetch_array() )
            {
                $board_id = $row['board_id'];
                $board_name = $row['board_name']; 
                //-display the result of the array 
                echo <<< EOT
                <ul>
                <li><a href="/ptt/board.php?board_id=$board_id">$board_name</a><li> // will open new tab on window.onload
                <ul>
EOT;
            }
            $query = "SELECT * FROM post WHERE post_name LIKE '%$name%'"; 
            $result = $con->query($query);
            while($row = $result->fetch_array() )
            {
                $post_id = $row['post_id'];
                $post_name = $row['post_name']; 
                //-display the result of the array 
                echo <<< EOT
                <ul>
                <li><a href="/ptt/post.php?post_id=$post_id">$post_name</a><li> // will open new tab on window.onload
                <ul>
EOT;
            }
        }
    }
?>

<html>
    <head>
        <meta charset=utf-8>
        <title>NTUST-ptt - search</title>
        <link href="/bootstrap-4.1.3-dist/css/bootstrap.min.css" />
        <link href="/css/style.css" rel="stylesheet" type="text/css" />
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
			<h1 class="page-title"><?php echo('Search Result'); ?></h1>
			<?php showSearch($_POST['name']); ?>
			<footer class="footer">
			    <?php goBack();?>
			</footer>
		</div>
    </body>
</html>