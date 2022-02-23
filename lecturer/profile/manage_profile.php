<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .="/sdp/db_connection.php";
include_once($path);

session_start();

if (isset($_SESSION["lecturer_login"])) {
} else {
	header("location: ../../login.php");
}

$LecturerID = $_SESSION['LecturerID'];

$sql = "Select * from lecturer where LecturerID = '".$LecturerID."'";
$result = $conn ->query($sql);

if (!empty($result) && $result->num_rows > 0) {
	for ($i = 0; $i < mysqli_num_rows($result); $i++){
		$row  = mysqli_fetch_assoc($result);
		$LecturerName = $row['LecturerName'];
		$Password = $row['Password'];
		$Department = $row['Department'];
	}
}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Lecturer Profile</title>
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
				<li><a href="#">Lecturer Profile</a></li>
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
		
		
			<div class ="box">
				<h2>Manage Profile Details</h2>
				<form  method = "post" action = "manage_profile_2.php">
					<table>
						<tr>
							<td><label>LecturerID:</label></td>
							<td><input type = "text" name ="LecturerID" value = '<?php echo $LecturerID ?>' readonly /></td>
						</tr>
						<tr>
							<td><label>Lecturer Name:</label></td>
							<td><input type = "text" name ="LecturerName" value = '<?php echo $LecturerName ?>' readonly /></td>
						</tr>
						<tr>
							<td><label>Department:</label></td>
							<td><input type = "text" name ="Department" value = '<?php echo $Department?>' readonly /></td>
						</tr>
						<tr>
							<td><label>Password:</label></td>
							<td><input type = "text" name ="Password" value = '<?php echo $Password?>' required="required"/></td>
						</tr>
					</table>
					
					<input type="submit" class= "updatebutton" value="Update"/>
				</form>
			</div>
	</body>
</html>














