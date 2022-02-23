  <?php
	
	session_start();
	
	
	if (isset($_SESSION["management_login"])) {
	} else {
		header("location: ../login.php");
	}

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .="/sdp/db_connection.php";
	include_once($path);
	
	$name = $_SESSION["Staff_Name"];
	
 ?>
 
 
 <!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Management Staff Homepage</title>
		<link href = "management.css" rel = "stylesheet" >
		<link rel = "icon" href ="../logo.png" type = "image/x-icon"> 
		<script src = "jvscript.js"></script>
		<script src = "jvscript2.js"></script>
	</head>
	
	<body>
		<div class ="btn">
			<span class ="fas fa-bars"></span>
		</div>
		
		<nav class = "sidebar">
			<div class ="text">MG Academy</div>
			<ul>
				<li><a href ="#">Homepage</a></li>
				<li><a href='profile/manage_profile.php'>Manage Profile</a></li>
				<li><a href='attendance/attendance_class.php'>Class Attendance Record</a></li>
				<li><a href='attendance/attendance_student.php'>Student Attendance Record</a></li>
				<li>
				<a href="#" class ="feed-btn">Feedback
					<span class="fas fa-caret-down first"></span>
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
		

		$('.feed-btn').click(function(){
			$('nav ul .feed-show').toggleClass("show1");
			$('nav ul .first').toggleClass("rotate");
		});
		$('nav ul li').click(function(){
			$(this).addClass("active").siblings().removeClass("active");
		});
			
		</script>	
		
		<div class='title'>
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
			<p> © 2021 MG Academy  | All Rights Reserved.</p>
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


























