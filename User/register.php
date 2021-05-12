<?php
require_once("conn.php");
$msg="";
if(isset($_REQUEST['btnsubmit']))
{
	$fname=$_REQUEST['txtfirstname'];
	$lname=$_REQUEST['txtlastname'];
	$email=$_REQUEST['txtemail'];
	$pass=$_REQUEST['txtpassword'];
	$cpass=$_REQUEST['txtcpassword'];
	$add=$_REQUEST['txtaddress'];
	$gender=$_REQUEST['rdo'];
	$dob=$_REQUEST['txtdate'];
	if (empty($fname)) 
		$msg="Please Fill First Name";
	else if (empty($lname)) 
		$msg="Please Fill Last Name";
	else if (empty($email)) 
		$msg="Please Fill Email";
	else if (empty($pass)) 
		$msg="Please Fill Password";
	else if (empty($cpass)) 
		$msg="Please Fill Confirm Password";
	else if ($pass!=$cpass) 
		$msg="Did not match Password";
	else if (empty($add)) 
		$msg="Please Fill Address";
	else
	{ 	
		$query=$conn->query("Select * from customer where firstName='$fname' and lastName='$lname' and email='$email'")or die("Can't Select Record");
		$num=mysqli_num_rows($query);
		if ($num>0) 
			$msg="You name and email is already exist!";
		else
			$query=$conn->query("insert into customer(firstName,lastName,email,password,address,gender,Dob)values('$fname','$lname','$email','$pass','$add','$gender','$dob')") or die("Cann't Insert Record!");
		 if(!empty($query))
		 	$msg="Congratulations Your Sign Up!";
		 
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title> User Register</title>
	<link rel="stylesheet" type="text/css" href="user_style.css">
</head>
<body>
	<?php
	require_once("header.php");
	if(@$_SESSION['user']['custname']!="")
	{
		echo 'Welcome to:<font color="red">'.@$_SESSION['user']['custname'].'</font>';
	}
	?>
	<div id="page">
	<?php
	include('sidebar.php');
	?>
	<div id="content">
		<div id="title">
			<h2>Register Here</h2>
		</div>
	<?php
	if ($msg!="") 
	{
		echo '<font color="red">'.$msg.'</font>';
	}

	?>
<form action="#" name="Register" method="post">
	<table>
		<tr>
			<td colspan="2" style="background-color:grey; text-align: center;">New Register
			</td>		
		</tr>
		<tr>
			<td style="color:brown; font-style: italic;">
				First Name
			</td>
			<td>
				<input type="text" name="txtfirstname" char width="30">
			</td>
		</tr>
		<tr>
			<td style="color:brown; font-style: italic;">
				Last Name
			</td>
			<td>
			<input type="text" name="txtlastname" char width="30">
			</td>
		</tr>
		<tr>
			<td style="color:brown; font-style: italic;">
				Email
			</td>
			<td>
				<input type="Email" name="txtemail" char width="30">
			</td>
		</tr>
		<tr>
			<td style="color:brown; font-style: italic;">
				Password
			</td>
			<td>
				<input type="password" name="txtpassword" char width="30">
			</td>
		</tr>
		<tr>
			<td style="color:brown; font-style: italic;">
				Confirm Password
			</td>
			<td>
				<input type="password" char width="30" name="txtcpassword">
			</td>
		</tr>
		<tr>
			<td style="color:brown; font-style: italic;">
				Address
			</td>
			<td>
				<input type="text" char width="30" name="txtaddress">
			</td>
		</tr>
		<tr>
			<td>
				<input type="radio" name="rdo" value="Male" checked="checked">Male
				<input type="radio" value="Female" checked="checked" name="rdo">Female
			</td>
		</tr>
		<tr>
			<td style="color:brown; font-style: italic;">
				Date
			</td>
			<td>
				
						<input type="date" name="txtdate" /> 
					
			</td>
		</tr>
		<tr>
			<td colspan="2">
			<input type="submit" value="Sign Up" name="btnsubmit">
			</td>
		</tr>
	</table>
</form>
</div>
</div>
<div style="clear:both"></div>
<?php
require("footer.php");
?>
</body>
</html>