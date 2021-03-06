  <?php
	
	session_start();
	
	
	if (isset($_SESSION["lecturer_login"])) {
	} else {
		header("location: ../login.php");
	}

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	$name = $_SESSION["LecturerName"];
	
 ?>
 
 
  <!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Lecturer Homepage</title>
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
				<li><a href ="#">Overview</a></li>
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
		
			
			<div class = "title">
			<h2>Welcome <?php echo $name ?> to MG Academy Attendance System</h2>
			</div>
			
			<!-- Slideshow container -->
		<div class="slideshow-container">
		
			<!-- Full-width images with number and caption text -->

			<div class="mySlides fade">
				<div class="numbertext">1 / 3</div>
				<img src="img1.jpg" class="style_slideshow">
			</div>

			<div class="mySlides fade">
				<div class="numbertext">2 / 3</div>
				<img src="img2.jpeg" class="style_slideshow" >
			</div>

			<div class="mySlides fade">
				<div class="numbertext">3 / 3</div>
				<img src="img3.png" class="style_slideshow">
			</div>

			<!-- Next and previous buttons -->
			<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
			<a class="next" onclick="plusSlides(1)">&#10095;</a>
		</div>
		
			<!-- The dots/circles -->
			<div style="text-align:center">
				<span class="dot" onclick="currentSlide(1)"></span> 
				<span class="dot" onclick="currentSlide(2)"></span> 
				<span class="dot" onclick="currentSlide(3)"></span>
			</div>

		<br><br><br>
		
		<hr/>
		<div class='footer'>
			<p> ?? 2021 MG Academy  | All Rights Reserved.</p>
		</div>
		
		<script>
			var slideIndex = 1;
			showSlides(slideIndex);

			function plusSlides(n) {
			  showSlides(slideIndex += n);
			}

			function currentSlide(n) {
			  showSlides(slideIndex = n);
			}

			function showSlides(n) {
			  var i;
			  var slides = document.getElementsByClassName("mySlides");
			  var dots = document.getElementsByClassName("dot");
			  if (n > slides.length) {slideIndex = 1}    
			  if (n < 1) {slideIndex = slides.length}
			  for (i = 0; i < slides.length; i++) {
				  slides[i].style.display = "none";  
			  }
			  for (i = 0; i < dots.length; i++) {
				  dots[i].className = dots[i].className.replace(" active", "");
			  }
			  slides[slideIndex-1].style.display = "block";  
			  dots[slideIndex-1].className += " active";
			}
		</script>

	</body>
</html>	
	
	
	





