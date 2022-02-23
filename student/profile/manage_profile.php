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
	
	$sql = "Select * from student where StudentTP = '".$StudentTP."'";
	$result = $conn ->query($sql);
	
	if ($result->num_rows > 0) {
		for ($i = 0; $i < mysqli_num_rows($result); $i++){
			$row  = mysqli_fetch_assoc($result);
			$StudentName = $row['StudentName'];
			$CourseID = $row['CourseID'];
			$Password = $row['Password'];
		}
	}

	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Student Profile</title>
		<link rel = "stylesheet" href ="../Student.css">
		<script src = "../jvscript.js"></script>
		<script src = "../jvscript2.js"></script>
	</head>
	
	<body class ="table-history">
		<div class ="btn">
			<span class ="fas fa-bars"></span>
		</div>
			
		<nav class = "sidebar">
			<div class ="text">MG Academy
			</div>
			
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
		
		<div class ="box">
			<pre><h2>Edit Profile Details</h2></pre>
			<form method = "post" action = "manage_profile_2.php">
			<table>
				<tr>
					<td><label>Student TP Number:</label></td>
					<td><input type="text" name="StudentTP" value = '<?php echo $StudentTP ?>' readonly /></td>
				</tr>
				<tr>
					<td><label>Student Name:</label></td>
					<td><input type="text" name="StudentName" value = '<?php echo $StudentName ?>' readonly /></td>
				</tr>
				<tr>
					<td><label>CourseID:</label></td>
					<td><input type="text" name="CourseID" value = '<?php echo $CourseID?>' readonly /></td>
				</tr>
				<tr>
					<td><label>Password			:</label></td>
					<td><input type="text" name="Password" value = '<?php echo $Password?>' required="required"/></td>
			
				</tr>
			</table>
			<br>
				
				<input type="submit" class= "updatebutton" value="Update"/>
			</form>
			
		</div>
	</body>
</html>














