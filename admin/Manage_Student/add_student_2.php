 <?php
 
 	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
 
	session_start();
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	if (isset($_POST['btn_add_student'])){
			
		$StudentName = $_REQUEST['StudentName'];
		$StudentTP = $_REQUEST['StudentTP'];
		$Password = $_REQUEST['Password'];
		$Course = $_REQUEST['Course'];
	 
		if (filter_has_var( INPUT_POST, 'btn_add_student')){
					
			$StudentName = $_POST['StudentName'];
			$StudentTP = $_POST['StudentTP'];
			$Password = $_POST['Password'];
			$Course = $_POST['Course'];
		}
					
		if (empty($StudentName)) {
			$errMsg = 1;
			echo '<script>alert("Please fill student name");';
			echo 'window.location = "add_student.php";</script>';
		}
		
		if (empty($StudentTP)) {
			$errMsg = 1;
			echo '<script>alert("Please fill student tp number");';
			echo 'window.location = "add_student.php";</script>';
		}
		
		if (empty($Password)) {
			$errMsg = 1;
			echo '<script>alert("Please fill password");';
			echo 'window.location = "add_student.php";</script>';
		}
		
		if (empty($Course)) {
			$errMsg = 1;
			echo '<script>alert("Please select course");';
			echo 'window.location = "add_student.php";</script>';
		}
				
		if (empty($errMsg)) {
				
			$sql = "Select * from student where StudentTP = '".$StudentTP. "'";
			$result = $conn ->query($sql);
				
			if (!empty($result) && $result->num_rows == 0) {
				
				$sql2 = "INSERT INTO `student`(`StudentTP`, `StudentName`,  `Password`, `CourseID`) VALUES ('".$StudentTP."','".$StudentName."','".$Password."','".$Course."')";
				$result2 = $conn ->query($sql2);
				
				if(mysqli_affected_rows($conn)== 0){
					echo '<script type="text/javascript">';
					echo 'alert("Failed to add");';
					echo '</script>';
				} else { 
						echo '<script>alert("Student Add Successfully")</script>';
						echo '<script>window.location = "manage_student.php";</script>';
				}
									
			} else {
				
				$sql3 = "SELECT StudentTP FROM student Order by StudentTP DESC LIMIT 1";
				$result3 = $conn ->query($sql3);
				
				if (!empty($result3) && $result3->num_rows > 0) {
					while ($row = $result3->fetch_assoc()) {
						echo '<script>alert("The TP Number have been taken. Please start with the next number ! \n \n Current Last TP Number Used is '.$row["StudentTP"].' !!")</script>';
						echo '<script>window.location = "add_student.php";</script>';
					}
				}
			}
		}	
	}
	
	mysqli_close($conn);
 ?>