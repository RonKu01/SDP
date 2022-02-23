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
		<title>Add New Module</title>
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
					<li><a href='../Manage_Course/manage_course.php'>Course</a></li>
					<li><a href='manage_module.php'>Module</a> </li>
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
			<pre><h2>Add New Module          </h2></pre>

			<form name='f1' action="add_module_2.php" onsubmit = "return validation()" method="post">
				<table>
					<tr>
						<td><label>Module ID :</label></td>
						<td><input type="text" id="ModuleID" name="ModuleID" required="required"></td>
					</tr>
					<tr>
						<td><label>Module Name :</label></td>
						<td><input type="text" id="ModuleName" name="ModuleName" required="required"></td>
					</tr>
				</table>
				
				<br>
				<pre><input type="button" style='margin-left:0.05%;' value="Back" onclick="window.location='manage_module.php';"><input type="submit" style='margin-left:1%;' value="Add" name="btn_add_module"></pre>
			</form>
		</div>
		
		<script>  
            function validation()  
            {  
                var ModuleID=document.f1.ModuleID.value;  
				var ModuleName=document.f1.ModuleName.value;  
				
                if(ModuleID.length=="" || ModuleName.length=="") {  
                    alert("Please enter all details (ModuleID and Module Name) !!!");  
                    return false;  
                }  			
            }  
        </script>
	</body>
</html>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		