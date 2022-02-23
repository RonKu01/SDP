   <?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	
	if (isset($_SESSION["student_login"])) {
	} else {
		header("location: ../login.php");
	}
	
	
	$StudentTP = $_SESSION['StudentTP'];
	$OTP_Number = $_POST['OTP_Number'];
	
	$sql = 'Select * from attendance where OTP_Number = "'.$OTP_Number.'" ';
	$result = $conn ->query($sql);
	
	if ($result->num_rows > 0) {

		$sql2 = 'Select * from attendance where OTP_Number = "'.$OTP_Number.'" and Status = "Active" ';
		$result2 = $conn ->query($sql2);
		
		if ($result2->num_rows > 0) {
			while ($row = $result2->fetch_assoc()) {
				
				$AttendanceID = $row['AttendanceID'];
				$ClassID = $row['ClassID'];
				
				$sql3 = 'Select * from attendance_detail where StudentTP = "'.$StudentTP.'" AND Attend_Status = "Present" AND AttendanceID = "'.$AttendanceID.'"';
				$result3 = $conn ->query($sql3);
				
				if ($result3->num_rows == 0) {
				
					$sql4 = 'Select StudentTP from student 
							inner join class on student.CourseID = class.CourseID
							inner join course on class.CourseID = course.CourseID
							where class.ClassID = "'.$ClassID.'" And StudentTP = "'.$StudentTP.'"';
							
					$result4 = $conn ->query($sql4);
					
			
					if ($result4->num_rows > 0) {
						
						$sql5 = "UPDATE `attendance_detail` SET `Attend_Status` = 'Present' WHERE StudentTP = '".$StudentTP."' AND AttendanceID = '".$AttendanceID."'";
						$result5 = $conn ->query($sql5);
						
						if(mysqli_affected_rows($conn)== 0){
							echo '<script type="text/javascript">';
							echo 'alert("Please try again");';
							echo '<script>window.location = "take_attendance.php";</script>';
							echo '</script>';
						} else {
							echo '<script>alert("Attendance Marked")</script>';
							echo '<script>window.location = "attendance/attendance_home.php";</script>';
						}
						
					} else {
							echo '<script>alert("Failed to take Attendance. \n \n You are not belong to this class.")</script>';
							echo '<script>window.location = "take_attendance.php";</script>';
					}
				}else {
					echo '<script>alert("Attendance already taken!! ")</script>';
					echo '<script>window.location = "take_attendance.php";</script>';
				}
			}
		}else{
			echo '<script>alert("Failed to take Attendance.\n \n  Period Ended !!!")</script>';
			echo '<script>window.location = "take_attendance.php";</script>';
			
			
		}
	} else {
		echo '<script>alert("Failed to take Attendance. \n \n OTP_Number not match!!! ")</script>';
		echo '<script>window.location = "take_attendance.php";</script>';
	}
	
?>