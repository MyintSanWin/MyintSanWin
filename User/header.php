<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Online Book Sale</title>
<link rel="stylesheet" type="text/css" href="user_style.css"/>
</head>

<body>
	<div id="wrapper">
	<div id="header">
		<div id="logo">
        	<h1><a href="#">Online Book Sale</a></h1>
            <h2>Designed by YarZarLin </h2>
		</div>
        <div id="menu">
          	<ul>
          	  <?php
			  	if(@$_SESSION['user']['custname']!="")
				{
					
			  ?>
              <li class="active"><a href="index.php">Home</a></li>
              <li><a href="#">Order</a></li>
          	  <li><a href="#">FeedBack</a></li>
          	  <li><a href="#">ContantUs</a></li>
              <li><a href="order.php">Order</a></li>
          	  <li><a href="logout.php">Logout</a></li>
              <?php
				}
				else
				{
					
			  ?>
              <li class="active"><a href="index.php">Home</a></li>
          	  <li><a href="Login.php">Login</a></li>
          	  <li><a href="Register.php">Register</a></li>
          	  <li><a href="#">Feedback</a></li>
          	  <li><a href="#">ContantUs</a></li>
              <li><a href="order.php">Order</a></li>
              <li><a href="logout.php">Logout</a></li>
              <?php
				}
			  ?>
       	  </ul>
   	  </div>
	</div>
</div>
</body>
</html>