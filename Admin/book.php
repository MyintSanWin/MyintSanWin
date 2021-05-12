<?php
	require_once('conn.php');
	if(isset($_REQUEST['btnsave']))
	{
		$bname=$_REQUEST['txtbookname'];
		$sname=$_REQUEST['cbosubject'];
		$aname=$_REQUEST['txtauthorname'];
		$ino=$_REQUEST['txtisbnno'];
		$sp=$_REQUEST['txtsaleprice'];
		$photo=$_FILES['photo']['name'];

		if(empty($bname))
			$msg="Please Enter Book Name";

		elseif($sname == "0")
			$msg="Please Choose Subject Name";

		elseif(empty($aname))
			$msg="Please Enter Author Name";

		elseif(empty($ino))
			$msg="Please Enter ISBN No";

		elseif(empty($sp))
			$msg="Please Enter Sale Price";

		elseif(empty($photo))
			$msg="Please Choose Photo";

		else
		{
			$query=$conn->query("Select * from book where BookName='$bname' and SubjectId='$sname' and AuthorName='$aname'")or die("Cann't Select");
			$num=mysqli_num_rows($query);
			if($num>0)
			{
				$msg="This Book is already exist";
			}
			else
			{
				$query=$conn->query("insert into book(BookName,SubjectId, AuthorName, Lsbn_no, SalePrice, Photo)values('$bname','$sname','$aname','$ino','$sp','$photo')")or die("Cann't insert");
				if($query)
				{
					move_uploaded_file($_FILES["photo"]["tmp_name"],"../Photo/".$photo);
					$msg="Save Successful Record";
				}
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
					echo "<font color='blue'>".$msg."</font>";
			?>
	
			<form name="book" action="#" method="post" enctype="multipart/form-data" style="width:800px; height: 300px;">
				<table  id="content" border ="2" style="background-color:#0F0;" >
					<tr>
						<td colspan="2" style="background-color:green; text-align: center;">New Book</td>		
					</tr>
					<tr>
						<td style="color:green;">Book Name</td>
						<td><input type="text" name="txtbookname" width="30"></td>
					</tr>
					<tr>
						<td style="color:green;">Subject Name</td>
						<td>
							<select name="cbosubject">
								<option value="0">---Select One---</option>
								<?php
									$query=$conn->query("Select * from subject")or die("Cann't Select");
									while($row=mysqli_fetch_array($query))
									{
										$sid=$row["SubjectId"];
										$sname=$row["SubjectName"];
										echo'<option value="'.$sid.'">'.$sname.'</option>';
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td style="color:green;">Author Name</td>
						<td><input type="text" name="txtauthorname" width="30"></td>
					</tr>
					<tr>
						<td style="color:green;">ISBN No</td>
						<td><input type="text" name="txtisbnno" width="30"></td>
					</tr>
					<tr>
						<td style="color:green;">Sale Price</td>
						<td><input type="text" name="txtsaleprice" width="30"></td>
					</tr>
					<tr>
						<td style="color:green;">Photo</td>
						<td><input type="file" name="photo"></td>
					</tr>
					<tr>
						<td colspan="2" align="right" ><input type="reset" name="btncancel" value="Cancel" class="box"><input type="submit" name="btnsave" value="Save" class="box"></td>
						
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