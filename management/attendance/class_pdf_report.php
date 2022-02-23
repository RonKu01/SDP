     <?php
 
 	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	require('../../fpdf/fpdf.php');
 
	session_start();
	
	if (isset($_SESSION["management_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
	$AttendanceID = isset($_GET['AttendanceID']) ? $_GET['AttendanceID'] : '';
	
	$sql = "Select * from attendance 
			inner join attendance_detail on attendance.AttendanceID = attendance_detail.AttendanceID 
			inner join class on attendance.ClassID = class.ClassID 
			inner join module on class.ModuleID = module.ModuleID
			inner join course on course.CourseID = class.CourseID
			inner join student on attendance_detail.StudentTP = student.StudentTP
			inner join lecturer on lecturer.LecturerID = class.LecturerID
			WHERE attendance_detail.AttendanceID = '".$AttendanceID."'";
	$result = $conn ->query($sql);
	
	if (!empty($result) && $result->num_rows > 0) {
		$row  = mysqli_fetch_assoc($result);

		$AttendanceID = $row['AttendanceID'];
		$ClassID = $row['ClassID'];
		$Date = $row['Date'];
		$Start_Time = $row['Start_Time'];
		$End_Time = $row['End_Time'];
		$OTP_Number = $row['OTP_Number'];
		$LecturerID = $row['LecturerID'];
		$LecturerName = $row['LecturerName'];
		$Status = $row['Status'];
		$CourseID = $row['CourseID'];
		$CourseName = $row['CourseName'];
		$ModuleID = $row['ModuleID'];
		$ModuleName = $row['ModuleName'];	
		
			//Reference: https://www.youtube.com/watch?v=XD8OOSwjMDs&ab_channel=GemulChannel
		
	//A4 width : 219mm
	//defult margin : 10mm each side
	//writeable horizontal : 219 -(10*2) = 189mm
	
		$pdf = new FPDF('p','mm','Letter');
		$pdf->AddPage();
		
		$pdf->SetFont('Arial','B',30);
		
		$pdf->Cell(189,8,'MG Academy',0,1,'C');
		
		$pdf->Cell(189	,10,'',0,1);//end of line
		
		//set font to arial, bold, 14pt
		$pdf->SetFont('Arial','B',14);

		//Cell(width , height , text , border , end line , [align] )

		$pdf->Cell(63,15,$CourseName,0,0);
		$pdf->Cell(63,15,$CourseID,0,0,"C");
		$pdf->Cell(63,15,$ClassID,0,1,"R");//end of line
		
		//set font to arial, regular, 12pt
		$pdf->SetFont('Arial','',12);

		$pdf->Cell(45	,5,'LecturerName :',0,0);
		$pdf->Cell(31.5	,5,$LecturerName,0,0);
		$pdf->Cell(45	,5,'LecturerID :',0,0);
		$pdf->Cell(42	,5,$LecturerID,0,1);//end of line

		$pdf->Cell(45	,5,'ModuleID :',0,0);
		$pdf->Cell(31.5	,5,$ModuleID,0,0);
		$pdf->Cell(45	,5,'ModuleName :',0,0);		
		$pdf->Cell(42	,5,$ModuleName,0,1);//end of line
		
		$pdf->Cell(45	,5,'Date :',0,0);
		$pdf->Cell(31.5	,5,$Date,0,0);
		$pdf->Cell(45	,5,'Duration :',0,0);
		$pdf->Cell(42	,5,$Start_Time.' --- '. $End_Time,0,1);//end of line
		
		$pdf->Cell(189	,10,'',0,1);//end of line
		
		$pdf->Cell(145	,10,'Student Attendance List',1,1, "C");//end of line
		
		$pdf->Cell(10	,5,'ID ',1,0);
		$pdf->Cell(45	,5,'StudentTP ',1,0);
		$pdf->Cell(45	,5,'Student Name ',1,0);
		$pdf->Cell(45	,5,'Attend Status ',1,1);//end of line
		
	$sql2 = "Select * from attendance_detail inner join attendance on attendance_detail.AttendanceID = attendance.AttendanceID inner join class on class.ClassID = attendance.ClassID inner join student on student.StudentTP = attendance_detail.StudentTP WHERE attendance_detail.AttendanceID = '".$AttendanceID."' ORDER BY attendance_detail.StudentTP ASC";
		$result2 = $conn ->query($sql2);
	
	if (!empty($result2) && $result2->num_rows > 0) {
		for ($i = 0; $i < mysqli_num_rows($result2); $i++){
			$row2  = mysqli_fetch_assoc($result2);
			$ID = 1 + $i ;
			
			$StudentTP = $row2['StudentTP'];
			$StudentName = $row2['StudentName'];
			$Attend_Status = $row2['Attend_Status'];
			
			$pdf->Cell(10,5,$ID,1,0);
			$pdf->Cell(45,5,$StudentTP,1,0);
			$pdf->Cell(45,5,$StudentName,1,0);
			$pdf->Cell(45,5,$Attend_Status,1,1);//end of line
					
		}	
		
	}
	
		$pdf->Cell(189	,10,'',0,1);//end of line
		
		$pdf->Cell(189	,5,'This is an auto-genereated PDF Report. Do not require signature! ',1,1, "C");
		
		$pdf->Output();
	
	} else {
		echo 'Thats an error in code. Please contact admin to fix it!';
		
	}
	?>
	
	
	
	
	