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
		<title>Attendance Details</title>
		<link rel = "stylesheet" href ="Student.css">
		<script src = "jvscript.js"></script>
		<script src = "jvscript2.js"></script>	
	</head>
	
	<body class = "table-history">
		<div class ="btn">
			<span class ="fas fa-bars"></span>
		</div>
		
		<nav class = "sidebar">
			<div class ="text">MG Academy</div>
			
			<ul>
				<li><a href ="student_home.php">Home</a></li>
				<li><a href="take_attendance.php">Take Attendance</a></li>
				<li><a href='profile/manage_profile.php'>Manage Profile</a></li>
				<li><a href='attendance/attendance_home.php'>Attendance Details</a></li>
				<li>
					<a href="#" class ="nav-extend-btn">Feedback
					<span class="fas fa-caret-down first"></span>
				</a>
					<ul class="nav-extend-show">
					<li><a href='feedback/feedback.php'>Feedback</a></li>
					<li><a href="feedback/feedback_history.php">View Feedback History</a></li>
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
			
		<div class ="box" style="width:750px">
		<center>
			<h2 class ="title_2">Attendance</h2>
		
			<form action="take_attendance_2.php" method="POST">
				<label style= "font-size : 30px">Please Insert the OTP Number Below</label>
			<br><br>
				<input type="number" id="OTP_Number" name="OTP_Number" required='required' min="100" max="999" 
				style= "box-sizing: border-box; border: 2px solid red; border-radius: 4px; margin-top: 10px;" pattern= "[0-9]{3}"> <br>
		</center>
				<input type="submit" style="font-size:28px;" value="Mark Attendance" name="Mark_Attendance">
			
			</form>
			<br><br>
			
		</div>
	</body>
</html>
		
		
		
		
		
		
		
		
		
		
		
		