   <?php
 
 	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
 
	session_start();
	
	if (isset($_SESSION["lecturer_login"])) {
	} else {
		header("location: ../login.php");
	}
	
	if (isset($_POST['btn_add_attendance'])){
			
		$ClassID = $_REQUEST['ClassID'];
		$Date = $_REQUEST['Date'];
		$Start_Time = $_REQUEST['Start_Time'];
		$End_Time = $_REQUEST['End_Time'];
		$OTP_Number = $_REQUEST['OTP_Number'];
		$LecturerID = $_REQUEST['LecturerID'];		
	 
		if (filter_has_var( INPUT_POST, 'btn_add_class')){
			
		$ClassID = $_POST['ClassID'];
		$Date = $_POST['Date'];
		$Start_Time = $_POST['Start_Time'];
		$End_Time = $_POST['End_Time'];
		$OTP_Number = $_POST['OTP_Number'];
		$LecturerID = $_POST['LecturerID'];				
		}
					
		if (empty($ClassID)) {
			$errMsg = 1;
			echo '<script>alert("Please fill ClassID");';
			echo 'window.location = "take_attendance.php";</script>';
		}
		
		if (empty($Date)) {
			$errMsg = 1;
			echo '<script>alert("Please fill Date");';
			echo 'window.location = "take_attendance.php";</script>';
		}
		
		if (empty($Start_Time)) {
			$errMsg = 1;
			echo '<script>alert("Please fill Start_Time");';
			echo 'window.location = "take_attendance.php";</script>';
		}
		
		if (empty($End_Time)) {
			$errMsg = 1;
			echo '<script>alert("Please fill $End_Time");';
			echo 'window.location = "take_attendance.php";</script>';
		}
						
		if (empty($errMsg)) {
			
			$sql = "INSERT INTO `attendance`(`ClassID`, `Date`, `Start_Time`, `End_Time`, `OTP_Number`, `Status`) VALUES ('".$ClassID."','".$Date."','".$Start_Time."' ,'".$End_Time."' ,'".$OTP_Number."','Active')";
			$result = $conn ->query($sql);
			
			
			if(mysqli_affected_rows($conn)== 0){
				
				echo '<script type="text/javascript">';
				echo 'alert("Failed to generate Attendance");';
				echo '</script>';
				
			} else {
				$_SESSION['ClassID'] = $ClassID ;
				$_SESSION['Date'] = $Date;
				$_SESSION['Start_Time'] = $Start_Time ;
				$_SESSION['End_Time'] = $End_Time ;
				$_SESSION['OTP_Number'] = $OTP_Number ;
				
				$sql2 = "SELECT * FROM `attendance` WHERE ClassID = '".$ClassID."' AND Date = '".$Date."' AND Start_Time = '".$Start_Time."' AND End_Time = '".$End_Time."' AND OTP_Number = '".$OTP_Number."' AND  Status = 'Active'";
				$result2 = $conn ->query($sql2);
				
				$row2 = mysqli_fetch_assoc($result2);
				$AttendanceID = $row2['AttendanceID'];
				
				$sql3 = "Select StudentTP from student inner join class on student.CourseID = class.CourseID where ClassID = '".$ClassID."'";
				$result3 = $conn ->query($sql3);
				if (!empty($result3) && $result3->num_rows > 0) {
					for ($i = 0; $i < mysqli_num_rows($result3); $i++){
						$row3  = mysqli_fetch_assoc($result3);
						$StudentTP = $row3['StudentTP'];
						
						$sql4 = "INSERT INTO `attendance_detail`(`StudentTP`, `Attend_Status`, `AttendanceID`) VALUES ('".$StudentTP."','Absent','".$AttendanceID."')";
						$result4 = $conn ->query($sql4);
					}
				}
				echo '<script>window.location = "show_otp.php";</script>';
			}	
		}	
	}
	
	mysqli_close($conn);
 ?>