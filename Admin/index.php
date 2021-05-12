<?php
	require_once('conn.php');
	if (isset($_REQUEST['btnlogin'])) {
		$username=$_REQUEST['txtName'];
		$password=$_REQUEST['txtpassword'];
		$usertype=$_REQUEST['Cbousertype'];
		if (empty($username)) 
			$msg="Please enter username";
		elseif (empty($password))
			$msg="Please enter userpassword";
		elseif($usertype="0")
		
			$msg="Please choose user type";
		else
		{
			$query=$conn->query("select * from user where userName='$username' and password='$password'") or die("can't select");
			$num=mysqli_num_rows($query);
			if ($num>0) 
			{
				$_SESSION['uname']=$username;


				  echo '<script language="javascript">window.location.href="user.php"</script>';
				
				// echo "user name is ". $_SESSION['uname'];
				// require_once('user.php');
			}
			else
			{
				$msg="username and password is invald , please try agin";
			}
		}
	}

	?>



<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
</head>
<link rel="stylesheet" type="text/css" href="style.css">
<body style="background-color: grey;">
<div id="page">
	<div id="content">
		<?php
		if (!empty($msg)) {
			echo "<font color='red'>".$msg."</font>";
		}

		?>
<form action="#" method="post" style="background-color:#0F0;">
	<table border="1px;" style="width: 800px; height: 300px;">
		<tr >
			<td style="background-color:green; text-align:center;" colspan="2">
				LOGIN
			</td>
			
		</tr>
		<tr>
			<td>
				User Name:
			</td>
			<td>
				<input type="text" name="txtName" placeholder="Enter user name">
			</td>
		</tr>
		<tr>
			<td>
				Password:
			</td>
			<td>
				<input type="password" name="txtpassword" placeholder="Enter Password">
			</td>
		</tr>
		<tr>
			<td>
			User Type:
			</td>
			<td>
				<select  name="Cbousertype">
					<option value="0">---Select---
					</option>
					<option value="Administrator" >
						Administrator
					</option>
					<option value="User" >
						User
					</option>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" value="Login" name="btnlogin" style="padding: 10px;">
				<input type="reset" value="Cancel" name="btncalcel" style="padding: 10px;">
			</td>
		</tr>
	</table>
</form>
</div>
</div>
</body>
</html>