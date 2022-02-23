 <?php
 
 	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
 
	session_start();
	
	if (isset($_SESSION["admin_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	if (isset($_POST['btn_add_lecturer'])){
			
		$LecturerID = $_REQUEST['LecturerID'];
		$LecturerName = $_REQUEST['LecturerName'];
		$Password = $_REQUEST['Password'];
		$Department = $_REQUEST['Department'];
	 
		if (filter_has_var( INPUT_POST, 'btn_add_lecturer')){
					
			$LecturerID = $_POST['LecturerID'];
			$LecturerName = $_POST['LecturerName'];
			$Password = $_POST['Password'];
			$Department = $_POST['Department'];
		}
					
		if (empty($LecturerID)) {
			$errMsg = 1;
			echo '<script>alert("Please fill LecturerID");';
			echo 'window.location = "add_lecturer.php";</script>';
		}
		
		if (empty($LecturerName)) {
			$errMsg = 1;
			echo '<script>alert("Please fill Lecturer Name");';
			echo 'window.location = "add_lecturer.php";</script>';
		}
		
		if (empty($Password)) {
			$errMsg = 1;
			echo '<script>alert("Please enter Password");';
			echo 'window.location = "add_lecturer.php";</script>';
		}
		
		if (empty($Department)) {
			$errMsg = 1;
			echo '<script>alert("Please fill Department");';
			echo 'window.location = "add_lecturer.php";</script>';
		}
				
		if (empty($errMsg)) {
				
			$sql = "Select * from lecturer where LecturerID = '".$LecturerID. "'";
			$result = $conn ->query($sql);
			
			if (!empty($result) && $result->num_rows == 0) {
				
				$sql2 = "INSERT INTO `lecturer`(`LecturerID`, `LecturerName`, `Password`,  `Department`) VALUES 
						('".$LecturerID."','".$LecturerName."','".$Password."','".$Department."')";
				$result2 = $conn ->query($sql2);
				
				if(mysqli_affected_rows($conn)== 0){
					echo '<script type="text/javascript">';
					echo 'alert("Failed to add");';
					echo '</script>';
				} else { 
						echo '<script>alert("Lecturer Add Successfully")</script>';
						echo '<script>window.location = "manage_lecturer.php";</script>';
				}
									
			} else {
				
				$sql3 = "SELECT LecturerID FROM lecturer Order by LecturerID DESC LIMIT 1";
				$result3 = $conn ->query($sql3);
				
				if ($result3->num_rows > 0) {
					while ($row = $result3->fetch_assoc()) {
						echo '<script>alert("The LecturerID have been taken. Please start with the next number ! \n \n Current Last LecturerID Used is '.$row["LecturerID"].' !!")</script>';
						echo '<script>window.location = "add_lecturer.php";</script>';
					}
				}
			}
		}	
	}
	
	mysqli_close($conn);
 ?>