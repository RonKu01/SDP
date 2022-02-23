<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	$Admin_ID = isset($_GET['Admin_ID']) ? $_GET['Admin_ID'] : '';
	
	$sql = 'Select * from admin where Admin_ID = "'.$Admin_ID.'"' ;
	$result = mysqli_query ($conn, $sql);
	
	
	$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset = "utf-8">
		<title>Edit Admin Account</title>
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
				<li><a href='manage_profile.php'>Manage admin Profile</a> </li>
				<li><a href='../Manage_Student/manage_student.php'>Manage student details</a> </li>
				<li><a href='../Manage_Lecturer/manage_lecturer.php'>Manage lecturer details</a> </li>
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
		
		<div class ="box">
			<pre><h2>Edit Admin Details</h2></pre>
			<form method = "post" action = "edit_admin_2.php">
			<table>
				<tr>
					<td><label>Admin_ID   :</label></td>
					<td><input type="text" name="Admin_ID" value = '<?php echo $row['Admin_ID']?>' readonly/></td>
				</tr>
				<tr>
					<td><label>Admin_Name:</label></td>
					<td><input type="text" name="Admin_Name" value = '<?php echo $row['Admin_Name']?>' readonly/></td>
				</tr>
				<tr>
					<td><label>Password   :</label></td>
					<td><input type="text" name="Password" value = '<?php echo $row['Password']?>' required="required"/></td>
				</tr>
			</table>
			
			<pre><input type="button" value="Back" style='margin-left:0.05%;margin-top:1.5%' onclick="window.location='manage_profile.php';">  <input type="submit" style='margin-left:1%;margin-top:1.5%' value="Update"/></pre>
			</form>
			
		</div>
		
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
	</body>
</html>