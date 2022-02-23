    <?php
 
 	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
 
	session_start();
	
	if (isset($_SESSION["lecturer_login"])) {
	} else {
		header("location: ../login.php");
	}
	
	$lectuerID = ($_SESSION["LecturerID"]);
	?>
	

 
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Attendance History</title>
		<link rel = "stylesheet" href ="../lecturer.css">
		<script src = "../jvscript.js"></script>
		<script src = "../jvscript2.js"></script>	
	</head>
	
	<body>
		<div class ="btn">
			<span class ="fas fa-bars"></span>
		</div>
			
		<nav class = "sidebar">
			<div class ="text">MG Academy
			</div>
			
			<ul>
				<li><a href ="../lecturer_home.php">Overview</a></li>
				<li><a href="../profile/manage_profile.php">Lecturer Profile</a></li>
				<li>
					<a href="#" class="atten-btn">Attendance
					<span class="fas fa-caret-down first"></span>
				</a>
				<ul class="atten-show">
					<li><a href="../take_attendance.php">Generate Attendance</a></li>
					<li><a href="../attendance/attendance_home.php">View Attendance History</a></li>
				</ul>
				</li>
				
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
			
				$('.atten-btn').click(function(){
					$('nav ul .atten-show').toggleClass("show");
					$('nav ul .first').toggleClass("rotate");
				});
				$('.feed-btn').click(function(){
					$('nav ul .feed-show').toggleClass("show1");
					$('nav ul .second').toggleClass("rotate");
				});
				
				$('nav ul li').click(function(){
					$(this).addClass("active").siblings().removeClass("active");
				});
				
			</script>
			
			<div class="box">
				<h2>Attendance History</h2>
			
			<div class = "scroll-table" style="height:auto;">
				<table border = 1 style = 'table-layout:fixed; text-align: center; max-width: 400px; width:1200px; font-size: 20px'>
					<tr bgcolor = 'f8fca2'>
						<th width="40px">ClassID</th>
						<th width="100px">Attendance Details</th>
						<th width="100px">Date & Time</th>
						<th width="50px">OTP Number</th>
						<th width="50px">Status</th>
						<th width="50px">Amount of Student Attended</th>
						<th width="50px">Student List</th>
						<th width="40px">Update</th>
						<th width="40px">Delete</th>
					</tr>
					
					<?php

					$sql = "Select * from attendance inner join class on attendance.ClassID = class.ClassID WHERE class.LecturerID = '".$_SESSION["LecturerID"]."' ORDER BY AttendanceID DESC";
					$result = $conn ->query($sql);
					
					if (!empty($result) && $result->num_rows > 0) {
						for ($i = 0; $i < mysqli_num_rows($result); $i++){
							$row  = mysqli_fetch_assoc($result);
							
							$sql2 = 'Select Count(Attend_Status) as Present_Amount from attendance_detail WHERE AttendanceID = "'.$row['AttendanceID'].'" 
									AND (attendance_detail.Attend_Status = "Present" OR attendance_detail.Attend_Status = "Late" OR attendance_detail.Attend_Status = "Absent With Reason")';
							$result2 = $conn ->query($sql2);
							$row2  = mysqli_fetch_assoc($result2);
							
							$Present_Amount = $row2['Present_Amount'];
							
							$sql3 = 'Select Count(Attend_Status) as Total_Amount from attendance_detail WHERE AttendanceID = "'.$row['AttendanceID'].'"';
							$result3 = $conn ->query($sql3);
							$row3  = mysqli_fetch_assoc($result3);
							
							$Total_Amount = $row3['Total_Amount'];
							
							$Percentage = round((($Present_Amount / $Total_Amount) * 100), 1);
							
							echo '<tr>';
							echo '<td id="ClassID" >'.$row['ClassID'].'</td>';
							echo '<td>'.$row['CourseID'].' - '.$row['ModuleID'].'</td>';
							echo '<td>'.$row['Date'].' ('.$row['Start_Time'].' -- '.$row['End_Time'].')</td>';
							echo '<td>'.$row['OTP_Number'].'</td>';
							echo '<td>'.$row['Status'].'</td>';
							echo '<td>'.$Present_Amount.' / '.$Total_Amount.' ('.$Percentage.'%)</td>';
							echo '<td><a href = "student_list.php?AttendanceID='.$row['AttendanceID'].'"><button class = "studentlist_button">Student List</button></a></td>';	
							echo '<td style="width: 50px;"><a href = "edit_attendance.php?AttendanceID='.$row['AttendanceID'].'"><button class = "editbutton">√</button></a></td>';						
							echo '<td style="width: 50px;"><a href = "delete_attendance.php?AttendanceID='.$row['AttendanceID'].'"><button class = "deletebutton">X</button></a></td>';						
							echo '</tr>';


						}
						$_SESSION['AttendanceID'] = $row['AttendanceID']; 
						mysqli_free_result($result);
					}
					mysqli_close($conn);
					?>
					
				</table>
				</div>
					
				<script>
				function SearchClassID() {
				  var input, filter, table, tr, td, i, txtValue;
				  input = document.getElementById("SearchBoxClassID");
				  filter = input.value.toUpperCase();
				  table = document.getElementById("Attendance_List");
				  tr = table.getElementsByTagName("tr");
				  for (i = 0; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[0];
					if (td) {
					  txtValue = td.textContent || td.innerText;
					  if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					  } else {
						tr[i].style.display = "none";
					  }
					}       
				  }
				}
				
				</script>
			
	</body>
</html>
			
			
			
			
			
			
			
			
			
			
			
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	