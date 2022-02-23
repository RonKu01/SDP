   <?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	if (isset($_SESSION["management_login"])) {
	} else {
		header("location: ../../login.php");
	}

?>


 <!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Feedback History</title>
		<link href = "../management.css" rel = "stylesheet">
		<script src = "../jvscript.js"></script>
		<script src = "../jvscript2.js"></script>
	
	<style>
		th {
		style='width:auto';
		}
	</style>
		
	
	</head>
	
	<body>
<div class ="btn">
				<span class ="fas fa-bars"></span>
				</div>
				
				<nav class = "sidebar">
					<div class ="text">MG Academy</div>
					<ul>
						<li><a href ="../management_home.php">Homepage</a></li>
						<li><a href='../profile/manage_profile.php'>Manage Profile</a></li>
						<li><a href='../attendance/attendance_class.php'>Class Attendance Record</a></li>
						<li><a href='../attendance/attendance_student.php'>Student Attendance Record</a></li>
						<li>
				<a href="#" class ="feed-btn">Feedback
					<span class="fas fa-caret-down second"></span>
				</a>
					<ul class="feed-show">
					<li><a href="feedback.php">Feedback Review</a></li>
					<li><a href="#">View Feedback History</a></li>
				</ul>
				</li>
						<li><a href="../../logout.php">Logout</a></li>
					</ul>
				</nav>
		
				<script>
		$('.btn').click(function(){
			$(this).toggleClass("click");
			$('.sidebar').toggleClass("show");
		});
		

		$('.feed-btn').click(function(){
			$('nav ul .feed-show').toggleClass("show1");
			$('nav ul .first').toggleClass("rotate");
		});
		$('nav ul li').click(function(){
			$(this).addClass("active").siblings().removeClass("active");
		});
			
		</script>	
	
		<div class = "box">
				<h2>Feedback History</h2>
	
			<div class='scroll-table' style="height:auto">
			<table border = 1 style = 'table-layout:fixed; text-align: center; max-width: 400px; width:1200px; font-size: 20px'>
				<tr bgcolor = 'f8fca2'>
					<th width="40px">ID</th>
					<th width="70px">LecturerID</th>
					<th width="200px">Bug</th>
					<th width="200px">Details</th>
					<th width="100px">Created At</th>
					<th width="100px">Respond from Admin</th>
				</tr>
							
				<?php
				$path = $_SERVER['DOCUMENT_ROOT'];
				$path .="/sdp/db_connection.php";
				include_once($path);
							
				$Staff_ID = $_SESSION["Staff_ID"];
							
				$sql = "Select * from feedback where Staff_ID='".$Staff_ID."'";
				$result = $conn ->query($sql);
							
				if (!empty($result) && $result->num_rows > 0) {
					for ($i = 0; $i < mysqli_num_rows($result); $i++){
						$row  = mysqli_fetch_assoc($result);
						echo '<tr>';
						echo '<td>'.$row['ID'].'</td>';
						echo '<td>'.$row['Staff_ID'].'</td>';
						echo '<td>'.$row['Bug'].'</td>';
						echo '<td style="word-wrap: break-word">'.$row['Details'].'</td>';
						echo '<td width="200px">'.$row['Created_At'].'</td>';
						echo '<td style="word-wrap: break-word">'.$row['Admin_Reply'].'</td>';										
					}
					mysqli_free_result($result);
				}
				mysqli_close($conn);
				?>
							
			</table>
			</div>
		</div>
	</body>
</html>



			