 <?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	
	if (isset($_SESSION["management_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	$ClassID = isset($_GET['ClassID']) ? $_GET['ClassID'] : '';

?>



 <!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Class Attendance Record</title>
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
						<li><a href='attendance_class.php'>Class Attendance Record</a></li>
						<li><a href='../attendance/attendance_student.php'>Student Attendance Record</a></li>
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
			<h2>Class Attendance Record</h2>
			<input type="text" style='width:auto' id="SearchBoxClassID" onkeyup="SearchClassID()" placeholder="Search by ClassID.">
			<input type="text" style='width:auto' id="SearchBoxLecturerID" onkeyup="SearchLecturerID()" placeholder="Search by LecturerID.">			
			
			<div class = "scroll-table" style="height:auto;">
				<table border = 1 style = 'table-layout:fixed; text-align: center; max-width: 400px; width:1200px; font-size: 20px' id="Attendance_List">
					<tr bgcolor = 'f8fca2'>
						<th width="40px">ClassID</th>
						<th width="100px">CourseID / ModuleID</th>
						<th width="100px">Date Time</th>
						<th width="70px">OTP_Number</th>
						<th width="50px">LecturerID</th>
						<th width="50px">Status</th>
						<th width="50px">Attendance Rate</th>
						<th width="60px">Check for Details</th>
						<th width="40px">PDF Report</th>
					</tr>
					
					<?php
					$path = $_SERVER['DOCUMENT_ROOT'];
					$path .="/sdp/db_connection.php";
					include_once($path);
					
					$sql = "Select * from attendance inner join class on attendance.ClassID = class.ClassID WHERE attendance.ClassID = '".$ClassID."'  ORDER BY AttendanceID DESC ";
					$result = $conn ->query($sql);
					
					if (!empty($result) && $result->num_rows > 0) {
						for ($i = 0; $i < mysqli_num_rows($result); $i++){
							$row  = mysqli_fetch_assoc($result);
							
							$sql2 = 'Select Count(Attend_Status) as Present_Amount from attendance_detail WHERE AttendanceID = "'.$row['AttendanceID'].'" AND (attendance_detail.Attend_Status = "Present" OR attendance_detail.Attend_Status = "Late" OR attendance_detail.Attend_Status = "Absent With Reason")';
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
							echo '<td>'.$row['LecturerID'].'</td>';		
							echo '<td>'.$row['Status'].'</td>';
							echo '<td>'.$Present_Amount.' / '.$Total_Amount.' ('.$Percentage.'%)</td>';	
							echo '<td><a href = "attendance_class_details.php?AttendanceID='.$row['AttendanceID'].'&ClassID='.$ClassID.'"><button class = "editbutton">Details</button></a></td>';
							echo '<td><a href = "class_pdf_report.php?AttendanceID='.$row['AttendanceID'].'" target="_blank"><button class = "deletebutton">Print</button></a></td>';
						}
					}
					
					?>
				</table>
			</div>
		
			<br><br>
			<input type="button" style='font-size: 20px; width: 200px; margin-left:40%;' value="Back" onclick="window.location ='attendance_class.php';">

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
			
			function SearchLecturerID() {
			  var input, filter, table, tr, td, i, txtValue;
			  input = document.getElementById("SearchBoxLecturerID");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("Attendance_List");
			  tr = table.getElementsByTagName("tr");
			  for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[4];
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