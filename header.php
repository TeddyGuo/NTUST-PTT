<?php
    include('../util/constant.php');
    include('../util/connect.php');
    include('../util/general.php');
?>
<html>
	<meta charset="utf-8">
	<head>
		<title>NTUST-ptt</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script> -->
		<!-- <link href="/css/style.css" rel="stylesheet"  id="changeStyle"/> -->
		<link href="<?php echo $_SESSION['style_state']; ?>" rel="stylesheet"  id="changeStyle"/>

		
	</head>
<body>
		<header class="masthead">
			<div class="container">
                    <div class="row">
        				<div class="col-lg-12">
                            <h4 class="header_title">NTUST-ptt</h4>
                        </div>
        				<nav class="col-lg-10 masthead-nav">
        					<a class="btn btn-outline-light btn-sm" href="/ptt/home.php">Home</a>
                            <a class="btn btn-outline-light btn-sm" href="../user/user_style.php">Style</a>
        					<?php showUserManagement($_SESSION['default_permission']); ?>
        					<a class="btn btn-outline-light btn-sm" href="../user/user_info.php"><?php showUser(); ?></a>
        				</nav>
        				<div class="col-lg-2" style="text-align:right;">
        					<a class="btn btn-outline-light btn-sm" href="../logout.php">Log out</a>
        				</div>
                    </div>
			</div>
		</header><hr />