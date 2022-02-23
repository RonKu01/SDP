<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}

	$sql = "SELECT Admin_ID FROM admin Order by Admin_ID DESC LIMIT 1";
	$result = $conn ->query($sql);

	if (!empty($result) && $result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			
			$LastUsedID = $row["Admin_ID"];
			$intLastUsedID = preg_replace("/[^0-9]/", '', $LastUsedID);
			$newID = $intLastUsedID + 1;
			$newID = str_pad($newID, 4, '0', STR_PAD_LEFT); 
			$Admin_ID = $newID ;
		}
	}
?> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Add New Admin</title>
		<link href = "../admin.css" rel = "stylesheet">
		<script src = "../jvscript.js"></script>
		<script src = "../jvscript2.js"></script>
	</head>
	<body>
		<div class ="btn">
			<span class ="fas fa-bars"></span>
		</div>
		
		<nav class = "sidebar">
			<div class ="text">MG Acadaemy</div>
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
			<h2>Add New Admin</h2>
			<form name='f1' action="add_admin_2.php" onsubmit = "return validation()" method="post">
				<table>
					<tr>
						<td><label>Admin_ID  :</label></td>
						<td><input type="text" id="Admin_ID" name="Admin_ID" readonly value ="<?php echo $Admin_ID; ?>" /></td>
					</tr>
					<tr>
						<td><label>Admin Name:</label></td>
						<td><input type="text" id="Admin_Name" name="Admin_Name" required="required"></td>
					</tr>
					<tr>
						<td><label>Password  :</label></td>
						<td><input type="text" id="Password" name="Password" required="required"></td>
					</tr>
				</table>
				<pre><input type="button" style='margin-left:0.05%;margin-top:1.5%' value="Back" onclick="window.location='manage_profile.php';">   <input type="submit" value="Add" style='margin-left:1%; margin-top:1.5%;' name="btn_add_admin"></pre>
				
			</form>
		</div>
		
		<script>  
            function validation()  
            {  
                var Admin_ID=document.f1.Admin_ID.value;  
				var Admin_Name=document.f1.Admin_Name.value;  
               	var Password=document.f1.Password.value;
				
                if(Admin_ID.length=="" || Admin_Name.length=="" || Password.length=="") {  
                    alert("Please enter all details (Admin_ID, Admin_Name and Password) !!!");  
                    return false;  
                }  			
            }  
        </script> 

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
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		