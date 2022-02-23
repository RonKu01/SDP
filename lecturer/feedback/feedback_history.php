	<?php

		$path = $_SERVER['DOCUMENT_ROOT'];
		$path .="/sdp/db_connection.php";
		include_once($path);
		
		session_start();
		
		if (isset($_SESSION["lecturer_login"])) {
		} else {
			header("location: ../../login.php");
		}

	?>


 <!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Feedback History</title>
		<link rel = "stylesheet" href ="../lecturer.css">
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
				
				$LecturerID = $_SESSION["LecturerID"];
				
				$sql = "Select * from feedback where LecturerID='".$LecturerID."'";
				$result = $conn ->query($sql);
				
				if (!empty($result) && $result->num_rows > 0) {
					for ($i = 0; $i < mysqli_num_rows($result); $i++){
						$row  = mysqli_fetch_assoc($result);
						echo '<tr>';
						echo '<td>'.$row['ID'].'</td>';
						echo '<td>'.$row['LecturerID'].'</td>';
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
			</table>
			</div>
		</div>

	</body>
</html>



			