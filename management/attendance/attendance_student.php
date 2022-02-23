	<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	session_start();
	
	
	if (isset($_SESSION["management_login"])) {
	} else {
		header("location: ../../login.php");
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Student Attendance Record</title>
		<link href = "../management.css" rel = "stylesheet">
		<script src = "../jvscript.js"></script>
		<script src = "../jvscript2.js"></script>
	</head>
	
	<body>
		<div class ="btn">
				<span class ="fas fa-bars"></span>
				</div>
				
				<nav class = "sidebar">
					<div class ="text">MG Academy</div>
					<ul>
						<li><a href ="../management_home.php">Homepage</a></li>
						<li><a href='../profile/manage_profile.php'>Manage Profile</a></li>
						<li><a href='../attendance/attendance_class.php'>Class Attendance Record</a></li>
						<li><a href='#'>Student Attendance Record</a></li>
						<li>
				<a href="#" class ="feed-btn">Feedback
					<span class="fas fa-caret-down second"></span>
				</a>
					<ul class="feed-show">
					<li><a href="../feedback/feedback.php">Feedback Review</a></li>
					<li><a href="../feedback/feedback_history.php">View Feedback History</a></li>
				</ul>
				</li>
						<li><a href="../../logout.php">Logout</a></li>
					</ul>
				</nav>
		
				<script>
		$('.btn').click(function(){
			$(this).toggleClass("click");
			$('.sidebar').toggleClass("show");
		});
		

		$('.feed-btn').click(function(){
			$('nav ul .feed-show').toggleClass("show1");
			$('nav ul .first').toggleClass("rotate");
		});
		$('nav ul li').click(function(){
			$(this).addClass("active").siblings().removeClass("active");
		});
			
		</script>	
				
			<div class="box">
				<h2>Student Attendance Record</h2>		
				<input type="text" id="SearchBoxTP" onkeyup="SearchTP()" placeholder="Search by StudentTP."><br><br>
			
				<div class='scroll-table'>
					<table border = 1 style = 'text-align: center; width: 900px; font-size:25px;' id="Student_List" >
						<tr bgcolor = 'f8fca2'>
							<th>StudentTP</th>
							<th>StudentName</th>
							<th>Attendance Rate</th>
							<th>Warning Letter</th>
						</tr>
						
						<?php
						$sql = "Select * from student ORDER BY StudentTP";
						$result = $conn ->query($sql);
						

						if (!empty($result) && $result->num_rows > 0) {
							for ($i = 0; $i < mysqli_num_rows($result); $i++){
								$row  = mysqli_fetch_assoc($result);
								
								$sql2 = "SELECT COUNT(StudentTP) as Total_Class from attendance_detail where StudentTP  = '".$row['StudentTP']."'";
								$result2 = $conn ->query($sql2);
								$row2  = mysqli_fetch_assoc($result2);
								$Total_Class = $row2['Total_Class'];
								
								$sql3 = "SELECT COUNT(Attend_Status) as Present_Amount from attendance_detail where StudentTP  = '".$row['StudentTP']."' AND Attend_Status='Present'";
								$result3 = $conn ->query($sql3);
								$row3  = mysqli_fetch_assoc($result3);
								$Present_Amount = $row3['Present_Amount'];
											
								if ($Total_Class == 0) {
									$Percentage = 0;
								} else {
									$Percentage = round((($Present_Amount / $Total_Class) * 100), 1);
								}
								
								
								echo '<tr>';
								echo '<td><a href = "attendance_student_details.php?StudentTP='.$row['StudentTP'].'">'.$row['StudentTP'].'</a></td>'; 
								echo '<td>'.$row['StudentName'].'</td>'; 
								echo '<td>'.$Present_Amount.' / '.$Total_Class.' ( '.$Percentage.'%)</td>';
								echo '<td><button class="editbutton" onclick="Send_email()">Send email</button></td>';
								echo '</tr>';	

								echo '<input type="hidden" id = "StudentTP" value= "'.$row['StudentTP'].'" >';
							}
						}
						
						?>
						
					</table>
				</div>
			
			<script>
			function SearchTP() {
			  var input, filter, table, tr, td, i, txtValue;
			  input = document.getElementById("SearchBoxTP");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("Student_List");
			  tr = table.getElementsByTagName("tr");
			  for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[0];
				if (td) {
				  txtValue = td.textContent || td.innerText;
				  if (txtValue.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				  } else {
					tr[i].style.display = "none";
				  }
				}       
			  }
			}
			</script>
			
			<script>
			function Send_email() {
				
				var StudentTP, text;
				StudentTP = document.getElementById("StudentTP").value;
				window.open('mailto:' + StudentTP + '@MGAcademy.com?subject=Warning Letter &body=Dear Student, %0D%0A %0D%0AWe observe that you have low attendance rate which below 80%. This letter is to inform you that remember to attend classes before getting kicked out by the MGAcademy. Thanks for your cooperation. %0D%0A %0D%0ARegards, %0D%0AMGACADEMY %0D%0A %0D%0AThis is only for assignment purposes. If your are a real account, we apologies and just ignore this email. Thanks :) %0D%0A %0D%0A');
			}
			</script>
		</div>
	</body>
</html>