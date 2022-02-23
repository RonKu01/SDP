    <?php
	
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
				
	session_start();
	
	
	if (isset($_SESSION["lecturer_login"])) {
	} else {
		header("location: ../login.php");
	}
	
	$First_Input = (rand(1,9));
	$Second_Input = (rand(1,9));
	$Third_Input = (rand(1,9));
	
	$str_First_Input = (string)$First_Input;
	$str_Second_Input = (string)$Second_Input;
	$str_Third_Input = (string)$Third_Input;
	
	$OTP_Number = (''.$str_First_Input.''.$str_Second_Input.''.$str_Third_Input.'') ;
	
	$LecturerID = $_SESSION['LecturerID'];
	
 ?>
	
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Class Attendance Details</title>
		<link rel = "stylesheet" href ="lecturer.css">
		<script src = "jvscript.js"></script>
		<script src = "jvscript2.js"></script>
	</head>
	
	
	<body>
		<div class ="btn">
			<span class ="fas fa-bars"></span>
		</div>
		
		<nav class = "sidebar">
			<div class ="text">MG Academy
			</div>
			
			<ul>
				<li><a href ="lecturer_home.php">Overview</a></li>
				<li><a href="profile/manage_profile.php">Lecturer Profile</a></li>
				<li>
					<a href="#" class="atten-btn">Attendance
					<span class="fas fa-caret-down first"></span>
				</a>
				<ul class="atten-show">
					<li><a href="take_attendance.php">Generate Attendance</a></li>
					<li><a href="attendance/attendance_home.php">View Attendance History</a></li>
				</ul>
				</li>
				
				<li>
					<a href="#" class ="feed-btn">Feedback
					<span class="fas fa-caret-down second"></span>
				</a>
					<ul class="feed-show">
					<li><a href="feedback/feedback.php">Feedback Review</a></li>
					<li><a href="feedback/feedback_history.php">View Feedback History</a></li>
				</ul>
				</li>
				<li><a href="../logout.php">Logout</a></li>
			</ul>
		</nav>
		
			<script>
			$('.btn').click(function(){
				$(this).toggleClass("click");
				$('.sidebar').toggleClass("show");
			});
			
				$('.atten-btn').click(function(){
					$('nav ul .atten-show').toggleClass("show");
					$('nav ul .first').toggleClass("rotate");
				});
				$('.feed-btn').click(function(){
					$('nav ul .feed-show').toggleClass("show1");
					$('nav ul .second').toggleClass("rotate");
				});
				
				$('nav ul li').click(function(){
					$(this).addClass("active").siblings().removeClass("active");
				});
				
			</script>
			
		<!--<p>Please fill in the blank with class details</p>
		-->
			<div class ="box">
				<h2>Attendance Details</h2>
				<form name='f1' action="take_attendance_2.php" onsubmit = "return validation()" method="post">
				<table>
					<tr>
						<td><label>ClassID:</label></td>
						<td>
							<div class = "select-box">
								<select name="ClassID">
									<option value="" selected="selected" required="required"> --Select Class-- </option>
										<?php
									$sql = "Select * from class where LecturerID = '".$LecturerID."'";
									$result = $conn ->query($sql);
									
									if ($result->num_rows > 0) {
										for ($i = 0; $i < mysqli_num_rows($result); $i++){
											$row  = mysqli_fetch_assoc($result);
											echo '<option value= "'.$row['ClassID'].'">'.$row['ClassID'].'-'.$row['CourseID'].'-'.$row['ModuleID'].'</option>';
										}
									}
									?>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td><label>Date:</label></td>
						<td><input type = "date" name ="Date" id='Date' required='required'></td>
					</tr>
					<tr>
						<td><label>Start_Time:</label></td>
						<td><input type = "time" name ="Start_Time" min="09:00:00" max="18:00:00" id='Start_Time' required='required'></td>
					</tr>
					<tr>
						<td><label>End_Time:</label></td>
						<td><input type = "time" name ="End_Time" min="09:00:00" max="18:00:00" id='End_Time' required='required'></td>
					</tr>
						<input type='hidden' name="OTP_Number" value=<?php echo $OTP_Number;?> >
						<input type='hidden' name="LecturerID" value=<?php echo $LecturerID;?> >
					
				</table>
						<input type="submit" value="Generate" name="btn_add_attendance"/>
	
				</form>
		
		
		<script>  
            function validation()  
            {  
                var ClassID=document.f1.ClassID.value;  
				var Date=document.f1.Date.value;  
                var Start_Time=document.f1.Start_Time.value;
				var End_Time=document.f1.End_Time.value;
				
                if(ClassID.length=="" || Date.length=="" || Start_Time.length=="" || End_Time.length=="") {  
                    alert("Please enter all details !!!!!");  
                    return false;  	
				} 
			
				
				if(Start_Time >= End_Time){
					alert("End Time should be bigger than Start Time!!!");
					return false;
				}
			}
        </script>  
		</div>

	</body>
</html>

 
 
 
 
 
 
 
 
 
 