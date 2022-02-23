<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}
				
	$sql = "SELECT StudentTP FROM student Order by StudentTP DESC LIMIT 1";
	$result = $conn ->query($sql);

	if (!empty($result) && $result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			
			$LastUsedTP = $row["StudentTP"];
			$intLastUsedTP = preg_replace("/[^0-9]/", '', $LastUsedTP);
			$newTP = $intLastUsedTP + 1;
			$newTP = str_pad($newTP, 4, '0', STR_PAD_LEFT); 
			$StudentTP = "TP" . $newTP ;
		}
	}
?>




<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Add New Student</title>
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
				<li><a href='manage_student.php'>Manage student details</a> </li>
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
			<pre><h2>Add New Student      </h2></pre>
			
			<form name='f1' action="add_student_2.php" onsubmit = "return validation()" method="post">
				<table>
					<tr>
						<td><label>Student TP Number:</label></td>
						<td><input type="text" id="StudentTP" name="StudentTP" readonly value ="<?php echo $StudentTP; ?>"></td>
					</tr>
					<tr>
						<td><label>Student Name:</label></td>
						<td><input type="text" id="StudentName" name="StudentName" required="required"></td>
					</tr>
					<tr>
						<td><label>Password:</label></td>
						<td><input type="text" id="Password" name="Password" required="required"></td>
					</tr>
					<tr>
						<td><label>Course:</label></td>
						<td><select style='font-size: 20px' name="Course" required="required">
							<option value="" selected="selected">    --- select course ---   </option>
							<?php
						
							$sql = "Select * from course";
							$result = $conn ->query($sql);
							
							if ($result->num_rows > 0) {
								for ($i = 0; $i < mysqli_num_rows($result); $i++){
									$row  = mysqli_fetch_assoc($result);
									echo '<option value= "'.$row['CourseID'].'">'.$row['CourseID'].'-'.$row['CourseName'].'</option>';
								}
							}
							?>
							</select>
						</td>
					</tr>
				</table>
				
				<br><br>
				<pre><input type="button" style='margin-left:0.05%;' value="Back" onclick="window.location='manage_student.php';"><input type="submit" value="Add" style='margin-left:1%;' name="btn_add_student"></pre>
			</form>
		</div>
		
		<script>  
            function validation()  
            {  
                var StudentName=document.f1.StudentName.value;  
				var StudentTP=document.f1.StudentTP.value;  
                var Password=document.f1.Password.value;
				var Course=document.f1.Course.value;
				
                if(StudentName.length=="" || StudentTP.length=="" || Password.length=="" || Course.length=="") {  
                    alert("Please enter all details (Student Name, Student TP Number, Password and Course) !!!");  
                    return false;  
                }  			
            }  
        </script>  
	</body>
</html>
































