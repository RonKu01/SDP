  <?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	if (isset($_SESSION["student_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
?>


 <!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Feedback</title>
		<link rel = "stylesheet" href ="../Student.css">
		<script src = "../jvscript.js"></script>
		<script src = "../jvscript2.js"></script>	
	</head>
	
	<body class ="table-history">
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
	
	
		<div class ="box" style="width:800px">
		<h2 align ="center" class ="title_2">Feedback</h2>
		<form method = "post" action = "feedback_2.php">
			
			<label>Issues / Bugs / Problem :</label> <br>
			<textarea name="Bug" style="font-size: 25px;" required="required" rows="4" cols="50"></textarea>
			
			<br><br>
			
			<label>Details Explanation :</label><br>
			<textarea name="Details" style="font-size: 25px;" required="required" rows="4" cols="50"></textarea>
			
			<br><br>
	
			<input type="submit" class= "updatebutton" value="Submit"/>
			</form>
			
		</div>
	</body>
</html>