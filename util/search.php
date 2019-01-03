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
    $name = $_POST['name'];

    $url = "../ptt/home.php";
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $html = curl_exec($ch);
    curl_close($ch);

    # Create a DOM parser object
    $dom = new DOMDocument();

    # Parse the HTML from Google.
    # The @ before the method call suppresses any warnings that
    # loadHTML might throw because of invalid HTML in the page.
    @$dom->loadHTML($html);

    function showSearch($name)
    {
        # Iterate over all the <a> tags
        foreach($dom->getElementsByTagName('a') as $link) 
        {
            $content = strval($link->nodeValue);
            if (strpos($content, $name) )
            {
                $str = strval($link->getAttribute('href') );
                # Show the <a href>
                echo <<< EOT
                <ul>
                <li><button onclick="window.location.href='$str'">$content</button><li>
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
			<?php showSearch($name); ?>
			<footer class="footer">
			    <?php goBack();?>
			</footer>
		</div>
    </body>
</html>