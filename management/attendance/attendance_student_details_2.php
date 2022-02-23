 <?php

 	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	require('../../fpdf/fpdf.php');
 
	session_start();
	
	if (isset($_SESSION["management_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	$StudentTP = isset($_GET['StudentTP']) ? $_GET['StudentTP'] : '';
	$ClassID = isset($_GET['ClassID']) ? $_GET['ClassID'] : '';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Student Attendance Record</title>
		<link href = "../management.css" rel = "stylesheet">
		<script src = "../jvscript.js"></script>
		<script src = "../jvscript2.js"></script>

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
					<li><a href='attendance_student.php'>Student Attendance Record</a></li>
					<li>
				<a href="#" class ="feed-btn">Feedback
					<span class="fas fa-caret-down second"></span>
				</a>
					<ul class="feed-show">
					<li><a href="../feedback/feedback.php">Feedback Review</a></li>
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
		

		$('.feed-btn').click(function(){
			$('nav ul .feed-show').toggleClass("show1");
			$('nav ul .first').toggleClass("rotate");
		});
		$('nav ul li').click(function(){
			$(this).addClass("active").siblings().removeClass("active");
		});
			
		</script>	
		
		<div class="box">
			<h2>Student Attendance Record Details</h2>
				<div class='scroll-table' style="height:auto;">
					<table border = 1 style = 'table-layout:fixed; text-align: center; max-width: 400px; width:1200px; font-size: 20px'>
						<tr bgcolor = 'f8fca2'>
							<th width="50px">StudentTP</th>
							<th width="40px">ClassID</th>
							<th width="70px">CourseID</th>
							<th width="50px">ModuleID</th>
							<th width="100px">Date</th>
							<th width="100px">Start Time</th>
							<th width="100px">End Time</th>
							<th width="50px">Present Status</th>					
						</tr>
						
						<?php

						$sql = "Select * from attendance_detail inner join attendance on attendance_detail.AttendanceID = attendance.AttendanceID inner join class on class.ClassID = attendance.ClassID WHERE `StudentTP` = '".$StudentTP."' AND attendance.ClassID = '".$ClassID."' ORDER BY ID DESC";
						$result = $conn ->query($sql);
				
						if (!empty($result) && $result->num_rows > 0) {
							for ($i = 0; $i < mysqli_num_rows($result); $i++){
								$row  = mysqli_fetch_assoc($result);
								echo '<tr>';
								echo '<td>'.$row['StudentTP'].'</td>';
								echo '<td>'.$row['ClassID'].'</td>';
								echo '<td>'.$row['CourseID'].'</td>';
								echo '<td>'.$row['ModuleID'].'</td>';
								echo '<td>'.$row['Date'].'</td>';
								echo '<td>'.$row['Start_Time'].'</td>';
								echo '<td>'.$row['End_Time'].'</td>';	
								echo '<td>'.$row['Attend_Status'].'</td>';						
								echo '</tr>';						
							}
							mysqli_free_result($result);
						}
						mysqli_close($conn);
						?>
					</table>
				</div>
			
			<br><br>
			<input type="button" value="Back" style='font-size: 20px; width: 200px; margin-left:40%;' onclick="window.location ='attendance_student_details.php?StudentTP=<?php echo $StudentTP; ?> ';"> 			
	
		</div>
	</body>
</html>
			
 