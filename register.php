<?php
    include("util/constant.php");

    $option = '';
    for ($i = 1; $i < count($permission_text); $i++)
    {
        if ($i == 1) $option .= "<option value=$i selected='selected'>$permission_text[$i]</option>";
        else $option .= "<option value=$i>$permission_text[$i]</option>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8 />
        <title>NTUST-ptt</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link href="/css/style.css" rel="stylesheet" />
    </head>
    <body onLoad="permissionText(document.getElementById('permission'))">
		<header class="masthead">
			<div class="container">
				<div class="masthead-logo">
					NTUST-ptt
				</div>
				<nav class="masthead-nav">
                    <a class="btn btn-outline-light btn-sm" href="/index.php">Back</a>
				</nav>
			</div>
		</header>
		
		<div class="container markdown-body">
			<h1 class="page-title">Register a new account</h1>
			<form method="post" action="_register.php" onSubmit="return inputCheck()">
            <div>
					<label for="username">Username :</label>
					<input class="form-control col-lg-5" id="username" name="username" type="text" />
				</div>
				<div>
					<label for="password">Password :</label>
					<input class="form-control col-lg-5" id="password" name="password" type="password" />
				</div>
				<div>
					<label for="confirm">Confirm password :</label>
					<input class="form-control col-lg-5" class="form-control" id="confirm" type="password" />
				</div>
				<div>
					<label for="permission">Default permission :&emsp;</label>
                    <span id="describe"></span>
					<select class="form-control col-lg-2" id="permission" name="permission" autoComplete="off" onChange="permissionText(this)">
						<?php echo($option); ?>
					</select>
                </div>
                
				<!-- <input class="btn" type="submit" name="submit" value="Register" /> -->
                <div><br>
                    <button type="submit" name="submit" class="btn btn-outline-light btn-sm">Register</button>
                </div><br>
			</form>
			<footer class="footer">
                <h5>We are family!</h5>
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