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
    //base url
    $base = '../ptt/home.php';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, $base);
    curl_setopt($curl, CURLOPT_REFERER, $base);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    $str = curl_exec($curl);
    curl_close($curl);

    // Create a DOM object
    $html_base = new simple_html_dom();
    // Load HTML from a string
    $html_base->load($str);

    function showSearch($name)
    {
        // Find all links 
        // foreach($html_base->find('a') as $element) 
        // {
        //     if(strpos($element->innertext, strval($name) ) )
        //     { 
        //         //<<< EOT
        //         //<ul>
        //         //<li><button onclick="window.location.href='$element->href'">$element->innertext</button><li>
        //         //<ul>;
        //     }
        // }
        $html_base->clear(); 
        unset($html_base);
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