  <?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	if (isset($_SESSION["lecturer_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	$ID = isset($_GET['ID']) ? $_GET['ID'] : '';
	
	$sql = 'Select * from attendance_detail inner join student on attendance_detail.StudentTP = student.StudentTP where ID = "'.$ID.'"' ;
	$result = mysqli_query ($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	
	
	
	mysqli_free_result($result);
	
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset = "utf-8">
		<title>Student Attendance Status</title>
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
			<h2>Student Attendance Status</h2>
			<form method = "post" action = "update_attendance_list_2.php">
				<table>
					<tr>
						<td><label>StudentTP:</label></td>
						<td><input type="text" name="StudentTP" value = '<?php echo $row['StudentTP']?>' readonly></td>
					</tr>
					<tr>
						<td><label>Student Name:</label></td>
						<td><input type="text" name="StudentName" value = '<?php echo $row['StudentName']?>' readonly></td>
					</tr>
					<tr>
						<td><label>Status:</label></td>
						<td><select name="Attend_Status" required="required">
							<option value="<?php echo $row['Attend_Status']?>" selected="selected"> <?php echo $row['Attend_Status']?>(Current)</option>
							<option value="Present" >Present</option>
							<option value="Late">Late</option>
							<option value="Absent">Absent</option>
							<option value="Absent With Reason">Absent With Reason</option>
						</select>
						<br><br>
						</td>
					</tr>
					
					<input type="hidden" name="ID" value = "<?php echo $ID; ?>" required="required"/>
					<input type="hidden" name="AttendanceID" value = "<?php echo $row['AttendanceID'] ?>" required="required"/>
				</table>
				
				<pre><input type="button" value="Back" style='margin-left:0.05%;margin-top:1.5%' onclick="window.location ='student_list.php?AttendanceID= <?php echo $row['AttendanceID'] ?> ';">  <input type="submit" style='margin-left:1%;margin-top:1.5%' value="Update"/></pre>
			</form>
		</div>
	</body>
	
</html>			
			
