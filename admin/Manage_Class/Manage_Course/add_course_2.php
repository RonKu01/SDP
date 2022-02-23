  <?php
 
 	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
 
	session_start();
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	if (isset($_POST['btn_add_course'])){
			
		$CourseID = $_REQUEST['CourseID'];
		$CourseName = $_REQUEST['CourseName'];
	 
		if (filter_has_var( INPUT_POST, 'btn_add_course')){
					
			$CourseID = $_POST['CourseID'];
			$CourseName = $_POST['CourseName'];
		}
					
		if (empty($CourseID)) {
			$errMsg = 1;
			echo '<script>alert("Please fill CourseID");';
			echo 'window.location = "add_course.php";</script>';
		}
		
		if (empty($CourseName)) {
			$errMsg = 1;
			echo '<script>alert("Please fill Course Name");';
			echo 'window.location = "add_course.php";</script>';
		}
				
		if (empty($errMsg)) {
				
			$sql = "Select * from course where CourseID = '".$CourseID. "'";
			$result = $conn ->query($sql);
				
			if ($result->num_rows == 0) {
				
				$sql2 = "INSERT INTO `course`(`CourseID`, `CourseName`) VALUES 
						('".$CourseID."','".$CourseName."')";
				$result2 = $conn ->query($sql2);
				
				if(mysqli_affected_rows($conn)== 0){
					echo '<script type="text/javascript">';
					echo 'alert("Failed to add");';
					echo '</script>';
				} else { 
						echo '<script>alert("Course Add Successfully")</script>';
						echo '<script>window.location = "manage_course.php";</script>';
				}
									
			} else {
				
				$sql3 = "SELECT CourseID FROM course Order by CourseID DESC LIMIT 1";
				$result3 = $conn ->query($sql3);
				
				if ($result3->num_rows > 0) {
					while ($row = $result3->fetch_assoc()) {
						echo '<script>alert("The CourseID have been taken. Please start with the next number ! \n \n Current Last CourseID Used is '.$row["CourseID"].' !!")</script>';
						echo '<script>window.location = "add_course.php";</script>';
					}
				}
			}
		}	
	}
	
	mysqli_close($conn);
 ?>