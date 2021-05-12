	<?php
	session_start();
		require_once('conn.php');
		if(isset($_REQUEST['btnLogin']))
		{
			$email=$_REQUEST['txtemail'];
			$pass=$_REQUEST['txtpassword'];
			if(empty($email))
			$msg="Please Fill Email";
			else if(empty($pass))
			$msg="Please Fill Password";
			else
			{
				$_SESSION['email'] = $email;
				$query=$conn->query("Select * From customer where email='$email' and password='$pass'")or die("Cann't Select Record");
				$num=mysqli_num_rows($query);
				
				if($num>0)
				{
					while($row=mysqli_fetch_array($query))
					 {
						// $_SESSION['user']['custname'] = array('custid'=>$row['customerID'],'custname'=>$row['firstName']." ".$row['lastName']);
						 
						
					 	 echo'<script language="javascript">window.location.href="index.php";</script>';
					// var_dump($row['customerID']);
					// var_dump($row['firstName']); 
					// var_dump($row['lastName']);
					 
					}
				
				}
				else
				{
					$msg="Your email and password is invaild";
				}
			}
		}
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Online Book Sale</title>
<link rel="stylesheet" type="text/css" href="user_style.css"/>
</head>

<body>
	<?php 
		require_once('header.php');
	?>
	<div id="page">
	<?php
		require_once('sidebar.php')
	?>
	<div id="content">
	<h1><?php if(!empty($_SESSION['username']))echo 'Welcome to<font color="red">'.$_SESSION['username'].'</font>';?></h1>
	<?php
	if(!empty($msg))
	echo '<font color="red">'.$msg.'</font>';
	?>
    
    <form action="#" method="post" name="Login">
    	<table width="100%" border="5" cellspacing="10" cellpadding="10">
  <tr>
    <td colspan="2" class="headerbg">Login</td>
    </tr>
  <tr>
    <td>Email</td>
    <td><input name="txtemail" type="text" char width="30" /></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><input name="txtpassword" type="password" char width="30" /></td>
  </tr>
  <tr>
    <td colspan="2"><input name="btnLogin" type="submit" value="Login"class="box" /></td>
    </tr>
</table>
    </form>
    </div>
    </div>
    <div style="clear:both"></div>
    <?php
        require_once("footer.php");
    ?>
</body>
</html>