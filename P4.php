<!DOCTYPE html>
<html>
<head>
	<title>Passport</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
th
{
  background: linear-gradient(to right, #000066 0%, #cc0099 100%); 
  color: yellow; 
  font-size: 35px;
}
</style>
</head>
<body>
<form method="post" enctype="multipart/form-data" action="P4.php">
<table class="w2-table w3-striped">
<tr>
	<th colspan="2">Passport Form</th>
</tr>
<tr>
	<td>Passport Number</td>
	<td><input type="number" name="num" required></td>
</tr>
<tr>
	<td>First Name</td>
	<td><input type="text" name="fname" required></td>
</tr>
<tr>
	<td>Middle Name</td>
	<td><input type="text" name="mname" required></td>
</tr>
<tr>
	<td>Last Name</td>
	<td><input type="text" name="lname" required></td>
</tr>
<tr>
	<td>DOB</td>
	<td><input type="date" name="fdob" required></td>
</tr>
<tr>
	<td>Nationality</td>
	<td><input type="text" name="nation" required></td>
</tr>
<tr>
	<td>Address</td>
	<td><input type="text" name="address" maxsize="50" required></td>
</tr>
<tr>
	<td>Gender</td>
	<td><input type="radio" name="gender" value="male">Male
	<input type="radio" name="gender" value="female">Female
	<input type="radio" name="gender" value="other">Other</td>
</tr>
<tr>
	<td>Upload Photo</td>
	<td><input type="file" name="photo"  required></td>
</tr>
<tr>
	
	<td colspan="2"><center><input class="w3-button w3-purple" type="submit" name="submit" value="Submit"> <input class="w3-button w3-purple" type="submit" name="update" value="Update"> </center></td>
</tr>
</table>

</form>
<form method="post">
	<br>
Do you want to delete a record? 
	<input type="submit" name="yes" class="w3-button w3-purple" value="Yes"> <input type="submit" name="no" class="w3-button w3-purple" value="No">
				
</form>

<?php
$pno=0;
$fname=" ";
$mname=" ";
$lname=" ";
$dob=" ";
$nationality=" ";
$address=" ";
$gender=" ";

if(isset($_POST['submit']))
{
$mysql=new mysqli("localhost","root","","awt");
if(!$mysql) 
{
	die("ERROR!!!");
}
else
{	
	echo"Connection Done..<br>";
}


$pno=$_POST['num'];
$fname=$_POST['fname'];
$mname=$_POST['mname'];
$lname=$_POST['lname'];
$dob=$_POST['fdob'];
$nationality=$_POST['nation'];
$address=$_POST['address'];
$gender=$_POST['gender'];
$ffname=" ";
if(!empty($_FILES["photo"]["name"]))
{
	
	 $filepath="img/" .$_FILES["photo"]["name"];
	move_uploaded_file($_FILES["photo"]["tmp_name"],$filepath);
	$sql="INSERT INTO passport(pno,fname,mname,lname,dob,nationality,address,gender,img)values($pno,'$fname','$mname','$lname','$dob','$nationality','$address','$gender','$filepath')";
	if(mysqli_query($mysql,$sql))
	{
		echo"Record Inserted..";
	}
	else
	{
		echo" Insertion failed!!!";
	}
}
}
?>

<?php
$pno=0;
$fname=" ";
$mname=" ";
$lname=" ";
$dob=" ";
$nationality=" ";
$address=" ";
$gender=" ";
if(isset($_POST['update']))
{
$mysql=new mysqli("localhost","root","","awt");
if(!$mysql) 
{
	die("ERROR!!!");
}
$pno=$_POST['num'];
$fname=$_POST['fname'];
$mname=$_POST['mname'];
$lname=$_POST['lname'];
$dob=$_POST['fdob'];
$nationality=$_POST['nation'];
$address=$_POST['address'];
$gender=$_POST['gender'];
$ffname=" ";
if(!empty($_FILES["photo"]["name"]))
{
	 $filepath="img/" .$_FILES["photo"]["name"];
	move_uploaded_file($_FILES["photo"]["tmp_name"],$filepath);
$sql="update passport set pno=$pno,fname='$fname',mname='$mname',lname='$lname',dob='$dob',nationality='$nationality',address='$address',gender='$gender',img='$filepath' where pno=$pno";
	if(mysqli_query($mysql,$sql))
	{
		echo"Updation completed";
	}
	else
	{
		echo" No record exist in this passpost number!!!";
	}
}
}
?>

<?php
	if(isset($_POST['no']))
	{
		echo"Thank you!!!";
	}
?>

<?php
	if(isset($_POST['yes']))
	{
		echo"Enter Passport number that you want to delete";
		echo"<form method='post'> <br><input type='number' name='num1' required>
			<br><br><input type='submit' name='del' value='Delete'></form>";
	}	
?>

<?php 
$mysql=new mysqli("localhost","root","","awt");
if(!$mysql) 
{
	die("ERROR!!!");
}
if(isset($_POST['del']))
{
	$pno=$_POST['num1'];
	$sql="delete FROM passport where pno=$pno";
	if(mysqli_query($mysql,$sql)&& $mysql->affected_rows>0)
	{
		
		echo"Recored deleted";				
	}
	else
	{
		echo" No record exist in this passpost number!!!";
	}
}
?>
</body>
</html>