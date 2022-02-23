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
		<title>Feedback</title>
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
						<li><a href='../attendance/attendance_class.php'>Class Attendance Record</a></li>
						<li><a href='../attendance/attendance_student.php'>Student Attendance Record</a></li>
						<li>
				<a href="#" class ="feed-btn">Feedback
					<span class="fas fa-caret-down second"></span>
				</a>
					<ul class="feed-show">
					<li><a href="#">Feedback Review</a></li>
					<li><a href="feedback_history.php">View Feedback History</a></li>
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
	</body>
</html>