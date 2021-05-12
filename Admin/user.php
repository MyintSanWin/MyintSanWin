<?php
		require_once('conn.php');
		
		if (isset($_REQUEST['btnsave'])) 
		{
			$username=$_REQUEST['txtusername'];
			$Password=$_REQUEST['txtpassword'];
			$usertype=$_REQUEST['Cbousertype'];


			if (empty($username)) 
				$msg="Please Enter user name";
			elseif(empty($Password))
				$msg="Please Enter user password";
			elseif ($usertype=="0") 
				$msg="Please choose user type";
			else
			{
				$query=$conn->query("select * from user where userName='$username' and password='$Password'") or die("Can't select");
				$num=mysqli_num_rows($query);
				if ($num>0) 
				{
					$msg="This record is already exist";
				}
				elseif($username!=$Password)
				{
					$query=$conn->query("insert into user(userName, password, userType) values('$username', '$Password', '$usertype')");
					if($query)
					{
						$msg="Save data successfully";
					}
				}
				else
				{
					$msg="User name and password must not same";
				}
			}
		}
		?>
		
<!DOCTYPE html>
<html>
<head>
	<title>User</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background-color:grey;">
	<?php
	require_once('header.php');
	?>
	
	<div id="page">
		<div id="content">
			<h3>
				<strong style="color:blue;">Welcome to</strong>
				<?php
				if(!empty($_SESSION['uname']))
					echo "<font color='blue'>".$_SESSION['uname']."</font>";
				?>
			</h3>
			<?php
				if(!empty($msg))
					echo "<font color='red'>".$msg."</font>";
			?>
	
			<form name="user" action="#" method="post">
				<table  id="content" style="background-color:#0F0;" >
					<tr>
						<th colspan="2" style="background-color: green;">New User</th>				
					</tr>
					<tr>
						<td>User Name</td>
						<td><input type="text" name="txtusername" width="30"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="text" name="txtpassword" width="30"></td>
					</tr>
					<tr>
						<td>User Type</td>
						<td>
							<select name="Cbousertype">
								<option value="0">---Select---</option>
								<option value="administrator">Administrator</option>
								<option value="user">User</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="right" ><input type="reset" name="reset" value="Cancel"><input type="submit" name="btnsave" value="Save"></td>
						
					</tr>
				</table>
			</form>
		</div>
	</div>
	<div id="footer">
		&copy;2020 YourSite. Design by Laravel Development Member.
	</div>
</body>

</html>