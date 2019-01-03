<?php
	include("../header.php");

    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $permission = $_SESSION['default_permission'];
    $registration_time = $_SESSION['registration_time'];
?>

<!--<!DOCTYPE html>
<html lang="en-US">
	<head>
		<title>NTUST-ptt - <?php echo($username); ?></title>
		<link href="/css/style.css" rel="stylesheet" />
        <link href="/bootstrap-4.1.3-dist/css/bootstrap.min.css" />
        <script src="/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
	</head>
	<body>
        <header class="masthead">
            <div class="container">
                <div class="row">
                    <div class="masthead-logo col-md-4">
                        NTUST-ptt
                    </div>
                    <div class="masthead-nav col-md-8">
                        <a href="/ptt/home.php">Home</a> Important to turn bbs folder to ptt
                        <?php showUserManagement($_SESSION['default_permission']); ?>
                        <a href="/user/user_info.php"><?php showUser(); ?></a>
                        <a href="/logout.php">Log out</a>
                    </div>
                </div>
            </div>
        </header>-->
		
		<div class="container markdown-body">
			<div class="row">
			<div class="col-lg-12">
				<h1 class="page-title">Username : <?php echo($username); ?></h1>
			</div>
			<div class="col-lg-12">
				<label>Registration time : </label>
				<?php echo($registration_time); ?>
			</div>
			<div class="col-lg-12">
				<label>Default permission : </label>
				<?php if ($permission < ADMIN) echo($permission_text[$permission]); else echo('Admin'); ?>
			</div>
			<div class="col-lg-12">
				<br>
				<h2>Change password</h2>
			</div>
			<form method="post" action="change_password.php" onSubmit="return inputCheck()">
				<div class="col-lg-12">
					<label for="old_password">Old password :</label>
					<input class="form-control" id="old_password" name="old_password" type="password" />
				</div>
				<div class="col-lg-12">
					<label for="new_password">New password :</label>
					<input class="form-control" id="new_password" name="new_password" type="password" />
				</div>
				<div class="col-lg-12">
					<label for="confirm">Confirm password :</label>
					<input class="form-control" class="form-control" id="confirm" type="password" />
				</div>
				<div class="col-lg-12"><br>
					<input class="btn btn-outline-light btn-sm" type="submit" name="submit" value="Change" />
				</div>
			</form>
			<!-- <footer class="footer">
				We are the best!
			</footer> --></div>
		</div>
	</body>
</html>

<script>
function inputCheck()
{
	old_password = document.getElementById("old_password");
	new_password = document.getElementById("new_password");
	confirm = document.getElementById("confirm");

	if (old_password.value && new_password.value && (new_password.value == confirm.value))
		return true;
	if (!old_password.value)
		alert("Old password should not be empty.");
	if (!new_password.value)
		alert("New password should not be empty.");
	if (new_password.value != confirm.value)
		alert("Passwords should be consistent.");
	
    old_password.value = "";
	new_password.value = "";
	confirm.value = "";
	old_password.focus();
	return false;
}
</script>