<html>
<head>
	<title>Cookies</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body><b>
<br><br><br>
<form action="P2.php" method="POST">
<table class="w3-table w3-striped">
<tr>
	<th colspan="2" style= "font-size:30px;background: linear-gradient(to top left, #9933ff 0%, #000066 100%);color: white;">See Your Flight Performence!</th>
</tr>
<tr>
	<td>Name</td><td><input type="text" name="name" required></td>
</tr>
<tr>
	<td>Seat Selection</td><td><input type="radio" value="Aisle" name="seat">Aisle
				   <input type="radio" value="Window" name="seat">Window
				   <input type="radio" value="Center" name="seat">Center</td>
</tr>
<tr>
	<td>Meal Selection</td><td><input type="radio" value="Vegetarian" name="meal">Vegetarian
				   <input type="radio" value="Non-Vegetarian" name="meal">Non-Vegetarian
				   <input type="radio" value="Diabetic" name="meal">Diabetic
				   <input type="radio" value="Child" name="meal">Child</td>
</tr>
<tr>
	<td colspan="2" align="center"> <input type="submit" style="background-color: #4CAF50;" name="submit" value="SUBMIT"></td>
</tr>
</table>
</form>
<?php
$name;
$seat;
$meal;
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	if(isset($_POST['seat']))
		$seat=$_POST['seat'];
	else
		echo '<script>alert("Please select your seat!!!")</script>';
	if(isset($_POST['meal']))
		$meal=$_POST['meal'];
	else
		echo '<script>alert("Please select your meal!!!")</script>';
	setcookie("flight1",$name);
	setcookie("flight2",$seat);
	setcookie("flight3",$meal);
	if(isset($_COOKIE["flight1"]))
	{
		echo"Cookie Set!!";
		echo"<br> <form method='post'>Press<input type='submit' style='background-color: #4CAF50;' name='go' value='Go'>to see Cookie</form>";
	}
}
?>
<center>
<?php
	if(isset($_POST['go']))
	{
		echo '<div style="border: 5px double purple;">';
		echo"----------JSD Flights------------";
		echo"<br><br>Thank you for choosing JSD Flight";
		echo"<br>The Cookie Values are:-";
		echo"<br><br>Name:  ".$_COOKIE["flight1"];
		echo"<br><br>Seat:     ".$_COOKIE["flight2"];
		echo"<br><br>Meal:     ".$_COOKIE["flight3"];
		echo '</div>';
	}
?>
</center>
</b></body>
</html>





