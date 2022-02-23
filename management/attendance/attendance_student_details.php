 <?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	
	if (isset($_SESSION["management_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	$StudentTP = isset($_GET['StudentTP']) ? $_GET['StudentTP'] : '';

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
			<h2>Student Attendance Record</h2>
				<div class='scroll-table' style="height:auto;">
					<table border = 1 style = 'table-layout:fixed; text-align: center; max-width: 400px; width:1200px; font-size: 20px' id="Attendance_List">
						<tr bgcolor = 'f8fca2'>
							<th width="40px">ClassID</th>
							<th width="40px">ModuleID</th>
							<th width="50px">Class Attended</th>
							<th width="50px">Percentage</th>
							<th width="40px">Details</th>
						</tr>

						<?php
						
						$sql = "SELECT DISTINCT attendance.ClassID, class.ModuleID from attendance 
								inner join class on attendance.ClassID = class.ClassID 
								inner join student on student.CourseID = class.CourseID
								inner join attendance_detail on attendance.AttendanceID = attendance_detail.AttendanceID
								WHERE attendance_detail.studentTP = '".$StudentTP."'";
						$result = $conn ->query($sql);
						
						for ($i = 0;  $i < mysqli_num_rows($result); $i++) {
							$row  = mysqli_fetch_assoc($result);
							
							$sql2 = "Select Count(attendance_detail.Attend_Status) as Attend_Number from attendance_detail inner join attendance on attendance_detail.AttendanceID = attendance.AttendanceID where StudentTP='".$StudentTP."' AND ClassID='".$row['ClassID']."' AND (attendance_detail.Attend_Status = 'Present' OR attendance_detail.Attend_Status = 'Late' OR attendance_detail.Attend_Status = 'Absent With Reason')";
							$result2 = $conn ->query($sql2);
							$row2 = mysqli_fetch_assoc($result2);
							$Attend_Number = $row2['Attend_Number'];
							
							$sql3 = "Select Count(attendance_detail.Attend_Status) as Late_Number from attendance_detail inner join attendance on attendance_detail.AttendanceID = attendance.AttendanceID where StudentTP='".$StudentTP."' AND ClassID='".$row['ClassID']."' AND attendance_detail.Attend_Status = 'Late'";
							$result3 = $conn ->query($sql3);
							$row3 = mysqli_fetch_assoc($result3);
							$Late_Number = $row3['Late_Number'];
							
							$Total_Attend_Number = $Attend_Number - floor($Late_Number / 3);
							
							$sql4 = "SELECT COUNT(ClassID) as Class_Amount from attendance inner join attendance_detail on attendance_detail.AttendanceID = attendance.AttendanceID where StudentTP='".$StudentTP."' AND ClassID = '".$row['ClassID']."' ";
							$result4 = $conn ->query($sql4);
							$row4 = mysqli_fetch_assoc($result4);
							$Class_Amount = $row4['Class_Amount'];
							
							$Percentage = round((($Total_Attend_Number / $Class_Amount) * 100), 1);
							
							echo'<tr>';
							echo'<td>'.$row['ClassID'].'</td>';
							echo'<td>'.$row['ModuleID'].'</td>';
							echo'<td>'.$Total_Attend_Number.' / '.$Class_Amount.'</td>';
							echo'<td>'.$Percentage.'% </td>';
							echo '<td><a href = "attendance_student_details_2.php?ClassID='.$row['ClassID'].'&StudentTP='.$StudentTP.'"><button class="studentlist_button">View</button></a></td>';	
							echo'</tr>';
						}

						mysqli_close($conn);
						?>
					</table>
				
				
				
				</div>
		
		
			<pre><a href = "student_pdf_report.php?StudentTP=<?php echo $StudentTP; ?>" target="_blank"><button style='font-size: 20px; height: 42px; width: 500px; border-bottom: none; cursor: pointer; background: #f7497d; color: #fff; margin-bottom: 0; text-transform: uppercase; margin-left: 10%;'>Generate PDF Report</button></a> <input type="button" value="Back" style='margin-left:1%;margin-top:1.5%' onclick="window.location ='attendance_student.php?StudentTP=<?php echo $StudentTP; ?> ';">  </pre>
		

		</div>
				
	</body>
</html>
			
			
			
			
			
			
			
			
			
			
			
			
		