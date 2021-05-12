<?php
session_start();
require_once("conn.php");

?>


<!DOCTYPE html>
<html>
<head>
	<title>Online Book Sale</title>
</head>
<link rel="stylesheet" type="text/css" href="user_style.css">
<body>
	<?php
	require_once("header.php");
	if (!empty($_SESSION['email'])) 
	{
		$Email=$_SESSION['email'];
		$name=$conn->query("select firstName, lastName from customer where email='$Email'");
			//$num=mysqli_num_rows($query);
		$row=mysqli_fetch_array($name);
		echo "<strong><u>Welcome to user </u></strong> " . $row['firstName']."".$row['lastName'];
	}

	?>
	<div id="page">
		<?php
		if (!empty($msg)) {
			echo $msg;
		}
		?>
		<?php
			require_once('sidebar.php');
		?>
		<div id="content">
			<div id="title">
				<h2><b id="search">Book List</b></h2>
			</div>
			<?php
				if(!empty($_REQUEST['sid']))
				{
					$subid=$_REQUEST['sid'];
					$query=$conn->query("Select * from book where subjectid=$subid");
				}
				if(empty($_REQUEST['sid']))
				$query=$conn->query("Select * from book")or die("Can't Select");
				if (mysqli_num_rows($query)>0)
				{
					while($row=mysqli_fetch_array($query))
					{
						$bname=$row['BookName'];
						$aname=$row['AuthorName'];
						$price=$row['SalePrice'];
						$photo=$row['Photo'];
			?>
						<div id="item">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td colspan="2">
										<img src="../Photo/<?php echo $photo; ?>" width="150" height="120"/>
									</td>
								</tr>
								<tr style="line-height: 3">
									<td>Book Name</td>
									<td><?php echo $bname; ?></td>
								</tr>
								<tr style="line-height: 3">
									<td>AuthorName</td>
									<td><?php echo $aname; ?></td>
								</tr>
								<tr style="line-height: 3">
									<td>Price</td>
									<td><?php echo $price; ?></td>
								</tr>
								
							</table>
						</div>
						<?php
					}
				}
				else
				{
					echo '<font color="red">No Record in Database</font>';
				}
			?>
		</div>
	</div>
<div style="clear: both"></div>
<?php
require_once("footer.php");
?>

</body>
</html>