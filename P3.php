<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Session</title>
</head>
<?php
session_start();
$disable="";
if (isset($_POST['login'])) 
{
    $_SESSION['user'] = $_POST['user'];
    if (isset($_COOKIE[$_POST['user']])) 
    {
        	setcookie($_POST['user'], $_COOKIE[$_POST['user']] + 1, time() + (86400 * 30), "/");
       		echo  "<h3>" . $_SESSION['user'] . "</h3>"; 
		echo "<h3>You have visited this page " . $_COOKIE[$_POST['user']] . " Times</h3>";
    } 
    else 
    {
        	setcookie($_POST['user'], 1, time() + (86400 * 30), "/");
    		$_SESSION['loggedin'] = true;
    		$disable="disabled";  
    } 
}
if (isset($_POST['logout'])) 
{
    echo "<h4>Logged Out</h4>";
    session_destroy();
}
?>
<body>
<table border="2">
<form action="" method="post">
<tr>
	<th colspan="2" style="background: linear-gradient(to right, #003300 0%, #00ff00 100%); color:white; font-size: 25px;">Login Sessions</th>
</tr>
<tr>
	<td>User Name:</td><td><input type="text" name="user"></td>
</tr>
<tr>
	<td>Password:</td><td><input type="password" name="pwd"></td>
</tr>
<tr>
                <?php
                if (!isset($_POST['login']))//logged in
                    echo "<td colspan=2><input type=\"submit\" value=\"Login\" name=\"login\"></td>";
                if (isset($_POST['login']))
                echo "<td colspan=2><input type=\"submit\" value=\"Logout\" name=\"logout\"></td>";
                ?>
</tr>
</form>
</table>
</body>
</html>

