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
	$CourseID = $_SESSION["Student_CourseID"]
?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Attendance History</title>
		<link rel = "stylesheet" href ="../Student.css">
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
		
		<div class="box">
			<h2 align= "center" class ="title_2">Attendance History</h2>
			
			<div class='scroll-table' style="height:auto">
				<table border = "1" style ='width:1000px; left:0; right:0; margin-left:auto; margin-right:auto; font-size:35px;'>
				
			

				<?php
				
				$sql = "SELECT DISTINCT attendance.ClassID, class.ModuleID from attendance 
						inner join class on attendance.ClassID = class.ClassID 
						inner join student on student.CourseID = class.CourseID
						inner join attendance_detail on attendance.AttendanceID = attendance_detail.AttendanceID
						WHERE attendance_detail.studentTP = '".$StudentTP."' AND student.CourseID = '".$CourseID."'";
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
					echo'<th style = "line-height:55px ;font-size: 40px; background-color:#ff4d94 ; color:white" colspan="3">'.$row['ClassID'].'   '.$row['ModuleID'].'</th>';
					echo'</tr>';
					echo'<tr>';
					echo'<td style = "line-height:25px ; text-align:center">Class Attended : '.$Total_Attend_Number.' / '.$Class_Amount.'</td>';		
					echo'<td style = "line-height:25px ; text-align:center">'.$Percentage.'% </td>';	
					echo '<td style = "line-height:25px ; text-align:center"><a href = "attendance_detail.php?ClassID='.$row['ClassID'].'"><button class = "editbutton">Details</button></a></td>';	
					echo'</tr>';
					
				}

				mysqli_close($conn);
				?>
				</table>
			</div>
			
		</div>
	</body>
</html>
			
			
			
			
			
			
			
			
			
			
			
			
		