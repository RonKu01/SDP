 <?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}

?> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Add New Course</title>
		<link href = "../../admin.css" rel = "stylesheet">
		<script src = "../../jvscript.js"></script>
		<script src = "../../jvscript2.js"></script>	
	</head>
	<body>
		<div class ="btn">
			<span class ="fas fa-bars"></span>
		</div>
		
		<nav class = "sidebar">
			<div class ="text">MG Academy</div>
			<ul>
				<li><a href ="../../admin_home.php">Homepage</a></li>
				<li><a href='../../Manage_Admin/manage_profile.php'>Manage admin Profile</a> </li>
				<li><a href='../../Manage_Student/manage_student.php'>Manage student details</a> </li>
				<li><a href='../../Manage_Lecturer/manage_lecturer.php'>Manage lecturer details</a> </li>
				<li><a href='../../Manage_Staff/manage_staff.php'>Manage staff details</a> </li>
				<li>
					<a href="#" class="nav-extend-btn">Manage Classes
					<span class="fas fa-caret-down first"></span>
				</a>
				<ul class="nav-extend-show">
					<li><a href='../Manage_Class_Details/class.php'>Class</a></li>
					<li><a href='manage_course.php'>Course</a></li>
					<li><a href='../Manage_Module/manage_module.php'>Module</a> </li>
				</ul>
				</li>
				<li><a href='../../Manage_Feedback/view_feedback.php'>Manage Feedbacks</a> </li>
				<li><a href="../../../logout.php">Logout</a></li>
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
			<pre><h2>Add New Course          </h2></pre>
	
			<form name='f1' action="add_course_2.php" onsubmit = "return validation()" method="post">
				<table>
					<tr>
						<td><label>Course ID  :</label></td>
						<td><input type="text" id="CourseID" name="CourseID" required="required"></td>
					</tr>
					<tr>
						<td><label>Course Name  :</label></td>
						<td><input type="text" id="CourseName" name="CourseName" required="required"></td>
					</tr>
				</table>
				<br>
				<pre><input type="button" style='margin-left:0.05%;' value="Back" onclick="window.location='manage_course.php';"><input type="submit" value="Add" style='margin-left:1%;' name="btn_add_course"></pre>
					
			</form>
		</div>
		
		<script>  
            function validation()  
            {  
                var CourseID=document.f1.CourseID.value;  
				var CourseName=document.f1.CourseName.value;  
				
                if(CourseID.length=="" || CourseName.length=="") {  
                    alert("Please enter all details (CourseID and Course Name) !!!");  
                    return false;  
                }  			
            }  
        </script> 
	</body>
</html>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		