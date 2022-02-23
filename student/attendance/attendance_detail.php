 <?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	
	if (isset($_SESSION["student_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	
	$StudentTP = $_SESSION['StudentTP'];
	
	$ClassID = isset($_GET['ClassID']) ? $_GET['ClassID'] : '';

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Attendance Details</title>
		<link rel = "stylesheet" href ="../Student.css">
		<script src = "../jvscript.js"></script>
		<script src = "../jvscript2.js"></script>
	</head>
	
	<body class  = "table-history">
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
				<li><a href="../logout.php">Logout</a></li>
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
		
		<div class="box">
			<pre><h2 class ="title_2">Attendance Details                  </h2></pre>
			
			<div class='scroll-table' style="height:auto;max-height:600px;">
				<table border = "1" style="width:1000px;">
				
			
					<tr bgcolor = 'f8fca2'>
						<th style = "line-height:50px">StudentTP</th>
						<th style = "line-height:50px">ClassID</th>
						<th style = "line-height:50px">CourseID</th>
						<th style = "line-height:50px">ModuleID</th>
						<th style = "line-height:50px">Date</th>
						<th style = "line-height:50px">Start Time</th>
						<th style = "line-height:50px">End Time</th>
						<th style = "line-height:50px">Status</th>					
					</tr>
					
					<?php

					$sql = "Select * from attendance_detail inner join attendance on attendance_detail.AttendanceID = attendance.AttendanceID inner join class on class.ClassID = attendance.ClassID WHERE `StudentTP` = '".$StudentTP."' AND attendance.ClassID = '".$ClassID."' ORDER BY ID DESC";
					
					$result = $conn ->query($sql);
			
					if (!empty($result) && $result->num_rows > 0) {
						for ($i = 0; $i < mysqli_num_rows($result); $i++){
							$row  = mysqli_fetch_assoc($result);
							echo '<tr>';
							echo '<td style = "text-align:center; line-height:30px">'.$row['StudentTP'].'</td>';
							echo '<td style = "text-align:center; line-height:30px"">'.$row['ClassID'].'</td>';
							echo '<td style = "text-align:center; line-height:30px"">'.$row['CourseID'].'</td>';
							echo '<td style = "text-align:center; line-height:30px"">'.$row['ModuleID'].'</td>';
							echo '<td style = "text-align:center; line-height:30px"">'.$row['Date'].'</td>';
							echo '<td style = "text-align:center; line-height:30px"">'.$row['Start_Time'].'</td>';
							echo '<td style = "text-align:center; line-height:30px"">'.$row['End_Time'].'</td>';	
							echo '<td style = "text-align:center; line-height:30px"">'.$row['Attend_Status'].'</td>';						
							echo '</tr>';						
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
			
