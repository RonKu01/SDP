<?php

session_start();
 
	if (isset($_SESSION["student_login"])) {
		header("location: student/student_home.php");
	}
	
	if (isset($_SESSION["lecturer_login"])) {
		header("location: lecturer/lecturer_home.php");
	}
	
	if (isset($_SESSION["management_login"])) {
		header("location: management/management_home.php");
	}
	
	if (isset($_SESSION["admin_login"])) {
		header("location: admin/admin_home.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>MG Academy Login Page</title>
		<link href = "login.css" rel = "stylesheet">	</head>

	<body>
	
		<div class ="box">
			<h2>MG Academy</h2>
			
			<form name='f1' action="login_verify.php" onsubmit = "return validation()" method="post">
				<div>
					<label>User:</label>				
					<input type="text" id="username" name="username" Placeholder= "TPxxxx / LTxxxx / STxxxx / Admin_Name" required="required">
				</div>
				<div>	
					<label>Password:</label>
					<input type="password" id="password" name="password" Placeholder = "Enter Password here." required="required">
				</div>
				<div>
					<label>Role  :</label>  
					<select name="role" style="font-size: 22px; border: 1px solid black; text-align-last:center;" required="required">
						<option value="" selected="selected">--Select--</option>
						<option value="student">Student</option>
						<option value="lecturer">Lecturer</option>
						<option value="management">Management</option>
						<option value="admin">Admin</option>
					</select>
				</div>	
				<br><br>
					<input type="submit" value="Login" name="btn_login">
				
			</form>	
			
			<script>  
				function validation()  
				{  
					var id=document.f1.username.value;  
					var ps=document.f1.password.value;
					var role=document.f1.role.value;
					
					if(id.length=="" || ps.length=="" || role.length=="") {  
						alert("Please enter all details (Username, Password and Role) !!!");  
						return false;  
					}  			
				}  
			</script>  
		</div>
	</body>
</html>

