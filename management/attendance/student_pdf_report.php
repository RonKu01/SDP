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
	
	$StudentTP = isset($_GET['StudentTP']) ? $_GET['StudentTP'] : '';
		
	//Reference: https://www.youtube.com/watch?v=XD8OOSwjMDs&ab_channel=GemulChannel
		
	//A4 width : 219mm
	//defult margin : 10mm each side
	//writeable horizontal : 219 -(10*2) = 189mm
	
		$pdf = new FPDF('p','mm','Letter');
		$pdf->AddPage();
		
		//set font to arial, bold, 14pt
		$pdf->SetFont('Arial','B',30);
		
		$pdf->Cell(189,8,'MG Academy',0,1,'C');
		
		$pdf->Cell(189	,10,'',0,1);//end of line

		//Cell(width , height , text , border , end line , [align] )
		$sql = "SELECT * FROM student where StudentTP ='".$StudentTP."'";
		$result = $conn ->query($sql);
		
		if (!empty($result) && $result->num_rows > 0) {
			$row  = mysqli_fetch_assoc($result);
			
			$StudentTP = $row['StudentTP'];
			$StudentName = $row['StudentName'];
			$CourseID = $row['CourseID'];
			
			$pdf->SetFont('Arial','',15);
			
			$pdf->Cell(50,8,'StudentTP   :',0,0);
			$pdf->Cell(35,8,$StudentTP,0,1);//end of line
			
			$pdf->Cell(50,8,'Student Name :',0,0);
			$pdf->Cell(35,8,$StudentName,0,1);//end of line
			
			$pdf->Cell(50,8,'CourseID   :',0,0);
			$pdf->Cell(35,8,$CourseID,0,1);//end of line
			
			$pdf->Cell(189	,10,'',0,1);//end of line
		
			
			//set font to arial, regular, 12pt
			$pdf->SetFont('Arial','',12);
		

		$sql2 = "Select DISTINCT attendance.ClassID from attendance 
				inner join attendance_detail on attendance.AttendanceID = attendance_detail.AttendanceID 
				inner join class on attendance.ClassID = class.ClassID 
				inner join module on class.ModuleID = module.ModuleID
				inner join course on course.CourseID = class.CourseID
				inner join student on attendance_detail.StudentTP = student.StudentTP
				inner join lecturer on lecturer.LecturerID = class.LecturerID
				WHERE student.StudentTP = '".$StudentTP."'";
		$result2 = $conn ->query($sql2);
		
		if (!empty($result2) && $result2->num_rows > 0) {
			for ($i = 0; $i < mysqli_num_rows($result2); $i++){
				$row2  = mysqli_fetch_assoc($result2);
				
				$ClassID = $row2['ClassID'];
				
				$sql3 = "Select * from attendance 
				inner join attendance_detail on attendance.AttendanceID = attendance_detail.AttendanceID 
				inner join class on attendance.ClassID = class.ClassID 
				inner join module on class.ModuleID = module.ModuleID
				inner join course on course.CourseID = class.CourseID
				inner join student on attendance_detail.StudentTP = student.StudentTP
				inner join lecturer on lecturer.LecturerID = class.LecturerID
				WHERE student.StudentTP = '".$StudentTP."' AND attendance.ClassID = '".$ClassID."'";
				$result3 = $conn ->query($sql3);
				
				if (!empty($result3) && $result3->num_rows > 0) {
					$row3  = mysqli_fetch_assoc($result3);
					
					$pdf->SetFont('Arial','B',15);
					$Class = $row3['ClassID'];
					$ModuleID = $row3['ModuleID'];
					
					$pdf->Cell(175,10,'ClassID: '.$Class,1,1);

					$sql4 = "Select * from attendance_detail inner join attendance on attendance_detail.AttendanceID = attendance.AttendanceID inner join class on class.ClassID = attendance.ClassID WHERE `StudentTP` = '".$StudentTP."' AND attendance.ClassID = '".$Class."' ORDER BY ID DESC";
						
					$result4 = $conn ->query($sql4);
							
					if (!empty($result4) && $result4->num_rows > 0) {
						$pdf->SetFont('Arial','B',12);
						$pdf->Cell(35,8,'ModuleID',1,0);
						$pdf->Cell(35,8,'Date',1,0);
						$pdf->Cell(35,8,'Start_Time',1,0);
						$pdf->Cell(35,8,'End_Time',1,0);
						$pdf->Cell(35,8,'Attend_Status',1,1);//end of line
							
						for ($a = 0; $a < mysqli_num_rows($result4); $a++){
							$row4  = mysqli_fetch_assoc($result4);
							
							$Date = $row4['Date'];
							$Start_Time = $row4['Start_Time'];
							$End_Time = $row4['End_Time'];
							$Attend_Status = $row4['Attend_Status'];
							
							$pdf->SetFont('Arial','',10);
							
							$pdf->Cell(35,6,$ModuleID,1,0);
							$pdf->Cell(35,6,$Date,1,0);
							$pdf->Cell(35,6,$Start_Time,1,0);
							$pdf->Cell(35,6,$End_Time,1,0);
							$pdf->Cell(35,6,$Attend_Status,1,1);//end of line
						}
					}
					$pdf->Cell(189	,10,'',0,1);//end of line
				}
			}
			$pdf->Cell(189	,10,'',0,1);//end of line
			$pdf->SetFont('Arial','',15);
			$pdf->Cell(189	,10,'This is an auto-genereated PDF Report. Do not require signature! ',1,1, "C");
			
			$pdf->Output();
		}
	} else {
		echo 'Thats an error in code. Please contact admin to fix it!';
		
	}
	
	?>
	
	
	
	
	