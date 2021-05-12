<?php

require("conn.php");
?>
<div id="sidebar">
	<ul>
		<li>
			<h2>
				<b id="search">Subject List</b>
			</h2>
			<ul>
				<?php
				$query=$conn->query("Select * from subject") or die("cannot select");
				while ($row=mysqli_fetch_array($query))
				{
					$sid=$row['SubjectId'];
					$subname=$row['SubjectName'];
					echo "<li><a href='index.php?sid=$sid'>$subname</a></li>";
				}
				?>
			</ul>
		</li>
	</ul>
	</div>