<?php
	session_start();
	if(!isset($_SESSION['roll']))
		header("location: home.php");
	if($_SESSION['visited'] == 1)
		header("location: result.php");
?>

<html>
	<head>
		<title>Examination Portal</title>
		<meta charset="utf-8">
		<link href="home.css" type="text/css" rel="stylesheet"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
		
	</head>
	
	<body>
		<nav class="navbar navbar-expand-sm d-flex justify-content-between bg-dark header">
			<h1 class = "title">Examination Portal</h1>
			<?php echo '<span id="rollno" style="text-align: right;">Logged in as '.$_SESSION['roll'].'<a href="logout.php"><button class="btn btn-primary" style="margin: 5px;">Log out</button></a></span>'; ?>
		</nav>
		
		<div class="container d-flex justify-content-center">
			<div class="col-sm-10 col-md-8 col-lg-6 bg-light shadow-lg" style="margin: 10px; border-radius: 5px;">
				<h2>Instructions Here</h2>
				<ul>
					<li>There will be 10 Objective type questions</li>
					<li>You have 10 minutes of time</li>
					<li>Timer will be start when you click on begin</li>
					<li>Each correct answer gives you 2 marks</li>
					<li>Every Incorrect answer costs 0.5 marks</li>
					<li>Unatempted Questions will not be evaluated</li>
					<li>You have only on atempt available</li>
					<li>After submission you can see your result</li>
					<li>Do not try to refresh the page when answering because it resets all your answers but timer will not start over again</li>
					
				</ul>
				<center><b>ALL THE BEST</b><br><br>
				<form action="question.php" method="post">
					<input type="submit" class="btn btn-primary" value="Begin">
				</form></center>
			</div>
		</div>
		
		<script src="home.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
	</body>
</html>