<?php
    include('../util/connect.php');
    include('../util/general.php');
    include('../util/constant.php');

    if(isset($_POST['submit']))
    { 
        if(!isset($_GET['go']) )
        {
            $last_page = '../ptt/home.php';
            header("Location: " . $last_page);
        }
    } 
    $html = file_get_html('../ptt/home.php');

    function showSearch($name)
    {
        // Find all links 
        foreach($html->find('a') as $element) 
        {
            if(strpos($element->innertext, strval($name) ) )
            { 
                echo <<< EOT
                <ul>
                <li><button onclick="window.location.href='$element->href'">$element->innertext</button><li>
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