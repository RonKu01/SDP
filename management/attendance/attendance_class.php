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
					<li><a href='#'>Class Attendance Record</a></li>
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
				<table border = 1 style = 'table-layout:fixed; text-align: center; max-width: 400px; width:1200px; font-size: 20px;' id="Attendance_List">
					<tr bgcolor = 'f8fca2'>
						<th width="100px">ClassID</th>
						<th width="100px">CourseID / ModuleID</th>
						<th width="100px">LecturerID</th>
						<th width="150px">Check for Attendance</th>
					</tr>
					
					<?php
					$path = $_SERVER['DOCUMENT_ROOT'];
					$path .="/sdp/db_connection.php";
					include_once($path);
					
					$sql = "Select DISTINCT attendance.ClassID, class.ModuleID, class.CourseID, class.LecturerID from attendance inner join class on attendance.ClassID = class.ClassID ORDER BY attendance.ClassID ";
					$result = $conn ->query($sql);
					
					if (!empty($result) && $result->num_rows > 0) {
						for ($i = 0; $i < mysqli_num_rows($result); $i++){
							$row  = mysqli_fetch_assoc($result);
							echo '<tr>';
							echo '<td id="ClassID" >'.$row['ClassID'].'</td>';
							echo '<td>'.$row['CourseID'].' - '.$row['ModuleID'].'</td>';
							echo '<td>'.$row['LecturerID'].'</td>';
							echo '<td><a href = "attendance_class2.php?ClassID='.$row['ClassID'].'"><button class = "studentlist_button">Check for atttendance</button></a></td>';
						}
					}
					
					?>
				</table>
			</div>
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
				td = tr[i].getElementsByTagName("td")[2];
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
		</div>
	</body>
</html>