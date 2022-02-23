  <?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	
	if (isset($_SESSION["lecturer_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	$AttendanceID = isset($_GET['AttendanceID']) ? $_GET['AttendanceID'] : '';
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Student List</title>
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
			
			
		<div class = "box">
			<h2>Student List</h2>
			<input type="text" style="width:auto" id="SearchBoxTP" onkeyup="SearchTP()" placeholder="Search by StudentTP." title="Type in a name">	
			
			
			<div class="scroll-table">
				<table border = 1 style = 'text-align: center; width: 900px; font-size:25px;' id="Student_List">
				<tr bgcolor = 'f8fca2'>
					<th>ID</th>
					<th>StudentTP</th>
					<th>StudentName</th>
					<th>Status</th>
					<th>Update Status</th>
				</tr>
				
				<?php
				$sql = "Select * from attendance_detail inner join attendance on attendance_detail.AttendanceID = attendance.AttendanceID inner join class on class.ClassID = attendance.ClassID inner join student on student.StudentTP = attendance_detail.StudentTP WHERE attendance_detail.AttendanceID = '".$AttendanceID."' ORDER BY attendance_detail.StudentTP ASC";
				$result = $conn ->query($sql);
		
				if (!empty($result) && $result->num_rows > 0) {
					for ($i = 0; $i < mysqli_num_rows($result); $i++){
						$row  = mysqli_fetch_assoc($result);
						$ID = 1 + $i ;
	
						echo '<tr>';
						echo '<td>'.$ID.'</td>';
						echo '<td>'.$row['StudentTP'].'</td>'; 
						echo '<td>'.$row['StudentName'].'</td>'; 
						echo '<td>'.$row['Attend_Status'].'</td>';
						echo '<td><a href = "update_attendance_list.php?ID='.$row['ID'].'"><button class = "editbutton">√</button></a></td>';						
						echo '</tr>';						
					}	
					
				}
				mysqli_close($conn);
				?>
				
			</table>
			
			<script>
			function SearchTP() {
			  var input, filter, table, tr, td, i, txtValue;
			  input = document.getElementById("SearchBoxTP");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("Student_List");
			  tr = table.getElementsByTagName("tr");
			  for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[1];
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
			<br><br>
			<input type="button" style='font-size: 20px; width: 200px; margin-left:40%;' value="Back" onclick="window.location ='attendance_home.php';">
			
			
		</div>

			
	</body>
</html>







