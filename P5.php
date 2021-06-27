<!DOCTYPE html> 
<html>
<head>
	<title>Bank Operations</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body style="background-color: pale-green;">
<form method="post">
<center>
	<div class="w3-panel w3-pink">
  		<h2 class="w3-opacity">My Bank</h2>
	</div>
		<input style="background-color: #4CAF50;" type="submit" name="create" value="Create">
		<input style="background-color: #4CAF50;" type="submit" name="deposit" value="Deposit">
		<input style="background-color: #4CAF50;" type="submit" name="withdraw" value="Withdraw">
		<input style="background-color: #4CAF50;" type="submit" name="enquiry" value="Balance Enquiry"></center>
</form>

<?php 
  if(isset($_POST['create']))
  {
	echo"<div class='w3-blue'><h2>Create Your Account</h2></div>";
	echo"<form method='post'>";
	echo"<table class='w2-table w3-striped'>
		<tr>
			<td>Enter Account number</td>
			<td><input type='number' name='acc_num' required></td>
		</tr>
		<tr>
			<td>Enter Name</td>
			<td><input type='text' name='name' required></td>
		</tr>
		<tr>
			<td>Enter Address</td>
			<td><input type='text' name='address' required></td>
		</tr>
		<tr>
			<td>Select Account Type</td>
			<td><select name='type'>
				<option>SB Account</option>
				<option>Joint Account</option>
			</td>
		</tr>
		<tr>
			<td>Add minimum of Rs.500 to create account </td>
			<td><input type='number' name='bal' required></td>
		</tr>
		<tr>
			<td colspan='2'><input style='background-color: #4CAF50;' type='submit' name='create1' value='Create'></td>
		</tr>
	</table>
	</form>";
  }

?>
<?php 
  if(isset($_POST['create1']))
  {
	$accno=0;
	$name=" ";
	$address=" ";
	$type="";
	$bal=0;
	
	$mysql=new mysqli("localhost","root","","awt");
	if(!$mysql) 
	{
		die("ERROR!!!");
	}

	$accno=$_POST['acc_num'];
	$name=$_POST['name'];
	$address=$_POST['address'];
	$type=$_POST['type'];
	$bal=$_POST['bal'];
	
		if($_POST['bal']<500)
			echo '<script>alert("To create account deposit minimun of Rs.500 ")</script>';
		else
		{
		$sql="INSERT INTO customer(accno,name,address,type,bal)values($accno,'$name','$address','$type',$bal)";
		}
		if(mysqli_query($mysql,$sql))
		{
		
			echo '<script>alert("Account created. ")</script>';
	
		}
		else
		{
		echo '<script>alert("Failed to create account!!! ")</script>';
		}	
		
	}
?>

<?php
  if(isset($_POST['deposit']))
  {	
	echo"<div class='w3-blue'><h2>Deposit Amount</h2></div>";  
	echo"<form method='post'>";
	echo"Enter the account number<br>";
	echo"<input type='number' name='acno' required><br><br>";
	echo"Enter amount to be deposited<br>";
	echo"<input type='number' name='amt' required>&nbsp";
	echo"<input type='submit' style='background-color: #4CAF50;' name='submit' value='OK'></form>";
  }
?>

<?php
  if(isset($_POST['submit']))
  {
	$mysql=new mysqli("localhost","root","","awt");
	if(!$mysql) 
	{
		die("ERROR!!!");
	}
	
	$amt=$_POST['amt'];
	$acno=$_POST['acno'];

	$no=" select bal from customer where accno=$acno";
	$res=$mysql->query($no);
	$i=mysqli_num_rows($res);

	if($i>0)
	{
	
	while($row=$res->fetch_array())
	{
		$amt1=$row[0];
	}
	if($amt<0)
	{
		echo '<script>alert("Please enter correct amount")</script>';
	}
	else
	{
	$amt=$amt+$amt1;
	$newbal="update customer set bal=$amt where accno=$acno";
	if(mysqli_query($mysql,$newbal))
		{
		
			echo '<script>alert("Amount deposited.")</script>';
	
		}
		else
		{
		echo '<script>alert("Something went wrong!!! ")</script>';
		}	
	}
	}
	else
	{
		echo '<script>alert("No such account exists!!")</script>';
	}
	
}			
?>

<?php

  if(isset($_POST['withdraw']))
  {
	echo"<div class='w3-blue'><h2>Withdraw Amount</h2></div>";  
	echo"<form method='post'>";
	echo"<br>Enter the account number <br>";
	echo"<input type='number' name='acno' required><br><br>";
	echo"Enter amount to withdraw<br>";
	echo"<input type='number' name='amt' required>&nbsp";
	echo"<input type='submit' name='submit1'style='background-color: #4CAF50;' value='OK'></form>";
  }
?>

<?php

if(isset($_POST['submit1']))
  {
	$mysql=new mysqli("localhost","root","","awt");
	if(!$mysql) 
	{
		die("ERROR!!!");
	}
	$amt=$_POST['amt'];
	$acno=$_POST['acno'];
	$no=" select bal from customer where accno=$acno";
	$res=$mysql->query($no);
	$i=mysqli_num_rows($res);
	if($i>0)
	{
	while($row=$res->fetch_array())
	{
		$amt1=$row[0];
	}
	if($amt<0)
	{
		echo '<script>alert("Please enter correct amount")</script>';
	}
	else if($amt>$amt1)
	{
		echo '<script>alert("Insufficient amount")</script>';
	}
	else if($amt1-$amt<500)
	{
		echo '<script>alert("Maintain minimum of Rs.500")</script>';
	}
	else
	{
		$amt1=$amt1-$amt;
		$newbal="update customer set bal=$amt1 where accno=$acno";
	if(mysqli_query($mysql,$newbal))
		{
			echo '<script>alert("Amount withdrawal successfull.")</script>';
		}
		else
		{
		echo '<script>alert("Something went wrong!!! ")</script>';
		}	
	}
	}
	else
	{
		echo '<script>alert("No such account exists!!")</script>';
	}
}
?>	

<?php

  if(isset($_POST['enquiry']))
  {
    echo"<div class='w3-blue'><h2>View Balance</h2></div>";
	echo"<form method='post'>";
	echo"<br>Enter the account number<br>";
	echo"<input type='number' name='acno' required><br><br>";
	echo"<input type='submit' name='submit2' style='background-color: #4CAF50;' value='OK'></form>";
  }
?>

<?php
  if(isset($_POST['submit2']))
  {
	$mysql=new mysqli("localhost","root","","awt");
	if(!$mysql) 
	{
		die("ERROR!!!");
	}
	$acno=$_POST['acno'];
	$no=" select name,bal from customer where accno=$acno";
	$res=$mysql->query($no);
	$i=mysqli_num_rows($res);
	
	if($i>0)
	{
	while($row=$res->fetch_array())
	{
		$name1=$row[0];
		$balance=$row[1];
	}
	echo"<br><center><table>
		<tr><th border='2' colspan='2' style='text-decoration:underline;'>Customer Account Details</th></tr>
		
		<tr><td>Name    </td><td>$name1</td></tr>
		
		<tr><td>Balance </td><td>$balance</td>
		</table></center>";
	}
	else
	{
		echo '<script>alert("No such account exists!!")</script>';
	}
}
?>		
</body>
</html>