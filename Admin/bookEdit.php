<?php
require_once('conn.php');
if (isset($_REQUEST['ebid'])) 
{
	$edit_bid=$_REQUEST['ebid'];
	 // print_r($edit_bid);
	$query=$conn->query("select * from book where BookId=".$edit_bid) or die("cannot select");
	 $row=mysqli_fetch_array($query);
	 $old_photo=$row['Photo'];
	 $old_bname=$row['BookName'];
	 $old_subjectid=$row['SubjectId'];
	 $old_ino=$row['Lsbn_no'];
	$old_aname=$row['AuthorName'];
	 $old_sp=$row['SalePrice'];
	

}
?>
<?php
if (isset($_REQUEST['btnedit'])) 
{
	$bname=$_REQUEST['txtbookname'];
	$sname=$_REQUEST['cbosubject'];
	$aname=$_REQUEST['txtauthorname'];
	$ino=$_REQUEST['txtisbnno'];
	$sp=$_REQUEST['txtsaleprice'];
	$photo=$_FILES['photo']['name'];
	if (empty($bname)) 
		$msg="Please enter book name";
		elseif($sname=="0")
			$msg="Please choose subject name";
		elseif (empty($aname)) 
			$msg="Please enter author name";
		elseif (empty($ino)) 
			$msg="Please enter Isbn no";
		elseif (empty($sp)) 
			$msg="Please enter sale price";
		else
		{
			{
				if (empty($photo))
				{
					$query=$conn->query("update book set BookName='$bname', SubjectId='$sname', AuthorName='$aname', Lsbn_no='$ino', SalePrice='$sp' where BookId='$edit_bid'") or die("cannot update");
					if ($query) 
					{
						$msg="update successfully record";

					}
				}
				else
				{
					$query=$conn->query("update book set BookName='$bname', SubjectId='$sname', AuthorName='$aname', Lsbn_no='$ino', SalePrice='$sp', Photo='$photo' where BookId='$edit_bid'") or die("cannot update");
					if ($query)
					 {
						move_uploaded_file($_FILES["photo"] ["tmp_name"], "../Photo/".$photo);
						$msg="Update successfully record ";
					}
				}
				echo '<script language="javascript">window.location.href="booklist.php"</script>';
			}
		}
			
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Online Book Sale</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
require_once('header.php');

?>
<div id="page">
	<div id="content">
		<h3 style="color:blue;">Welcome To 
			<?php
			if (!empty($_SESSION['uname'])) {
				echo "<font color='blue'>".$_SESSION['uname']."</font>";
			}
			?>
			</h3>
			<?php
			if (!empty($smg)) {
				echo "<font color='blue'>".$smg."</font>";
			}
			?>
			<form action="#" method="post" enctype="multipart/form-data" name="BookEdit">
				<table width="60%" border="2" cellspacing="10" cellpadding="10">
					<tr>
						<td colspan="3" class="headerbg">
							BOOK EDIT
						</td>
					</tr>
					<tr>
						<td>
							Book Name
						</td>
						<td>
							<input type="text" char width="30" value="<?= $old_bname;?>" name="txtbookname">
						</td>
					
						<td rowspan="3">
						Photo
						</td>
					</tr>
					<tr>
						<td>
							Sbuject Name
						</td>
						<td>
							<select name="cbosubject" id="cbosubject">
								<?php
								echo '<option value="0">---select---</option>';
								$query=$conn->query("select * from subject") or die("cannot select");
								while ($row=mysqli_fetch_array($query)) 
								{
									$sid=$row['SubjectId'];
									$sname=$row['SubjectName'];
									if (($sid==$old_subjectid)) 
									{										echo '<option selected="selected" value="'.$sid.'">'.$sname.'</option>';
									}

										else
											echo '<option value="'.$sid.'">'.$sname.'</option>';

										
									
								}
								?>
							 </select>
						</td>
					</tr>
					<tr>
						<td>
							Author Name
						</td>
						<td>
							<input type="text" value="<?= $old_aname;?>" name="txtauthorname">
						</td>
					</tr>
					<tr>
						<td>
							ISBN No.
						</td>
						<td>
							<input type="text" name="txtisbnno" value="<?= $old_ino;?>">
						</td>
						<td rowspan="3">
							<img src="../Photo/<?= $old_photo;?>" width="80" height="74">
						</td>
					</tr>
					<tr>
						<td>
							Sale Price
						</td>
						<td>
							<input type="text" value="<?= $old_sp;?>" char width="30" name="txtsaleprice">
						</td>
					</tr>
					<tr>
						<td>
							Photo
						</td>
						<td>
							<input type="file" id="photo" name="photo">
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<input type="submit" value="Edit" class="box" name="btnedit">
							<input type="reset" value="Cancel" class="box" name="btncancel">
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