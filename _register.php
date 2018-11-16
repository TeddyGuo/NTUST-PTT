<?php
    include('util/constant.php');
    include('util/connect.php');
    
    if (!isset($_POST['submit']))
        exit('Illegal call to this page.');
        
    $username = $_POST['username'];
    $username = addslashes($username);
    $password = MD5($_POST['password']);
    $permission = $_POST['permission'];
    $permission = addslashes($permission);
        
    $now = date('Y-m-d H:i:s', time());
    
    $query = "INSERT INTO user(username, password, default_permission, registration_time) ";
    $query .= "VALUES('$username', '$password', '$permission', '$now')";
    $con->query($query) or die($con->error);
?>

<!DOCTYPE html>
<script>
	alert("Registered completed.");
	window.location.href = "./index.html";
</script>