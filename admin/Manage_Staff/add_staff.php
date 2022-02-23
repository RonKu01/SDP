<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	$sql = "SELECT Staff_ID FROM management_staff Order by Staff_ID DESC LIMIT 1";
	$result = $conn ->query($sql);

	if (!empty($result) && $result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			
			$LastUsedID = $row["Staff_ID"];
			$intLastUsedID = preg_replace("/[^0-9]/", '', $LastUsedID);
			$newID = $intLastUsedID + 1;
			$newID = str_pad($newID, 4, '0', STR_PAD_LEFT); 
			$Staff_ID = "ST" . $newID ;
		}
	}
	
?> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Add New Staff</title>
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
				<li><a href='../Manage_Lecturer/manage_lecturer.php'>Manage lecturer details</a> </li>
				<li><a href='manage_staff.php'>Manage staff details</a> </li>
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
			<pre><h2>Add New Staff        </h2></pre>
		
			<form name='f1' action="add_staff_2.php" onsubmit = "return validation()" method="post">
				<table>
					<tr>
						<td><label>Staff_ID:</label></td>
						<td><input type="text" id="Staff_ID" name="Staff_ID" readonly value ="<?php echo $Staff_ID; ?>"></td>
					</tr>
					<tr>
						<td><label>Staff Name:</label></td>
						<td><input type="text" id="Staff_Name"  name="Staff_Name" required="required" > </td>
					</tr>
					<tr>
						<td><label>Password:</label></td>
						<td><input type="password" id="Password" name="Password" required="required"></td>
					</tr>
				</table>
				
				<br>
				<pre><input type="button" style='margin-left:0.05%;' value="Back" onclick="window.location='manage_staff.php';"><input type="submit" style='margin-left:1%;'value="Add" name="btn_add_staff" ></pre>
			</form>
		</div>
		
		<script>  
            function validation()  
            {  
                var Staff_ID=document.f1.Staff_ID.value;  
				var Staff_Name=document.f1.Staff_Name.value;  
				var Password=document.f1.Password.value;
				
                if(Staff_ID.length=="" || Staff_Name.length=="" || Password.length=="") {  
                    alert("Please enter all details (Staff_ID, Staff_Name, Age and Password) !!!");  
                    return false;  
                }  			
            }  
        </script>  
		
	</body>
</html>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		