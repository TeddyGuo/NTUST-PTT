<?php
    include("util/constant.php");

    $option = '';
    for ($i = 1; $i < count($permission_text); $i++)
    {
        if ($i == 2) $option .= "<option value=$i selected='selected'>$permission_text[$i]</option>";
        else $option .= "<option value=$i>$permission_text[$i]</option>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8 />
        <title>NTUST-ptt - register</title>
        <link href="/bootstrap-4.1.3-dist/css/bootstrap.min.css" />
		<link href="/css/style.css" rel="stylesheet" />
        <script src="/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
    </head>
    <body onLoad="permissionText(document.getElementById('permission'))">
		<header class="masthead">
			<div class="container">
				<div class="masthead-logo">
					NTUST-ptt
				</div>
				<nav class="masthead-nav">
					<a href="/index.php">Back</a>
				</nav>
			</div>
		</header>
		
		<div class="container markdown-body">
			<h1 class="page-title">Register a new account</h1>
			<form method="post" action="_register.php" onSubmit="return inputCheck()">
				<p>
					<label for="username">Username :</label>
					<input class="form-control" id="username" name="username" type="text" />
				</p>
				<p>
					<label for="password">Password :</label>
					<input class="form-control" id="password" name="password" type="password" />
				</p>
				<p>
					<label for="confirm">Confirm password :</label>
					<input class="form-control" class="form-control" id="confirm" type="password" />
				</p>
				<p>
					<label for="permission">Default permission :</label>
					<select class="form-control" id="permission" name="permission" autoComplete="off" onChange="permissionText(this)">
						<?php echo($option); ?>
					</select>
				</p>
				<p><div id="describe"></div></p>
				<input class="btn" type="submit" name="submit" value="Register" />
			</form>
			<footer class="footer">
				We are family!
			</footer>
		</div>
	</body>
</html>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																										
<script>
    function inputCheck()
    {
        username = document.getElementById("username");
        password = document.getElementById("password");
        confirm = document.getElementById("confirm");
        if (!username.value)
        {
            alert("User name should not be empty.");
            username.focus();
            return false;
        }
        if (!password.value)
        {
            alert("Password should not be empty.");
            password.value = "";
            confirm.value = "";
            password.focus();
            return false;
        }
        if (password.value != confirm.value)
        {
            alert("Passwords should be consistent.");
            password.value = "";
            confirm.value = "";
            password.focus();
            return false;
        }
        return true;
    }
    function permissionText(select)
    {
        permissionToText = new Array();
        // permissionToText[0] = "A tourist can only read posts.";
        permissionToText[0] = "A user can read, create posts, but cannot delete posts of others.";
        permissionToText[1] = "A moderator can read, create and delete posts.";
        permissionToText[2] = "An administrator can read, create and delete posts. \
                        An administrator can also manage the status of others.";
        document.getElementById("describe").innerHTML = permissionToText[select.selectedIndex];
    }
</script>