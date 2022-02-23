<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	$LecturerID = isset($_GET['LecturerID']) ? $_GET['LecturerID'] : '';
	
	$sql = 'Select * from lecturer where LecturerID = "'.$LecturerID.'"' ;
	$result = mysqli_query ($conn, $sql);
	
	
	$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset = "utf-8">
		<title>Edit Lecturer Account</title>
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
			<h2>Edit Lecturer Details</h2><br>
			<form method = "post" action = "edit_lecturer_2.php">
				<table>
					<tr>
						<td><label>LecturerID   :</label></td>
						<td><input type="text" name="LecturerID" value = '<?php echo $row['LecturerID']?>' readonly></td>
					</tr>
					<tr>	
						<td><label>Lecturer Name :</label></td>
						<td><input type="text" name="LecturerName" value = '<?php echo $row['LecturerName']?>' readonly></td>
					</tr>
					<tr>		
						<td><label>Password   :</label></td>
						<td><input type="text" name="Password" value = '<?php echo $row['Password']?>' required="required"/></td>
					</tr>
					<tr>		
						<td><label>Department:</label></td>
						<td><select name="Department" required="reqiured">
								<option value="<?php echo $row['Department']?>" selected="selected" required="required"><?php echo $row['Department']?>   (Current)  </option>
								<option value="School of IT"  required="required"> School of Information Technology  </option>
								<option value="School of Engineering"  required="required"> School of Engineering  </option>
								<option value="School of Business"  required="required"> School of Business </option>
							</select>
						</td>
					</tr>
				</table>
				
				<br>
				<pre><input type="button" value="Back" style='margin-left:0.05%;margin-top:1.5%' onclick="window.location='manage_lecturer.php';"><input type="submit" class= "updatebutton" style='margin-left:1%;margin-top:1.5%' value="Update"/></pre>
					
			</form>
		</div>
	</body>
</html>