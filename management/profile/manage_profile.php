 <?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	if (isset($_SESSION["management_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	$Staff_ID = $_SESSION['Staff_ID'];
	
	$sql = "Select * from management_staff where Staff_ID = '".$Staff_ID."'";
	$result = $conn ->query($sql);
	
	if ($result->num_rows > 0) {
		for ($i = 0; $i < mysqli_num_rows($result); $i++){
			$row  = mysqli_fetch_assoc($result);
			$Staff_Name = $row['Staff_Name'];
			$Password = $row['Password'];
		}
	}

	
?>


 <!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Management Staff Profile</title>
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
					<li><a href='#'>Manage Profile</a></li>
					<li><a href='../attendance/attendance_class.php'>Class Attendance Record</a></li>
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
	
		<div class ="box">
			<h2>Edit Profile Details</h2>
				<form method = "post" action = "manage_profile_2.php">
				<table>
					<tr>
						<td><label>Staff_ID:</label></td>
						<td><input type="text" name="Staff_ID" value = '<?php echo $Staff_ID ?>' readonly/></td>
					</tr>
					<tr>					
						<td><label>Staff Name:</label></td>
						<td><input type="text" name="Staff_Name" value = '<?php echo $Staff_Name ?>' readonly/></td>
					</tr>
					<tr>
						<td><label>Password:</label></td>
						<td><input type="text" name="Password" value = '<?php echo $Password?>' required="required"/></td>
					</tr>
				</table>
			<br>
					<input type="submit" class= "updatebutton" value="Update"/>
				</form>
			
		</div>					
	</body>
</html>














