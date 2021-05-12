<?php
	require_once('conn.php');
	if(isset($_REQUEST['dbid']))
	{
		$delete_bid=$_REQUEST['dbid'];

		$query=$conn->query("delete from book where bookid=".$delete_bid)or die("Cann't Delete");
			if($query)
				{
					$msg="Delete Successfully ";
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
			<table width="900px">
				<tr class="headerbg">
					<td colspan="7" style="text-align: center; font-variant: small-caps; color: white; background-color: green;">Book List</td>
				</tr>
				<tr>
					<td width="90" style="background-color:green; color: white;">Photo</td>
					<td width="88" style="background-color:green; color: white;">Book Name</td>
					<td width="141" style="background-color:green; color: white;">Subject Name</td>
					<td width="131" style="background-color:green; color: white;">Author Name</td>
					<td width="80" style="background-color:green; color: white;">ISBN No</td>
					<td width="104" style="background-color:green; color: white;">Sale Price</td>
					<td width="150" style="background-color:green; color: white;">Action</td>
				</tr>
				<?php
				$query=$conn->query("Select * from book,subject where book.SubjectId=subject.SubjectId") or die("Cann't Select");
				while($row=mysqli_fetch_array($query))
					{
							$photo=$row["Photo"];
							$bname=$row["BookName"];
							$sname=$row["SubjectName"];
							$aname=$row["AuthorName"];
							$ino=$row["Lsbn_no"];
							$sp=$row["SalePrice"];
							$bid=$row["BookId"];
				
							echo "<tr bgcolor='#0F0'>
							<td><img src='../photo/$photo' width='100' height='100'/></td>
							<td> $bname </td>
							<td> $sname </td>
							<td> $aname </td>
							<td> $ino </td>
							<td> $sp </td>
							<td>
								<a href='bookedit.php?ebid=$bid'><strong>Edit</strong></a>
								<a href='bookedit.php?ebid=$bid'><img src='images/_DIT2.PNG' width='16' height='16'/></a>
								<a href='booklist.php?dbid=$bid'><strong>Delete</strong></a>
								<a href='booklist.php?dbid=$bid'><img src='images/_EL.PNG' width='18' height='19'/></a>
							</td>
						</tr>";
					}
					?>
			</table>
			
		</div>
	</div>
	<div id="footer">
		&copy;2020 YourSite. Design by Laravel Development Member.
	</div>
</body>
</html>