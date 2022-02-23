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
		<title>Feedback</title>
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
		
		<div class ="box">
			<form method="post" action="feedback_2.php" >
			<h2>Feedback</h2>
				<div>
					<label style= 'font-size: 20px'>Issues / Bugs / Problem:</label>
					<br><br>
					<textarea style="border:solid 1px #f090ac;resize: none;text-align:left; font-size: 30px;" name="Bug" required="required" rows="4" cols="50"></textarea>
				</div>
				<div>
					<label style= 'font-size: 20px'>Details Explanation:</label>
					<br><br>
					<textarea style="border:solid 1px #f090ac;resize: none;text-align:left; font-size: 30px;" name="Details" required="required" rows="4" cols="50"></textarea>
				</div>
				<br><br>
				
				<input type="submit" class= "updatebutton" value="Submit"/>
			</form>
		</div>	
		
