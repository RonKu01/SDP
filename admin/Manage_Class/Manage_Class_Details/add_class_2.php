  <?php
 
 	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
 
	session_start();
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	if (isset($_POST['btn_add_class'])){
			
		$ClassID = $_REQUEST['ClassID'];
		$CourseID = $_REQUEST['CourseID'];
		$ModuleID = $_REQUEST['ModuleID'];
		$LecturerID = $_REQUEST['LecturerID'];
	 
		if (filter_has_var( INPUT_POST, 'btn_add_class')){
			
			$ClassID = $_POST['ClassID'];
			$CourseID = $_POST['CourseID'];
			$ModuleID = $_POST['ModuleID'];	
			$LecturerID = $_POST['LecturerID'];
		}
					
		if (empty($ClassID)) {
			$errMsg = 1;
			echo '<script>alert("Please fill ClassID");';
			echo 'window.location = "add_class.php";</script>';
		}
		
		if (empty($CourseID)) {
			$errMsg = 1;
			echo '<script>alert("Please fill CourseID");';
			echo 'window.location = "add_class.php";</script>';
		}
		
		if (empty($ModuleID)) {
			$errMsg = 1;
			echo '<script>alert("Please fill ModuleID");';
			echo 'window.location = "add_class.php";</script>';
		}
		
		if (empty($LecturerID)) {
			$errMsg = 1;
			echo '<script>alert("Please fill LecturerID");';
			echo 'window.location = "add_class.php";</script>';
		}
						
		if (empty($errMsg)) {
				
			$sql = "Select * from class where ClassID = '".$ClassID. "'";
			$result = $conn ->query($sql);
			
			if (!empty($result) && $result->num_rows == 0) {
				
				$sql2 = "Select * from class where CourseID = '".$CourseID. "' AND ModuleID= '".$ModuleID."' AND LecturerID= '".$LecturerID."'";
				$result2 = $conn ->query($sql2);
					
				if (!empty($result) && $result2->num_rows == 0) {
					
					$sql2 = "INSERT INTO `class`(`ClassID`, `CourseID`, `ModuleID`, `LecturerID`) VALUES ('".$ClassID."','".$CourseID."','".$ModuleID."', '".$LecturerID."')";
					$result2 = $conn ->query($sql2);
					
					if(mysqli_affected_rows($conn)== 0){
						echo '<script type="text/javascript">';
						echo 'alert("Failed to add");';
						echo '</script>';
					} else { 
							echo '<script>alert("Class Add Successfully")</script>';
							echo '<script>window.location = "class.php";</script>';
					}
										
				} else {
					while ($row = $result2->fetch_assoc()) {
						echo '<script>alert("The Course, Module and Lecturer are same with '.$row["ClassID"].' !!")</script>';
						echo '<script>window.location = "class.php";</script>';
					}

				}
			} else	{
				
				$sql3 = "SELECT ClassID FROM class Order by ClassID DESC LIMIT 1";
				$result3 = $conn ->query($sql3);
					
				if (!empty($result) && $result3->num_rows > 0) {
					while ($row2 = $result3->fetch_assoc()) {
						echo '<script>alert("The ClassID have been taken. Please start with the next number ! \n \n Current Last CLassID Used is '.$row2["ClassID"].' !!")</script>';
						echo '<script>window.location = "add_class.php";</script>';
					}
				}

			}
		}	
	}
	
	mysqli_close($conn);
 ?>