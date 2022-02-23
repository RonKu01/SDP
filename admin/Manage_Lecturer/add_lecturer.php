<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	$sql = "SELECT LecturerID FROM lecturer Order by LecturerID DESC LIMIT 1";
	$result = $conn ->query($sql);

	if (!empty($result) && $result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			
			$LastUsedID = $row["LecturerID"];
			$intLastUsedID = preg_replace("/[^0-9]/", '', $LastUsedID);
			$newID = $intLastUsedID + 1;
			$newID = str_pad($newID, 4, '0', STR_PAD_LEFT); 
			$LecturerID = "LT" . $newID ;
		}
	}
	
?> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Add New Lecturer</title>
		<link href = "../admin.css" rel = "stylesheet">
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
				<li><a href ="../admin_home.php">Homepage</a></li>
				<li><a href='../Manage_Admin/manage_profile.php'>Manage admin Profile</a> </li>
				<li><a href='../Manage_Student/manage_student.php'>Manage student details</a> </li>
				<li><a href='manage_lecturer.php'>Manage lecturer details</a> </li>
				<li><a href='../Manage_Staff/manage_staff.php'>Manage staff details</a> </li>
				<li>
					<a href="#" class="nav-extend-btn">Manage Classes
					<span class="fas fa-caret-down first"></span>
				</a>
				<ul class="nav-extend-show">
					<li><a href='../Manage_Class/Manage_Class_Details/class.php'>Class</a></li>
					<li><a href='../Manage_Class/Manage_Course/manage_course.php'>Course</a></li>
					<li><a href='../Manage_Class/Manage_Module/manage_module.php'>Module</a> </li>
				</ul>
				</li>
				<li><a href='../Manage_Feedback/view_feedback.php'>Manage Feedbacks</a> </li>
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
		
		<div class="box">
			<pre><h2>Add New Lecturer        </h2></pre>
			<form name='f1' action="add_lecturer_2.php" onsubmit = "return validation()" method="post">
				<table>
					<tr>
						<td><label>LecturerID:</label></td>
						<td><input type="text" id="LecturerID" name="LecturerID" readonly value ="<?php echo $LecturerID; ?>"></td>
					</tr>
					<tr>
						<td><label>Lecturer Name:</label></td>
						<td><input type="text" id="LecturerName" name="LecturerName"  required="reqiured" ></td>
					</tr>
					<tr>
						<td><label>Password:</label></td>
						<td><input type="password" id="Password" name="Password" required="reqiured"></td>
					</tr>
					<tr>		
						<td><label>Department:</label></td>
						<td><select style='font-size: 20px' name="Department" required="reqiured">
							<option value="" selected="selected" required="required"> --Select Course-- </option>
							<option value="School of IT"  required="required"> School of Information Technology  </option>
							<option value="School of Engineering"  required="required"> School of Engineering  </option>
							<option value="School of Business"  required="required"> School of Business </option>
							</select>
						</td>
					</tr>
				</table>
				
				<br>
				<pre><input type="button" value="Back" style='margin-left:0.05%;' onclick="window.location='manage_lecturer.php';"><input type="submit" style='margin-left:1%;' value="Add" name="btn_add_lecturer"></pre>
				
			</form> 
		</div>
	</body>
</html>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		