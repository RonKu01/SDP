<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	$sql = "SELECT ClassID FROM class Order by ClassID DESC LIMIT 1";
	$result = $conn ->query($sql);

	if (!empty($result) && $result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			
			$LastUsedID = $row["ClassID"];
			$intLastUsedID = preg_replace("/[^0-9]/", '', $LastUsedID);
			$newID = $intLastUsedID + 1;
			$newID = str_pad($newID, 2, '0', STR_PAD_LEFT); 
			$ClassID = "CL" . $newID ;
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Add Class Details</title>
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
					<li><a href='class.php'>Class</a></li>
					<li><a href='../Manage_Course/manage_course.php'>Course</a></li>
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
			<pre><h2>Class Details       </h2></pre>
			<form name='f1' action="add_class_2.php" onsubmit = "return validation()" method="post">
				<table>
					<tr>	
						<td><label>ClassID   :</label></td>
						<td><input type="text" id="ClassID" name="ClassID" readonly value ="<?php echo $ClassID; ?>"></td>
					</tr>
					<tr>
						<td><label>CourseID   :</label></td>
						<td><select name="CourseID" required="required">
								<option value="" selected="selected"> --Select Course-- </option>

								<?php
							
								$sql2 = "Select * from course";
								$result2 = $conn ->query($sql2);
								
								if (!empty($result) && $result2->num_rows > 0) {
									for ($i = 0; $i < mysqli_num_rows($result2); $i++){
										$row2  = mysqli_fetch_assoc($result2);
										echo '<option value= "'.$row2['CourseID'].'">'.$row2['CourseID'].'-'.$row2['CourseName'].'</option>';
									}
								}
				
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label>ModuleID   :</label></td>
						<td><select name="ModuleID" required="required">
							<option value="" selected="selected" > --Select Module-- </option>

							<?php
						
							$sql3 = "Select * from module";
							$result3 = $conn ->query($sql3);
							
							if (!empty($result) && $result3->num_rows > 0) {
								for ($i = 0; $i < mysqli_num_rows($result3); $i++){
									$row3  = mysqli_fetch_assoc($result3);
									echo '<option value= "'.$row3['ModuleID'].'">'.$row3['ModuleID'].'-'.$row3['ModuleName'].'</option>';
								}
							}
								
							?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label>LecturerID   :</label></td>
						<td><select name="LecturerID" required="required">
							<option value="" selected="selected"> -Select Lecturer- </option>

							<?php
						
							$sql4 = "Select * from lecturer";
							$result4 = $conn ->query($sql4);
							
							if (!empty($result) && $result4->num_rows > 0) {
								for ($i = 0; $i < mysqli_num_rows($result4); $i++){
									$row4  = mysqli_fetch_assoc($result4);
									echo '<option value= "'.$row4['LecturerID'].'">'.$row4['LecturerID'].'-'.$row4['LecturerName'].'</option>';
								}
							}
							?>
							</select>
						</td>
					</tr>
				</table>
				
				<br>
				<pre><input type="button" value="Back" style='margin-left:0.05%;' onclick="window.location='class.php';"><input type="submit" value="Add" style='margin-left:1%;' name="btn_add_class"></pre>
								
			</form>
		</div>
		
		<script>  
            function validation()  
            {  
                var ClassID=document.f1.ClassID.value;  
				var CourseID=document.f1.CourseID.value;  
                var ModuleID=document.f1.ModuleID.value;
				var LecturerID=document.f1.LecturerID.value;
				
                if(ClassID.length=="" || CourseID.length=="" || ModuleID.length=="" || LecturerID.length=="") {  
                    alert("Please enter all details !!!!!");  
                    return false;  
                }  			
            }  
        </script>  
	</body>
</html>
































