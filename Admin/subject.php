<?php
		require_once('conn.php');
		
		if (isset($_REQUEST['btnsave'])) 
		{
			$subject=$_REQUEST['txtsubj'];
			// $Password=$_REQUEST['txtpassword'];
			// $usertype=$_REQUEST['Cbousertype'];


			if (empty($subject)) 
				$msg="Please Enter subject name";
			// elseif(empty($Password))
			// 	$msg="Please Enter user password";
			// elseif ($usertype=="0") 
			// 	$msg="Please choose user type";
			else
			{
				$query=$conn->query("select * from subject where SubjectName='$subject'") or die("Can't select");
				$num=mysqli_num_rows($query);
				if ($num>0) 
				{
					$msg="This record is already exist";
				}
				elseif($subject!="")
				{
					$query=$conn->query("insert into subject(SubjectName) values('$subject')");
					if($query)
					{
						$msg="Save data successfully";
					}
				}
				else
				{
					$msg="Subject Name must not be null";
				}
			}
		}
		?>
		

<!DOCTYPE html>
<html>
<head>
	<title>Subject</title>
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
	
<form action="#" method="post" style="width:800px;">
	<table bgcolor="#0F0" border="1px" >
		<tr>
			<td colspan="2" style="text-align: center; background-color: green;">
					NEW SUBJECT
			</td>
		</tr>
			<tr>
				<td style="text-align: center;">
					Subject Name
				</td>
				<td>
					<input type="text" placeholder="enter subject name" name="txtsubj">
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" value="Insert" name="btnsave">
					<input type="reset" value="Cancel" name="btnCancel">
				</td>
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