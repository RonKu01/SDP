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
	
	$sql = 'Select * from attendance where AttendanceID = "'.$AttendanceID.'"' ;
	$result = mysqli_query ($conn, $sql);
	
	
	$row = mysqli_fetch_assoc($result);
	
	mysqli_free_result($result);
	
	$_SESSION['AttendanceID'] = $AttendanceID;
	
	
	
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset = "utf-8">
		<title>Class Details</title>
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
			<h2>Update Class Details</h2>
			<form method = "post" action = "edit_attendance_2.php">
			<table>
					<tr>
						<td><label>ClassID:</label></td>
						<td><input type="text" name="ClassID" value = '<?php echo $row['ClassID']?>' readonly/></td>
					</tr>
					<tr>
						<td><label>Date:</label></td>
						<td><input type="date" name="Date" value = '<?php echo $row['Date']?>' required="required"/></td>
					</tr>
					<tr>
						<td><label>Start_Time:</label></td>
						<td><input type="time" name="Start_Time" min="09:00:00" max="18:00:00" value = '<?php echo $row['Start_Time']?>' required="required"/></td>
					</tr>
					<tr>
						<td><label>End_Time:</label></td>
						<td><input type="time" name="End_Time" min="09:00:00" max="18:00:00" value = '<?php echo $row['End_Time']?>' required="required"/></td>
					</tr>				
					<tr>
						<td><label>Status:</label></td>
						<td><select name="Status">
								<option value="<?php echo $row['Status']?>" selected="selected" required="required"> <?php echo $row['Status']?>(Current)</option>
								<option value="Active"  required="required">Active</option>
								<option value="Ended" required="required">Ended</option>
							</select>
						<br><br>
						</td>
					</tr>		
				</table>
					<pre><input type="button" value="Back" style='margin-left:0.05%;margin-top:1.5%' onclick="window.location =' attendance_home.php';">  <input type="submit" style='margin-left:1%;margin-top:1.5%' value="Update"/></pre>
			</form>									
		</div>
	</body>
</html>

