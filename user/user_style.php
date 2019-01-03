<?php
    include("../header.php");
        
    // $user_id = $_SESSION['user_id'];
    // $username = $_SESSION['username'];
    // $permission = $_SESSION['default_permission'];
    // $registration_time = $_SESSION['registration_time'];
?>

        <div class="container markdown-body">
            <form method="post" action="change_style.php">
                <h1>Style:</h1>
                <select class="form-control col-lg-2" name="cssStyle" id="cssStyle">
                    <option <?php if($_SESSION['style_state'] == '/css/style.css'){echo("selected");}?> value="/css/style.css">Black</option>
                    <option <?php if($_SESSION['style_state'] == '/css/style1.css'){echo("selected");}?> value="/css/style1.css">Blue</option>
                    <option <?php if($_SESSION['style_state'] == '/css/style2.css'){echo("selected");}?> value="/css/style2.css">Purple</option>
                    <option <?php if($_SESSION['style_state'] == '/css/style3.css'){echo("selected");}?> value="/css/style3.css">Red</option>
                    <option <?php if($_SESSION['style_state'] == '/css/style4.css'){echo("selected");}?> value="/css/style4.css">Green</option>
                </select>
                <div><br>
					<button type="submit" name="submit" class="btn btn-outline-light btn-sm">Change</button>
				</div><br>
            </form>
			<!-- <footer class="footer">
				We are the best!
			</footer> -->
        </div>
	</body>
</html>