 <?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	if (isset($_SESSION["student_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
?>


 <!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Feedback</title>
		<link rel = "stylesheet" href ="../Student.css">
		<script src = "../jvscript.js"></script>
		<script src = "../jvscript2.js"></script>
	</head>
	
	<body class = "table-history">
		<div class ="btn">
			<span class ="fas fa-bars"></span>
		</div>
		
		<nav class = "sidebar">
			<div class ="text">MG Academy</div>
			
			<ul>
				<li><a href ="../student_home.php">Home</a></li>
				<li><a href="../take_attendance.php">Take Attendance</a></li>
				<li><a href='../profile/manage_profile.php'>Manage Profile</a></li>
				<li><a href='../attendance/attendance_home.php'>Attendance Details</a></li>
				<li>
					<a href="#" class ="nav-extend-btn">Feedback
					<span class="fas fa-caret-down first"></span>
				</a>
					<ul class="nav-extend-show">
					<li><a href='../feedback/feedback.php'>Feedback</a></li>
					<li><a href="../feedback/feedback_history.php">View Feedback History</a></li>
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
		
			$('.nav-extend-btn').click(function(){
				$('nav ul .nav-extend-show').toggleClass("show");
				$('nav ul .first').toggleClass("rotate");
			});
			$('nav ul li').click(function(){
				$(this).addClass("active").siblings().removeClass("active");
			});
			
		</script>	
	
		<div class ="box" style="1000px">
			<pre><h2>Feedback History</h2></pre>
			
			<div class='scroll-table' style="height:auto; max-height:600px;">
				<table border = "1">
			
				<table border = 1 style =' font-size:20px; align: center; width: 1000px'>
					<tr bgcolor = 'f8fca2'>
						<th style = "line-height:50px; width:50px;">ID</th>
						<th style = "line-height:50px">StudentTP</th>
						<th style = "line-height:50px">Bug</th>
						<th style = "line-height:50px">Details</th>
						<th style = "line-height:50px">Created At</th>
						<th style = "line-height:50px">Respond from Admin</th>
					</tr>
			
			<?php
			$path = $_SERVER['DOCUMENT_ROOT'];
			$path .="/sdp/db_connection.php";
			include_once($path);
			
			$StudentTP = $_SESSION["StudentTP"];
			
			$sql = "Select * from feedback where StudentTP='".$StudentTP."'";
			$result = $conn ->query($sql);
			
			if (!empty($result) && $result->num_rows > 0) {
				for ($i = 0; $i < mysqli_num_rows($result); $i++){
					$row  = mysqli_fetch_assoc($result);
					echo '<tr>';
					echo '<td>'.$row['ID'].'</td>';
					echo '<td>'.$row['StudentTP'].'</td>';
					echo '<td>'.$row['Bug'].'</td>';
					echo '<td style="word-wrap: break-word">'.$row['Details'].'</td>';
					echo '<td >'.$row['Created_At'].'</td>';
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